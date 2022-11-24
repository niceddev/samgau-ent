<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

//Profiles
Route::screen('/profiles', \App\Orchid\Screens\Profiles\IndexScreen::class)
    ->name('platform.profiles.index');

Route::screen('/profiles/form', \App\Orchid\Screens\Profiles\CreateScreen::class)
    ->name('platform.profiles.create');

Route::screen('/profiles/form/{profile}', \App\Orchid\Screens\Profiles\EditScreen::class)
    ->name('platform.profiles.edit');

//Students
Route::screen('/students', \App\Orchid\Screens\Students\IndexScreen::class)
    ->name('platform.students.index');

Route::screen('/students/form', \App\Orchid\Screens\Students\CreateScreen::class)
    ->name('platform.students.create');

Route::screen('/students/form/{student}', \App\Orchid\Screens\Students\EditScreen::class)
    ->name('platform.students.edit');

//Classes
Route::screen('/classes', \App\Orchid\Screens\Classes\IndexScreen::class)
    ->name('platform.classes.index');

Route::screen('/classes/form', \App\Orchid\Screens\Classes\CreateScreen::class)
    ->name('platform.classes.create');

Route::screen('/classes/form/{class}', \App\Orchid\Screens\Classes\EditScreen::class)
    ->name('platform.classes.edit');
