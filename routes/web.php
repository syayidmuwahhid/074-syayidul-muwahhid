<?php

use App\Helpers\Anyhelpers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('auth.welcome'))->name('welcome');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'signup']);

Route::name('admin.')->prefix('admin')->middleware('auth', 'auth-role:administrator')->group(function () {
    Route::get('/', [DashboardController::class, 'indexAdmin'])->name('dashboard');

    Route::Resource('users', UsersController::class);
    Route::patch('/users', [UsersController::class, 'changeStatus'])->name('users.change-status');

    Route::resource('transactions', TransactionController::class)->only('index', 'destroy');
});

Route::name('user.')->middleware(['auth', 'auth-role:user'])->group(function() {
    Route::get('/home', [DashboardController::class, 'indexUser'])->name('dashboard');

    Route::resource('transactions', TransactionController::class)->except('show', 'edit');

    Route::resource('files', FilesController::class)->only('store', 'destroy');

});

Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show')->middleware('auth');
Route::patch('/transactions', [TransactionController::class, 'changeStatus'])->name('transactions.change-status')->middleware('auth');

Route::get('/files', [FilesController::class, 'index'])->name('files.index')->middleware('auth');

Route::get('/profile', [UsersController::class, 'profile'])->name('profile.index')->middleware('auth');
Route::get('/profile/{id}', [UsersController::class, 'editProfile'])->name('profile.edit')->middleware('auth');
Route::put('/profile/{id}', [UsersController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

Route::get('/500-system-error', function() {
    return view('layouts.500');
})->name('error-500');

Route::fallback(function() {
    return view('layouts.404');
});
