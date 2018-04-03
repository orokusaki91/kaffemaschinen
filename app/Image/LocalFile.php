<?php

namespace App\Image;

use Illuminate\Support\Facades\File;

class LocalFile
{


    /**
     * relative path for the image
     */
    public $relativePath = NULL;

    /**
     * url for the image
     */
    public $url = NULL;

    /**
     * Pass Relative path for the file
     */
    public function __construct($relativePath = NULL) {

        $this->relativePath = $relativePath;
        $this->url = asset($relativePath);

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {
            $objectVarName = $sizeName . "Url";

            $baseName = basename($relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName. "-" .$baseName , $relativePath) ;

            $this->$objectVarName = asset($sizeNamePath);
        }
    }


    /**
     * return Relative path for the image
     */
    public function destroy(){

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {
            $baseName = basename($this->relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName. "-" .$baseName , $this->relativePath) ;

            $path = public_path($sizeNamePath);
            File::delete($path);

        }

        $path = public_path($this->relativePath);
        File::delete($path);

        return $this;
    }

    /**
     * return Relative path for the image
     */
    public static function deleteImages($relativePath){

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {
            $baseName = basename($relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName. "-" .$baseName , $relativePath) ;

            $path = public_path($sizeNamePath);
            File::delete($path);

        }

        $path = public_path($relativePath);
        File::delete($path);
    }

    /**
     * return Relative path for the image
     */
    public function getRelativePath() {
        return str_replace(asset('/'),'', $this->relativePath);
    }
}