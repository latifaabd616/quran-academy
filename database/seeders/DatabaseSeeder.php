<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. حساب السوبر آدمن (الـ role هو admin إجبارياً ليتوافق مع الـ enum)
        User::updateOrCreate(
            ['email' => 'superadmin@academy.com'],
            [
                'password' => Hash::make('Admin@2026'),
                'role' => 'admin', // دور معتمد في الـ enum
                'first_name' => 'Super',
                'last_name' =>'Admin',
                'phone' => '0555123456',
                'profile_image' => 'superadmin.png',
                'is_active' => true,
            ]
        );

        // 2. حساب الآدمن المساعد (الـ role هو admin أيضاً)
        User::updateOrCreate(
            ['email' => 'admin@academy.com'],
            [
                'password' => Hash::make('AdminAssistant@2026'),
                'role' => 'admin', // دور معتمد في الـ enum
                'first_name' => 'First',
                'last_name' =>'Admin' ,
                'phone' => '0555987654',
                'profile_image' => 'admin.png',
                'is_active' => true,
            ]
        );
    }
}
