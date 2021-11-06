<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<?php
include "../../database/dbHelper.php";
$userId = $_GET['id'];
$sqlSelectUser = "SELECT * FROM tbl_user WHERE id = $userId";
$user = executeSingleResult($sqlSelectUser);
?>
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Thêm mới người dùng</h4>
            </div>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    if (isset($_POST['sbm'])) {

        $name = $_POST['userName'];
        $phone = $_POST['userPhone'];
        $email = $_POST['userEmail'];
        $address = $_POST['userAddress'];
        $username = $_POST['username'];
        $password = $_POST['userPass'];
        $role_id = $_POST['userRoleId'];

        $sqlUpdate = "UPDATE tbl_user SET name = '$name'," .
            "phone = '$phone'," .
            "email = '$email'," .
            "address = '$address'," .
            "username = '$username'," .
            "password = '$password' " .
            "WHERE id = $userId";

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
                        <div class="row">
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">
                                    <label for="userName">Tên người dùng</label>
                                    <input type="text" class="form-control" name="userName" id="userName"
                                        value="<?php echo $user['name'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên người dùng.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userPhone">Số điện thoại</label>
                                    <input type="text" class="form-control" name="userPhone" id="userPhone"
                                        value="<?php echo $user['phone'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập số điện thoại.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userEmail">Email</label>
                                    <input type="email" class="form-control" name="userEmail" id="userEmail"
                                        value="<?php echo $user['email'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập email.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userRoleId">Chức vụ</label>
                                    <select class="form-select" name="userRoleId" id="role_id" required>
                                        <?php
                                        echo '<option selected disabled value="">Chọn chức vụ...</option>';

                                        $sqlSelectRole = "SELECT * FROM tbl_role";
                                        $listRoles = executeResult($sqlSelectRole);

                                        if (count($listRoles) > 0) {

                                            foreach ($listRoles as $item) {

                                                echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn chức vụ.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">
                                    <label for="userAddress">Địa chỉ</label>
                                    <input type="text" class="form-control" name="userAddress"
                                        value="<?php echo $user['address'] ?>" id="userAddress" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập địa chỉ.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Tài khoản</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="<?php echo $user['username'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tài khoản.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userPass">Mật khẩu</label>
                                    <input type="password" class="form-control" name="userPass" id="userPass"
                                        value="<?php echo $user['password'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu.
                                    </div>
                                </div>

                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="sbm" value="Cập nhật"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php" ?>
    <script>
    (function() {
        'use strict'

        $('#role_id').val(<?php echo $user["role_id"] ?>);

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