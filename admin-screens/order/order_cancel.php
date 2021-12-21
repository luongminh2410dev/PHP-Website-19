<?php
include "../../database/dbHelper.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sqlCancelOrder = "UPDATE tbl_order SET status = 'Đã hủy' WHERE id = $id";
    if (execute($sqlCancelOrder)) {
        echo json_encode("Done");
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}

if(isset($_POST['ids'])){
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    $sqlCancelOrders = "UPDATE tbl_order SET status = 'Đã hủy' WHERE id IN ($strIds)";
    if (execute($sqlCancelOrders)) {
        echo json_encode("Done");
    } else {
        echo "<script>alert('Lỗi')</script>";
    }
}
?>