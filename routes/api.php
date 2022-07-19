<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionController;

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

Route::get('show-suggestions/{user_id}', [ConnectionController::class, 'getSuggestions']);
Route::get('connect/{user_id}/{sec_user}', [ConnectionController::class, 'connect']);

Route::get('send-requests/{user_id}', [ConnectionController::class, 'sendRequest']);
Route::get('withdraw/{user_id}/{sec_user}', [ConnectionController::class, 'withdraw']);

Route::get('received-requests/{user_id}', [ConnectionController::class, 'receivedRequest']);
Route::get('accept/{user_id}/{sec_user}', [ConnectionController::class, 'accept']);

Route::get('connections/{user_id}', [ConnectionController::class, 'connections']);
Route::get('remove/{user_id}/{sec_user}', [ConnectionController::class, 'remove']);

Route::get('common-connections/{user_id}/{sec_user}', [ConnectionController::class, 'commonConnections']);
