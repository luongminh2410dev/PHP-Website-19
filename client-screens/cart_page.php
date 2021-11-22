<?php
require('./inc/header.php');
?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container" id="cart-container">
        <!-- row -->
        <div class="row">
            <!-- <div class="col-md-8"> -->
            <?php
            if (empty($_SESSION['cart'])) {
                echo '<h3 style="text-align:center;">Chưa có sản phẩm nào trong giỏ hàng</h3>';
                echo '<br>';
                echo '<div style="text-align:center;"><a href="index.php" class="primary-btn order-submit">Quay lại trang chủ</a></div>';
            } else {
                echo '<div class="col-md-8" >';
                echo '<table class="table table-hover">';
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
                    echo '<div style="display:flex;align-items:center;width:400px">';
                    echo '<img src="' . $_SESSION['cart'][$i]["imageUrl"] . '" style="object-fit:contain;" alt="" width="150px" height="150px">';
                    echo '<a href="#">' . $_SESSION['cart'][$i]["name"] . '</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td style="width:90px;vertical-align:middle">';
                    echo '<input type="number" class="form-control" value="' . $_SESSION['cart'][$i]["quantity"] . '" onchange="updateCart(event, ' . $i . ')" min="1">';
                    echo '</td>';
                    echo '<td style="vertical-align:middle">';
                    echo $price . ' đ';
                    echo '</td>';
                    echo '<td style="vertical-align:middle; color:#005ce6">';
                    echo number_format($_SESSION['cart'][$i]["total"], 0, ',', '.') . ' đ';
                    echo '</td>';
                    echo '<td style="vertical-align:middle">';
                    echo '<a style="color:red;cursor:pointer" onclick="removeFromCart(' . $i . ')"><i class="fa fa-trash-alt"></i></a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
            ?>
            <!-- </div> -->
            <?php
            if (!empty($_SESSION['cart'])) {
                $count = count($_SESSION['cart']);
                $totalOrder = 0;
                for ($i = 0; $i < $count; $i++) {
                    $totalOrder += $_SESSION['cart'][$i]["total"];
                }
                echo '<div class="col-md-4 order-details">
                <div style="display: flex;justify-content: space-between;margin-bottom: 30px;">
                    <div><b>Tạm tính</b></div>
                    <div><strong>' . number_format($totalOrder, 0, ',', '.') . ' đ</strong></div>
                </div>
                <div style="display: flex;justify-content: space-between;margin-bottom: 30px;">
                    <div><strong>Giảm giá</strong></div>
                    <div><strong>0 đ</strong></div>
                </div>
                <div style="display: flex;justify-content: space-between;margin-bottom: 30px;">
                    <div><strong>Tổng tiền</strong></div>
                    <div><strong style="color: #d10024;font-size: 20px;">' . number_format($totalOrder, 0, ',', '.') . ' đ</strong></div>
                </div>
                <div style="text-align: center;">';
                if (isset($_SESSION['user'])) {
                    echo ' <a href="checkout.php" class="primary-btn order-submit">Tiến hành đặt hàng</a>';
                } else {
                    echo ' <a href="#" onclick="handleShowLoginForm()" class="primary-btn order-submit">Tiến hành đặt hàng</a>';
                }
                echo '</div>';

                echo '</div>';
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