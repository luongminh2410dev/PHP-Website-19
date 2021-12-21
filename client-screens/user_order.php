<?php
require('./inc/header.php');
?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container" id="cart-container">
        <!-- row -->
        <div class="row">
            <span style="margin-bottom: 12px;" class="breadcrumb-header">Đơn hàng của bạn</span>
            <?php
            if (isset($_SESSION['user'])) {
                $query = 'SELECT * FROM tbl_order WHERE user_id = ' . $_SESSION['user']['id'] . ' ;';
                $result = executeResult($query);
                if (count($result) <= 0) {
                    echo '<h3 style="text-align:center;">Bạn chưa mua sản phẩm nào</h3>';
                    echo '<br>';
                    echo '<div style="text-align:center;"><a href="index.php" class="primary-btn order-submit">Quay lại trang chủ</a></div>';
                } else {
                    echo '<div class="col-md-12" >';
                    echo '<table class="table table-hover">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Người nhận</th>';
                    echo '<th>Số điện thoại</th>';
                    echo '<th>Tổng tiền</th>';
                    echo '<th>Trạng thái</th>';
                    echo '<th>Địa chỉ</th>';
                    echo '<th>Ngày đặt</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($result as $i) {
                        $price = number_format($i["total"], 0, ',', '.');
                        echo '<tr>';
                        echo '<td style="vertical-align:middle">';
                        echo '<p>' . $i['user_name'] . '</p>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo '<p>' . $i['user_phone'] . '</p>';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo '<p>' . $price . ' đ</p>';
                        echo '</td>';
                        echo '<td style="vertical-align:middle; color:#005ce6">';
                        echo ' <p>' . $i['status'] . '</p>';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo '<p>' . $i['user_address'] . '</p>';
                        echo '</td>';
                        echo '</td>';
                        echo '<td style="vertical-align:middle">';
                        echo '<p>' . $i['created_date'] . '</p>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
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