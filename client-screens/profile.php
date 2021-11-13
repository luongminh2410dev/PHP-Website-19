<?php
require('./inc/header.php');
require('./functions/renderListProduct.php');
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <div class="col-md-7">
            <!-- Billing Details -->
            <div class="billing-details">
                <div class="section-title">
                    <h3 class="title">Thông tin tài khoản</h3>
                </div>
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username']) {
                    $username = $_SESSION['username'];
                    $query = 'SELECT * FROM tbl_user WHERE username = "' . $username . '"';
                    $result = executeResult($query)[0];
                    if ($result != null) {
                        echo '<div class="form-group">
                                <input class="input" id="profile-username" type="text" readonly="readonly" disabled="disabled" name="profile-username" value="' . $result['username'] . '" placeholder="Tài khoản">
                            </div>
                            <div class="form-group">
                                <input class="input" id="profile-password" type="password" name="profile-password" value="' . $result['password'] . '" placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <input class="input" id="profile-fullname" type="email" name="profile-fullname" value="' . $result['name'] . '" placeholder="Họ Tên">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" readonly="readonly" disabled="disabled" name="profile-phonenumber" value="' . $result['phone'] . '" placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <input class="input" id="profile-email" type="text" name="profile-email" value="' . $result['email'] . '" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="input" id="profile-address" type="text" name="profile-address" value="' . $result['address'] . '" placeholder="Địa chỉ">
                            </div>';
                    }
                }
                ?>
                <div class="modal__control">
                    <button id="sign-out-button" type="button" class="btn btn_cancel">Đăng xuất</button>
                    <button id="update-profile-button" type="button" name="update-profile-button" class="btn btn_primary">Cập nhật thông tin</button>
                </div>
            </div>
        </div>
        <div class="col-md-5 order-details">
            <div class="aside">
                <h3 class="aside-title">Sản phẩm đã xem</h3>
                <?php
                if (isset($_SESSION['product_recent']) && $_SESSION['product_recent']) {
                    $product_recent_array = implode(",", $_SESSION['product_recent']);
                    $sql = 'SELECT tbl_product.id, tbl_product.name, tbl_product.price,tbl_product_details.image_url AS image_url, tbl_category_type.name AS brand_type 
                    FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
                    WHERE tbl_product.type_id = tbl_category_type.id
                    AND tbl_product_details.id_product = tbl_product.id
                    AND tbl_product.id IN(' . $product_recent_array . ')
                    GROUP BY tbl_product.id';
                    $listTopSelling = executeResult($sql);
                    foreach ($listTopSelling as $item) {
                        $price          = number_format($item['price'], 0, ',', '.');
                        $old_price        = number_format($item['price'] + 1000000, 0, ',', '.');
                        echo '<div onclick="handleRedirectProduct(' . $item['id'] . ')" class="product-widget">
							<div class="product-img">
								<img src="' . $item['image_url'] . '" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">' . $item['brand_type'] . '</p>
								<h3 class="product-name"><a href="#">' . $item['name'] . '</a></h3>
								<h4 class="product-price">₫ ' . $price . ' <del class="product-old-price">₫ ' . $old_price . '</del></h4>
							</div>
						</div>';
                    }
                } else {
                    echo '<span>Bạn chưa xem sản phẩm nào...</span>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<script>
    const usernameField = document.getElementById('profile-username');
    const passwordField = document.getElementById('profile-password');
    const fullnameField = document.getElementById('profile-fullname');
    const emailField = document.getElementById('profile-email');
    const addressField = document.getElementById('profile-address');
    $('#sign-out-button').click(function() {
        $.ajax({
            type: "POST",
            url: "./functions/handleLogout.php"
        }).done(function(msg) {
            msg ? window.location.replace("index.php") : alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
        });
    });
    $('#update-profile-button').click(function() {
        $.ajax({
            type: "POST",
            url: "./functions/updateProfile.php",
            data: {
                'username': usernameField.value,
                'password': passwordField.value,
                'fullname': fullnameField.value,
                'email': emailField.value,
                'address': addressField.value
            }
        }).done(function(msg) {
            // msg != null ?
            //     alert('Cập nhật thành công') :
            //     alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
            alert(msg);
            location.reload();
        });
    });
</script>
<?php
require('./inc/footer.php');
?>