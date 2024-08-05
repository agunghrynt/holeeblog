<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function getFile($filename)
    {
        $path = storage_path('storage/app/public/' . $filename);

        if (!Storage::disk('users_profile')->exists($filename)) {
            abort(404);
        }

        return response()->file($path);
    }
}
