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

    Route::get('/', [
        \App\Http\Controllers\SubjectsController::class,
        'index'
    ]);

    Route::get('/change-lang/{lang}', [
        \App\Http\Controllers\SubjectsController::class,
        'changeLanguage'
    ])->name('change-lang');


});
