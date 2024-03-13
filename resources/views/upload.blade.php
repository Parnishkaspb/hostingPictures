@extends('layout')


@section('title', 'Загрузка файла')

@section('content')

@if ($message = Session::get('success'))
<div>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div>
    <strong>{{ $message }}</strong>
</div>
@endif


<form id="uploadForm" action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="file">Выберите файл:</label>
        <input type="file" id="files" name="files[]" multiple>
    </div>
    <button type="submit">Загрузить</button>
</form>


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