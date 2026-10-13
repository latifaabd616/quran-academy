<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * تفتيش بطاقة الدخول والصلاحيات بالمقاييس العالمية
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. التأكد من أن المستخدم سجل دخوله ومعه توكن أمان (Token) صالح
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required: Please log in to access this section.'
            ], 401);
        }

        // 2. فحص دور المستخدم (Role) هل هو مسموح له بالدخول أم لا
        if (!in_array($request->user()->role, $roles)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Access Denied: Your account role does not have permission to view this resource.'
            ], 403); // كود 403 العالمي للمنع من الصلاحيات
        }

        return $next($request);
    }
}
