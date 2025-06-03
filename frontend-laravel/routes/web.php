<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;


    Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
    Route::patch('/events/{id}/toggle-status', [EventController::class, 'toggleStatus'])->name('admin.events.toggleStatus');
