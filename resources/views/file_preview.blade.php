<div>
    <h2>Предпросмотр файла: {{ $file->name_file }}</h2>
    <img src="{{ asset('uploads/'. $file->name_file . '.' . $file->extension_file) }}" style="width: 100%">

</div>