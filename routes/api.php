<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\FollowController;
use App\Http\Controllers\api\UsersFetchController;
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
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/signup', [AuthController::class, 'signup'])->name('user.signup');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/currentUser', [AuthController::class, 'currentUser']);
    Route::put('/updatePhoto', [AuthController::class, 'updatePhoto'])->name('user.updatePhoto');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/follow', [FollowController::class, 'index']);
    Route::post('/follow', [FollowController::class, 'follow']);
    Route::post('/unfollow', [FollowController::class, 'unfollow']);
    
    Route::get('/allUsers', [UsersFetchController::class, 'allUsers']);
    Route::get('/user/{id}', [UsersFetchController::class, 'User']);
    Route::get('/suggestedUsers', [UsersFetchController::class, 'suggestedUsers']);
    
});
