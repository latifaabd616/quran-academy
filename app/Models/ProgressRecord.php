<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressRecord extends Model
{
    protected $table = 'progress_records';

    protected $fillable = [
        'student_id', 'session_id', 'juz_number', 
        'surah_name', 'ayah_start', 'ayah_end', 'status'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(QuranSession::class, 'session_id');
    }
}
