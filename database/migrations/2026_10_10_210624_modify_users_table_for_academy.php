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
    Schema::table('users', function (Blueprint $table) {
        // هنا نقوم بإضافة وتعديل حقول الـ ERD الخاصة بكِ على جدول المستخدمين الافتراضي:
        $table->string('password_hash')->nullable()->after('password');
        $table->enum('role', ['student', 'teacher', 'admin', 'guardian'])->default('student')->after('email');
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('phone')->nullable();
        $table->string('profile_image')->nullable();
        $table->boolean('is_active')->default(true);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
