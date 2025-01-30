<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * عرض قائمة الدورات.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * عرض نموذج لإنشاء دورة جديدة.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء الدورة هنا
    }

    /**
     * تخزين دورة جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // عنوان الدورة
            'description' => 'nullable|string', // وصف الدورة
            'duration' => 'required|integer', // مدة الدورة
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($course, 201);
    }

    /**
     * عرض تفاصيل دورة معينة.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * تحديث دورة معينة في قاعدة البيانات.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'sometimes|required|integer',
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $course->update($request->only('title', 'description', 'duration'));

        return response()->json($course);
    }

    /**
     * حذف دورة معينة من قاعدة البيانات.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}
