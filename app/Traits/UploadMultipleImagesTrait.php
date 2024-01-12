<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadMultipleImagesTrait {

    public function processMultipleImages($images, $folder = 'uploadingMultiple/', $disk = 'public', $width, $height) {

        if (isset($images) && is_array($images)) {
            $uploadedImages = [];
            foreach ($images as $key=>$image) {
                $filename = hexdec(uniqid()) . '.' . 'webp';
                Image::make($image->getRealPath())->encode('webp', 100)->save(public_path($folder . $filename));
                $uploadedImages[$key] = $filename;
                // dd($uploadedImages[$key]);
            }
            return $uploadedImages;
        }
        return null;
    }
}
