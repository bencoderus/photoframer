<?php
if (isset($_FILES["image"])) {
  require_once "convert.php";
  function generateFileName($ext)
  {
    $filename = time() . rand(100, 999);
    return $filename . $ext;
  }

  $sourceImg = @imagecreatefromstring(@file_get_contents($_FILES["image"]["tmp_name"]));
  if ($sourceImg === false) {
    echo "images/avatar.png";
    exit;
  }

  $image = makeDP($_FILES["image"]["tmp_name"], (isset($_POST["design"]) ? $_POST["design"] : 0));
  $ext = ".jpg";
  $loc = "uploads/" . generateFileName($ext);

  file_put_contents($loc, $image);
  echo $loc;
}
