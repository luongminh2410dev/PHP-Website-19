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
                <div id="recaptcha-container" class="modal__body-mainform">
                    <input type="text" id="login-form-username" class="modal__body-mainform-input" placeholder="Tài khoản">
                    <input type="password" class="modal__body-mainform-input" placeholder="Mật khẩu">
                    <div class="modal__otp-authen">
                        <input type="text" style="max-width: 150px; margin:0px 16px 0px 0px;" class="modal__body-mainform-input" placeholder="Mã OTP">
                        <button class="btn btn_primary">Xác nhận</button>
                    </div>
                    <div class="modal__body-mainform-note">
                        <p>Nếu bạn chưa có tài khoản, bạn có thể đăng ký tài khoản mới <a onclick="handleRedirectRegister()" class="modal__body-mainform-note-link">tại đây</a>
                        </p>
                        <!-- <p>Vui lòng nhập mã OTP từ điện thoại để hoàn tất đăng nhập</p> -->
                    </div>
                </div>

                <div class="modal__control">
                    <button onclick="handleHideDialog()" class="btn btn_cancel">THOÁT</button>
                    <button id="sign-in-button" class="btn btn_primary">ĐĂNG NHẬP</button>
                </div>
            </form>
        </div>
        <!-- <div class="modal__connect">
            <button class="btn btn_modal modal__connect_fb">
                <i class="fab fa-facebook-square"></i>
                <span class="modal__connect-text">Kết nối với Facebook</span>
            </button>
            <button class="btn btn_modal modal__connect_gg">
                <i class="fab fa-google-plus-g"></i>
                <span class="modal__connect-text"> Kết nối với Google</span>
            </button>
        </div> -->
    </div>
</div>