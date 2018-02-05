<?php
class Utility{
    
    function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);
        else{
            return move_uploaded_file($source_url, $destination_url);
        }
        unlink($source_url);
        return imagejpeg($image, $destination_url, $quality);
        }
}
?>