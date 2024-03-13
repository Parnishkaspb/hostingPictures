<?php
namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function createForm()
    {
        return view('upload', ["title" => "Загрузка файлов"]);
    }

    public function fileUpload(FileUploadRequest $request)
    {
        if (!$request->hasFile('files')) {
            return back()->with('error', 'Выберите хотя бы 1 файл для загрузки!');
        }

        $files = $request->file('files');

        foreach ($files as $file) {
            $file_name_without_extension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = $file->getClientOriginalExtension();
            $file_name = $this->transliterateAndLowerCast($file_name_without_extension);
            $final_name = $file_name . '.' . $file_extension;

            $uploadPath = public_path('uploads');
            $final_name = $file_name . '.' . $file_extension;

            if (file_exists($uploadPath . '/' . $final_name)) {
                $uniqueSuffix = date("YmdHis") . '_' . Str::random(5);
                $file_name = $file_name . '_' . $uniqueSuffix;
                $final_name = $file_name . '.' . $file_extension;
            }

            $file->move($uploadPath, $final_name);

            File::create([
                'name_file' => $file_name,
                'extension_file' => $file_extension,
            ]);
        }

        return back()->with('success', 'Вы успешно загрузили файлы.');
    }

    protected function transliterateRussianToEnglish($text)
    {
        $converter = [
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ъ' => '',
            'ы' => 'y',
            'ь' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',

            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'Yo',
            'Ж' => 'Zh',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'Ts',
            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',
            'Ъ' => '',
            'Ы' => 'Y',
            'Ь' => '',
            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',
        ];
        return strtr($text, $converter);
    }

    protected function transliterateAndLowerCast($text)
    {
        return strtolower($this->transliterateRussianToEnglish($text));
    }

}