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

    Route::name('test.')->prefix('test')->group(function (){

        Route::get('/', [
            \App\Http\Controllers\TestController::class,
            'index'
        ])->name('index');

        Route::post('/finish', [
            \App\Http\Controllers\TestController::class,
            'showFinish'
        ])->name('finish');

//        Route::post('/work-on-mistakes/{testId}', [
        Route::get('/work-on-mistakes', [
            \App\Http\Controllers\TestController::class,
            'showWorkOnMistakes'
        ])->name('work-on-mistakes');

        Route::get('/statistics', [
            \App\Http\Controllers\TestController::class,
            'showStatistics'
        ])->name('statistics');

    });

    Route::name('dashboard.')->group(function (){

        Route::get('/dashboard', [
            \App\Http\Controllers\DashboardController::class,
            'index'
        ])->name('index');

        Route::get('/dashboard/detailed', [
            \App\Http\Controllers\DashboardController::class,
            'showDetailed'
        ])->name('detailed');

    });

    Route::name('cabinet.')->group(function (){

        Route::get('/cabinet', [
            \App\Http\Controllers\CabinetController::class,
            'index'
        ])->name('index');

    });

    Route::name('profile.')->group(function (){

        Route::get('/profile', [
            \App\Http\Controllers\ProfileController::class,
            'index'
        ])->name('index');

    });

});
