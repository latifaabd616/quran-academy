<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProfile extends Model
{



    protected $table = 'student_profiles';
    protected $fillable = ['user_id', 'guardian_id', 'academic_id', 'current_level', 'enrollment_date'];

    public function user() { return $this->belongsTo(User::class); }
    public function guardian() { return $this->belongsTo(GuardianProfile::class, 'guardian_id'); }
    public function sessions() { return $this->hasMany(QuranSession::class, 'student_id'); }
    public function studentCourses() { return $this->hasMany(StudentCourse::class, 'student_id'); }
    public function academicPlans() { return $this->hasMany(AcademicPlan::class, 'student_id'); }
    public function progressRecords() { return $this->hasMany(ProgressRecord::class, 'student_id'); }
    public function subscriptions() { return $this->hasMany(Subscription::class, 'student_id'); }


}
