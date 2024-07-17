<?php

namespace App\Models;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;

    public function index() {
        $gemini = Gemini::chat()->startChat();
        
        return $gemini;
    }
}
