<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService {

    // cargar imagen al s3
    public function upload($image, $folder, $filename = null) {
        if($image == null) return null;
        $filename = $filename ?? time();
        $extension = $image->getClientOriginalExtension();
        $filename = $filename . '.' . $extension;
        //TODO: GUARDAMOS EN LA CARPETA NORMAL
        Storage::put("$folder/normal/" . $filename, file_get_contents($image->path()));
        // TODO: RECORTAR IMAGEN
        $image = $image;
        $img = file_get_contents($image->path());

        $dimensions = getimagesizefromstring($img);
        $width = $dimensions[0];
        $height = $dimensions[1];
        // $size = 300;
        $size = min($width, $height);

        $square = imagecreatetruecolor($size, $size);
        // Recortar y copiar la imagen original al lienzo cuadrado
        imagecopy($square, imagecreatefromstring($img), 0, 0, ($width - $size) / 2, ($height - $size) / 2, $size, $size);

        ob_start();
        imagepng($square);
        $imgData = ob_get_clean();
        Storage::put("$folder/thumb/" . $filename, $imgData);
        \Log::info('saveImage: ' . $filename);
        // Liberar memoria
        imagedestroy($square);
        return $filename;
    }



    // funcion para obtener la imagen
    public function getUrlImage($name, $folder = 'seed') {
        if($name == null) return null;
        $pathComplete = $folder . '/' . $name;
        $url_file = null;
        $exists = Storage::exists($pathComplete);
        if ($exists) {
            \Log::info('getUrlImage: ' . $pathComplete);
            $url_file = asset(Storage::url($pathComplete));
            return $url_file;
        } else {
            \Log::info('getUrlImage no existe: ' . $pathComplete);
            return null;
        }
    }

    // funicon para obtner la imagen del s3
    public function getImage($name, $folder = 'seed') {
        if($name == null) return null;
        $pathComplete = $folder . '/' . $name;
        $exists = Storage::exists($pathComplete);
        if ($exists) {
            \Log::info('getImage: ' . $pathComplete);
            return Storage::get($pathComplete);
        } else {
            \Log::info('getImage no existe: ' . $pathComplete);
            return null;
        }
    }

}
