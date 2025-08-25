<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Dashboard\Admin\AssignmentController as AdminAssignmentController;
use App\Http\Controllers\Dashboard\Admin\AssignmentSubmissionController as AdminAssignmentSubmissionController;
use App\Http\Controllers\Dashboard\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Dashboard\Admin\ComplainController as AdminComplainController;
use App\Http\Controllers\Dashboard\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Dashboard\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Dashboard\Admin\LiveClassController as AdminLiveClassController;
use App\Http\Controllers\Dashboard\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Dashboard\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Dashboard\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dashboard\Admin\LiveClassMethodController as AdminLiveClassMethodController;
use App\Http\Controllers\Dashboard\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Dashboard\Admin\OptionController as AdminOptionController;

Route::prefix('master')->middleware('auth:admin', 'auth')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profile/update', [AdminProfileController::class, 'update_profile'])->name('admin.profile_update');
    Route::patch('/password/update', [AdminProfileController::class, 'update_password'])->name('admin.password_update');
    Route::patch('/profile-image/update', [AdminProfileController::class, 'update_profile_image'])->name('admin.profile_image_update');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::get('/student', [AdminStudentController::class, 'index'])->name('admin.student');
    Route::get('/student/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
    Route::post('/student/store', [AdminStudentController::class, 'store'])->name('admin.student.store');
    Route::get('/student/{id}', [AdminStudentController::class, 'get_students'])->name('admin.student.class');
    Route::get('/student/edit/{id}', [AdminStudentController::class, 'edit'])->name('admin.student.edit');
    Route::delete('/student/delete/{id}', [AdminStudentController::class, 'delete'])->name('admin.student.delete');
    Route::get('/student/activate/{id}', [AdminStudentController::class, 'activate'])->name('admin.student.activate');
    Route::get('/student/deacivate/{id}', [AdminStudentController::class, 'deactivate'])->name('admin.student.deactivate');
    Route::put('/student/update/{id}', [AdminStudentController::class, 'update'])->name('admin.student.update');
    Route::patch('/student/update_profile/{id}', [AdminStudentController::class, 'update_profile_image'])->name('admin.student.update_profile_image');
    Route::patch('/student/update_password/{id}', [AdminStudentController::class, 'update_password'])->name('admin.student.update_password');

    Route::get('/teacher', [AdminTeacherController::class, 'index'])->name('admin.teacher');
    Route::get('/teacher/create', [AdminTeacherController::class, 'create'])->name('admin.teacher.create');
    Route::post('/teacher/store', [AdminTeacherController::class, 'store'])->name('admin.teacher.store');
    Route::get('/teacher/edit/{id}', [AdminTeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::get('/teacher/activate/{id}', [AdminTeacherController::class, 'activate'])->name('admin.teacher.activate');
    Route::get('/teacher/deactivate/{id}', [AdminTeacherController::class, 'deactivate'])->name('admin.teacher.deactivate');
    Route::delete('/teacher/delete/{id}', [AdminTeacherController::class, 'delete'])->name('admin.teacher.delete');
    Route::put('/teacher/update/{id}', [AdminTeacherController::class, 'update'])->name('admin.teacher.update');
    Route::patch('/teacher/update_profile/{id}', [AdminTeacherController::class, 'update_profile_image'])->name('admin.teacher.update_profile_image');
    Route::patch('/teacher/update_password/{id}', [AdminTeacherController::class, 'update_password'])->name('admin.teacher.update_password');
    Route::get('/teacher/assign/{id}', [AdminTeacherController::class, 'assign'])->name('admin.teacher.assign');
    Route::post('/teacher/assign', [AdminTeacherController::class, 'saveAsign'])->name('admin.teacher.save_assign');

    Route::get('/course', [AdminCourseController::class, 'index'])->name('admin.course');
    Route::get('/course/create', [AdminCourseController::class, 'create'])->name('admin.course.create');
    Route::post('/course/store', [AdminCourseController::class, 'store'])->name('admin.course.store');
    Route::get('/course/edit/{id}', [AdminCourseController::class, 'edit'])->name('admin.course.edit');
    Route::patch('/course/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.update');
    Route::get('/course/activate/{id}', [AdminCourseController::class, 'activate'])->name('admin.course.activate');
    Route::get('/course/deactivate/{id}', [AdminCourseController::class, 'deactivate'])->name('admin.course.deactivate');
    Route::delete('/course/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.course.delete');


    Route::get('/class', [AdminClassController::class, 'index'])->name('admin.class');
    Route::get('/class/create', [AdminClassController::class, 'create'])->name('admin.class.create');
    Route::post('/class/store', [AdminClassController::class, 'store'])->name('admin.class.store');
    Route::get('/class/edit/{id}', [AdminClassController::class, 'edit'])->name('admin.class.edit');
    Route::patch('/class/update/{id}', [AdminClassController::class, 'update'])->name('admin.class.update');
    Route::get('/class/activate/{id}', [AdminClassController::class, 'activate'])->name('admin.class.activate');
    Route::get('/class/deactivate/{id}', [AdminClassController::class, 'deactivate'])->name('admin.class.deactivate');
    Route::delete('/class/delete/{id}', [AdminClassController::class, 'delete'])->name('admin.class.delete');


    Route::get('/complain', [AdminComplainController::class, 'index'])->name('admin.complain');
    Route::get('/complain/edit/{id}', [AdminComplainController::class, 'edit'])->name('admin.complain.edit');
    Route::patch('/complain/update/{id}', [AdminComplainController::class, 'update'])->name('admin.complain.update');
    Route::get('/complain/activate/{id}', [AdminComplainController::class, 'activate'])->name('admin.complain.activate');
    Route::get('/complain/deactivate/{id}', [AdminComplainController::class, 'deactivate'])->name('admin.complain.deactivate');
    Route::delete('/complain/delete/{id}', [AdminComplainController::class, 'delete'])->name('admin.complain.delete');
    Route::get('/complain/view/{id}', [AdminComplainController::class, 'view'])->name('admin.complain.view');
    Route::post('/complain/reply', [AdminComplainController::class, 'reply'])->name('admin.complain.reply');


    Route::get('/liveclass', [AdminLiveClassController::class, 'index'])->name('admin.liveclass');
    Route::get('/liveclass/create', [AdminLiveClassController::class, 'create'])->name('admin.liveclass.create');
    Route::post('/liveclass/store', [AdminLiveClassController::class, 'store'])->name('admin.liveclass.store');
    Route::get('/liveclass/edit/{id}', [AdminLiveClassController::class, 'edit'])->name('admin.liveclass.edit');
    Route::patch('/liveclass/update/{id}', [AdminLiveClassController::class, 'update'])->name('admin.liveclass.update');
    Route::get('/liveclass/activate/{id}', [AdminLiveClassController::class, 'activate'])->name('admin.liveclass.activate');
    Route::get('/liveclass/deactivate/{id}', [AdminLiveClassController::class, 'deactivate'])->name('admin.liveclass.deactivate');
    Route::delete('/liveclass/delete/{id}', [AdminLiveClassController::class, 'delete'])->name('admin.liveclass.delete');


    Route::get('/live_class_method', [AdminLiveClassMethodController::class, 'index'])->name('admin.live_class_method');
    Route::get('/live_class_method/create', [AdminLiveClassMethodController::class, 'create'])->name('admin.live_class_method.create');
    Route::post('/live_class_method/store', [AdminLiveClassMethodController::class, 'store'])->name('admin.live_class_method.store');
    Route::get('/live_class_method/edit/{id}', [AdminLiveClassMethodController::class, 'edit'])->name('admin.live_class_method.edit');
    Route::patch('/live_class_method/update/{id}', [AdminLiveClassMethodController::class, 'update'])->name('admin.live_class_method.update');
    Route::get('/live_class_method/activate/{id}', [AdminLiveClassMethodController::class, 'activate'])->name('admin.live_class_method.activate');
    Route::get('/live_class_method/deactivate/{id}', [AdminLiveClassMethodController::class, 'deactivate'])->name('admin.live_class_method.deactivate');
    Route::delete('/live_class_method/delete/{id}', [AdminLiveClassMethodController::class, 'delete'])->name('admin.live_class_method.delete');


    Route::get('/assignment', [AdminAssignmentController::class, 'index'])->name('admin.assignment');
    Route::get('/assignment/create', [AdminAssignmentController::class, 'create'])->name('admin.assignment.create');
    Route::post('/assignment/store', [AdminAssignmentController::class, 'store'])->name('admin.assignment.store');
    Route::get('/assignment/edit/{id}', [AdminAssignmentController::class, 'edit'])->name('admin.assignment.edit');
    Route::patch('/assignment/update/{id}', [AdminAssignmentController::class, 'update'])->name('admin.assignment.update');
    Route::get('/assignment/activate/{id}', [AdminAssignmentController::class, 'activate'])->name('admin.assignment.activate');
    Route::get('/assignment/deactivate/{id}', [AdminAssignmentController::class, 'deactivate'])->name('admin.assignment.deactivate');
    Route::delete('/assignment/delete/{id}', [AdminAssignmentController::class, 'delete'])->name('admin.assignment.delete');


    Route::get('/assignment_submission', [AdminAssignmentSubmissionController::class, 'index'])->name('admin.assignment.submissions');
    Route::get('/assignment_submission/assignment/{id}', [AdminAssignmentSubmissionController::class, 'assignment'])->name('admin.assignment.submissions_assignment');
    Route::delete('/assignment_submission/delete/{id}', [AdminAssignmentSubmissionController::class, 'delete'])->name('admin.assignment.delete');
    Route::get('/assignment_submission/view/{id}', [AdminAssignmentSubmissionController::class, 'view'])->name('admin.assignment.submission_view');


    Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance');
    Route::get('/attendance/class/{id}', [AdminAttendanceController::class, 'attendance_date'])->name('admin.attendance.date');
    Route::get('/attendance/view/{id}/{date}', [AdminAttendanceController::class, 'view'])->name('admin.attendance.view');
    Route::get('/attendance/mark', [AdminAttendanceController::class, 'mark'])->name('admin.attendance.mark');
    Route::get('/attendance/mark/{id}', [AdminAttendanceController::class, 'mark_class'])->name('admin.attendance.mark_class');
    Route::post('/attendance/mark/class', [AdminAttendanceController::class, 'mark_store'])->name('admin.attendance.mark_store');


    Route::get('/settings', [AdminOptionController::class, 'index'])->name('admin.option');
    Route::patch('/settings/update', [AdminOptionController::class, 'update'])->name('admin.option.update');


});
