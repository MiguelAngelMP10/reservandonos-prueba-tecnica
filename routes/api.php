<?php

use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/likes', [LikeController::class, 'store']);

Route::get('/getPlacesByFilter', function (Request $request) {
    $mode = $request->get('mode');
    $page = $request->get('page');
    $response = \Illuminate\Support\Facades\Http::get("https://dev.reservandonos.com/api/places/getPlacesByFilter?mode=$mode&page=$page");
    return $response;
});

Route::get('getPlaceById/{id}', function (int $id) {
    $response = \Illuminate\Support\Facades\Http::get("https://dev.reservandonos.com/api/places/getPlaceById/$id");

    return $response;
});