<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPermissionController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/link-student',[StudentController::class,'linkStudent']);

    Route::post('/send-student-codes', [StudentController::class, 'sendCodes']);

    Route::prefix('/students/{student_id}')->group(function(){
        Route::get('/home', [HomeController::class,'index']);

        Route::get('/attendance',[AttendanceController::class,'index']);

        Route::get('/marks',[MarksController::class,'getMarks']);

        Route::get('/permissions',[StudentPermissionController::class,'index']);

        Route::post('/permissions',[StudentPermissionController::class,'store']);

        // Route::put('/permissions',[StudentPermissionController::class,'update']);
        // Route::delete('/permissions',[StudentPermissionController::class,'destroy']);

        Route::get('/notifications', [StudentController::class,'getNotifications']);

        Route::get('/books',[BookController::class,'index']);

        Route::get('/profile',[StudentController::class,'getStudentProfile']);
    });


    Route::post('/logout',[AuthController::class,'logout']);
});

Route::post('/events/behavior',[TestController::class,'behavior']);
Route::post('/events/aggression',[TestController::class,'aggression']);
Route::post('/events/kinematic',[TestController::class,'kinematic']);
Route::post('/checkpoints/store',[TestController::class,'checkpoints']);
Route::post('/reports/store',[TestController::class,'reports']);


