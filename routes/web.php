<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/jobSeekerRegister', [AuthController::class, 'jobSeekerRegister'])->name('jobSeekerRegister');
Route::get('/employerRegister', [AuthController::class, 'employerRegister'])->name('employerRegister');
