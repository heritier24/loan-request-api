<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\loanRequestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signin', [AuthenticationController::class, 'login']);


Route::get('/clients', [ClientsController::class, 'clients']);

Route::get('/clients/{id}', [ClientsController::class, 'clientById'])->whereNumber('id');

Route::post('/clients', [ClientsController::class, 'postClient']);

Route::put('/client/update/{id}', [ClientsController::class, 'updateClient'])->whereNumber('id');

Route::get('/items', [ItemsController::class, 'listItems']);

Route::post('/items', [ItemsController::class, 'postItem']);

Route::get('/items/{itemId}', [ItemsController::class, 'getItemByItemId'])->whereNumber('itemId');

Route::put('/items/update/{id}', [ItemsController::class, 'updateItem'])->whereNumber('id');

Route::delete('/items/delete/{id}', [ClientsController::class, 'deleteItem'])->whereNumber('id');

Route::get('loan-request', [loanRequestController::class, 'getLoansRequest']);

Route::post('loan-request', [loanRequestController::class, 'postLoansRequest']);

Route::put('/loan-request/update/{id}', [loanRequestController::class, 'updateLoansRequest'])->whereNumber('id');

Route::get('/count-request-statistics', [loanRequestController::class, 'getCountRequestStatistics']);