<?php

use App\Http\Controllers\Web\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/test-payment', [PaymentController::class, 'testFunction']);
Route::post('/make-payment', [PaymentController::class, 'generatePayment']);
Route::get('/success-payment', [PaymentController::class, 'successPayment']);