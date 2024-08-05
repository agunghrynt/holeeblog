<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{
    public function index()
    {
        return view('user-dashboard.user-profile.index');
    }
}
