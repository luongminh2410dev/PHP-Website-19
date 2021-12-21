<?php
include "../../database/dbHelper.php";
if (isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $strIds = implode(",", $ids);
    $sqlUsers = "DELETE FROM tbl_user WHERE id IN ($strIds)";
    if (execute($sqlUsers)) {
        echo json_encode("success");
    } else {
        echo json_encode("failed");
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sqlRemoveUser = "DELETE FROM tbl_user WHERE id = $id";
    if (execute($sqlRemoveUser)) {
        echo json_encode("success");
    } else {
        echo json_encode("failed");
    }
}