<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SessionController;

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
Route::patch('/events/{id}/toggle-status', [EventController::class, 'toggleStatus'])->name('admin.events.toggleStatus');

// Session
Route::get('/events/{event_id}/sessions', [SessionController::class, 'index'])->name('admin.sessions.index');
Route::get('/events/{event_id}/sessions/create', [SessionController::class, 'create'])->name('admin.sessions.create');
Route::post('/events/{event_id}/sessions', [SessionController::class, 'store'])->name('admin.sessions.store');
Route::get('/sessions/{id}/edit', [SessionController::class, 'edit'])->name('admin.sessions.edit');
Route::put('/sessions/{id}', [SessionController::class, 'update'])->name('admin.sessions.update');
Route::delete('/sessions/{id}', [SessionController::class, 'destroy'])->name('admin.sessions.destroy');
Route::get('/admin/events/{event_id}/sessions', [SessionController::class, 'index'])->name('admin.sessions.index');
