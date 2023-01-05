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

//Subjects
Route::screen('/subjects', \App\Orchid\Screens\Subjects\IndexScreen::class)
    ->name('platform.subjects.index');

//Questions
Route::screen('/subject/{id}/questions', \App\Orchid\Screens\Questions\IndexScreen::class)
    ->name('platform.subjects.questions.index');

Route::screen('/question/{subject}/create', \App\Orchid\Screens\Questions\CreateScreen::class)
    ->name('platform.question.create');

Route::screen('/question/{question}/edit', \App\Orchid\Screens\Questions\EditScreen::class)
    ->name('platform.question.edit');

//Students
Route::screen('/students', \App\Orchid\Screens\Students\IndexScreen::class)
    ->name('platform.students.index');

Route::screen('/students/form', \App\Orchid\Screens\Students\CreateScreen::class)
    ->name('platform.students.create');

Route::screen('/students/form/{student}', \App\Orchid\Screens\Students\EditScreen::class)
    ->name('platform.students.edit');

//Grades
Route::screen('/grades', \App\Orchid\Screens\Grades\IndexScreen::class)
    ->name('platform.grades.index');

Route::screen('/grades/form', \App\Orchid\Screens\Grades\CreateScreen::class)
    ->name('platform.grades.create');

Route::screen('/grades/form/{grade}', \App\Orchid\Screens\Grades\EditScreen::class)
    ->name('platform.grades.edit');

