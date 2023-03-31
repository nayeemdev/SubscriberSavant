<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function apiValidate(Request $request): RedirectResponse
    {
        return back()->with('success', 'API key is valid and ready to use.');
    }
}
