<?php
include "../../database/dbHelper.php";

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
$limitItem = 5;
$data = executeResult($sqlSearch);
$totalPage = ceil(count($data) / $limitItem);
$result = new stdClass();
$result->totalPage = "$totalPage";
$result->totalItem = "" . count($data);
echo json_encode($result);