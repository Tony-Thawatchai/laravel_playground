<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('todos', [TodoController::class, 'index'])
        ->name('todos.index');



    Route::put('/todos/{id}/toggle-complete', [TodoController::class, 'toggleComplete'])->name('todos.toggle-complete');

    Route::get('todos/create', [TodoController::class, 'create'])
        ->name('todos.create');

    Route::post('todos/create', [TodoController::class, 'store'])
        ->name('todos.store');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
