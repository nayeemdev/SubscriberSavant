<?php

namespace App\Services;

use App\DTO\SubscriberDTO;
use App\Http\Requests\CreateSubscriberRequest;
use App\Library\Mailerlite\Mailerlite;
use App\Models\ApiKey;
use App\Models\Subscriber;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class SubscriberService
{
    protected $mailerlite;
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->mailerlite = new Mailerlite($apiKey);
        $this->apiKey = $apiKey;
    }

    /**
     * @return bool
     * @throws GuzzleException
     */
    public function validateApiKey(): bool
    {
        $check = $this->mailerlite->authentication()->check();

        if ($check) {
            ApiKey::updateOrCreate(
                ['name' => 'mailerlite'],
                ['key' => $this->apiKey]
            );
        }

        return $check;
    }

    /**
     * @param  CreateSubscriberRequest  $request
     * @return bool
     * @throws GuzzleException
     */
    public function subscribe(CreateSubscriberRequest $request): bool
    {
        $subscriber = $this->mailerlite->subscribers()->create([
            'email' => $request->email,
            'name' => $request->name,
            'fields' => [
                'country' => $request->country,
            ],
        ]);

        if ($subscriber) {
            // if not exists, create new subscriber with subscriber id and email
            Subscriber::updateOrCreate(
                ['email' => $subscriber->email],
                ['subscriber_id' => $subscriber->id]
            );

            return true;
        }

        return false;
    }

    /**
     * @param  string  $subscriberId
     * @return bool
     * @throws GuzzleException
     */
    public function unsubscribe(string $subscriberId): bool
    {
        $this->mailerlite->subscribers()->delete($subscriberId);

        $subscriber = Subscriber::where('subscriber_id', $subscriberId)->first();
        if ($subscriber) {
            $subscriber->delete();
        }

        return true;
    }

    /**
     * @param  string  $subscriberId
     * @param  array  $data
     * @return bool
     * @throws GuzzleException
     */
    public function update(string $subscriberId, array $data): bool
    {
        $subscriber = $this->mailerlite->subscribers()->update($subscriberId, [
            'name' => $data['name'],
            'fields' => [
                'country' => $data['country'],
            ],
        ]);

        if ($subscriber) {
            return true;
        }

        return false;
    }

    /**
     * @param  string  $subscriberId
     * @return object
     * @throws GuzzleException
     */
    public function find(string $subscriberId): object
    {
        $subscriber = $this->mailerlite->subscribers()->find($subscriberId);

        return new SubscriberDTO(
            $subscriber->id,
            $subscriber->name,
            $subscriber->email,
            collect($subscriber->fields)->where('key', 'country')->first()->value,
        );
    }

    /**
     * @throws GuzzleException
     */
    public function datatable(Request $request)
    {
        $subscribers = $this->mailerlite
                            ->subscribers()
                            ->offset($request->get('start', 0))
                            ->limit($request->get('length', 10));

        $search = $request->get('search')['value'];

        if (!empty($search)) {
            $subscribers = $subscribers->search($search);
        } else {
            $subscribers = $subscribers->get();
        }

        $totalCount = $this->mailerlite->subscribers()->totalCount();
        $data = $this->getData($subscribers);

        $jsonData = [
            "draw"            => intval($request->get('draw')),
            "recordsTotal"    => $totalCount,
            "recordsFiltered" => count($data),
            "data"            => $data
        ];

        return json_encode($jsonData);
    }

    /**
     * @param $subscribers
     * @return array
     */
    public function getData($subscribers): array
    {
        $data = [];
        if (!empty($subscribers)) {
            foreach ($subscribers as $subscriber) {
                $editRoute = route('subscribers.edit', $subscriber->id);
                $deleteRoute = route('subscribers.destroy', $subscriber->id);
                $subscribedDate = new Carbon($subscriber->date_subscribe);

                $subs['name'] = $subscriber->name;
                $subs['email'] = '
                    <a href="'.$editRoute.'" class="text-decoration-none">'.$subscriber->email.'</a>
                ';
                $subs['country'] = collect($subscriber->fields)->where('key', 'country')->first()->value ?? '-';
                $subs['subscribe_date'] = $subscribedDate->format('d/m/Y');
                $subs['subscribe_time'] = $subscribedDate->format('H:i:s');
                $subs['actions'] = '
                        <form action="'.$deleteRoute.'" method="POST" class="d-inline-block">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger border-0 py-2">Delete</button>
                        </form>
                ';
                $data[] = $subs;
            }
        }
        return $data;
    }
}
