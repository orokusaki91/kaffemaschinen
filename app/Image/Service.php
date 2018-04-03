<?php

namespace App\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Service extends ImageManager
{

    /**
     * Image Service Image
     */
    public $image = NULL;

    /**
     * Upload Image and resize it
     */
    public function upload($image, $directory, $keepAspectRatio = true)
    {
        $path = 'uploads/'.$directory;
        $this->image = parent::make($image);
        $name = $image->getClientOriginalName();

        $fullPath = public_path($path) . "/" . $name;

        $this->directory($directory);

        $this->image->save($fullPath);

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {

            list($width, $height) = $widthHeight;

            $image = parent::make($fullPath);
            $image->fit($width, $height);

            $sizePath = $image->dirname . "/" . $sizeName .  "-" .$image->basename;
            $image->save($sizePath);
        }

        $localImage = new LocalFile($path . "/" . $name);

        return $localImage;
    }

    /**
     * Create Directories if not exists
     */
    public function directory($directory)
    {
        if(!Storage::disk('uploads')->exists($directory)) {
            Storage::disk('uploads')->makeDirectory($directory);
        }
        return $this;
    }

    /**
     * @todo destroy the image from path
     */
    public function destroy() {
        dd($this);
    }
}