<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobSeekerController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/jobs', function(){
    return view('jobs');
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/contact', function(){
    return view('contact');
});

//job_seeker routes
Route::get('/jobs', [JobSeekerController::class, 'jobs'])->name('jobs');



//employer routes 
Route::middleware(['auth:employer'])->group(function () {
    Route::get('/post_job', [JobPostingController::class, 'create'])->name('create');
    Route::get('/employer/manage_job', [JobPostingController::class, 'showPostedJobs'])->name('employer.jobs');
    Route::post('/submit_job', [JobPostingController::class, 'store'])->name('store');
    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    });
});




Route::middleware(['web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/jobSeekerRegister', [AuthController::class, 'jobSeekerRegister'])->name('jobSeekerRegister');
    Route::post('/jobSeekerRegister', [AuthController::class, 'jobSeekerRegistration'])->name('jobSeekerRegistration');

    Route::get('/employerRegister', [AuthController::class, 'employerRegister'])->name('employerRegister');
    Route::post('/employerRegister', [AuthController::class, 'employerRegistration'])->name('employerRegistration');
});

