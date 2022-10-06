<?php

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


Route::get('/clients', [ClientsController::class, 'clients']);

Route::get('/clients/{id}', [ClientsController::class, 'clientById']);

Route::post('/clients', [ClientsController::class, 'postClient']);

Route::put('/client/update/{id}', [ClientsController::class, 'updateClient']);

Route::get('/items', [ItemsController::class, 'listItems']);

Route::post('/items', [ItemsController::class, 'postItem']);

Route::put('/items/update/{id}', [ItemsController::class, 'updateItem']);

Route::delete('/items/delete/{id}', [ClientsController::class, 'deleteItem']);

Route::get('loan-request', [loanRequestController::class, 'getLoansRequest']);

Route::put('/loan-request/update/{id}', [loanRequestController::class, 'updateLoansRequest']);