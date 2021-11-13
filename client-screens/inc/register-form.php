<div id="register-form" class="modal hide-form">
    <div onclick="handleHideAllDialog()" class="modal__overlay"></div>
    <!-- Register -->
    <div id="dialog_body" id="register-form" class="modal__body">
        <div class="modal__body-main">
            <div class="modal__body-header">
                <span class="modal__body-header-one">Đăng ký</span>
                <button onclick="handleRedirectLogin()" type="button" class="modal__body-header-two">Đăng nhập</button>
            </div>
            <form action="" method="POST">
                <div class="modal__body-mainform">
                    <input type="text" id="register-form-username" class="modal__body-mainform-input" placeholder="Tài khoản">
                    <input type="password" id="register-form-password" class="modal__body-mainform-input" placeholder="Mật khẩu">
                    <input type="text" id="register-form-fullname" class="modal__body-mainform-input" placeholder="Họ tên">
                    <input type="text" id="register-form-phonenumber" class="modal__body-mainform-input" placeholder="Số điện thoại">
                    <div class="modal__otp-authen">
                        <input type="text" id="register-form-otp-input" style="max-width: 150px; margin:0px 16px 0px 0px;" class="modal__body-mainform-input" placeholder="Mã OTP">
                        <button type="button" id="get-otp-button" class="btn btn_primary">Gửi mã xác thực</button>
                    </div>
                    <div id="recaptcha-container"></div>
                </div>

                <div class="modal__body-mainform-note">
                    <p>Bằng việc đăng ký, bạn đã đồng ý với <b>Electro.</b> về
                        <a href="#" class="modal__body-mainform-note-link">Điều khoản dịch vụ</a> &
                        <a href="#" class="modal__body-mainform-note-link">Chính sách bảo mật</a>
                    </p>
                </div>
                <div class="modal__control">
                    <button onclick="handleRedirectLogin()" type="button" class="btn btn_cancel">TRỞ LẠI</button>
                    <button id="register-button" type="button" class="btn btn_primary">ĐĂNG KÝ</button>
                </div>
            </form>
        </div>
    </div>
</div>