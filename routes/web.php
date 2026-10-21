<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [PageController::class, 'hello']);
Route::get('/about', [PageController::class, 'about']);

use App\Http\Controllers\TaskController;
Route::resource('tasks', TaskController::class)->only([
    'index', 'store', 'destroy'
]);

Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');