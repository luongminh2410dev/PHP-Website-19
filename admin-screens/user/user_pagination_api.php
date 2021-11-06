<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT * FROM tbl_user LIMIT $startPage, $limitItem";
    $listUsers = executeResult($sql);
    echo json_encode($listUsers);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $sqlSearch = "SELECT * FROM tbl_user WHERE";
    $firstCondition = true;
    if (!empty($_POST['name'])) {
        $sqlSearch .= " name like '%" . $_POST['name'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['role_id'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " role_id = " . $_POST['role_id'] . "";
        $firstCondition = false;
    }
    if (!empty($_POST['email'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " email like '%" . $_POST['email'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['phone'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " phone like '%" . $_POST['phone'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['address'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " address like '%" . $_POST['address'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['username'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " username like '%" . $_POST['username'] . "%'";
        $firstCondition = false;
    }
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= " LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}