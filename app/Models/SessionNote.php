<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionNote extends Model
{
    protected $table = 'session_notes';

    protected $fillable = [
        'session_id', 'private_teacher_notes', 'public_guardian_notes', 
        'student_performance', 'guardian_notified'
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(QuranSession::class, 'session_id');
    }
}
