<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guest\GuestEventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;


Route::get('/', [GuestEventController::class, 'index'])->name('guest.landing');

// Login
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::view('/login', 'login')->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');



