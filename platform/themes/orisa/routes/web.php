<?php

use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Route;
use Theme\Orisa\Http\Controllers\OrisaController;

Theme::routes();

Route::group(['controller' => OrisaController::class], function (): void {
    Route::get('download-file', 'downloadFile')->name('public.download-file');
});
