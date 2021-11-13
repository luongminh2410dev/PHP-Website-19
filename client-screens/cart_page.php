<?php
require('./inc/header.php');
require('../functions/functionHelper.php');
?>
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Giỏ hàng</h3>
                <!-- <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Blank</li>
                </ul> -->
            </div>
        </div>

    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container" id="cart-container">
        <!-- row -->
        <div class="row">
            <?php  
            if(empty($_SESSION['cart'])){
                echo '<h3 style="text-align:center;">Chưa có sản phẩm nào trong giỏ hàng</h3>';
            }  else {
                echo '<div class="col-md-8">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Sản phẩm</th>';
                echo '<th>Số lượng</th>';
                echo '<th>Đơn giá</th>';
                echo '<th>Thành tiền</th>';
                echo '<th></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $count = count($_SESSION['cart']);
                    for ($i = 0; $i < $count; $i++) {
                        $price = number_format($_SESSION['cart'][$i]["price"], 0, ',', '.');
                        echo '<tr>';
                        echo '<td >';
                        echo '<div style="display:flex;align-items:center;width:300px">';
                        echo '<img src="'.$_SESSION['cart'][$i]["imageUrl"].'" style="object-fit:contain;" alt="" width="100px" height="100px">';
                        echo '<a href="#">'.$_SESSION['cart'][$i]["name"].'</a>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td style="width:90px;vertical-align:middle">';
                        echo '<input type="number" class="form-control" value="'.$_SESSION['cart'][$i]["quantity"].'" onchange="updateCart(event, '.$i.')" min="1">';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo $price.' đ';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo number_format($_SESSION['cart'][$i]["total"], 0, ',', '.').' đ';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo '<a style="color:red;cursor:pointer" onclick="removeFromCart('.$i.')">X</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
            ?>
            <?php
                  if(!empty($_SESSION['cart'])){
                    echo '<div class="col-md-4 order-details">';
                    echo '<div class="section-title text-center">';
                    echo '<h3 class="title">Giỏ hàng</h3>';
                    echo '</div>';
                    echo '<div class="order-summary">';
                    echo '<div class="order-col">';
                    echo '<div><strong>Sản phẩm</strong></div>';
                    echo '<div><strong>Thành tiền</strong></div>';
                    echo '</div>';
                    echo '<div class="order-products">';
                    $totalOrder = 0;
                    $count = count($_SESSION['cart']);
                        for ($i = 0; $i < $count; $i++) {
                            echo '<div class="order-col">';
                            echo '<div>'.$_SESSION['cart'][$i]["quantity"].'x '.$_SESSION['cart'][$i]["name"].'</div>';
                            echo '<div>'.number_format($_SESSION['cart'][$i]["total"], 0, ',', '.').' đ</div>';
                            echo '</div>';
                            $totalOrder += $_SESSION['cart'][$i]["total"];
                        }
                    echo '</div>';
                    echo '<div class="order-col">';
                    echo '<div><strong>Tổng tiền</strong></div>';
                    echo '<div><strong class="order-total">'.number_format($totalOrder, 0, ',', '.').' đ</strong></div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<a href="checkout.php" class="primary-btn order-submit">Thanh toán</a>';
                    echo '</div>';
                } else {
                    echo "";
                }
            ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php
require('./inc/footer.php');
?>