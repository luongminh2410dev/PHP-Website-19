<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Thêm mới hoá đơn</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    include "../../database/dbHelper.php";
    if (isset($_POST['sbm'])) {
        
        $user_id = $_POST['user_id'];
        $phone = $_POST['userPhone'];
        $email = $_POST['userEmail'];
        $address = $_POST['userAddress'];
        $totalAll = $_POST['totalAll'];
    
        $username = executeSingleResult("SELECT name FROM tbl_user where id = $user_id")['name'];
        $sqlAddOrder =  "INSERT INTO tbl_order (user_id, user_name, user_phone, user_email, user_address, total, status)".
                    " VALUES ('$user_id', '$username', '$phone', '$email','$address', '$totalAll', 'Đang chờ xử lý')";

        $idReturn = executeReturnId($sqlAddOrder);
        if ($idReturn > 0) {
            $flag = 1;
            $productId = $_POST['productId'];
            $productQuantity = $_POST['productQuantity'];
            $productPrice = $_POST['productPrice'];
            $productTotal = $_POST['productTotal'];
            for($i = 0; $i < count($productId); $i++){
                $sqlAddOrderDetails =  "INSERT INTO tbl_detail_order (product_id, order_id, quantity, price, total)".
                " VALUES ('$productId[$i]', '$idReturn', '$productQuantity[$i]', '$productPrice[$i]', '$productTotal[$i]')";
                if(execute($sqlAddOrderDetails)){
                    $flag = 1;
                }else{
                    $flag = 0;
                    break;
                }
            }    
            if($flag == 1){
                echo '<div class="alert alert-success" role="alert">
                        Thêm mới sản phẩm thành công.
                      </div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">
                        Thêm mới sản phẩm thất bại.
                      </div>';
            }
           
        } else {

            echo '<div class="alert alert-danger" role="alert">
                    Thêm mới sản phẩm thất bại.
                  </div>';
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="info-customer mb-4">
                            <div style="border-bottom: 1px solid #d9d9d9;">
                                <h4>Chi tiết khách hàng</h4>
                            </div>
                            <div style="padding: 20px;">
                                <div class="form-group">
                                    <label for="brand_id">Khách hàng</label>
                                    <select class="form-select input-info-customer" name="user_id" id="user_id"
                                        required>
                                        <?php
                                        echo '<option selected disabled value="">Chọn khách hàng...</option>';
                                        $sqlSelectUser = "SELECT * FROM tbl_user";
                                        $listUsers = executeResult($sqlSelectUser);

                                        if (count($listUsers) > 0) {

                                            foreach ($listUsers as $item) {

                                                echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn khách hàng.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userPhone">Số điện thoại</label>
                                    <input type="text" class="form-control input-info-customer" name="userPhone"
                                        id="userPhone" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userEmail">Email</label>
                                    <input type="email" class="form-control input-info-customer" name="userEmail"
                                        id="userEmail" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập email.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userAddress">Địa chỉ</label>
                                    <input type="text" class="form-control input-info-customer" name="userAddress"
                                        id="userAddress" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-order mb-4">
                            <div style="border-bottom: 1px solid #d9d9d9;">
                                <h4>Chi tiết hóa đơn</h4>
                            </div>
                            <div style="padding: 20px;">
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

                                        </tbody>
                                        <tfoot>
                                            <tr style="border-color: #ffffff;">
                                                <td style="text-align: end;" colspan="4"><b>Tổng tiền</b></td>
                                                <td style="text-align: end;" id="totalAll"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="product_id">Chọn sản phẩm</label>
                                    <select class="form-select input-info-customer" name="product_id" id="product_id"
                                        required>
                                        <?php
                                        // include "../../database/dbHelper.php";
                                        echo '<option selected disabled value="">Chọn sản phẩm...</option>';
                                        $sqlSelectProduct = "SELECT * FROM tbl_product";
                                        $listProducts = executeResult($sqlSelectProduct);

                                        if (count($listProducts) > 0) {

                                            foreach ($listProducts as $item) {

                                                echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                    <div id="invalid-product" style="color: red;">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userAddress">Số lượng</label>
                                    <input type="number" class="form-control input-info-customer" name="quantity"
                                        id="quantity" value="0" required>
                                    <div id="invalid-quantity" style="color: red;">

                                    </div>
                                </div>
                                <div style="text-align: end;">
                                    <button type="button" class="btn btn-secondary" id="addProduct">
                                        <i class="fas fa-plus-circle"></i> Thêm sản phẩm
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="dataInput">
                            <input type="hidden" id="totalPriceOrder" name="totalAll">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="sbm">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "../layouts/footer.php" ?>
<script>
(function() {
    'use strict'

    $('#user_id').change(function() {
        var userId = $(this).val();
        $.ajax({
            url: "user_api.php",
            type: "post",
            dataType: "json",
            data: {
                userId: userId
            },
            success: function(data) {
                $('#userPhone').val(data.phone);
                $('#userEmail').val(data.email);
                $('#userAddress').val(data.address);
            },
            error: function(jqXHR, textStatus,
                errorThrown) {
                console.log(textStatus, errorThrown);
                console.warn(jqXHR.responseText)
            }
        });
    });

    var i = 1;
    var totalAll = 0;
    var arrProductIds = new Array();
    $('#addProduct').click(function() {
        var productId = $('#product_id').val();
        var quantity = $('#quantity').val();
        if (productId == null) {
            $('#invalid-product').text('Vui lòng chọn sản phẩm')
        } else if (quantity == 0) {
            $('#invalid-quantity').text('Vui lòng chọn số lượng sản phẩm')
        } else {
            $.ajax({
                url: "product_api.php",
                type: "post",
                dataType: "json",
                data: {
                    productId: productId
                },
                success: function(data) {
                    if (arrProductIds.includes(data.id)) {
                        alert("Sản phẩm đã được thêm");
                    } else {
                        arrProductIds.push(data.id);
                        var tr = document.createElement("tr")
                        tr.innerHTML = ""

                        var tdId = document.createElement("td");
                        tdId.innerHTML = data.id;
                        tdId.style.display = "none";
                        tdId.classList.add("product-id");
                        var tdSTT = document.createElement("td");
                        tdSTT.innerHTML = i++;
                        var tdName = document.createElement("td");
                        tdName.innerHTML = data.name;
                        var tdQuantity = document.createElement("td");
                        tdQuantity.innerHTML = quantity;
                        var tdPrice = document.createElement("td");
                        var price = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(data.price);
                        tdPrice.innerHTML = price;
                        var tdTotalPrice = document.createElement("td");
                        var totalPrice = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(data.price * quantity);
                        tdTotalPrice.innerHTML = totalPrice;

                        tr.append(tdId);
                        tr.append(tdSTT);
                        tr.append(tdName);
                        tr.append(tdQuantity);
                        tr.append(tdPrice);
                        tr.append(tdTotalPrice);
                        $('tbody').append(tr);
                        totalAll += data.price * quantity;
                        var totalAll1 = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(totalAll);
                        $('#totalAll').html(totalAll1);

                        var inputPId = document.createElement("input");
                        inputPId.type = "hidden";
                        inputPId.value = data.id;
                        inputPId.name = "productId[]";
                        var inputQuantity = document.createElement("input");
                        inputQuantity.type = "hidden";
                        inputQuantity.value = quantity;
                        inputQuantity.name = "productQuantity[]";
                        var inputPrice = document.createElement("input");
                        inputPrice.type = "hidden";
                        inputPrice.value = data.price;
                        inputPrice.name = "productPrice[]";
                        var inputTotal = document.createElement("input");
                        inputTotal.type = "hidden";
                        inputTotal.value = data.price * quantity;
                        inputTotal.name = "productTotal[]";
                        $('#dataInput').append(inputPId);
                        $('#dataInput').append(inputQuantity);
                        $('#dataInput').append(inputPrice);
                        $('#dataInput').append(inputTotal);
                        $('#totalPriceOrder').val(totalAll);
                    }
                },
                error: function(jqXHR, textStatus,
                    errorThrown) {
                    console.log(textStatus, errorThrown);
                    console.warn(jqXHR.responseText)
                }
            });
        }
    });

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