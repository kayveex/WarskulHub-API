<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-teacher', [AuthController::class, 'registerAsTeacher'])->name('register-teacher');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

// Classes Routes
Route::get('/classes', [ClassesController::class, 'index']);
Route::get('/classes/{user_id}', [ClassesController::class, 'indexTeacher']);
Route::get('/classes/show/{class_id}', [ClassesController::class, 'show']);
Route::post('/classes/store',[ClassesController::class, 'store']);
Route::put('/classes/update/{class_id}', [ClassesController::class, 'update']);
Route::delete('/classes/delete/{class_id}', [ClassesController::class, 'destroy']);

// Students Routes
Route::get('/students', [StudentsController::class, 'index']);
Route::post('/students/store', [StudentsController::class, 'store']);
Route::put('/students/update/{student_id}', [StudentsController::class, 'update']);
Route::delete('/students/delete/{student_id}', [StudentsController::class, 'destroy']);
Route::get('/students/show/{student_id}', [StudentsController::class, 'show']);


