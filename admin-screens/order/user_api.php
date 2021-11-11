<?php
include "../../database/dbHelper.php";

$id = $_POST['userId'];
$sql = "SELECT * FROM tbl_user WHERE id = $id";
$result = executeSingleResult($sql);
echo json_encode($result);