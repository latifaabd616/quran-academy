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
        Schema::create('guardian_profiles', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
         $table->enum('relation_to_student', ['father', 'mother', 'brother', 'sister', 'other']);
         $table->enum('preferred_contact_method', ['whatsapp', 'email', 'sms'])->default('whatsapp');
         $table->boolean('receive_notifications')->default(true);
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian_profiles');
    }
};
