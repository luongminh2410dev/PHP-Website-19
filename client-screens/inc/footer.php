<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Đăng ký để nhận <strong>Gift Voucher</strong> và Deals Hot</p>
                    <form>
                        <input class="input" type="email" placeholder="Nhập Email của bạn...">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Đăng ký</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i style="font-size: 20px;" class="fab fa-facebook-square"></i></a>
                        </li>
                        <li>
                            <a href="#"><i style="font-size: 20px;" class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i style="font-size: 20px;" class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i style="font-size: 20px;" class="fab fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Công ty chủ quản</h3>
                        <p>Công ty CP vô trách nhiệm 3 thành viên Phúc Lộc Thọ</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i> Số 3 Cầu Giấy </a></li>
                            <li><a href="#"><i class="fa fa-phone"></i> +84-921-955-184 </a></li>
                            <li><a href="#"><i class="far fa-envelope"></i>luongminh2410dev@gmail.com </a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Danh mục</h3>
                        <ul class="footer-links">
                            <li><a href="#">Khuyến mãi</a></li>
                            <li><a href="#">Các sản phẩm</a></li>
                            <li><a href="#">Chính sách bảo hành</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <!-- <li><a href="#">Accessories</a></li> -->
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Tài liệu</h3>
                        <ul class="footer-links">
                            <li><a target="_blank" href="https://cellphones.com.vn/">CellphoneS</a></li>
                            <li><a target="_blank" href="https://www.thegioididong.com/">Thegioididong</a></li>
                            <li><a target="_blank" href="https://www.php.net/manual/en/index.php">PHP Manual</a></li>
                            <li><a target="_blank" href="https://freetuts.net/">Freetuts</a></li>
                            <li><a target="_blank" href="https://sandbox.onlinephpfunctions.com/">PHP Sandbox</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Dịch vụ</h3>
                        <ul class="footer-links">
                            <li><a href="#">Tài khoản</a></li>
                            <li><a href="#">Xem giỏ hàng</a></li>
                            <li><a href="#">Danh sách ước</a></li>
                            <li><a href="#">Giao hàng miễn phí</a></li>
                            <li><a href="#">Bảo hành tận nơi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

</footer>
<?php
require('./inc/login-form.php');
require('./inc/register-form.php');
?>
<!-- /FOOTER -->
<!-- Script -->
<script>
    function handleHideAllDialog() {
        $('#login-form').addClass('hide-form');
        $('#register-form').addClass('hide-form');
    }

    function handleShowLoginForm() {
        $('#login-form').addClass('show-form');
        $('#login-form').removeClass('hide-form');
    }

    function handleRedirectRegister() {
        $('#login-form').removeClass('show-form');
        $('#login-form').addClass('hide-form');

        $('#register-form').addClass('show-form');
        $('#register-form').removeClass('hide-form');
    }

    function handleRedirectLogin() {
        $('#login-form').addClass('show-form');
        $('#login-form').removeClass('hide-form');

        $('#register-form').removeClass('show-form');
        $('#register-form').addClass('hide-form');
    }

    function handleHideDialog() {
        $('#login-form').removeClass('show-form');
        $('#login-form').addClass('hide-form');

        $('#register-form').removeClass('show-form');
        $('#register-form').addClass('hide-form');
    }
    // handle when user click into product
    function handleRedirectProduct($id) {
        $href = 'product.php?product_id=' + $id;
        $(location).prop('href', $href);
    }
    // handle redirect to profile-page
    function handleRedirectProfile() {
        $(location).prop('href', 'profile.php');
    }
</script>
<script src="./js/slick.min.js"></script>
<script src="./js/nouislider.min.js"></script>
<script src="./js/main.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-analytics.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.20.0/firebase-auth.js"></script>
<script src="./js/authentication-otp.js"></script>

</body>

</html>