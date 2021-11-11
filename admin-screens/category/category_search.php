<?php
include "../../database/dbHelper.php";

$sqlSearch = "SELECT tbl_category_type.id, tbl_category_type.name, tbl_category_type.updated_date, tbl_brand.name AS 'brand_name' " .
    "FROM tbl_category_type " .
    "INNER JOIN tbl_brand On tbl_category_type.brand_id = tbl_brand.id WHERE";
$firstCondition = true;
if (!empty($_POST['name'])) {
    $sqlSearch .= " tbl_category_type.name like '%" . $_POST['name'] . "%'";
    $firstCondition = false;
}
if (!empty($_POST['brand_id'])) {
    if (!$firstCondition) {
        $sqlSearch .= " AND ";
    }
    $sqlSearch .= " tbl_category_type.brand_id = " . $_POST['brand_id'] . "";
    $firstCondition = false;
}
$limitItem = 5;
$data = executeResult($sqlSearch);
$totalPage = ceil(count($data) / $limitItem);
$result = new stdClass();
$result->totalPage = "$totalPage";
$result->totalItem = "" . count($data);
echo json_encode($result);