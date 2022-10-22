<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user-manage', [UserController::class, 'userManage'])->name('user-manage');

Route::middleware(['auth'])->group(function () {
    // confirm dialog requests 
    Route::post('/confirm_dailog', [PageController::class, 'confirm_dailog'])->name('confirm_dailog');
    Route::get('/users', [PageController::class, 'users']);
    Route::get('/students', [PageController::class, 'students']);
    Route::get('/student-exam/{exam_id}', [PageController::class, 'student_exam']);
    Route::get('/student-exam-result/{exam_id}/{student_id}', [PageController::class, 'student_exam_result']);
    Route::get('/student-exam-results/{exam_id}', [PageController::class, 'student_exam_results']);
    Route::get('/exams', [PageController::class, 'exams']);
    Route::get('/grade', [PageController::class, 'grade']);
    Route::get('/dashboard', [PageController::class, 'dashboard']);
    Route::post('/exam-manage', [ExamController::class, 'exam_manage'])->name('exam-manage');
    Route::get('/exam-result-pdf/{exam_id}', [ExamController::class, 'resultPdf'])->name('exam-result-pdf');
    Route::get('/continue-make-exam/{exam_id}', [ExamController::class, 'continue_make_exam'])->name('continue-make-exam');

});

require __DIR__.'/auth.php';
