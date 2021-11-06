<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT * FROM tbl_product LIMIT $startPage, $limitItem";
    $listProducts = executeResult($sql);
    echo json_encode($listProducts);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $sqlSearch = "SELECT * FROM tbl_product WHERE";
    $firstCondition = true;
    if (!empty($_POST['name'])) {
        $sqlSearch .= " name like '%" . $_POST['name'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['price'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " price = '" . $_POST['price'] . "'";
        $firstCondition = false;
    }
    if (!empty($_POST['type_id'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " type_id = " . $_POST['type_id'] . "";
        $firstCondition = false;
    }
    if (!empty($_POST['cpu'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " cpu like '%" . $_POST['cpu'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['screen'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " screen like '%" . $_POST['screen'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['ram'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " ram like '%" . $_POST['ram'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['storage'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " storage like '%" . $_POST['storage'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['pin'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " pin like '%" . $_POST['pin'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['connect'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= "connect like '%" . $_POST['connect'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['os'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= "os like '%" . $_POST['os'] . "%'";
        $firstCondition = false;
    }
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= " LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}