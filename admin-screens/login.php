<!doctype html>
<html>

<head>
    <title>Login admin</title>
    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <style type="text/css">
    body {
        background-color: #dad9d8cf;
    }

    .login-register-form-section {
        max-width: 350px;
        margin: 0 auto;
    }

    .login-register-form-section i {
        width: 10px;
    }

    .login-register-form-section .nav-tabs>li>a {
        color: #2abb9b;
    }

    .login-register-form-section .nav-tabs>li.active>a {
        background-color: #2abb9b;
        border-color: #2abb9b;
        color: white;
    }

    .login-register-form-section .nav-tabs>li>a,
    .login-register-form-section .nav-tabs>li.active>a {
        width: 160px;
        text-align: center;
        border-radius: 0;
    }

    .login-register-form-section .nav-tabs {
        padding-bottom: 10px;
        margin-bottom: 10px;
    }


    .login-register-form-section .btn-custom {
        width: 100%;
        background-color: #2abb9b;
        border-color: #2abb9b;
        margin-bottom: 0.5em;
        border-radius: 0;
    }

    .login-register-form-section .btn-custom:hover {
        width: 100%;
        background-color: #48A497;
        border-color: #2abb9b;
    }

    .login-register-form-section .form-group {
        padding: 0 20px;
    }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <div class="login-register-form-section">
            <div class="tab-content" style="border-radius: 20px;padding: 20px;background-color: #fff;margin-top: 50px;">
                <div style="text-align: center;">
                    <h4>ĐĂNG NHẬP HỆ THỐNG</h4>
                    <br>
                </div>
                <?php
                include "../database/dbHelper.php";
                session_start();
                if (isset($_POST['sbm'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $password = md5($password);
                    $sql = "SELECT tbl_user.id, tbl_user.name, tbl_user.phone, tbl_user.email, tbl_user.address, tbl_user.username, tbl_user.password, tbl_user.role_id, tbl_role.name as 'role' 
                    FROM tbl_user INNER JOIN tbl_role on tbl_user.role_id = tbl_role.id 
                    WHERE username = '$username' AND password = '$password' AND role_id != 2";
                    $user = executeSingleResult($sql);
                    if ($user == null) {
                        echo '<div class="alert alert-danger" role="alert">
                                Sai tên đăng nhập hoặc mật khẩu
                             </div>';
                    } else {
                        $role = $user['role'];
                        $_SESSION[$role] = $user;
                        $_SESSION['role'] = $role;
                        header("location: dashboard.php");
                    }
                }
                ?>
                <form class="form-horizontal" method="post" action="">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Username"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password"
                            aria-label="Password" aria-describedby="basic-addon2">
                    </div>
                    <input type="submit" value="Login" name="sbm" class="btn btn-success btn-custom">
                </form>
            </div>
        </div>
    </div>
    <script src="assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>