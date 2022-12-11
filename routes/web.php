<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/change-lang/{lang}', [
    \App\Http\Controllers\MultiLanguageController::class,
    'changeLanguage'
])->name('change-lang');

require __DIR__ . '/auth.php';

Route::middleware(['auth:ent', 'verified', 'language'])->group(function() {

    Route::get('/subjects', [
        \App\Http\Controllers\SubjectsController::class,
        'index'
    ])->name('subjects');

    Route::name('test.')->group(function (){

        Route::get('/test/{subject}', [
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

    Route::name('cabinet.')->group(function (){

        Route::get('/cabinet', [
            \App\Http\Controllers\CabinetController::class,
            'index'
        ])->name('index');

    });

});
