<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->where('question', '[0-9]+')->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->where('question', '[0-9]+')->name('questions.destroy');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->where('question', '[0-9]+')->name('questions.edit');
});

Route::get('/questions/{question}', [QuestionController::class, 'show'])->where('question', '[0-9]+')->name('questions.show');

require __DIR__.'/auth.php';
