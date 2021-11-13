<?php
include "../database/dbHelper.php";
session_start();
if(isset($_POST['productId']) && !isset($_POST['quantity'])  && $_POST['type'] == "add"){
    $productId = $_POST['productId'];
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = [];
        addToCart($productId);     
    } else {
    $flag = 0;
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if($_SESSION["cart"][$i]["id"] == $productId){
            $_SESSION["cart"][$i]["quantity"]++;
            $_SESSION["cart"][$i]["total"] = $_SESSION["cart"][$i]["quantity"] * $_SESSION["cart"][$i]["price"];
            $flag = 1;
        }         
    }
    if($flag == 0){
        addToCart($productId);     
    }
}   
    echo json_encode("success");
}

if(isset($_POST['productId']) && isset($_POST['quantity'])  && $_POST['type'] == "add"){
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = [];
        addToCartWithQuantity($productId, $quantity);      
    } else {
    $flag = 0;
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if($_SESSION["cart"][$i]["id"] == $productId){
            $_SESSION["cart"][$i]["quantity"]+= $quantity;
            $_SESSION["cart"][$i]["total"] = $_SESSION["cart"][$i]["quantity"] * $_SESSION["cart"][$i]["price"];
            $flag = 1;
        }         
    }
    if($flag == 0){
        addToCartWithQuantity($productId, $quantity);     
    }
}   
    echo json_encode("success");
}

if(isset($_POST['idItemCart']) && $_POST['type'] == "remove"){
    $id = $_POST['idItemCart'];
    $carts = $_SESSION["cart"];
    array_splice($carts, $id, 1);
    $_SESSION['cart'] = $carts;
    echo json_encode("success");
}

if(isset($_POST['idItemCart']) && $_POST['type'] == "update"){
    $id = $_POST['idItemCart'];
    $quantity = $_POST['quantity'];
    $carts = $_SESSION["cart"];
    $carts[$id]["quantity"] = $quantity;
    $carts[$id]["total"] = $quantity * $carts[$id]["price"];
    $_SESSION['cart'] = $carts;
    echo json_encode("success");
}


function addToCart($productId){
    $total = 0;
    $sql = "SELECT * FROM tbl_product WHERE id = $productId";
    $sqlImg = "SELECT * FROM tbl_product_details WHERE id_product = $productId LIMIT 1";
    $result  = executeSingleResult($sql);
    $image = executeSingleResult($sqlImg);
    $total = $result['price'];
    $itemCart = array("id" => $result['id'],
                      "name" => $result['name'],
                      "imageUrl" => $image['image_url'],
                      "quantity" => 1,
                      "price" => $result['price'],
                      "total" => $total, );
    $_SESSION['cart'][] = $itemCart;      
}

function addToCartWithQuantity($productId, $quantity){
    $total = 0;
    $sql = "SELECT * FROM tbl_product WHERE id = $productId";
    $sqlImg = "SELECT * FROM tbl_product_details WHERE id_product = $productId LIMIT 1";
    $result  = executeSingleResult($sql);
    $image = executeSingleResult($sqlImg);
    $total = $result['price'];
    $itemCart = array("id" => $result['id'],
                      "name" => $result['name'],
                      "imageUrl" => $image['image_url'],
                      "quantity" => $quantity,
                      "price" => $result['price'],
                      "total" => $total, );
    $_SESSION['cart'][] = $itemCart;      
}
?>