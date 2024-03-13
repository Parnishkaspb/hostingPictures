$(document).ready(function () {
    $('#uploadForm').submit(function (e) {
        var files = $('#files')[0].files;
        if (files.length > 5) {
            alert('Пожалуйста, выберите не более 5 файлов.');
            e.preventDefault();
        }
    });
});