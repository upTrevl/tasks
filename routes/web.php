<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/task/create', function () {
        return Inertia\Inertia::render('TaskCreate');
    })->name('task.create');
    Route::put('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::put('/task/accept', [TaskController::class, 'accept'])->name('task.accept');
    Route::put('/task/close', [TaskController::class, 'close'])->name('task.close');
    Route::get('/tasks', function () {
        return Task::open()->get() ;
    })->name('tasks.get');
    Route::get('/tasks/archive', function () {
        return Task::close()->get() ;
    })->name('tasks.archive');
    Route::get('/task/show/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/archive/', [TaskController::class, 'showArchive'])->name('archive');
    Route::get('/search/{val}', [TaskController::class, 'search'])->name('search');
    Route::get('/notifications', [UserController::class, 'notifications'])->name('notifications');
});
