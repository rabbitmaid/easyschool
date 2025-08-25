<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\Student\LoginController;
use App\Http\Controllers\Authentication\Student\RegisterController;
use App\Http\Controllers\Authentication\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Authentication\Admin\RegisterController as AdminRegisterController;


Route::prefix('student')->middleware('guest')->group(function () {

    Route::get('', function () {
        return redirect()->route('student.login');
    });

    Route::get('/login', [LoginController::class, 'login'])->name('student.login');
    Route::post('/auth', [LoginController::class, 'authenticate'])->name('student.auth');
    Route::get('/register', [RegisterController::class, 'register'])->name('student.register');
    Route::post('/create', [RegisterController::class, 'create'])->name('student.create');
});




Route::prefix('master')->middleware('guest.admin')->group(function () {

    Route::get('', function () {
        return redirect()->route('admin.login');
    });

    Route::get('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/auth', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    Route::get('/register', [AdminRegisterController::class, 'register'])->name('admin.register');
    Route::post('/create', [AdminRegisterController::class, 'create'])->name('admin.create');
});

