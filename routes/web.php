<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/change-lang/{lang}', [
    \App\Http\Controllers\MultiLanguageController::class,
    'changeLanguage'
])->name('change-lang');

Route::get('/send-code', [
    \App\Http\Controllers\MailController::class,
    'sendCode'
])->name('sendCode');

require __DIR__ . '/auth.php';

Route::middleware(['auth:ent', 'verified', 'language'])->group(function() {

    Route::get('/subjects', [
        \App\Http\Controllers\SubjectsController::class,
        'index'
    ])->name('subjects');

    Route::name('test.')->prefix('test')->group(function () {

        Route::get('/', [
            \App\Http\Controllers\Test\TestController::class,
            'index'
        ])->name('index');

        Route::post('/', [
            \App\Http\Controllers\Test\TestController::class,
            'store'
        ])->name('store');

    });

    Route::name('results.')->prefix('result')->group(function () {

        Route::get('/', [
            \App\Http\Controllers\Test\ResultController::class,
            'index'
        ])->name('index');

//        Route::post('/work-on-mistakes/{testId}', [
//        Route::get('/work-on-mistakes', [
//            \App\Http\Controllers\TestController::class,
//            'showWorkOnMistakes'
//        ])->name('work-on-mistakes');
//
//        Route::get('/statistics', [
//            \App\Http\Controllers\TestController::class,
//            'showStatistics'
//        ])->name('statistics');

    });

    Route::name('dashboard.')->prefix('dashboard')->group(function () {

        Route::get('/', [
            \App\Http\Controllers\Dashboard\DashboardController::class,
            'index'
        ])->name('index');

        Route::get('/detailed', [
            \App\Http\Controllers\Dashboard\DetailedController::class,
            'index'
        ])->name('detailed');

    });

    Route::name('cabinet.')->prefix('cabinet')->group(function () {

        Route::get('/', [
            \App\Http\Controllers\CabinetController::class,
            'index'
        ])->name('index');

    });

    Route::name('profile.')->prefix('profile')->group(function () {

        Route::get('/', [
            \App\Http\Controllers\ProfileController::class,
            'index'
        ])->name('index');

    });

});
