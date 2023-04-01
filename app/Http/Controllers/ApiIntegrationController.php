<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiIntegrationRequest;
use App\Services\SubscriberService;
use Illuminate\Http\RedirectResponse;
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
        $subscriberService = new SubscriberService($request->api_key);

        if ($subscriberService->validateApiKey()) {
            return back()->with('success', 'Key is valid and ready to use. You can now subscribe to the newsletter.');
        }

        return back()->with('error', 'API key is not valid.');
    }
}
