<?php
include "../../database/dbHelper.php";

$sqlSearch = "SELECT * FROM tbl_brand WHERE name like '%" . $_POST['name'] . "%'";
$limitItem = 5;
$data = executeResult($sqlSearch);
$totalPage = ceil(count($data) / $limitItem);
$result = new stdClass();
$result->totalPage = "$totalPage";
$result->totalItem = "" . count($data);
echo json_encode($result);