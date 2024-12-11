<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/menus', \App\Http\Controllers\MenuController::class);

Route::resource('/biodatas', \App\Http\Controllers\BiodataController::class);

Route::resource('/pesanans', \App\Http\Controllers\PesananController::class);

Route::resource('/transaksis', \App\Http\Controllers\TransaksiController::class);

Route::get('/get-snap-token/{transaksiId}', [PaymentController::class, 'getSnapToken']);
Route::post('/midtrans-notification', [PaymentController::class, 'notificationHandler']);

Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);
Route::post('/process-payment', [PaymentController::class, 'processPayment']);

// Login
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/absensis', [AbsensiController::class, 'index'])->name('absensis.index');
    Route::post('/absensis', [AbsensiController::class, 'store'])->name('absensis.store');
});


Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
});

Route::middleware([RoleMiddleware::class . ':admin,user'])->group(function () {
    Route::post('/create-post', [PostController::class, 'createPost']);
});
