<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SubscriberController extends Controller
{
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
        return view('subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return back()->with('success', 'Subscriber created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $subscriber_id
     * @return View
     */
    public function edit(string $subscriber_id): View
    {
        return view('subscribers.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $subscriber_id
     * @return RedirectResponse
     */
    public function update(Request $request, string $subscriber_id): RedirectResponse
    {
        return redirect()->route('subscribers.index')->with('success', 'Subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $subscriber_id
     * @return JsonResponse
     */
    public function destroy(string $subscriber_id): JsonResponse
    {
        return response()->json(['success' => 'Subscriber deleted successfully.']);
    }
}
