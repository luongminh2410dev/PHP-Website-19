<?php
session_start();
if (isset($_SESSION['user']) || isset($_SESSION['username'])) {
    unset($_SESSION['product_recent']);
    unset($_SESSION['user']);
    echo true;
} else {
    echo false;
}
