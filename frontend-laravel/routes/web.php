<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;


Route::get('/', [EventController::class, 'guestIndex'])->name('guest.landing');

// Login
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::view('/login', 'login')->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/dashboard', [EventController::class, 'authIndex'])->name('dashboard');

// Admin
Route::get('/admin', [StatisticsController::class, 'adminIndex'])->name('admin.index');
Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UsersController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/', [UsersController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
Route::get('/admin/{roleId}', [UsersController::class, 'listByRole'])->name('admin.users.byRole');

// Profile
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

// Panitia
Route::get('/committee', [StatisticsController::class, 'panitiaIndex'])->name('committee.index');
Route::get('/events', [EventController::class, 'panitiaEventIndex'])->name('committee.events.index');
Route::get('/events/create', [EventController::class, 'panitiaCreate'])->name('committee.events.create');
Route::post('/events/create', [EventController::class, 'panitiaStore'])->name('committee.events.store');
Route::get('/events/{eventId}', [EventController::class, 'panitiaShow'])->name('committee.events.show');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{id}', [EventController::class, 'show'])->name('committee.events.show');
Route::post('/events/{id}/sessions', [EventController::class, 'addSession'])->name('committee.sessions.store');
