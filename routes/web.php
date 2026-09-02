<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('school-years', 'school-years.index')
        ->name('school-years.index');

    Route::livewire('school-levels', 'school-levels.index')
        ->name('school-levels.index');
        
    Route::livewire('/school-classes', 'school-classes.index')
        ->name('school-classes.index');
        
    Route::livewire('/students', 'students.index')
        ->name('students.index');

    Route::livewire('/subjects', 'subjects.index')
        ->name('subjects.index');

    Route::livewire('/enrollments', 'enrollments.index')
        ->name('enrollments.index');

    Route::livewire('/grades', 'grades.index')
        ->name('grades.index');
});

require __DIR__.'/settings.php';