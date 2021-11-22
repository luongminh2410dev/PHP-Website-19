<?php
include "../../database/dbHelper.php";
if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    $sqlCategory = "DELETE FROM tbl_category_type WHERE brand_id IN ($strIds)";
    $sqlBrand = "DELETE FROM tbl_brand WHERE id IN ($strIds)";
    if (execute($sqlCategory)) {
        echo execute($sqlBrand);
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sqlCategory = "DELETE FROM tbl_category_type WHERE brand_id = $id";
    $sqlBrand = "DELETE FROM tbl_brand WHERE id = $id";
    if (execute($sqlCategory)) {
        echo execute($sqlBrand);
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}