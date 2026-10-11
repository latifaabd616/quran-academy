<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = ['title', 'description', 'category', 'image_url', 'is_active'];

    public function sessions(): HasMany
    {
        return $this->hasMany(QuranSession::class, 'course_id');
    }

    public function studentCourses(): HasMany
    {
        return $this->hasMany(StudentCourse::class, 'course_id');
    }
}
