<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * عرض قائمة الامتحانات.
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
    }

    /**
     * عرض نموذج لإنشاء امتحان جديد.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء الامتحان هنا
    }

    /**
     * تخزين امتحان جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // عنوان الامتحان
            'description' => 'nullable|string', // وصف الامتحان
            'date' => 'required|date', // تاريخ الامتحان
            'duration' => 'required|integer', // مدة الامتحان
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $exam = Exam::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'duration' => $request->duration,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($exam, 201);
    }

    /**
     * عرض تفاصيل امتحان معين.
     */
    public function show(Exam $exam)
    {
        return response()->json($exam);
    }

    /**
     * تحديث امتحان معين في قاعدة البيانات.
     */
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'sometimes|required|date',
            'duration' => 'sometimes|required|integer',
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $exam->update($request->only('title', 'description', 'date', 'duration'));

        return response()->json($exam);
    }

    /**
     * حذف امتحان معين من قاعدة البيانات.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json(null, 204);
    }
}
