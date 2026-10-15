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
            'password' => Hash::make($request->password), // تشفير عالمي آمن بالـ Bcrypt
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

        if (!$user || !Hash::check($request->password, $user->password)) {
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


        /**
     * نظام تسجيل الخروج الآمن وتدمير التوكن (Logout API)
     */
    public function logout(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        // تدمير التوكن الحالي الذي استخدمه المستخدم لدخول هذه الجلسة فوراً
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully. Token revoked and session secured.'
        ], 200); // كود 200 القياسي للعمليات الناجحة
    }


        /**
     * إرسال رابط/كود استعادة كلمة المرور (Forgot Password)
     */
    public function forgotPassword(\App\Http\Requests\Api\ForgotPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = \Illuminate\Support\Str::random(60);

        // تخزين التوكن المؤقت في الجدول الافتراضي الذي رأيناه في الملف الأول
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => \Illuminate\Support\Facades\Hash::make($token), 'created_at' => now()]
        );

        // 💡 المقاييس العالمية: هنا يتم إرسال الإيميل الفعلي للمستخدم يحتوي على التوكن
        // Mail::to($request->email)->send(new ResetPasswordMail($token));

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset token generated and simulated. (In production, an email will be dispatched).',
            'debug_token' => $token // نرسله حالياً لتجربته في فحص الـ API
        ], 200);
    }

    /**
     * تعيين كلمة المرور الجديدة (Reset Password)
     */
    public function resetPassword(\App\Http\Requests\Api\ResetPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $record = \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record || !\Illuminate\Support\Facades\Hash::check($request->token, $record->token)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid email or token expired.'], 422);
        }

        // تحديث كلمة المرور المشفرة داخل حقل password_hash الخاص بمخططكِ كلياً!
        $user = \App\Models\User::where('email', $request->email)->first();
        $user->update([
            'password_hash' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        // مسح التوكن المؤقت بعد الاستخدام الناجح لحماية الحساب
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Your password has been successfully updated. You can now login with your new credentials.'
        ], 200);
    }

}
