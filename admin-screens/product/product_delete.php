<?php
include "../../database/dbHelper.php";

$ids = $_POST['ids'];
$strIds = implode(",", $ids);

$sqlProductDetail = "DELETE FROM tbl_product_details WHERE id_product IN ($strIds)";
$sqlProduct = "DELETE FROM tbl_product WHERE id IN ($strIds)";
if (execute($sqlProductDetail)) {
    echo execute($sqlProduct);
} else {
    echo "<script>alert('Lỗi')</script>";
}