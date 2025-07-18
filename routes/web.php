<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// BẮT ĐẦU KHU VỰC YÊU CẦU ĐĂNG NHẬP
Route::middleware(['auth'])->group(function () {

    // Route gốc ('/') BÂY GIỜ NẰM BÊN TRONG.
    // Ai chưa đăng nhập sẽ không thể vào đây, và sẽ bị chuyển đến trang 'login'.
    Route::get('/', function () {
        // Nếu đã đăng nhập, chuyển hướng đến trang dashboard.
        return redirect()->route('dashboard');
    });

    // Route cho trang Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route cho trang Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/schedules/completed', [App\Http\Controllers\ScheduleController::class, 'completed'])->name('schedules.completed');
    Route::patch('/schedules/{schedule}/complete', [App\Http\Controllers\ScheduleController::class, 'complete'])->name('schedules.complete');
    
    // Nơi bạn sẽ thêm route quản lý học viên sau này...
    Route::resource('students', StudentController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::patch('/schedules/{schedule}/complete', [ScheduleController::class, 'markAsComplete'])->name('schedules.complete');
}); // KẾT THÚC KHU VỰC YÊU CẦU ĐĂNG NHẬP

// File này chứa các route cho login, logout, etc.
// Nó phải nằm BÊN NGOÀI để người dùng có thể truy cập trang login.
require __DIR__.'/auth.php';