<div id="snackbar"></div>
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
                        <h3 class="footer-title">About Us</h3>
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
                        <h3 class="footer-title">References</h3>
                        <ul class="footer-links">
                            <li><a target="_blank" href="https://cellphones.com.vn/">CellphoneS</a></li>
                            <li><a target="_blank" href="https://www.thegioididong.com/">Thegioididong</a></li>
                            <li><a target="_blank" href="https://www.php.net/manual/en/index.php">PHP Manual</a></li>
                            <li><a target="_blank" href="https://freetuts.net/">Freetuts</a></li>
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
<?php
require('./inc/login-form.php');
require('./inc/register-form.php');
?>
<!-- /FOOTER -->
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
// // Turn off phone auth app verification.
// firebase.auth().settings.appVerificationDisabledForTesting = true;

// var phoneNumber = "+84975967842";
// var testVerificationCode = "123456";

// // This will render a fake reCAPTCHA as appVerificationDisabledForTesting is true.
// // This will resolve after rendering without app verification.
// var appVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
// // signInWithPhoneNumber will call appVerifier.verify() which will resolve with a fake
// // reCAPTCHA response.
// firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
//     .then(function(confirmationResult) {
//         alert('Here')
//         // confirmationResult can resolve with the fictional testVerificationCode above.
//         return confirmationResult.confirm(testVerificationCode)
//     }).catch(function(error) {
//         // Error; SMS not sent
//         // ...
//     });
</script>
<!-- jQuery Plugins -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="./js/jquery.min.js"></script>
<script src="./js/phone-auth.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/nouislider.min.js"></script>
<script src="./js/jquery.zoom.min.js"></script>
<script src="./js/cart.js"></script>
<script src="./js/whishlist.js"></script>
<script src="./js/main.js"></script>
</body>

</html>