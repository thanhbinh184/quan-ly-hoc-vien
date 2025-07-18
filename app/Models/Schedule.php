<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'lesson_type',
        'lesson_date',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    /**
     * Lấy thông tin học viên của lịch học này.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}