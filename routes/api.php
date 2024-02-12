<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LegalAdviceController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\ReservationController ;
use App\Http\Controllers\Api\ChatController ;
use App\Http\Controllers\Api\ReviewController ;
use App\Http\Controllers\Api\UserController ;
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
Route::group([ 'middleware' => 'api' , 'prefix' => 'auth' ] , function() {
    Route::post('/register' , [ AuthController::class , 'register']);
    Route::post('/login' , [ AuthController::class , 'login']);
    Route::post('/logout' , [ AuthController::class , 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
Route::get('/categories' , [ CategoryController::class , 'categories']);


Route::post('/addQuestion' , [ LegalAdviceController::class , 'addQuestion']);
Route::post('/myQusetion' , [ LegalAdviceController::class , 'myQusetion']);
Route::post('/replyQuestion' , [ LegalAdviceController::class , 'replyQuestion']);
Route::post('/notifications' , [ LegalAdviceController::class , 'notifications']);


Route::post('/providerLegalAdvice' , [ LegalAdviceController::class , 'providerLegalAdvice']);
Route::post('/providerReplies' , [ LegalAdviceController::class , 'providerReplies']);
Route::post('/detailsQuestion' , [ LegalAdviceController::class , 'detailsQuestion']);
Route::post('/searchProvider' , [ LegalAdviceController::class , 'searchProvider']);

Route::post('/subscribe' , [ SubscribeController::class , 'subscribe']);
Route::get('/packages' , [ SubscribeController::class , 'packages']);
Route::post('/addPost' , [ SubscribeController::class , 'addPost']);

Route::post('/reserve' , [ ReservationController::class , 'reserve']);
Route::post('/provider_reservation' , [ ReservationController::class , 'provider_reservation']);
Route::post('/accept_reservation' , [ ReservationController::class , 'accept_reservation']);


Route::post('/addReview' , [ ReviewController::class , 'addReview']);

Route::get('/myProfile/{id}' , [ UserController::class , 'myProfile']);