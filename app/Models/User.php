<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // 1. استدعاء حزمة التوكنات الرسمية

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
     protected $fillable = ['email', 'password', 'role', 'first_name', 'last_name', 'phone', 'profile_image', 'is_active'];
       
     protected $hidden = [
        'password', // التعديل هنا لإخفاء كلمة المرور المشفرة من الـ APIs
        'remember_token',
    ];

    public function teacherProfile() { return $this->hasOne(TeacherProfile::class, 'user_id'); }
    public function studentProfile() { return $this->hasOne(StudentProfile::class, 'user_id'); }
    public function guardianProfile() { return $this->hasOne(GuardianProfile::class, 'user_id'); }
    public function attendanceRecords() { return $this->hasMany(AttendanceRecord::class, 'user_id'); }
    public function notifications() { return $this->hasMany(Notification::class, 'user_id'); }
  


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
