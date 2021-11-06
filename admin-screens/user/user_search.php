<?php
include "../../database/dbHelper.php";

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
$limitItem = 5;
$data = executeResult($sqlSearch);
$totalPage = ceil(count($data) / $limitItem);
$result = new stdClass();
$result->totalPage = "$totalPage";
$result->totalItem = "" . count($data);
echo json_encode($result);