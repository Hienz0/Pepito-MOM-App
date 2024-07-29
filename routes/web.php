<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [NotulenController::class, 'index'])->name('notulens.index');
    Route::get('/create', [NotulenController::class, 'create'])->name('notulens.create');
    Route::post('/store', [NotulenController::class, 'store'])->name('notulens.store');
    Route::get('/notulens/{id}', [NotulenController::class, 'show'])->name('notulens.show');
    Route::put('/notulens/tasks/{id}', [NotulenController::class, 'updateTask'])->name('notulens.updateTask');
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

// Authentication routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('aldyanqseven2@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
});

use App\Http\Controllers\EmailController;

Route::get('/send-welcome-email', [EmailController::class, 'sendWelcomeEmail']);


// reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
