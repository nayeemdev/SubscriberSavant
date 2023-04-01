<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Services\SubscriberService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SubscriberController extends Controller
{
    private $subscriberService;

    public function __construct()
    {
        $this->subscriberService = new SubscriberService(getApiKey('mailerlite'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('subscribers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $jsonOfCountries = file_get_contents(database_path('resources/countries.json'));
        $countries = json_decode($jsonOfCountries, true);

        return view('subscribers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSubscriberRequest $request
     * @return RedirectResponse
     */
    public function store(CreateSubscriberRequest $request): RedirectResponse
    {
        try {
            $this->subscriberService->subscribe($request);

            return back()->with('success', 'Subscriber created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        } catch (GuzzleException $e) {
            return back()->with('error', $this->handleGuzzleException($e));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $subscriberId
     * @return View|RedirectResponse
     */
    public function edit(string $subscriberId)
    {
        try {
            $jsonOfCountries = file_get_contents(database_path('resources/countries.json'));
            $countries = json_decode($jsonOfCountries, true);
            $subscriber = $this->subscriberService->find($subscriberId);

            return view('subscribers.edit', compact('subscriber', 'countries'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        } catch (GuzzleException $e) {
            return back()->with('error', $this->handleGuzzleException($e));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubscriberRequest $request
     * @param string $subscriberId
     * @return RedirectResponse
     */
    public function update(UpdateSubscriberRequest $request, string $subscriberId): RedirectResponse
    {
        try {
            $this->subscriberService->update($subscriberId, $request->validated());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        } catch (GuzzleException $e) {
            return back()->with('error', $this->handleGuzzleException($e));
        }

        return redirect()->route('subscribers.index')->with('success', 'Subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $subscriberId
     * @return JsonResponse
     */
    public function destroy(string $subscriberId): JsonResponse
    {
        try {
            $this->subscriberService->unsubscribe($subscriberId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.'
            ]);
        } catch (GuzzleException $e) {
            return response()->json([
                'success' => false,
                'message' => $this->handleGuzzleException($e)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subscriber deleted successfully.'
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function json(Request $request)
    {
        return $this->subscriberService->datatable($request);
    }

    public function handleGuzzleException(\Exception $e): string
    {
        $code = $e->getCode();
        $message = $e->getMessage();

        if ($code === 0) {
            $message = 'Connection error';
        }

        if ($code === 401) {
            $message = 'Unauthorized';
        }

        if ($code === 404) {
            $message = 'Subscriber not found';
        }

        if ($code === 429) {
            $message = 'Too many requests, please try again later';
        }

        if ($code === 500) {
            $message = 'Internal server error';
        }

        return $message;
    }
}
