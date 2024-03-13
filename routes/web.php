<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ShowFilesController;

Route::get('/upload', [FileUploadController::class, 'createForm']);
Route::post('/upload', [FileUploadController::class, 'fileUpload'])->name('fileUpload');

Route::get('/show', [ShowFilesController::class, 'index'])->name('index');
Route::get('/show/{id}', [ShowFilesController::class, 'preview'])->name('files.preview');
Route::get('/download/{name}', [ShowFilesController::class, 'download'])->name('download.file');