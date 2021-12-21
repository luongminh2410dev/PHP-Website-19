<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT * FROM tbl_order ORDER BY created_date DESC LIMIT $startPage, $limitItem";
    $listOrders = executeResult($sql);
    echo json_encode($listOrders);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $sqlSearch = "SELECT * FROM tbl_order WHERE";
    $firstCondition = true;
    if (!empty($_POST['id'])) {
        $sqlSearch .= " id like '%" . $_POST['id'] . "%'";
        $firstCondition = false;
    }
    if (!empty($_POST['dateRange'])) {
        $dateRange =  explode(" - ", $_POST['dateRange']);
        $startDate = str_replace('/', '-', $dateRange[0]);
        $startDate1 = date("Y-m-d", strtotime($startDate));
        $endDate = str_replace('/', '-', $dateRange[1]);
        $endDate1 = date("Y-m-d", strtotime($endDate));
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " created_date BETWEEN '$startDate1' AND '$endDate1'";
        $firstCondition = false;
    }
    if (!empty($_POST['user_id'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " user_id = " . $_POST['user_id'] . "";
        $firstCondition = false;
    }
    if (!empty($_POST['status'])) {
        if (!$firstCondition) {
            $sqlSearch .= " AND ";
        }
        $sqlSearch .= " status = '" . $_POST['status'] . "'";
        $firstCondition = false;
    }
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= " LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}