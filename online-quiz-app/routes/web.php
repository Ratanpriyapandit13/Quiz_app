<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ManageQuizzes;
use App\Livewire\Admin\ManageUsers;
use App\Livewire\Admin\QuizAttempts;
use App\Livewire\Login;
use App\Livewire\Quiz;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/',Login::class);

Route::get('/login', Login::class);
Route::get('/register', Register::class);
Route::get('/admin-dashboard', AdminDashboard::class);
Route::get('/quiz', Quiz::class);
Route::get('/manage-quizzes', ManageQuizzes::class);
Route::get('/quiz-attemps', QuizAttempts::class);
Route::get('/manage-users', ManageUsers::class);
