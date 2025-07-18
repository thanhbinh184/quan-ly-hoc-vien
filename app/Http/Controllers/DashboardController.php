<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard với các số liệu thống kê.
     */
    public function index()
    {
        // 1. Lấy tổng số học viên (chỉ tính những người đang học)
        $totalActiveStudents = Student::where('status', 'Đang học')->count();

        // 2. Lấy số lịch học có trạng thái "Đã đặt" và diễn ra trong ngày hôm nay
        $schedulesToday = Schedule::where('status', 'Đã đặt')
                                  ->whereDate('lesson_date', today())
                                  ->count();

        // 3. Lấy số học viên mới đăng ký trong tháng hiện tại
        $newStudentsThisMonth = Student::whereMonth('enrollment_date', now()->month)
                                       ->whereYear('enrollment_date', now()->year)
                                       ->count();
                                       
        // 4. Lấy 5 học viên đăng ký gần đây nhất
        $recentStudents = Student::orderBy('enrollment_date', 'desc')->limit(5)->get();

        // 5. Trả về view và truyền tất cả các biến chứa số liệu sang
        return view('dashboard', [
            'totalActiveStudents'  => $totalActiveStudents,
            'schedulesToday'       => $schedulesToday,
            'newStudentsThisMonth' => $newStudentsThisMonth,
            'recentStudents'       => $recentStudents,
        ]);
    }
}
