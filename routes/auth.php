<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['guest:ent', 'language'])->group(function () {

    Route::name('login.')->group(function () {
        Route::get('/login', [
            \App\Http\Controllers\Auth\LoginController::class,
            'create'
        ])->name('form');

        Route::post('/login', [
            \App\Http\Controllers\Auth\LoginController::class,
            'store'
        ])->name('store');
    });

});

Route::middleware('auth:ent')->group(function () {

    Route::get('/logout', [
        \App\Http\Controllers\Auth\LoginController::class,
        'destroy'
    ])->name('logout');

});
