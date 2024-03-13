<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use ZipArchive;

class ShowFilesController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'name_file');

        $allowedSorts = ['name_file', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'name_file';
        }

        $files = File::orderBy($sortBy, 'asc')->get();
        // Сортировку можно было сделать также с помощью таблиц на JS 
        return view('files', [
            "title" => "Просмотр файлов",
            "files" => $files
        ]);
    }

    public function preview($id)
    {
        $file = File::findOrFail($id);
        return view('file_preview', compact('file'));
    }

    public function download($fileName)
    {
        $filePath = public_path('uploads/' . $fileName);

        $zipFileName = $fileName . '.zip';

        $zipFilePath = sys_get_temp_dir() . '/' . $zipFileName;

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            $zip->addFile($filePath, $fileName);
            $zip->close();

            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } else {
            return abort(404, 'Не удалось создать архив.');
        }

    }
}