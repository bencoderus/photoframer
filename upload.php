<?php
/**
 * Project: Photo Framer v1.0
 * Author: Benjamin Iduwe
 * Date: June 2020
 */

 
spl_autoload_register();
use app\Services\ImageBuilder;

$file = $_FILES["image"]["tmp_name"];
$design= $_POST["design"];
$image = new ImageBuilder();
$res = $image->upload($file, $design);
echo($res);
