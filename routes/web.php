<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return inertia('Index/Index');
// });

Route::get('/', [IndexController::class, 'index'])->name('main');


// Authenticated users
Route::get('/message/create',[MessageController::class, 'create'])->name('message.create')->middleware('auth');
Route::post('/message',[MessageController::class, 'store'])->name('message.store')->middleware('auth');
Route::get('/message/complete',[MessageController::class, 'complete'])->name('message.complete')->middleware('auth');


// These are for public users
Route::get('/files/{secret}',[MessageController::class, 'show'])->name('files.show');
Route::get('/download/{secret}',[FileController::class, 'show'])->name('file.download');


// User Auth
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);

Route::get('/send-sms', [MessageController::class, 'sendSms']);