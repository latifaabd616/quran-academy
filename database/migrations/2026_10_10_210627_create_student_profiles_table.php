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
        Schema::create('student_profiles', function (Blueprint $table) {
            
              $table->id();
              $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
              $table->foreignId('guardian_id')->nullable()->constrained('guardian_profiles')->onDelete('set null');
              $table->string('academic_id')->unique()->nullable();
              $table->enum('current_level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
              $table->date('enrollment_date')->nullable();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
