<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<?php
include "../../database/dbHelper.php";
$brandId = $_GET['id'];
$sqlSelectBrand = "SELECT * FROM tbl_brand WHERE id = $brandId";
$brand = executeSingleResult($sqlSelectBrand);
?>
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Thêm mới thương hiệu</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    if (isset($_POST['brandName'])) {

        $name = $_POST['brandName'];

        $sqlUpdate = "UPDATE tbl_brand SET name = '$name' WHERE id = $brandId";

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
                        <div style="display: flex;align-items: center;">
                            <div class="form-group">
                                <label for="brandName">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brandName" id="brandName"
                                    value="<?php echo $brand['name'] ?>" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên thương hiệu.
                                </div>
                            </div>
                            <div style="margin-left: 10px;margin-top: 12px;">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php" ?>
    <script>
    (function() {
        'use strict'
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