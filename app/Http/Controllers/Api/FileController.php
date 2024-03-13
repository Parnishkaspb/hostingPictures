<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;

class FileController extends Controller
{

    public function index()
    {
        $files = File::all();
        return response()->json($files);
    }

    public function show($id)
    {
        $file = File::find($id);

        if (!$file) {
            return response()->json(['message' => 'Файл не найден'], 404);
        }

        return response()->json($file);
    }
}