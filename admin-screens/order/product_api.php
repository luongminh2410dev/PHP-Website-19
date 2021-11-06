<?php
include "../../database/dbHelper.php";

$id = $_POST['productId'];
$sql = "SELECT * FROM tbl_product WHERE id = $id";
$result = executeSingleResult($sql);
echo json_encode($result);