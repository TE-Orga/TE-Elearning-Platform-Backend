<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// لوحة التحكم العربية (الافتراضية)
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard.ar');

// لوحة التحكم الإنجليزية
Route::get('/en/dashboard', function () {
    return view('dashboard_en');
})->name('dashboard.en');

// يمكنك إضافة وحدة تحكم للغة إذا أردت التعامل مع تغيير اللغة بشكل أكثر تقدماً
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');
