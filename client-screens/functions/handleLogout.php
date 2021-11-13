<?php
session_start();
if (isset($_SESSION['username']) || isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    unset($_SESSION['fullname']);
    unset($_SESSION['product_recent']);
    echo true;
} else {
    echo false;
}
