<?php
include "../../database/dbHelper.php";

if(isset($_POST['product_detail_id'])){
    $id = $_POST['product_detail_id'];
    $sqlProductDetail = "DELETE FROM tbl_product_details WHERE id = $id";
    if (execute($sqlProductDetail)) {
        echo json_encode("success");
    } else {
        echo json_encode("failed");
    }
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sqlProductDetail = "DELETE FROM tbl_product_details WHERE id_product = $id";
    $sqlProduct = "DELETE FROM tbl_product WHERE id = $id";
    if (execute($sqlProductDetail)) {
        echo execute($sqlProduct);
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}

if(isset($_POST['ids'])){
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    
    $sqlProductDetail = "DELETE FROM tbl_product_details WHERE id_product IN ($strIds)";
    $sqlProduct = "DELETE FROM tbl_product WHERE id IN ($strIds)";
    if (execute($sqlProductDetail)) {
        echo execute($sqlProduct);
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}