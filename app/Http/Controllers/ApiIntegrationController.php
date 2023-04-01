<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiIntegrationRequest;
use App\Services\SubscriberService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ApiIntegrationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(): View
    {
        return view('api-integration.validate');
    }

    /**
     * Validate the API key.
     *
     * @param  ApiIntegrationRequest  $request
     * @return RedirectResponse
     */
    public function apiValidate(ApiIntegrationRequest $request): RedirectResponse
    {
        try {
            $subscriberService = new SubscriberService($request->api_key);

            if ($subscriberService->validateApiKey()) {
                return back()->with('success', 'Key is valid and ready to use. You can subscribe to the newsletter.');
            }
        } catch (\Exception|GuzzleException $e) {
            Log::error($e->getMessage());
        }

        return back()->with('error', 'API key is not valid.');
    }
}
