<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<?php
if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
} else {
    header("location: ../login.php");
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Thông tin tài khoản</h4>
            </div>
        </div>
    </div>
    <?php
        include "../../database/dbHelper.php";
        if (isset($_POST['sbm'])) {
            $id = $user['id'];
            $name = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $username = $_POST['username'];
           
            if(empty($_POST['password'])){
                $sqlUpdate = "UPDATE tbl_user SET name = '$name'," .
                "phone = '$phone'," .
                "email = '$email'," .
                "address = '$address'," .
                "username = '$username'" .
                "WHERE id = $id";
            } else {
                $password = $_POST['password'];
                $sqlUpdate = "UPDATE tbl_user SET name = '$name'," .
                "phone = '$phone'," .
                "email = '$email'," .
                "address = '$address'," .
                "username = '$username'," .
                "password = '$password' " .
                "WHERE id = $id";
            }
           
            if (execute($sqlUpdate)) {
                $sqlSelectUser = "SELECT * FROM tbl_user WHERE id = $id";
                $userUpdated = executeSingleResult($sqlSelectUser);
                $_SESSION['admin'] = $userUpdated;
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" class="form-horizontal form-material">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Họ và tên</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0"
                                        value="<?php echo $user["name"] ?>" name="fullname">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Email</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="email" value="<?php echo $user["email"] ?>"
                                        class="form-control p-0 border-0" name="email" id="example-email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Số điện thoại</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="<?php echo $user["phone"] ?>"
                                        class="form-control p-0 border-0" name="phone">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Địa chỉ</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="<?php echo $user["address"] ?>"
                                        class="form-control p-0 border-0" name="address">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Username</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="<?php echo $user["username"] ?>"
                                        class="form-control p-0 border-0" name="username">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Password</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="password" class="form-control p-0 border-0" name="password">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <input type="submit" name="sbm" class="btn btn-success" value="Cập nhật" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php" ?>