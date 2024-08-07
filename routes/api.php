<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\StudentofclassController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TotalScoreController;
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

// Proker Routes
Route::get('/proker', [ProkerController::class, 'index']);
Route::get('/proker/{class_id}', [ProkerController::class, 'indexTeacher']);
Route::post('/proker/store', [ProkerController::class, 'store']);
Route::put('/proker/update/{proker_id}', [ProkerController::class, 'update']);
Route::delete('/proker/delete/{proker_id}', [ProkerController::class, 'destroy']);
Route::get('/proker/show/{proker_id}', [ProkerController::class, 'show']);

// Totalscore Routes
Route::get('/totalscore', [TotalScoreController::class, 'index']);
Route::get('/totalscore/{class_id}', [TotalScoreController::class, 'indexByClassId']);
Route::post('/totalscore/store', [TotalScoreController::class, 'store']);
Route::put('/totalscore/update/{totalscore_id}', [TotalScoreController::class, 'update']);
Route::delete('/totalscore/delete/{totalscore_id}', [TotalScoreController::class, 'destroy']);
Route::get('/totalscore/show/{totalscore_id}', [TotalScoreController::class, 'show']);

// Studentofclass Routes
Route::get('/studentofclass', [StudentofclassController::class, 'index']);
Route::get('/studentofclass/{class_id}', [StudentofclassController::class, 'indexByClassId']);
Route::post('/studentofclass/store', [StudentofclassController::class, 'store']);
Route::put('/studentofclass/update/{studentofclass_id}', [StudentofclassController::class, 'update']);
Route::delete('/studentofclass/delete/{studentofclass_id}', [StudentofclassController::class, 'destroy']);
Route::get('/studentofclass/show/{studentofclass_id}', [StudentofclassController::class, 'show']);
