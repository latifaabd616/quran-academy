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
        // 1. إعادة تسمية الجدول بالكامل من الاسم الخاطئ "role_new" ليعود لاسمه الأساسي المقدس "users"
        if (Schema::hasTable('role_new')) {
            Schema::rename('role_new', 'users');
        }

        // 2. الدخول لداخل جدول الـ users وتعديل اسم العمود الداخلي ليكون "role" الصافي بدقة
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role_new')) {
                $table->renameColumn('role_new', 'role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('role', 'role_new');
        });
        Schema::rename('users', 'role_new');
    }
};
