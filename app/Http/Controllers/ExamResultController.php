<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * عرض قائمة نتائج الامتحانات.
     */
    public function index()
    {
        $examResults = ExamResult::all();
        return response()->json($examResults);
    }

    /**
     * عرض نموذج لإنشاء نتيجة امتحان جديدة.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء نتيجة الامتحان هنا
    }

    /**
     * تخزين نتيجة امتحان جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // تأكد من وجود المستخدم
            'exam_id' => 'required|exists:exams,id', // تأكد من وجود الامتحان
            'score' => 'required|integer|min:0', // درجة الامتحان
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $examResult = ExamResult::create([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'score' => $request->score,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($examResult, 201);
    }

    /**
     * عرض تفاصيل نتيجة امتحان معينة.
     */
    public function show(ExamResult $examResult)
    {
        return response()->json($examResult);
    }

    /**
     * تحديث نتيجة امتحان معينة في قاعدة البيانات.
     */
    public function update(Request $request, ExamResult $examResult)
    {
        $request->validate([
            'score' => 'sometimes|required|integer|min:0',
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $examResult->update($request->only('score'));

        return response()->json($examResult);
    }

    /**
     * حذف نتيجة امتحان معينة من قاعدة البيانات.
     */
    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();
        return response()->json(null, 204);
    }
}
