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

        <?php
        if(empty($_SESSION['cart'])){
            echo "<h3>Chưa có sản phẩm nào trong giỏ hàng</h3>";
        } else {
            echo '<div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    '.
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
                    }'.
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 order-details">

            </div>
        </div>';
        }
        ?>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php
require('./inc/footer.php');
?>