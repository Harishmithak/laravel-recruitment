<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyuserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JobController;


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


Route::post('/companyusers', [CompanyuserController::class, 'store']);
Route::get('/companyusers/{id}', [CompanyuserController::class, 'show']); 
// Route::post('/users', [UserController::class, 'store']); 
// Route::get('/users/{id}', [UserController::class, 'show']); 
Route::post('/login', [LoginController::class, 'login']);


Route::get('/register', function () {
    return view('layouts.app');
});


Route::get('/jobs', [JobController::class, 'index']);
// Route::get('/users', [UserController::class, 'index']); 
 //Route::get('/users', 'UserController@index');

Route::post('/jobs', [JobController::class, 'store']);


Route::get('/jobs/{id}', [JobController::class, 'show']);


Route::put('/jobs/{id}', [JobController::class, 'update']);


Route::delete('/jobs/{id}', [JobController::class, 'softDelete']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

