<?php
Route::post('/fileupload/upload',[\Alza\Alza_fileupload\FileuploaderController::class, 'upload_data'])->name('fileupload.upload');
Route::post('/fileupload/unupload',[\Alza\Alza_fileupload\FileuploaderController::class, 'delete_data'])->name('fileupload.unupload');
