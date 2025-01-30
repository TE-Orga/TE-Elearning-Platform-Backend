<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * عرض قائمة الأسئلة.
     */
    public function index()
    {
        $questions = Question::all();
        return response()->json($questions);
    }

    /**
     * عرض نموذج لإنشاء سؤال جديد.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء السؤال هنا
    }

    /**
     * تخزين سؤال جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id', // تأكد من وجود الامتحان
            'content' => 'required|string|max:1000', // محتوى السؤال
            'type' => 'required|string|in:multiple_choice,short_answer', // نوع السؤال
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $question = Question::create([
            'exam_id' => $request->exam_id,
            'content' => $request->content,
            'type' => $request->type,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($question, 201);
    }

    /**
     * عرض تفاصيل سؤال معين.
     */
    public function show(Question $question)
    {
        return response()->json($question);
    }

    /**
     * تحديث سؤال معين في قاعدة البيانات.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'sometimes|required|string|max:1000',
            'type' => 'sometimes|required|string|in:multiple_choice,short_answer',
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $question->update($request->only('content', 'type'));

        return response()->json($question);
    }

    /**
     * حذف سؤال معين من قاعدة البيانات.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(null, 204);
    }
}
