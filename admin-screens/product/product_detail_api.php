<?php
include "../../database/dbHelper.php";

$id = $_POST['productId'];

$sql = "SELECT * FROM tbl_product WHERE id = $id";
$sqlImg = "SELECT * FROM tbl_product_details WHERE id_product = $id";
$detail_product = executeSingleResult($sql);
$images = executeResult($sqlImg);
$result = new stdClass;
$result -> product = $detail_product;
$result -> images = $images;
echo json_encode($result);