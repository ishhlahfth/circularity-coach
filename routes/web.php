<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\Web\PaymentController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test',  function() {
//     return view('testView');
// });
// Route::post('/make-payment', [PaymentControllerx::class, 'test']);

Route::get('/', [FrontController::class, 'index']);
Route::get('/login', [FrontController::class, 'login']);
Route::post('/request-login', [FrontController::class, 'submitLogin']);
Route::get('/logout', [FrontController::class, 'logout']);
