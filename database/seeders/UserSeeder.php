<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ trong bảng users để tránh trùng lặp khi chạy lại seeder
        User::truncate();

        // Tạo tài khoản Admin (là bạn)
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'), // Đổi mật khẩu của bạn ở đây
            'email_verified_at' => now(),
            // 'role' => 'admin', // Chúng ta sẽ thêm cột này ở bước nâng cao sau
        ]);

        // Tạo tài khoản cho Thầy giáo thứ hai
        User::create([
            'name' => 'Thay Giao Vinh',
            'email' => 'thayvinh.b@gmail.com',
            'password' => Hash::make('123'), // Mật khẩu ban đầu cho họ
            'email_verified_at' => now(),
            // 'role' => 'instructor',
        ]);
    }
}