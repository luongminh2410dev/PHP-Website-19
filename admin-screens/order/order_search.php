<?php
include "../../database/dbHelper.php";

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
$limitItem = 5;
$data = executeResult($sqlSearch);
$totalPage = ceil(count($data) / $limitItem);
$result = new stdClass();
$result->totalPage = "$totalPage";
$result->totalItem = "" . count($data);
echo json_encode($result);