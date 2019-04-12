<?php
use Rainsens\Simplemde\Http\Controllers\AttachmentsController;
Route::post('attachments/upload', AttachmentsController::class.'@upload');
