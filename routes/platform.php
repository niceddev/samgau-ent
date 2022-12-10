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

//MustSubjects
Route::screen('/must-subjects', \App\Orchid\Screens\MustSubjects\IndexScreen::class)
    ->name('platform.must_subjects.index');

Route::screen('/must-subjects/form', \App\Orchid\Screens\MustSubjects\CreateScreen::class)
    ->name('platform.must_subjects.create');

Route::screen('/must-subjects/form/{mustSubject}', \App\Orchid\Screens\MustSubjects\EditScreen::class)
    ->name('platform.must_subjects.edit');

//Subjects
Route::screen('/subjects', \App\Orchid\Screens\Subjects\IndexScreen::class)
    ->name('platform.subjects.index');

Route::screen('/subjects/form', \App\Orchid\Screens\Subjects\CreateScreen::class)
    ->name('platform.subjects.create');

Route::screen('/subjects/form/{subject}', \App\Orchid\Screens\Subjects\EditScreen::class)
    ->name('platform.subjects.edit');

//Questions
Route::screen('/questions', \App\Orchid\Screens\Questions\IndexScreen::class)
    ->name('platform.questions.subjects.index');

Route::screen('/questions/{id}', \App\Orchid\Screens\Questions\QuestionsScreen::class)
    ->name('platform.questions.index');

Route::screen('/question/{question}', \App\Orchid\Screens\Questions\QuestionsEditScreen::class)
    ->name('platform.questions.edit');

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

