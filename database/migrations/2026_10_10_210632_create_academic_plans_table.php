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
        Schema::create('academic_plans', function (Blueprint $table) {
               $table->id();
        $table->foreignId('student_id')->constrained('student_profiles')->onDelete('cascade');
        $table->foreignId('teacher_id')->constrained('teacher_profiles')->onDelete('cascade');
        $table->text('target_memorization')->nullable();
        $table->text('target_minor_review')->nullable();
        $table->text('target_major_review')->nullable();
        $table->date('start_date');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_plans');
    }
};
