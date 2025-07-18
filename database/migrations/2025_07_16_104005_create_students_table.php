<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Cột ID tự động tăng

            // === BẮT ĐẦU THÊM CÁC CỘT CÒN THIẾU ===
            $table->string('full_name', 100); // Cột tên đầy đủ, tối đa 100 ký tự
            $table->date('date_of_birth')->nullable(); // Cột ngày sinh, có thể để trống
            $table->string('phone_number', 15)->nullable(); // Cột SĐT, có thể để trống
            $table->string('address', 255)->nullable(); // Cột địa chỉ
            $table->date('enrollment_date'); // Cột ngày đăng ký
            $table->string('status', 50)->default('Đang học'); // Trạng thái học viên
            // 'course_id', 'instructor_id' ... sẽ thêm sau
            // === KẾT THÚC THÊM CÁC CỘT ===

            $table->timestamps(); // Tự động tạo 2 cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
