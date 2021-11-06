<?php
include "../../database/dbHelper.php";

$id = $_POST['orderId'];

$sqlOrder = "SELECT user_name, user_phone, user_address, user_email " .
    "FROM tbl_order " .
    "WHERE id = $id";
$sqlDetailOrder = "SELECT tbl_detail_order.quantity, tbl_detail_order.price, tbl_detail_order.total, tbl_product.name " .
    "FROM tbl_detail_order " .
    "inner join tbl_product on tbl_detail_order.product_id = tbl_product.id " .
    "WHERE tbl_detail_order.order_id = $id";
$order = executeSingleResult($sqlOrder);
$detailOrder = executeResult($sqlDetailOrder);
$result = new stdClass;
$result->user_name = $order['user_name'];
$result->user_phone = $order['user_phone'];
$result->user_address = $order['user_address'];
$result->user_email = $order['user_email'];
$result->data = $detailOrder;
echo json_encode($result);