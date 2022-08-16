<?php

if($result){
  $maxDimW = 100;
  $maxDimH = 50;
  list($width, $height, $type, $attr) = getimagesize( $_FILES['photo']['tmp_name'] );
      $src = imagecreatefromstring(file_get_contents($fn));
      $dst = imagecreatetruecolor( $width, $height );
      imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
      imagejpeg($dst, $target_filename); // adjust format as needed
     }
  move_uploaded_file($_FILES['pdf']['tmp_name'],"pdf/".$_FILES['pdf']['name']);
?>