<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // Retourner une vue dynamique avec un message
        return view('test', ['message' => 'Ceci est une page pour tester avec ZAP']);
    }
}
