<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuranSession extends Model
{
    protected $table = 'quran_sessions';

    protected $fillable = [
        'teacher_id', 'student_id', 'course_id', 'scheduled_at', 
        'duration_minutes', 'status', 'meeting_link', 'session_type'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sessionNotes(): HasOne
    {
        return $this->hasOne(SessionNote::class, 'session_id');
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class, 'session_id');
    }

    public function progressRecords(): HasMany
    {
        return $this->hasMany(ProgressRecord::class, 'session_id');
    }
}
