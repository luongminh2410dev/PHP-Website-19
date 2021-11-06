<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT tbl_category_type.id, tbl_category_type.name, tbl_category_type.updated_date, tbl_brand.name AS 'brand_name' " .
        "FROM tbl_category_type " .
        "INNER JOIN tbl_brand On tbl_category_type.brand_id = tbl_brand.id " .
        "LIMIT $startPage, $limitItem";
    $listCategories = executeResult($sql);
    echo json_encode($listCategories);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
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
        $sqlSearch .= " tbl_category_type.brand_id = " . $_POST['brand_id'] . " ";
        $firstCondition = false;
    }
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= "LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}