<?php
    session_start();
    $role = $_SESSION['role'];
    unset($_SESSION[$role]);
    unset($_SESSION['role']);
    header("location: ../login.php");
?>