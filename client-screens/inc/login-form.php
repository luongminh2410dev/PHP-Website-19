<div id="login-form" class="modal hide-form">
    <div onclick="handleHideAllDialog()" class="modal__overlay"></div>
    <!-- Register -->
    <div id="dialog_body" class="modal__body">
        <div class="modal__body-main">
            <div class="modal__body-header">
                <span class="modal__body-header-one">Đăng nhập</span>
                <button onclick="handleRedirectRegister()" type="button" class="modal__body-header-two">Đăng ký</button>
            </div>
            <form method="POST">
                <div class="modal__body-mainform">
                    <input type="text" id="login-form-username" name="login-username" class="modal__body-mainform-input" placeholder="Tài khoản">
                    <input type="password" id="login-form-password" name="login-password" class="modal__body-mainform-input" placeholder="Mật khẩu">
                    <div class="modal__body-mainform-note">
                        <p>Nếu bạn chưa có tài khoản, bạn có thể đăng ký tài khoản mới <a onclick="handleRedirectRegister()" class="modal__body-mainform-note-link">tại đây</a>
                        </p>
                    </div>
                </div>
                <div class="modal__control">
                    <button onclick="handleHideDialog()" type="button" class="btn btn_cancel">THOÁT</button>
                    <button id="sign-in-button" type="button" name="login-button" class="btn btn_primary">ĐĂNG NHẬP</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    const login_username = document.getElementById("login-form-username");
    const login_password = document.getElementById("login-form-password");
    $('#sign-in-button').click(function() {
        $.ajax({
            type: "POST",
            url: "./functions/handleLogin.php",
            data: {
                'login-username': login_username.value,
                'login-password': login_password.value,
            }
        }).done(function(msg) {
            alert(msg)
            if (msg == 'Đăng nhập thành công!') {
                location.reload();
            }
        });
    });
</script>