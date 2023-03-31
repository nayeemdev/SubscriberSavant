<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ApiIntegrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('subscribers', SubscriberController::class)->except(['show']);
Route::get('api-integration', [ApiIntegrationController::class, 'show'])->name('integration.show');
Route::post('api-integration', [ApiIntegrationController::class, 'apiValidate'])->name('integration.validate');

Route::redirect('/', route('subscribers.create'));
