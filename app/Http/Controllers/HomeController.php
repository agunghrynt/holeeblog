<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {

        return view('home', [
            "title" => "Home",
            "active" => 'home',
        ]);
    }
    
}
