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
use App\Http\Controllers\EmailController;

Route::get('/register', function () {
    return view('layouts.app');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
});

Route::controller(CompanyuserController::class)->group(function () {
    Route::post('/companyusers', 'store');
    Route::get('/companyusers/{id}', 'show');
});

Route::controller(CandidatedetailController::class)->group(function () {
    Route::post('/apply', 'store');
      Route::get('/candidatedetails/{userEmail}', 'getAllDetailsByEmail');
    Route::get('/candidatedetails/{id}/relationships','getDetailsWithRelationships');
});

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/alljobs', 'index1');
    Route::post('/jobs', 'store');
    // Route::get('/jobs/{id}', 'show');
    Route::get('/jobs/{id}', 'restore');
    Route::put('/jobs/{id}', 'update');
    Route::delete('/jobs/{id}', 'softDelete');
});

Route::controller(AcademicdetailController::class)->group(function () {
    Route::post('/academicdetail', 'store');
    Route::get('/academicdetails/{candidateId}','getByCandidateId' );
});

Route::controller(ExperienceController::class)->group(function () {
    Route::post('/experiencedetail','store');
    Route::get('/experiencedetails/{candidateId}',  'getByCandidateId');
});

Route::controller(EmailController::class)->group(function () {
    Route::post('/send-email/{email}/{shortlistReason}', 'sendEmail');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

