<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

Route::get('/upload', [FileUploadController::class, 'createForm']);
Route::post('/upload', [FileUploadController::class, 'fileUpload'])->name('fileUpload');