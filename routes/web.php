<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
    Route::resource('students', StudentController::class);
    Route::get('attendances/meeting/{meeting}', [AttendanceController::class, 'meeting'])->name('attendances.meeting');
    Route::post('attendances/meeting/{meeting}', [AttendanceController::class, 'storeAttendance'])->name('attendances.meeting.store');
    Route::get('attendances/{attendance}/new-meeting', [AttendanceController::class, 'newMeeting'])->name('attendances.meeting.new');
    Route::post('attendances/{attendance}/new-meeting', [AttendanceController::class, 'storeMeeting'])->name('attendances.meeting.new.store');
    Route::get('attendances/{attendance}/report', [AttendanceController::class, 'report'])->name('attendances.report');
    Route::resource('attendances', AttendanceController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
