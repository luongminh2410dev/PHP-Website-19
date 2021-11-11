<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT * FROM tbl_brand LIMIT $startPage, $limitItem";
    $listBrands = executeResult($sql);
    echo json_encode($listBrands);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $sqlSearch = "SELECT * FROM tbl_brand WHERE name like '%" . $_POST['name'] . "%'";
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= "LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}