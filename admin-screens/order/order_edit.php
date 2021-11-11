<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<?php
include "../../database/dbHelper.php";
$orderId = $_GET['id'];
$sqlSelectOrder = "SELECT * FROM tbl_order WHERE id = $orderId";
$order = executeSingleResult($sqlSelectOrder);
$sqlSelectDetailOrder = "SELECT tbl_product.name, tbl_detail_order.quantity, tbl_detail_order.price, tbl_detail_order.total
                        FROM tbl_detail_order INNER JOIN tbl_product on tbl_detail_order.product_id = tbl_product.id
                        WHERE order_id = $orderId";
$detail_order = executeResult($sqlSelectDetailOrder);
?>
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Chi tiết hóa đơn</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    if (isset($_POST['name']) && isset($_POST['brand_id'])) {

        $name = $_POST['name'];
        $brand_id = $_POST['brand_id'];
        $sqlUpdate = "UPDATE tbl_category_type SET name = '$name', brand_id = $brand_id WHERE id = $categoryId";

        if (execute($sqlUpdate)) {
            echo '<div class="alert alert-success" role="alert">
                    Cập nhật thành công.
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                Cập nhật thất bại.
            </div>';
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="user-info">
                            <div>
                                <label><strong>Tên khách hàng: </strong></label>
                                <span id="userName"><?php echo $order['user_name'] ?></span>
                            </div>
                            <div>
                                <label><strong>Số điện thoại: </strong></label>
                                <span id="userPhone"><?php echo $order['user_phone'] ?></span>
                            </div>
                            <div>
                                <label><strong>Địa chỉ: </strong></label>
                                <span id="userAddress"><?php echo $order['user_address'] ?></span>
                            </div>
                            <div>
                                <label><strong>Email: </strong></label>
                                <span id="userEmail"><?php echo $order['user_email'] ?></span>
                            </div>
                        </div>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered">
                                <thead style="background-color: #e4e7ea;">
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (count($detail_order) > 0) {
                                        $i = 1;
                                        foreach ($detail_order as $item) { 
                                            echo '<tr>';
                                            echo '<td>'.$i.'</td>';
                                            echo '<td>'.$item['name'].'</td>';
                                            echo '<td>'.$item['quantity'].'</td>';
                                            echo '<td style="text-align: end;">'.number_format($item['price']).' đ'.'</td>';
                                            echo '<td style="text-align: end;">'.number_format($item['total']).' đ'.'</td>';
                                            echo '</tr>';
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr style="border-color: #ffffff;">
                                        <td style="text-align: end;" colspan="4"><b>Tổng tiền</b></td>
                                        <td style="text-align: end;"><?php echo number_format($order['total']) ?> đ</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div style="display: flex;align-items: baseline;" class="mb-3">
                            <label class="me-2">Trạng thái</label>
                            <select class="form-select" style="width: 200px;">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div style="display: flex;justify-content: space-between;">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="button" class="btn btn-secondary" onclick="window.print()">In hóa đơn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php" ?>
    <script>
    (function() {
        'use strict'

        $('#brand_id').val(<?php echo $category["brand_id"] ?>);

        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>