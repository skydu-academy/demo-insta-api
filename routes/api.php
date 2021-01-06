<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Routing\Router;
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

Route::get('info', function () { phpinfo(INFO_VARIABLES); });
Route::post('login')->uses(LoginController::class);
Route::post('token')->uses(TokenController::class);
Route::middleware('auth:sanctum')->namespace('App\Http\Controllers\Api')->group(function (Router $router) {
    $router->get('token/revoke')->uses('TokenController@revokeToken');
    $router->get('feed')->uses('FeedController');
    $router->resource('posts', 'PostController');
    $router->post('posts/{post}/like', 'PostController@updateLikes');
});
