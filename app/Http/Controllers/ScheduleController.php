<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('student')
                                    ->where('status', 'Đã đặt') 
                                    ->orderBy('lesson_date', 'asc') 
                                    ->orderBy('start_time', 'asc')
                                    ->paginate(15);

        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $students = Student::orderBy('full_name')->get();
        return view('schedules.create', compact('students'));
    }

    public function store(Request $request): RedirectResponse
{
    // 1. Xác thực dữ liệu từ form
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'lesson_type' => 'required|string|max:255',
        'lesson_date' => 'required|date',
        'start_time' => 'required|date_format:H:i:s,H:i', // Chấp nhận cả H:i và H:i:s
        'end_time' => 'required|date_format:H:i:s,H:i|after:start_time',
        'status' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    // 2. Tạo và lưu lịch học mới
    Schedule::create($validated);

    // 3. Chuyển hướng về trang danh sách với thông báo thành công
    return redirect()->route('schedules.index')->with('success', 'Đã thêm lịch học mới thành công!');
}
    public function edit(Schedule $schedule)
    {
        $students = Student::orderBy('full_name')->get();
        return view('schedules.edit', compact('schedule', 'students'));
    }

    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'lesson_type' => 'required|string|max:255',
            'lesson_date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Đã cập nhật lịch học thành công!');
    }

    public function markAsComplete(Schedule $schedule): RedirectResponse
    {
        // Cập nhật trạng thái
        $schedule->status = 'Hoàn thành';
        $schedule->save(); // Lưu thay đổi vào database

        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('schedules.index')->with('success', 'Đã cập nhật trạng thái lịch học thành công!');
    }
    public function destroy(Schedule $schedule): RedirectResponse
    {
        // Sử dụng Route-Model Binding, Laravel đã tìm sẵn lịch học cho chúng ta
        try {
            // Thực hiện xóa
            $schedule->delete();

            // Chuyển hướng về trang danh sách với thông báo thành công
            return redirect()->route('schedules.index')->with('success', 'Đã xóa lịch học thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi (ví dụ: lỗi khóa ngoại,...) thì báo lỗi
            return redirect()->route('schedules.index')->with('error', 'Không thể xóa lịch học này. Đã có lỗi xảy ra.');
        }
    }
    public function completed()
    {
        // Lấy các lịch học có status là 'Hoàn thành' hoặc 'Đã hủy'
        $completedSchedules = Schedule::with('student')
                                ->whereIn('status', ['Hoàn thành', 'Đã hủy'])
                                ->orderBy('lesson_date', 'desc') // Sắp xếp ngày gần nhất lên đầu
                                ->orderBy('start_time', 'desc')
                                ->paginate(15);

        // Trả về một view mới và truyền dữ liệu sang
        return view('schedules.completed', compact('completedSchedules'));
    }
}