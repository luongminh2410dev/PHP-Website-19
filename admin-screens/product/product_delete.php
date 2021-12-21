<?php
include "../../database/dbHelper.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $fileImgs = executeResult("SELECT * FROM tbl_product_details WHERE id_product = $id");
    $sqlProductDetail = "DELETE FROM tbl_product_details WHERE id_product = $id";
    $sqlProduct = "DELETE FROM tbl_product WHERE id = $id";
    if (execute($sqlProductDetail)) {
        if(execute($sqlProduct)){
            foreach($fileImgs as $fileImg){
                unlink('../../upload-images/'.$fileImg['image_url']);
            }
            echo json_encode("success");
        };
    } else {
        echo json_encode("failed");
    }
}

if(isset($_POST['ids'])){
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    $sqlProductDetail = "DELETE FROM tbl_product_details WHERE id_product IN ($strIds)";
    $fileImgs = executeResult("SELECT * FROM tbl_product_details WHERE id_product IN ($strIds)");
    $sqlProduct = "DELETE FROM tbl_product WHERE id IN ($strIds)";
    if (execute($sqlProductDetail)) {
        if(execute($sqlProduct)){
            foreach($fileImgs as $fileImg){
                unlink('../../upload-images/'.$fileImg['image_url']);
            }
            echo json_encode("success");
        };
    } else {
        echo json_encode("failed");
    }
}