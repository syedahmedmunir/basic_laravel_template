<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;


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


Auth::routes();

Route::group(['middleware'=>'auth'], function(){

    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/user',[UsersController::class,'index'])->name('user.index');

    Route::get('/user/create',[UsersController::class,'create'])->name('user.create');

    Route::post('/user/store',[UsersController::class,'store'])->name('user.store');

    Route::get('/user/edit/{id}',[UsersController::class,'edit'])->name('user.edit');


    Route::post('/user/update/{id}',[UsersController::class,'update'])->name('user.update');

    Route::get('/user/delete/{id}',[UsersController::class,'delete'])->name('user.delete');


});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
