<?php

use App\Models\Admin;
use App\Models\Level;
use App\Models\AdminClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/classes', function(){
    
    $classes = Level::where('id', '!=', 1)->where(['status_id' => 1])->get();
    return response($classes, 200);
})->name('es.class.api');


Route::get('/teachers', function(){

    $teachers = Admin::where(['role_id' => 3])->where(['status_id' => 1])->get();
    return response($teachers, 200);

})->name('es.teacher.api');


Route::get('teacher_class/{id}', function($admin_id){

    $classes = AdminClass::join('classes', 'classes.id', '=', 'admin_class.class_id')
                            ->where(['admin_id' => $admin_id])
                            ->select('classes.name', 'classes.id')->get();
    return response($classes, 200);
})->name('es.teacher_class.api');