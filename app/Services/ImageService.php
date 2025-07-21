<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeImage(UploadedFile $file, string $folder = 'images'): string
    {
        return $file->store($folder, 'public');
    }
    
    public function updateImage(?string $oldPath, UploadedFile $newFile, string $folder = 'images'): string
    {
        $newPath = $this->storeImage($newFile, $folder);
        
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        
        return $newPath;
    }
}
