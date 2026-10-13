<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * نظام التسجيل الآمن (Sign Up API)
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // تم فحص وتأمين المدخلات تلقائياً بفضل الـ RegisterRequest المعياري

        // إنشاء الحساب وتشفير كلمة المرور في حقل password_hash المعتمد في الـ ERD
        $user = User::create([
            'email' => $request->email,
            'password_hash' => Hash::make($request->password), // تشفير عالمي آمن بالـ Bcrypt
            'role' => $request->role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'profile_image' => $request->profile_image ?? 'default.png',
            'is_active' => true,
        ]);

        // توليد التوكن المشفر فوراً للمستخدم الجديد (حزمة Sanctum)
        $token = $user->createToken('quran_academy_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User account successfully provisioned and secured inside Quran Academy.',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 201); // كود 201 القياسي العالمي للإنشاء الناجح
    }

    /**
     * نظام تسجيل الدخول (Login API)
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // البحث عن المستخدم والتحقق من كلمة المرور المشفرة بحقل password_hash بدقة كاملة
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication failed: Invalid email or password credentials.'
            ], 401); // كود 401 للخطأ في الصلاحيات
        }

        // فحص حالة الحساب هل هو معطل بواسطة الإدارة أم لا
        if (!$user->is_active) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access suspended: This account has been deactivated by the admin.'
            ], 403);
        }

        // توليد توكن دخول مشفر جديد
        $token = $user->createToken('quran_academy_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Authentication successful. Welcome back to Quran Academy.',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ], 200);
    }
}
