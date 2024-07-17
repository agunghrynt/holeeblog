<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeminiController extends Controller
{
    public function index()
    {

        return view('gemini', [
            "title" => "Gemini AI",
            "active" => 'home',
        ]);
    }
}
