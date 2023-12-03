<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddSurveyController;





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
    return view('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/survey/{id}', [SurveyController::class, 'index'])->name('survey');
Route::post('/answer', [AnswerController::class, 'store'])->name('answer');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::get('/add-survey', [AddSurveyController::class, 'create'])->name('survey.create');
Route::post('/survey/store', [AddSurveyController::class, 'store'])->name('survey.store');

Route::get('/survey/show/{id}', [SurveyController::class, 'show'])->name('show.survey');
Route::get('/admin/{id}', [SurveyController::class, 'delete'])->name('delete.survey');
Route::get('/edit-survey/{id}', [SurveyController::class, 'edit'])->name('edit.survey');
Route::post('/edit-survey/{id}', [SurveyController::class, 'update'])->name('update.survey');
Route::post('/remove-question', [SurveyController::class, 'remove_question'])->name('remove.question'); 


