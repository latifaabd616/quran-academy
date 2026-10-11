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
        Schema::create('session_notes', function (Blueprint $table) {
               $table->id();
        $table->foreignId('session_id')->constrained('quran_sessions')->onDelete('cascade');
        $table->text('private_teacher_notes');
        $table->text('public_guardian_notes');
        $table->enum('student_performance', ['excellent', 'good', 'needs_improvement']);
        $table->boolean('guardian_notified');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_notes');
    }
};
