<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ReviewController;

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
//     return redirect('/admin/home');
// });
Route::get('/', function () {
      return view('/welcome');
  });

Route::namespace("Admin")->prefix('admin')->group(function(){
    

    Route::namespace('Auth')->group(function(){
      Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
      Route::post('/login',[LoginController::class,'login']);
      Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
    });
      Route::get('/home',[HomeController::class,'index'])->name('admin.home');
      Route::get('/users',[UserController::class,'users'])->name('admin.users');
      Route::get('/deleteUser/{user_id}',[UserController::class,'deleteUser'])->name('admin.deleteUser');

      Route::get('/providers',[UserController::class,'providers'])->name('admin.providers');
      Route::get('/requestProviders',[UserController::class,'request_provider'])->name('admin.requestProviders');
      Route::get('/accept_provider/{provider_id}',[UserController::class,'accept_provider'])->name('admin.accept_provider');
      
      Route::get('/categories',[CategoryController::class,'categories'])->name('admin.categories');
      Route::post('/addCategory',[CategoryController::class,'addCategory'])->name('admin.addCategory');
      Route::post('/updatedCategory',[CategoryController::class,'updatedCategory'])->name('admin.updatedCategory');
      Route::get('/deleteCategory/{cat_id}',[CategoryController::class,'deleteCategory'])->name('admin.deleteCategory');
    

      Route::get('/questions',[QuestionController::class,'questions'])->name('admin.questions');
      Route::get('/reply/{id}',[QuestionController::class,'reply']);


      Route::get('/packages',[PackageController::class,'packages'])->name('admin.packages');
      Route::post('/addPackage',[PackageController::class,'addPackage']);
      Route::post('/updatePackage',[PackageController::class,'updatePackage']);
      Route::get('/deletePackage/{package_id}',[PackageController::class,'deletePackage']);



      Route::get('/subscribes',[SubscribeController::class,'subscribes'])->name('admin.subscribes');
      Route::get('/SubscribeRequest' , [ SubscribeController::class , 'SubscribeRequest'])->name('admin.SubscribeRequest');
      Route::get('/acceptSubscribe/{sub_id}' , [ SubscribeController::class , 'acceptSubscribe']);

      Route::get('/notifications',[NotificationController::class,'notifications'])->name('admin.notifications');

      
      Route::get('/reservations',[ReservationController::class,'reservations'])->name('admin.reservations');

      Route::get('/reviews',[ReviewController::class,'reviews'])->name('admin.reviews');

});