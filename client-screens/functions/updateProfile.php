<?php
require('../../database/dbHelper.php');
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
$fullname = addslashes($_POST['fullname']);
$email = addslashes($_POST['email']);
$address = addslashes($_POST['address']);
if ($fullname == '') {
    echo "Họ tên không được bỏ trống";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email không hợp lệ";
} else {
    $query = 'UPDATE tbl_user 
    SET tbl_user.password = "' . $password . '", tbl_user.name = "' . $fullname . '", tbl_user.email= "' . $email . '", tbl_user.address = "' . $address . '"
    WHERE tbl_user.username = "' . $username . '"';
    $result = execute($query);
    echo 'Cập nhật thành công';
}
