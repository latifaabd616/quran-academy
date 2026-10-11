<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quran_sessions', function (Blueprint $table) {
            $table->id();
        $table->foreignId('teacher_id')->constrained('teacher_profiles')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('student_profiles')->onDelete('cascade');
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        $table->timestamp('scheduled_at');
        $table->integer('duration_minutes');
        $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled', 'no_show']);
        $table->string('meeting_link');
        $table->enum('session_type', ['evaluation', 'memorization', 'review']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
