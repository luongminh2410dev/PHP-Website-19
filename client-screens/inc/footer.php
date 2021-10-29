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
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
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
                        <h3 class="footer-title">About Us</h3>
                        <p>Công ty CP vô trách nhiệm 3 thành viên Phúc Lộc Thọ</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i> Số 3 Cầu Giấy </a></li>
                            <li><a href="#"><i class="fa fa-phone"></i> +84-921-955-184 </a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>luongminh2410dev@gmail.com </a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categories</h3>
                        <ul class="footer-links">
                            <li><a href="#">Hot deals</a></li>
                            <li><a href="#">Laptops</a></li>
                            <li><a href="#">Smartphones</a></li>
                            <li><a href="#">Cameras</a></li>
                            <li><a href="#">Accessories</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
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
<!-- /FOOTER -->
<!-- MODAL -->
<div id="register-form" class="modal hide-form">
    <div class="modal__overlay"></div>
    <!-- Register -->
    <div id="dialog_body" id="register-form" class="modal__body">
        <div class="modal__body-main">
            <div class="modal__body-header">
                <span class="modal__body-header-one">Đăng ký</span>
                <button onclick="handleRedirectLogin()" class="modal__body-header-two">Đăng nhập</button>
            </div>
            <form action="" method="POST">
                <div class="modal__body-mainform">
                    <input type="text" class="modal__body-mainform-input" placeholder="Username">
                    <input type="password" class="modal__body-mainform-input" placeholder="Password">
                    <input type="password" class="modal__body-mainform-input" placeholder="Phone Number">
                </div>
                <div class="modal__body-mainform-note">
                    <p>Bằng việc đăng ký, bạn đã đồng ý với <b>Electro.</b> về
                        <a href="#" class="modal__body-mainform-note-link">Điều khoản dịch vụ</a> &
                        <a href="#" class="modal__body-mainform-note-link">Chính sách bảo mật</a>
                    </p>
                </div>
                <div class="modal__control">
                    <button onclick="handleRedirectLogin()" class="btn btn_cancel">TRỞ LẠI</button>
                    <button class="btn btn_primary">ĐĂNG KÝ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="login-form" class="modal hide-form">
    <div class="modal__overlay"></div>
    <!-- Register -->
    <div id="dialog_body" class="modal__body">
        <div class="modal__body-main">
            <div class="modal__body-header">
                <span class="modal__body-header-one">Đăng nhập</span>
                <button onclick="handleRedirectRegister()" class="modal__body-header-two">Đăng ký</button>
            </div>
            <form action="" method="POST">
                <div class="modal__body-mainform">
                    <input type="text" class="modal__body-mainform-input" placeholder="Username">
                    <input type="password" class="modal__body-mainform-input" placeholder="Password">
                </div>
                <div class="modal__control">
                    <button onclick="handleHideDialog()" class="btn btn_cancel">THOÁT</button>
                    <button class="btn btn_primary">ĐĂNG NHẬP</button>
                </div>
            </form>
        </div>
        <div class="modal__connect">
            <button class="btn btn_modal modal__connect_fb">
                <i class="fab fa-facebook-square"></i>
                <span class="modal__connect-text">Kết nối với Facebook</span>
            </button>
            <button class="btn btn_modal modal__connect_gg">
                <i class="fab fa-google-plus-g"></i>
                <span class="modal__connect-text"> Kết nối với Google</span>
            </button>
        </div>
    </div>
</div>
<!-- /MODAL -->
<script>
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
    // 
</script>
<!-- jQuery Plugins -->
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/nouislider.min.js"></script>
<script src="./js/jquery.zoom.min.js"></script>
<script src="./js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

</body>

</html>