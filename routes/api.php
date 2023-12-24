<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\FileController;

use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);

// Route::middleware('auth:api')->group(function () {
Route::post('/signout', [AuthController::class, 'signout']);
Route::post('/refresh-token', [AuthController::class, 'refresh']);
// });

// Route::middleware('auth:api')->group(function () {
Route::get('/profile', [ProfileController::class, 'getProfile']);
// });

// Route::middleware('auth:api')->group(function () {
Route::get('/notifications', [NotificationController::class, 'getNotifications']);
Route::patch('/notifications/{notificationId}/read', [NotificationController::class, 'markNotificationAsRead']);
// });

// Route::middleware('auth:api')->group(function () {
Route::get('/tasks', [TaskController::class, 'index']);
Route::patch('/tasks/{taskId}', [TaskController::class, 'update']);
// });

// Route::middleware('auth:api')->group(function () {
Route::get('/presensi/status', [PresensiController::class, 'status']);
Route::patch('/presensi/create', [PresensiController::class, 'create']);
// });

// Route::middleware('auth:api')->group(function () {
Route::post('/file/upload', [FileController::class, 'upload']);
// });
