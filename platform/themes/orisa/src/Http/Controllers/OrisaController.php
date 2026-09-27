<?php

namespace Theme\Orisa\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class OrisaController extends PublicController
{
    public function downloadFile(): ?Response
    {
        $filePath = request()->input('file');

        if (! $filePath || ! Storage::exists($filePath)) {
            abort(404);
        }

        return response()->download(Storage::path($filePath));
    }
}
