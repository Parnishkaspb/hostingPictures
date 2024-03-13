<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'files.*.required' => 'Необходимо выбрать хотя бы один файл.',
            'files.*.mimes' => 'Допустимы только файлы следующих типов: :values.',
            'files.*.max' => 'Максимальный размер файла не должен превышать :max килобайт.',
        ];
    }

    public function rules()
    {
        return [
            'files.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2048',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->file('files') && count($this->file('files')) > 5) {
                $validator->errors()->add('files', 'Загрузить на сервер за один раз можно не больше 5 файлов!');
            }
        });
    }
}