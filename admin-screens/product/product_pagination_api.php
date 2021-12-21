<?php
include "../../database/dbHelper.php";
if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $startPage = ($currentPage - 1) * $limitItem;
    $sql = "SELECT tbl_product.id, tbl_product.name, tbl_product.cpu, tbl_product.screen, tbl_product.ram, tbl_product.vga, tbl_product.storage, tbl_product.battery, tbl_product.connect, tbl_product.os, tbl_product.price, tbl_product.description, tbl_product.type_id, tbl_product.create_date, tbl_product.updated_date, tbl_product.old_price, tbl_product.total, tbl_product.sold, tbl_product.introtext, tbl_product_details.image_url FROM tbl_product ".
    "INNER JOIN tbl_product_details ON tbl_product.id = tbl_product_details.id_product GROUP BY tbl_product.id ORDER BY create_date DESC LIMIT $startPage, $limitItem";
    $listProducts = executeResult($sql);
    echo json_encode($listProducts);
}

if (isset($_POST['currentPage']) && isset($_POST['limitItem']) && !empty($_POST['type'])) {
    $limitItem = $_POST['limitItem'];
    $currentPage = $_POST['currentPage'];
    $sqlSearch = "SELECT tbl_product.id, tbl_product.name, tbl_product.cpu, tbl_product.screen, tbl_product.ram, tbl_product.vga, tbl_product.storage, tbl_product.battery, tbl_product.connect, tbl_product.os, tbl_product.price, tbl_product.description, tbl_product.type_id, tbl_product.create_date, tbl_product.updated_date, tbl_product.old_price, tbl_product.total, tbl_product.sold, tbl_product.introtext, tbl_product_details.image_url FROM tbl_product ".
    "INNER JOIN tbl_product_details ON tbl_product.id = tbl_product_details.id_product WHERE";
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
        $sqlSearch .= " battery like '%" . $_POST['pin'] . "%'";
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
    $startPage = ($currentPage - 1) * $limitItem;
    $sqlSearch .= " GROUP BY tbl_product.id LIMIT $startPage, $limitItem";
    $data = executeResult($sqlSearch);
    echo json_encode($data);
}