<?php

function cropImage($file_name, $dest, $crop_height, $crop_width) {
    
    $file_type = explode('.', $file_name);
    $file_type = $file_type[count($file_type) - 1];
    $file_type = strtolower($file_type);

    $original_image_size = getimagesize($file_name);
    $original_width = $original_image_size[0];
    $original_height = $original_image_size[1];

    if ($file_type == 'jpg') {
        $original_image_gd = imagecreatefromjpeg($file_name);
    }

    if ($file_type == 'gif') {
        $original_image_gd = imagecreatefromgif($file_name);
    }

    if ($file_type == 'png') {
        $original_image_gd = imagecreatefrompng($file_name);
    }

    $cropped_image_gd = imagecreatetruecolor($crop_width, $crop_height);
    $wm = $original_width / $crop_width;
    $hm = $original_height / $crop_height;
    $h_height = $crop_height / 2;
    $w_height = $crop_width / 2;

    if ($original_width > $original_height) {
        $adjusted_width = $original_width / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;

        imagecopyresampled($cropped_image_gd, $original_image_gd, -$int_width, 0, 0, 0, $adjusted_width, $crop_height, $original_width, $original_height);
    } elseif (($original_width < $original_height ) || ($original_width == $original_height )) {
        $adjusted_height = $original_height / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;

        imagecopyresampled($cropped_image_gd, $original_image_gd, 0, -$int_height, 0, 0, $crop_width, $adjusted_height, $original_width, $original_height);
    } else {

        imagecopyresampled($cropped_image_gd, $original_image_gd, 0, 0, 0, 0, $crop_width, $crop_height, $original_width, $original_height);
    }
    //$dest = "test/bmw_cropped.jpg"; //edit filename for cropped image
    //use the correct path if necessary
    return imagejpeg($cropped_image_gd, $dest, 100);
}

function borrarImagenCualquierFormato($file_name){
    
    echo "quiero borrar " . $file_name ."<br>";
    if(file_exists($file_name . ".jpg")){        
        unlink($file_name . ".jpg");
        echo "borre $file_name.jpg";
    }else if(file_exists($file_name . ".jpeg")){
        unlink($file_name . ".jpeg");
        echo "borre $file_name.jpeg";
    }else if(file_exists($file_name . ".png")){
        unlink($file_name . ".png");
        echo "borre $file_name.png";
    }else if(file_exists($file_name . ".gif")){
        unlink($file_name . ".gif");
        echo "borre $file_name.gif";
    }else{
        echo "no existe ninguna imagen";
    }
    echo "<br><br>";
}

?>