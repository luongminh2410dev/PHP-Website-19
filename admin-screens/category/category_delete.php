<?php
include "../../database/dbHelper.php";
if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    $sqlCategory = "DELETE FROM tbl_category_type WHERE id IN ($strIds)";
    if (execute($sqlCategory)) {
        echo json_encode("Done");
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlCategory = "DELETE FROM tbl_category_type WHERE id = $id";
    if (execute($sqlCategory)) {
        echo json_encode("Done");
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}