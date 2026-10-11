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
        Schema::create('progress_records', function (Blueprint $table) {
           $table->id();
        $table->foreignId('student_id')->constrained('student_profiles')->onDelete('cascade');
        $table->foreignId('session_id')->constrained('quran_sessions')->onDelete('cascade');
        $table->integer('juz_number');
        $table->string('surah_name');
        $table->integer('ayah_start');
        $table->integer('ayah_end');
        $table->enum('status', ['not_started', 'memorizing', 'memorized', 'needs_review']);
        $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_records');
    }
};
