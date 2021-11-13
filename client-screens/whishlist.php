<?php
include "../database/dbHelper.php";
if(isset($_POST['productId']) && $_POST['type'] == "add"){
    $productId = $_POST['productId'];
    $userId = 1;
    $sqlGetList = "SELECT * FROM tbl_whishlist WHERE product_id = $productId";
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
    $userId = 1;
    $sqlGetList = "DELETE FROM tbl_whishlist WHERE product_id = $productId AND user_id = $userId";
    if(execute($sqlGetList) ){
        echo json_encode("success");
    }
    else{
        echo json_encode("fail");  
    }
}
?>