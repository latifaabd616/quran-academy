<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuardianProfile extends Model
{

    protected $table = 'guardian_profiles';
    protected $fillable = ['user_id', 'relation_to_student', 'preferred_contact_method', 'receive_notifications'];

    public function user() { return $this->belongsTo(User::class); }
    public function students() { return $this->hasMany(StudentProfile::class, 'guardian_id'); }


}
