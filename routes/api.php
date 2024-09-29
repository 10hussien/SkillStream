<?php

use App\Http\Controllers\ApprovedController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\VideoCourseController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('addProfile', [ProfileController::class, 'addProfile'])->name('addProfile');
    Route::get('showMyProfile', [ProfileController::class, 'showMyProfile'])->name('showMyProfile');
    Route::get('showProfile/{user_id}', [ProfileController::class, 'showProfile'])->name('showProfile');
    Route::post('updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::get('deleteProfile', [ProfileController::class, 'deleteProfile'])->name('deleteProfile');
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('addTeacher', [TeacherController::class, 'addTeacher'])->name('addTeacher');
    Route::get('showMyCV', [TeacherController::class, 'showMyCV'])->name('showMyCV');
    Route::get('showTeacher/{user_id}', [TeacherController::class, 'showTeacher'])->name('showTeacher');
    Route::get('showAllTeacher', [TeacherController::class, 'showAllTeacher'])->name('showAllTeacher');
    Route::post('updateTeacher', [TeacherController::class, 'updateTeacher'])->name('updateTeacher');
    Route::get('deleteTeacher', [TeacherController::class, 'deleteTeacher'])->name('deleteTeacher');
});

Route::middleware(['auth:sanctum', 'setapplang', 'owner'])->group(function () {
    Route::get('showTeacherNotAccept', [ApprovedController::class, 'showTeacherNotAccept']);
    Route::post('teacherAccept/{id}', [ApprovedController::class, 'teacherAccept']);
});

Route::middleware(['auth:sanctum', 'setapplang', 'teacher'])->group(function () {
    Route::post('addCourse', [CourseController::class, 'addCourse']);
    Route::post('updateCourse/{user_id}', [CourseController::class, 'updateCourse']);
    Route::get('deleteCourse/{user_id}', [CourseController::class, 'deleteCourse']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('showCourse/{id}', [CourseController::class, 'showCourse']);
    Route::get('showAllCoursesForTeacher/{user_id}', [CourseController::class, 'showAllCoursesForTeacher']);
});

Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('registerCourse/{id}', [UserCourseController::class, 'registerCourse']);
    Route::post('UsersRegisteredInTheCourse/{course_id}', [UserCourseController::class, 'UsersRegisteredInTheCourse']);
    Route::post('CoursesRegisteredByUsers/{user_id}', [UserCourseController::class, 'CoursesRegisteredByUsers']);
    Route::get('RegisterMyCourses', [UserCourseController::class, 'RegisterMyCourses']);
    Route::get('DeleteCourseRegistration/{course_id}', [UserCourseController::class, 'DeleteCourseRegistration']);
});

//add middleware
Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::post('addVideo/{course_id}', [VideoCourseController::class, 'addVideo']);
    Route::post('updateVideo/{video_course_id}', [VideoCourseController::class, 'updateVideo']);
    Route::get('deleteVideo/{video_course_id}', [VideoCourseController::class, 'deleteVideo']);
});


Route::middleware(['auth:sanctum', 'setapplang'])->group(function () {
    Route::get('showCourseVideo/{course_id}', [VideoCourseController::class, 'showCourseVideo']);
    Route::get('showAllVideoToTeacher/{user_id}', [VideoCourseController::class, 'showAllVideoToTeacher']);
});
