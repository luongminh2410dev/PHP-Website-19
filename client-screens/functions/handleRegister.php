<?php
require('../../database/dbHelper.php');
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
$fullname = addslashes($_POST['fullname']);
$phoneNumber = addslashes($_POST['phoneNumber']);
// queries
$query1 = 'SELECT username FROM tbl_user WHERE username="' . $username . '" ';
$query2 = 'SELECT username FROM tbl_user WHERE phone="' . $phoneNumber . '"';
//Kiểm tra người dùng đã nhập liệu đầy đủ chưa
if (!$username || !$password || !$fullname || !$phoneNumber) {
    echo "Vui lòng nhập đầy đủ thông tin.";
}
//Kiểm tra tên đăng nhập này đã có người dùng chưa
elseif (executeResult($query1) != null) {
    echo "Tên tài khoản đã tồn tại. Vui lòng chọn tên khác";
    exit;
} elseif (executeResult($query2) != null) {
    echo "Số điện thoại này đã được đăng ký";
    exit;
} else {
    $password = md5($password);
    $queryInsert = 'INSERT INTO tbl_user (username, password, name, phone , role_id) VALUE ("' . $username . '","' . $password . '","' . $fullname . '","' . $phoneNumber . '", 2)';
    $result = execute($queryInsert);
    echo 'Đăng ký thành công!';
}
