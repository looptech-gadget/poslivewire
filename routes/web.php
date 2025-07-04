<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PosController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::resource('users', UserController::class);

// Role Routes
Route::resource('roles', RoleController::class);

// Permission Routes
Route::resource('permissions', PermissionController::class);

// Settings Routes
Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
Route::post('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

// POS Routes
Route::get('/pos', function () {
    return view('pos.index');
})->name('pos.index')->middleware('auth');
