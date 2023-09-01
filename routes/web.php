<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AdminController;
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


Route::get('/contact', function(){
    return view('contact');
});

Route::get('/jobs', [JobSeekerController::class, 'jobs'])->name('jobs');
Route::get('/view_jobs/{id}', [JobSeekerController::class, 'viewJobs'])->name('viewJobs');

//job_seeker routes
Route::middleware(['auth:job_seeker'])->group(function () {
    
    Route::get('/profile', [JobSeekerController::class, 'profile'])->name('profile');
    Route::get('/applyJob/{id}', [JobSeekerController::class, 'applyJob'])->name('applyJob');
    Route::get('/appliedJobs',[JobSeekerController::class, 'appliedJobs'])->name('appliedJobs');
    Route::post('/jobSeekerUpdateProfile/{id}',[JobSeekerController::class, 'jobSeekerUpdateProfile'])->name('jobSeekerUpdateProfile');
    Route::post('/updateResume/{id}',[JobSeekerController::class, 'updateResume'])->name('updateResume');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/manage_posts', [AdminController::class, 'managePosts'])->name('managePosts');
    Route::get('/manage_users', [AdminController::class, 'manageUsers'])->name('manageUsers');
    Route::get('/disableJobs', [AdminController::class, 'disableJobs'])->name('disableJobs');
    Route::get('/disableEmp', [AdminController::class, 'disableEmp'])->name('disableEmp');
    Route::get('/activeJobs', [AdminController::class, 'activeJobs'])->name('activeJobs');
    Route::get('/activeEmp', [AdminController::class, 'activeEmp'])->name('activeEmp');
    Route::get('/activePosts', [AdminController::class, 'activePosts'])->name('activePosts');
    Route::get('/disablePosts', [AdminController::class, 'disablePosts'])->name('disablePosts');
    
});

//employer routes 
Route::middleware(['auth:employer'])->group(function () {

    Route::get('/employer/dashboard', [JobPostingController::class, 'showDashboard'])->name('employer.dashboard');
    Route::get('/post_job', [JobPostingController::class, 'create'])->name('create');
    Route::get('/employer/showjobs', [JobPostingController::class, 'showPostedJobs'])->name('employer.jobs');
    Route::post('/submit_job', [JobPostingController::class, 'store'])->name('store');
    Route::get('/employer/manage_posts', [JobPostingController::class, 'managePosts'])->name('employer.manage_posts');
    Route::get('/employer/edit_post/{id}', [JobPostingController::class, 'editPost'])->name('edit_post');
    Route::get('/employer/viewApplicants/{id}', [JobPostingController::class, 'viewApplicant'])->name('viewApplicant');
    Route::get('/employer/viewApplicantDetails/{id}', [JobPostingController::class, 'viewApplicantDetails'])->name('viewApplicantDetails');
    Route::put('/employer/update_post/{id}', [JobPostingController::class, 'updatePost'])->name('update_post');
    Route::get('/employer/delete_post/{id}', [JobPostingController::class, 'deletePost'])->name('delete_post');
    Route::get('/hireApplicant/{id}',[JobPostingController::class, 'hireApplicant'])->name('hire');
    Route::get('/rejectApplicant/{id}',[JobPostingController::class, 'rejectApplicant'])->name('reject');

});

Route::middleware(['web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/jobSeekerRegister', [AuthController::class, 'jobSeekerRegister'])->name('jobSeekerRegister');
    Route::post('/jobSeekerRegister', [AuthController::class, 'jobSeekerRegistration'])->name('jobSeekerRegistration');

    Route::get('/employerRegister', [AuthController::class, 'employerRegister'])->name('employerRegister');
    Route::post('/employerRegister', [AuthController::class, 'employerRegistration'])->name('employerRegistration');
    Route::get('/verificationMail', [AuthController::class, 'verificationMail'])->name('verificationMail');
    Route::post('/verificationMail', [AuthController::class, 'verifyMail'])->name('verifyMail');

});
    
Route::get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::get('/send-mail', [AuthController::class, 'sendMail'])->name('sendMail');
