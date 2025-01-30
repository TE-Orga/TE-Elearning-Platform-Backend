<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * عرض قائمة الإجابات.
     */
    public function index()
    {
        $answers = Answer::all();
        return response()->json($answers);
    }

    /**
     * عرض نموذج لإنشاء إجابة جديدة.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء الإجابة هنا
    }

    /**
     * تخزين إجابة جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id', // تأكد من وجود السؤال
            'user_id' => 'required|exists:users,id', // تأكد من وجود المستخدم
            'content' => 'required|string|max:1000', // محتوى الإجابة
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $answer = Answer::create([
            'question_id' => $request->question_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($answer, 201);
    }

    /**
     * عرض تفاصيل إجابة معينة.
     */
    public function show(Answer $answer)
    {
        return response()->json($answer);
    }

    /**
     * تحديث إجابة معينة في قاعدة البيانات.
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'content' => 'sometimes|required|string|max:1000', // محتوى الإجابة
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $answer->update($request->only('content'));

        return response()->json($answer);
    }

    /**
     * حذف إجابة معينة من قاعدة البيانات.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->json(null, 204);
    }
}
