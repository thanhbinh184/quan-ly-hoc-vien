<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule; // <-- Quan trọng: Chỉ cho file này biết Model Schedule ở đâu

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xóa dữ liệu cũ trong bảng schedules để tránh tạo trùng lặp
        Schedule::truncate();

        // Tạo lịch học thứ nhất cho học viên có ID = 1
        Schedule::create([
            'student_id'      => 1,
            'lesson_type'     => 'Học sa hình',
            'lesson_date'     => now()->addDays(1), // Ngày mai
            'start_time'      => '08:00:00',
            'end_time'        => '10:00:00',
            'status'          => 'Đã đặt',
        ]);

        // Tạo lịch học thứ hai cho học viên có ID = 2
        Schedule::create([
            'student_id'      => 2,
            'lesson_type'     => 'Học đường trường',
            'lesson_date'     => now()->addDays(2), // Ngày kia
            'start_time'      => '14:00:00',
            'end_time'        => '16:00:00',
            'status'          => 'Hoàn thành',
        ]);

        // Tạo lịch học thứ ba cho học viên có ID = 1
         Schedule::create([
            'student_id'      => 1,
            'lesson_type'     => 'Ôn thi lý thuyết',
            'lesson_date'     => now()->addDays(3), // 3 ngày nữa
            'start_time'      => '09:00:00',
            'end_time'        => '11:00:00',
            'status'          => 'Đã hủy',
        ]);
    }
}