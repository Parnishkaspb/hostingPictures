@extends('layout')


@section('title', 'Загрузка файла')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            @if ($message = Session::get('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <div>
                    {{ $message }}
                </div>
            </div>
            @endif

            @if ($message = Session::get('error') || $errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div>
                    {{ $message }}
                </div>
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
        </div>

        <form class="row g-3" id="uploadForm" action="{{ route('fileUpload') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 offset-md-3">
                <label for="formFileMultiple" class="form-label">Выберите файл:</label>
                <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple>
            </div>
            <button class="col-md-6 offset-md-3 btn btn-danger" type="submit">Загрузить</button>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#uploadForm').submit(function(e) {
        var files = $('#files')[0].files;
        if (files.length > 5) {
            alert('Пожалуйста, выберите не более 5 файлов.');
            e.preventDefault();
        }
    });
});
</script>
@endsection