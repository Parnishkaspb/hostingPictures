<?php
use App\Http\Controllers\Api\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/files', [FileController::class, 'index']);

Route::get('/files/{id}', [FileController::class, 'show']);