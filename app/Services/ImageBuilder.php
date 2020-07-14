<?php
/**
 * Project: Photo Framer v1.0
 * Author: Benjamin Iduwe
 * Date: June 2020
 */

namespace app\Services;

use app\Traits\Response;

class ImageBuilder
{
    use Response;

    const HEIGHT = 400;
    const WIDTH = 400;
    const PATH = 'uploads/';
    const EXTENSION = '.jpg';

    /**
     * upload
     *
     * @param  mixed $file
     * @param  mixed $design
     * @return void
     */
    public function __construct()
    {
        $this->root = $_SERVER['DOCUMENT_ROOT'];
    }

    public function upload($file, $design)
    {
        try {
            $this->checkDirectory();
            $save = $this->storeImage($file, $design);
            return $this->okResponse("Image created successfully", $save);
        } catch (Exception $error) {
            return $this->errorResponse("Unable to create image");
        }
    }
    
    /**
     * generateFileName
     *
     * @return void
     */
    public function generateFileName()
    {
        $filename = time() . rand(100, 999);
        return $filename . self::EXTENSION;
    }
    
    /**
     * checkDirectory
     *
     * @return void
     */
    public function checkDirectory()
    {
        if (!file_exists(self::PATH)) {
            mkdir(self::PATH);
        }
    }
    
    /**
     * storeImage
     *
     * @param  mixed $image
     * @param  mixed $design
     * @return void
     */
    public function storeImage($image, $design)
    {
        $image = $this->convert($image, $design);
        $filename = $this->generateFileName();
        $loc = self::PATH . $filename;
        $store = file_put_contents($loc, $image);
        return $loc;
    }
    
    /**
     * convert
     *
     * @param  mixed $file
     * @param  mixed $design
     * @return void
     */
    public function convert($file, $design)
    {
        //set default image
        $file = ($file) ? $file : "images/avatar.png";
        $design = ($design) ? "frame-{$design}.png" : "frame-0.png";
        
        $src = imagecreatefromstring(file_get_contents($file));
        $fg = imagecreatefrompng($this->root ."/frames/$design");

        //assign width and height and crop image
        list($width, $height) = getimagesize($file);
        $croppedFG = imagecreatetruecolor($width, $height);
        $background = imagecolorallocate($croppedFG, 0, 0, 0);

        // removing the black from the placeholder
        imagecolortransparent($croppedFG, $background);
        imagealphablending($croppedFG, false);
        imagesavealpha($croppedFG, true);
        imagecopyresized($croppedFG, $fg, 0, 0, 0, 0, $width, $height, self::WIDTH, self::HEIGHT);
    
        // Start merging
        $out = imagecreatetruecolor($width, $height);
        imagecopyresampled($out, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        imagecopyresampled($out, $croppedFG, 0, 0, 0, 0, $width, $height, $width, $height);
        ob_start();
        imagepng($out);
        $image = ob_get_clean();
        return $image;
    }
}
