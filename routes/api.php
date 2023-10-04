<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyuserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CandidatedetailController;
use App\Http\Controllers\AcademicdetailController;
use App\Http\Controllers\ExperienceController;

Route::get('/register', function () {
    return view('layouts.app');
});

Route::post('/companyusers', [CompanyuserController::class, 'store']);
Route::get('/companyusers/{id}', [CompanyuserController::class, 'show']); 

Route::post('/login', [LoginController::class, 'login']);

Route::post('/apply', [CandidatedetailController::class, 'store']);
Route::get('/candidatedetails', [CandidatedetailController::class, 'getAllDetails']);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/alljobs', [JobController::class, 'index1']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{id}', [JobController::class, 'show']);
Route::get('/job/{id}', [JobController::class, 'restore']);
Route::put('/jobs/{id}', [JobController::class, 'update']);
Route::delete('/jobs/{id}', [JobController::class, 'softDelete']);

Route::post('/academicdetail', [AcademicdetailController::class, 'store']);

Route::post('/experiencedetail', [ExperienceController::class,'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

