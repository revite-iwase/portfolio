<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('admins', AdminController::class)->only(['index', 'create', 'store']);
Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
