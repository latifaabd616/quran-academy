<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicPlan extends Model
{
    protected $table = 'academic_plans';

    protected $fillable = [
        'student_id', 'teacher_id', 'target_memorization', 
        'target_minor_review', 'target_major_review', 'start_date'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_id');
    }
}
