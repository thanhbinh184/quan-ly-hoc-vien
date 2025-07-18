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
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();

        // Chỉ cần khóa ngoại đến học viên
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

        $table->string('lesson_type');
        $table->date('lesson_date');
        $table->time('start_time');
        $table->time('end_time');
        $table->string('status')->default('Đã đặt');
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
