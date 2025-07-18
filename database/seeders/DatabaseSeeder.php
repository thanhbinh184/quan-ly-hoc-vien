<?php

namespace Database\Seeders;

// Không cần dùng User::factory() nữa nên có thể xóa dòng use App\Models\User;
// use App\Models\User; 
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
 public function run(): void
    {
        // === BẮT ĐẦU SỬA ===

        // Tạm thời vô hiệu hóa kiểm tra khóa ngoại
        // để có thể truncate các bảng một cách an toàn
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // Gọi các seeder của bạn
        $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            ScheduleSeeder::class,
        ]);

        // Bật lại kiểm tra khóa ngoại
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // === KẾT THÚC SỬA ===
    }
}