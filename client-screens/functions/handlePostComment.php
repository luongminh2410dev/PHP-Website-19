<?php
require('../../database/dbHelper.php');
session_start();
$rating_content = addslashes($_POST['rating_content']);
$rating_star = addslashes($_POST['rating_star']);
$user_id = addslashes($_SESSION['user_id']);
$product_id = addslashes($_POST['product_id']);
// check user has bought product
$queryCheckBought = "SELECT tbl_order.user_id, tbl_detail_order.product_id FROM `tbl_order` INNER JOIN tbl_detail_order 
WHERE tbl_detail_order.order_id = tbl_order.id
AND tbl_order.user_id = $user_id
AND tbl_detail_order.product_id = $product_id";
$resultBought = executeResult($queryCheckBought);
if ($rating_star == null) {
    echo 'Bạn phải chọn số sao đánh giá';
} elseif ($user_id == null || $product_id == null) {
    echo 'Gửi đánh giá thất bại';
} elseif (count($resultBought) <= 0) {
    echo 'Bạn chỉ có thể đánh giá sản phẩm mình đã mua';
} else {
    $checkQuery = "SELECT * FROM tbl_comment WHERE user_id = $user_id AND product_id = $product_id";
    $result = executeResult($checkQuery);
    if ($result) {
        $queryDelete = "DELETE FROM tbl_comment WHERE user_id = $user_id AND product_id = $product_id";
        execute($queryDelete);
    }
    $query = "INSERT INTO tbl_comment (rate, content, user_id, product_id) VALUE ($rating_star, '$rating_content', $user_id, $product_id)";
    execute($query);
    echo 'Gửi đánh giá thành công';
}
