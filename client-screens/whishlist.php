<?php
include "../database/dbHelper.php";
session_start();
if(isset($_POST['productId']) && $_POST['type'] == "add"){
    $user = $_SESSION['user'];
    $productId = $_POST['productId'];
    $userId = $user['id'];
    $sqlGetList = "SELECT * FROM tbl_whishlist WHERE product_id = $productId AND user_id = $userId";
    $result = executeResult($sqlGetList);
    if(count($result) > 0){
        echo json_encode("exist");
    }
    else{
        $sqlAdd = "INSERT INTO tbl_whishlist (user_id, product_id) VALUES($userId, $productId)";
        if(execute($sqlAdd)){
            echo json_encode("success");
        } else {
            echo json_encode("fail");
        }
    }
}

if(isset($_POST['productId']) && $_POST['type'] == "remove"){
    $productId = $_POST['productId'];
    $userId = $_SESSION['user']['id'];
    $sqlGetList = "DELETE FROM tbl_whishlist WHERE product_id = $productId AND user_id = $userId";
    if(execute($sqlGetList) ){
        echo json_encode("success");
    }
    else{
        echo json_encode("fail");  
    }
}
?>