<?php
namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;

class FileUploadController extends Controller
{
    public function createForm()
    {
        return view('upload', ["title" => "Загрузка файлов"]);
    }

    public function fileUpload(FileUploadRequest $request)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            if (count($files) > 5) {
                return back()
                    ->with('error', 'Загрузить на сервер за один раз можно не больше 5 файлов!');
            }
            foreach ($files as $file) {
                $file_name_without_extension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $file_extension = $file->getClientOriginalExtension();
                // Транслируем текст и приводим в нижний регистр
                $file_name = $this->transliterateAndLowerCast($file_name_without_extension);
                $final_name = $file_name . '.' . $file_extension;

                $uploadPath = public_path('uploads');
                $filePath = $uploadPath . '/' . $final_name;

                if (file_exists($filePath)) {
                    $final_name = $file_name . '_' . date("Y-m-d h:i:s") . '.' . $file_extension;
                }

                $file->move($uploadPath, $final_name);

                File::create([
                    'name_file' => $final_name,
                ]);

            }
            return back()
                ->with('success', 'Вы успешно загрузили файлы.');
        }

        return back()
            ->with('error', 'Выберите хотя бы 1 файл для загрузки');
    }

    protected function transliterateAndLowerCast($text)
    {
        return strtolower(iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $text));
    }

}