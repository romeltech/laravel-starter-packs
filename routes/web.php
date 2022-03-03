<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

/**
 * Authenticaed User for VUEX
 */
Route::get('/auth_user', [UserController::class, 'getAuthenticatedUser'])->name('get.authenticated.user');
Auth::routes([
    'register' => false, // Registration Routes...
    //'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
Route::get('/', function () { return redirect('/d/dashboard');});
Route::get('/home', function () { return redirect('/d/dashboard');});
Route::group(['prefix'=>'d','as'=>'dashboard.', 'middleware' => 'auth'], function(){

    /**
     * vue-router pages
     */
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/{page}', [DashboardController::class, 'dashboard']);
    Route::get('/{page}/{action}', [DashboardController::class, 'dashboard']);

    /**
     * Users
     */
    Route::get('/user/edit/{id}', [DashboardController::class, 'dashboard'])->name('user.edit');
    Route::get('/user/get/all', [UserController::class, 'getAllUsers'])->name('user.get.all');
    Route::get('/user/get/{id}', [UserController::class, 'getSingleUser'])->name('user.get.single');
    Route::post('/user/status/update', [UserController::class, 'updateUserStatus'])->name('user.status.update');
    Route::post('/user/save', [UserController::class, 'saveUserData'])->name('user.save.data');
    Route::post('/user/check/email', [UserController::class, 'checkEmail'])->name('user.check.email');
    Route::post('/user/changepassword', [UserController::class, 'changePassword'])->name('user.change.password');
});
