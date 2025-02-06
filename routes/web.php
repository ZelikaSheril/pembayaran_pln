<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserController;

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

