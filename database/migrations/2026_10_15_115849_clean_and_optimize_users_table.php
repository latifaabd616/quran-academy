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
            // 1. حذف الحقول المكررة والزائدة لتوفير مساحة السيرفر
            $table->dropColumn(['name', 'password_hash']);

            // 2. تصحيح وتعديل نوع حقل الـ role ليكون Enum صارم ومحمي كما في الـ ERD
            // ملاحظة: نستخدم change() لتحديث العمود الحالي بأمان
            $table->enum('role_new', ['student', 'teacher', 'admin', 'guardian'])->default('student')->after('email');
        });

        // تنفيذ أمر فصل وتبديل الحقل القديم بالجديد بأمان
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('users', function (Blueprint $table) {
            Schema::rename('users', 'role_new', 'role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // كود التراجع الآمن للفريق في حال الحاجة
    }
};
