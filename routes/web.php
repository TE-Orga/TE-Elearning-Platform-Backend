<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;


Route::get('/', function () {
    return view('welcome');
    
});


// Route pour la page test avec ZAP
Route::get('/test-zap', [TestController::class, 'index']);
