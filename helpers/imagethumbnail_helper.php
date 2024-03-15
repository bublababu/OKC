<?php
function createThumbnail($sourcePath, $targetPath, $file_type, $thumbWidth, $thumbHeight){
	
    if($file_type== "image/png" || $file_type== "image/x-png")
    {
     $source = imagecreatefrompng($sourcePath);
    }
     elseif($file_type== "image/jpg" || $file_type== "image/jpeg" || $file_type== "mage/pjpeg")
     {
         $source = imagecreatefromjpeg($sourcePath);
     }
     elseif($file_type== "image/gif")
     {
         $source = imagecreatefromgif($sourcePath);
     }
     $width = imagesx($source);
     $height = imagesy($source);
     
     $tnumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
     
     imagecopyresampled($tnumbImage, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
     
     if (imagejpeg($tnumbImage, $targetPath, 90)) {
         imagedestroy($tnumbImage);
         imagedestroy($source);
         return TRUE;
     } else {
         return FALSE;
     }
 }
 ?>