<?php
namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;

class FileUploadController extends Controller
{
    public function createForm()
    {
        return view('upload');
    }

    public function fileUpload(FileUploadRequest $request)
    {
        $files = $request->file('files');

        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $fileName = time() . rand(1, 1000) . '.' . $file->extension();
                $file->move(public_path('uploads'), $fileName);
                $data[] = $fileName;
            }
        }

        return back()
            ->with('success', 'Вы успешно загрузили файлы.')
            ->with('files', $data);
    }
}