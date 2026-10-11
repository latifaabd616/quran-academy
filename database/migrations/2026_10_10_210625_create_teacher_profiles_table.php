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
        Schema::create('teacher_profiles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('academic_id')->unique()->nullable();
                $table->text('bio')->nullable();
                $table->string('ijazah_type')->nullable();
                $table->integer('experience_years')->default(0);
                $table->string('ijazah_file')->nullable();
                $table->decimal('rating', 3, 2)->default(5.00);
                $table->integer('total_students')->default(0);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
