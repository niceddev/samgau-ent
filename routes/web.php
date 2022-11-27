<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'language'], function() {

    Route::name('login.')->group(function (){

        Route::get('/login', [
            \App\Http\Controllers\LoginController::class,
            'index'
        ])->name('index');

        Route::post('/login', [
            \App\Http\Controllers\LoginController::class,
            'login'
        ])->name('auth');

    });

    Route::get('/subjects', [
        \App\Http\Controllers\SubjectsController::class,
        'index'
    ]);

    Route::name('test.')->group(function (){

        Route::get('/test', [
            \App\Http\Controllers\TestController::class,
            'index'
        ])->name('index');

    });

    Route::name('dashboard.')->group(function (){

        Route::get('/dashboard', [
            \App\Http\Controllers\DashboardController::class,
            'index'
        ])->name('index');

    });

    Route::get('/change-lang/{lang}', [
        \App\Http\Controllers\SubjectsController::class,
        'changeLanguage'
    ])->name('change-lang');


});
