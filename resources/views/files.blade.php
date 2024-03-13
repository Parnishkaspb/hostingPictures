@extends('layout')


@section('title', $title)

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><a href="?sort=name_file">Название файла</a></th>
                    <th scope="col"><a href="?sort=created_at">Дата создания</a></th>
                    <th scope="col">Время создания</th>
                    <th scope="col">Просмотреть весь файл</th>
                    <th scope="col">Скачать файл</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                <tr>
                    <th scope="row">
                        <a href="#" class="preview-link" data-file-id="{{ $file->id }}">{{ $file->name_file }}</a>
                    </th>
                    <td>{{ $file->created_at->toDateString() }}</td>
                    <td>{{ $file->created_at->toTimeString() }}</td>
                    <td> <a href="{{ asset('uploads/' . $file->name_file . '.' . $file->extension_file) }}">
                            На весь экран </a> </td>
                    <td> <a href="/download/{{$file->name_file}}.{{$file->extension_file}}"> Скачать </a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="previewModalLabel">Предпросмотр файла</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $('.preview-link').click(function(e) {
        e.preventDefault();
        var fileId = $(this).data('file-id');
        $.get('/show/' + fileId, function(data) {
            $('#previewModal .modal-body').html(data);
            $('#previewModal').modal('show');
        });
    });
});
</script>
@endsection