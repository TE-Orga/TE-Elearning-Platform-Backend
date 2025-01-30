<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * عرض قائمة المسؤولين.
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    /**
     * عرض نموذج لإنشاء مسؤول جديد.
     */
    public function create()
    {
        // يمكن إرجاع نموذج إنشاء المسؤول هنا
    }

    /**
     * تخزين مسؤول جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:50', // إضافة حقل الدور
            'department' => 'nullable|string|max:255', // إضافة حقل القسم
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $admin = Admin::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'department' => $request->department,
            // إضافة المزيد من الحقول حسب الحاجة
        ]);

        return response()->json($admin, 201);
    }

    /**
     * عرض تفاصيل مسؤول معين.
     */
    public function show(Admin $admin)
    {
        return response()->json($admin);
    }

    /**
     * تحديث مسؤول معين في قاعدة البيانات.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|string|max:50', // إضافة حقل الدور
            'department' => 'nullable|string|max:255', // إضافة حقل القسم
            // إضافة المزيد من القواعد حسب الحاجة
        ]);

        $admin->update($request->only('first_name', 'last_name', 'email', 'password', 'role', 'department'));

        return response()->json($admin);
    }

    /**
     * حذف مسؤول معين من قاعدة البيانات.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json(null, 204);
    }
}
