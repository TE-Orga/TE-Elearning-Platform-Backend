<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * عرض قائمة التسجيلات.
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }

    /**
     * عرض نموذج لإنشاء تسجيل جديد.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء التسجيل هنا
    }

    /**
     * تخزين تسجيل جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // تأكد من وجود المستخدم
            'course_id' => 'required|exists:courses,id', // تأكد من وجود الدورة
            'status' => 'required|string|in:active,inactive', // حالة التسجيل
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'status' => $request->status,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($enrollment, 201);
    }

    /**
     * عرض تفاصيل تسجيل معين.
     */
    public function show(Enrollment $enrollment)
    {
        return response()->json($enrollment);
    }

    /**
     * تحديث تسجيل معين في قاعدة البيانات.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'course_id' => 'sometimes|required|exists:courses,id',
            'status' => 'sometimes|required|string|in:active,inactive',
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $enrollment->update($request->only('user_id', 'course_id', 'status'));

        return response()->json($enrollment);
    }

    /**
     * حذف تسجيل معين من قاعدة البيانات.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json(null, 204);
    }
}
