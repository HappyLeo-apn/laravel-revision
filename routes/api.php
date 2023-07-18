<?php


use App\Models\MyFriends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\apiFriends;
use App\Http\Controllers\MyFriendsController;
use App\Http\Controllers\CategoryApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/friends', [MyFriendsController::class, 'index']);
Route::post('friends', [MyFriendsController::class, 'store']);
Route::get('/friends/{id}', [MyFriendsController::class, 'show']);
Route::get('/friends/{id}/age', [MyFriendsController::class, 'showAge']);
Route::get('/friends/{id}/hobby', [MyFriendsController::class, 'showHobby']);

 //Route::apiResource('/categories', CategoryApiController::class);
Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
Route::post('/categories', [CategoryApiController::class, 'store']);
Route::patch('/categories/{id}', [CategoryApiController::class, 'update']);
Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy']);
