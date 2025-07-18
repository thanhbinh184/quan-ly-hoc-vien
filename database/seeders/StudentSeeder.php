<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student; // <-- Nhớ import model Student

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::truncate(); // Xóa dữ liệu cũ để tránh trùng lặp

        Student::create([
            'full_name' => 'Nguyễn Văn An',
            'date_of_birth' => '2000-01-15',
            'phone_number' => '0987654321',
            'address' => '123 Đường ABC, Quận 1, TP. HCM',
            'enrollment_date' => now(),
            'status' => 'Đang học',
        ]);

        Student::create([
            'full_name' => 'Trần Thị Bình',
            'date_of_birth' => '2002-05-20',
            'phone_number' => '0912345678',
            'address' => '456 Đường XYZ, Quận 2, TP. HCM',
            'enrollment_date' => now()->subDays(10), // Đăng ký 10 ngày trước
            'status' => 'Đang học',
        ]);

         Student::create([
            'full_name' => 'Lê Văn Cường',
            'date_of_birth' => '1999-11-30',
            'phone_number' => '0905112233',
            'address' => '789 Đường KLM, Quận 3, TP. HCM',
            'enrollment_date' => now()->subMonths(2),
            'status' => 'Đã tốt nghiệp',
        ]);
    }
}