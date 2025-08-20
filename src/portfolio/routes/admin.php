<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TodoController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('login', [AdminController::class, 'authenticate'])->name('authenticate');

    Route::middleware('auth:admin')->group(function () {
        Route::resource('admins', AdminController::class)->except(['show', 'create', 'edit']);
        Route::resource('users', UserController::class)->except(['show', 'create', 'edit']);
        Route::resource('todos', TodoController::class)->except(['show', 'create', 'edit']);
    });
});
