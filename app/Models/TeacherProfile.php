<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class TeacherProfile extends Model
{
  

    protected $table = 'teacher_profiles';
    protected $fillable = ['user_id', 'academic_id', 'bio', 'ijazah_type', 'experience_years', 'ijazah_file', 'rating', 'total_students'];

    public function user() { return $this->belongsTo(User::class); }
    public function availabilities() { return $this->hasMany(TeacherAvailability::class, 'teacher_id'); }
    public function sessions() { return $this->hasMany(QuranSession::class, 'teacher_id'); }
    public function academicPlans() { return $this->hasMany(AcademicPlan::class, 'teacher_id'); }


}
