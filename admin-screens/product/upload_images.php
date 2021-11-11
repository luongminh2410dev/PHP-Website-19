<?php

// include "../../database/dbHelper.php";

function uploadImageAndSaveToDb($name, $idProduct)
{
    $bool = false;

    for ($i = 0; $i < count($_FILES["$name"]["name"]); $i++) {
        $folder = "../../upload-images/";
        $image_url = $_FILES["$name"]["name"][$i];
        move_uploaded_file($_FILES["$name"]["tmp_name"][$i], "$folder" . "$image_url");
        $sqlAddImage = "INSERT INTO tbl_product_details (image_url, id_product) VALUES ('$image_url', '$idProduct')";
        if(execute($sqlAddImage)){
            $bool = true;
        } else {
            $bool = false;
            break;
        };
    }
    return $bool;
}

?>