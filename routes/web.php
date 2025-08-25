<?php

use App\Exceptions\FIleNotFoundException;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');
Route::redirect('login', 'student', 301);


if(file_exists(__DIR__ . '/auth.php')){
    require __DIR__ . '/auth.php';
}else{
    throw new FIleNotFoundException("Auth Route File Not Found");
}



if(file_exists(__DIR__ . '/admin.php')){
    require __DIR__ . '/admin.php';
}else{
    throw new FIleNotFoundException("Admin Route File Not Found");
}


if(file_exists(__DIR__ . '/user.php')){
    require __DIR__ . '/user.php';
}else{
    throw new FIleNotFoundException("User Route File Not Found");
}
