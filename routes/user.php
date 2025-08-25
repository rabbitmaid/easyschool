<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Student\ProfileController;
use App\Http\Controllers\Dashboard\Student\ComplainController;
use App\Http\Controllers\Dashboard\Student\DashboardController;
use App\Http\Controllers\Dashboard\Student\LiveClassController;
use App\Http\Controllers\Authentication\Student\LoginController;
use App\Http\Controllers\Dashboard\Student\AssignmentController;



Route::prefix('student')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('student.profile');
    Route::put('/profile/update', [ProfileController::class, 'update_profile'])->name('student.profile_update');
    Route::patch('/password/update', [ProfileController::class, 'update_password'])->name('student.password_update');
    Route::patch('/profile-image/update', [ProfileController::class, 'update_profile_image'])->name('student.profile_image_update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('student.logout');

    Route::get('/complain', [ComplainController::class, 'index'])->name('student.complain');
    Route::get('/complain/create', [ComplainController::class, 'create'])->name('student.complain.create');
    Route::post('/complain/store', [ComplainController::class, 'store'])->name('student.complain.store');
    Route::get('/complain/edit/{id}', [ComplainController::class, 'edit'])->name('student.complain.edit');
    Route::patch('/complain/update/{id}', [ComplainController::class, 'update'])->name('student.complain.update');
    Route::get('/complain/view/{id}', [ComplainController::class, 'view'])->name('student.complain.view');

    Route::get('/assignment', [AssignmentController::class, 'index'])->name('student.assignment');
    Route::get('/assignment/view/{id}', [AssignmentController::class, 'view'])->name('student.assignment.view');
    Route::get('/assignment/submit/{id}', [AssignmentController::class, 'submit'])->name('student.assignment.submit');
    Route::post('/assignment/submit', [AssignmentController::class, 'submit_store'])->name('student.assignment.submit_store');

    Route::get('/liveclass', [LiveClassController::class, 'index'])->name('student.liveclass');
    Route::get('/liveclass/view/{id}', [LiveClassController::class, 'view'])->name('student.liveclass.view');
});
