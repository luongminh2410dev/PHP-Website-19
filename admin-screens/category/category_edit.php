<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<?php
include "../../database/dbHelper.php";
$categoryId = $_GET['id'];
$sqlSelectCategory = "SELECT * FROM tbl_category_type WHERE id = $categoryId";
$category = executeSingleResult($sqlSelectCategory);
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
    if (isset($_POST['name']) && isset($_POST['brand_id'])) {

        $name = $_POST['name'];
        $brand_id = $_POST['brand_id'];
        $sqlUpdate = "UPDATE tbl_category_type SET name = '$name', brand_id = $brand_id WHERE id = $categoryId";

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên dòng sản phẩm</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="<?php echo $category['name'] ?>" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên dòng sản phẩm.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_id">Thương hiệu</label>
                                    <select class="form-select" name="brand_id" id="brand_id" required>
                                        <?php
                                        echo '<option selected disabled >Chọn thương hiệu...</option>';

                                        $sqlSelectBrand = "SELECT * FROM tbl_brand";
                                        $listBrands = executeResult($sqlSelectBrand);

                                        if (count($listBrands) > 0) {

                                            foreach ($listBrands as $item) {
                                                echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn thương hiệu.
                                    </div>
                                </div>
                            </div>
                            <div>
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

        $('#brand_id').val(<?php echo $category["brand_id"] ?>);

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