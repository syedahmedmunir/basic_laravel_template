<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;


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

    Route::group(['prefix'=>'/user'  , 'as'=>'user.'],function(){

        Route::get('/',[UsersController::class,'index'])->name('index');
        Route::get('/create',[UsersController::class,'create'])->name('create');
        Route::post('/store',[UsersController::class,'store'])->name('store');
        Route::get('/edit/{id}',[UsersController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[UsersController::class,'update'])->name('update');
        Route::get('/delete/{id}',[UsersController::class,'delete'])->name('delete');

    });

    Route::group(['prefix'=>'/role'  , 'as'=>'role.'],function(){

        Route::get('/',[RoleController::class,'index'])->name('index');
        Route::get('/create',[RoleController::class,'create'])->name('create');
        Route::post('/store',[RoleController::class,'store'])->name('store');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('edit');
        Route::post('/update/{id}',[RoleController::class,'update'])->name('update');
        Route::get('/delete/{id}',[RoleController::class,'delete'])->name('delete');

    });

    


});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
