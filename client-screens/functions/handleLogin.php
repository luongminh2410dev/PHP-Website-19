<?php
session_start();
require('../../database/dbHelper.php');
$username = addslashes($_POST['login-username']);
$password = addslashes($_POST['login-password']);
if (!$username || !$password) {
    echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
} else {
    $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
    $result = executeResult($query);
    if ($result == null) {
        echo "Tài khoản hoặc mật khẩu không đúng. Vui lòng kiểm tra lại.";
    } else {
        // Lưu tên đăng nhập
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $result[0]['name'];
        $_SESSION['user_id'] = $result[0]['id'];
        echo "Đăng nhập thành công!";
    }
}
