<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/admin', [UsersController::class, 'getAdminUsers'])->name('admin.admin');
