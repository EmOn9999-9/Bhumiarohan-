<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    /**
     * Store an uploaded image on the public disk, deleting the old one if replaced.
     */
    protected function storeImage(Request $request, string $field, string $folder, ?string $old = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $old;
        }

        if ($old) {
            Storage::disk('public')->delete($old);
        }

        return $request->file($field)->store($folder, 'public');
    }

    protected function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
