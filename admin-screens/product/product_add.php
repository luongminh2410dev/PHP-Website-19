<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Thêm mới sản phẩm</h4>
            </div>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    include "../../database/dbHelper.php";
    include "upload_images.php";

    if (isset($_POST['sbm'])) {

        $name = $_POST['productName'];
        $price = $_POST['productPrice'];
        $old_price = $_POST['productOldPrice'];
        $cpu = $_POST['productCpu'];
        $screen = $_POST['productScreen'];
        $ram = $_POST['productRam'];
        $vga = $_POST['productVga'];
        $storage = $_POST['productStorage'];
        $pin = $_POST['productPin'];
        $connect = $_POST['productConnect'];
        $os = $_POST['productOs'];
        $type_id = $_POST['productTypeId'];
        $des = $_POST['productDes'];
        $productImages = "productImages";

        $sqlAdd =  "INSERT INTO tbl_product (name, price, old_price, cpu, screen, ram, vga, storage, battery, connect, os, description, type_id)
                    VALUES ('$name', '$price', '$old_price', '$cpu', '$screen','$ram', '$vga', '$storage', '$pin', '$connect', '$os', '$des', '$type_id')";

        $idReturn = executeReturnId($sqlAdd);
        if ($idReturn > 0 && uploadImageAndSaveToDb($productImages, $idReturn)) {

            echo '<div class="alert alert-success" role="alert">
                    Thêm mới sản phẩm thành công.
                  </div>';
        } else {

            echo '<div class="alert alert-danger" role="alert">
                    Thêm mới sản phẩm thất bại.
                  </div>';
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="product_add.php" method="POST" class="needs-validation" novalidate
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="productName" id="exampleInputEmail1"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sản phẩm.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productOldPrice">Giá cũ</label>
                                    <input type="text" class="form-control" name="productOldPrice" id="productOldPrice"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập giá bán.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productPrice">Giá hiện tại</label>
                                    <input type="text" class="form-control" name="productPrice" id="productPrice"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập giá bán.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productTypeId">Loại sản phẩm</label>
                                    <select class="form-select" name="productTypeId" required>
                                        <?php
                                        echo '<option selected disabled value="">Chọn loại sản phẩm...</option>';

                                        $sqlSelectBrand = "SELECT * FROM tbl_brand";
                                        $listBrands = executeResult($sqlSelectBrand);

                                        if (count($listBrands) > 0) {

                                            foreach ($listBrands as $item) {

                                                $brandId = $item['id'];
                                                $sqlSelectCategory =  "SELECT * FROM tbl_category_type WHERE tbl_category_type.brand_id = $brandId";
                                                $listCategories = executeResult($sqlSelectCategory);

                                                echo '<optgroup label="' . $item['name'] . '">';

                                                if (count($listCategories) > 0) {

                                                    foreach ($listCategories as $item) {
                                                        echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                                    }
                                                } else {
                                                    echo "0 results";
                                                }

                                                echo '</optgroup>';
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Vui lòng chọn loại sản phẩm
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productCpu">CPU</label>
                                    <input type="text" class="form-control" name="productCpu" id="productCpu" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập cpu.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productScreen">SCREEN</label>
                                    <input type="text" class="form-control" name="productScreen" id="productScreen"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập màn hình.
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">
                                    <label for="productVga">VGA</label>
                                    <input type="text" class="form-control" name="productVga" id="productVga" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập card đồ họa.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productRam">RAM</label>
                                    <input type="text" class="form-control" name="productRam" id="productRam" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập ram.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productStorage">STORAGE</label>
                                    <input type="text" class="form-control" name="productStorage" id="productStorage"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập ổ cứng.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productPin">PIN</label>
                                    <input type="text" class="form-control" name="productPin" id="productPin" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập pin.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productConnect">CONNECT</label>
                                    <input type="text" class="form-control" name="productConnect" id="productConnect"
                                        required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập kết nối.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productOs">OS</label>
                                    <input type="text" class="form-control" name="productOs" id="productOs" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập hệ điều hành.
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-4">
                                <label>Hình ảnh sản phẩm</label>
                                <div>
                                    <div class="form-group">
                                        <label class="btn btn-primary" for="productImages">Chọn ảnh</label>
                                        <input hidden="true" type="file" name="productImages[]" id="productImages"
                                            onchange="previewFile(this)" required multiple>
                                        <div class="invalid-feedback">
                                            Vui lòng chọn hình ảnh sản phẩm.
                                        </div>
                                    </div>
                                    <div id="list_image_preview" style="display: flex;">

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12 mt-4">
                                <div class="form-group">
                                    <label for="summernote">Mô tả sản phẩm</label>
                                    <br>
                                    <textarea id="summernote" name="productDes" required></textarea>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mô tả.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="sbm" value="Thêm mới"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php" ?>
    <style>
    .preview-image {
        transition: .5s ease;
        backface-visibility: hidden;
        opacity: 1;

    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .container-image:hover .preview-image {
        opacity: 0.3;
    }

    .container-image:hover .middle {
        opacity: 1;
    }

    .container-image {
        position: relative;
        margin-right: 20px;
    }
    </style>
    <script>
    (function() {
        'use strict'

        $('#summernote').summernote({
            placeholder: 'Viết mô tả về sản phẩm',
            tabsize: 2,
            height: 320
        });

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

    var count_images = 0;

    function previewFile(input) {
        var flag = 1;
        const max_images = 4;

        var total_file = document.getElementById("productImages").files.length;

        if (total_file <= max_images) {
            for (var i = 0; i < total_file; i++) {
                var currentIndex = i;

                if (count_images >= 4) {
                    alert("Chọn tối đa 4 ảnh")
                    break;
                }

                if (checkFileExist(event.target.files[i].name)) {
                    alert("File đã tồn tại")
                    flag = 0;
                }
                if (!checkImageFileType(event.target.files[i].type)) {
                    alert("Không đúng định dạng file")
                    flag = 0;
                }

                if (!checkImageSize(event.target.files[i].size)) {
                    alert("File quá nặng ( tối đa 500kb )")
                    flag = 0;
                }

                if (flag == 1) {

                    //element container
                    var div = document.createElement("div");
                    div.classList.add("container-image")

                    //element image
                    var elem = document.createElement("img");
                    elem.classList.add("preview-image")
                    elem.setAttribute("src", URL.createObjectURL(event.target.files[i]));
                    elem.setAttribute("height", "200");
                    elem.setAttribute("width", "200");
                    elem.setAttribute("alt", "Anh");

                    //element remove
                    var button = document.createElement("button");
                    button.classList.add('btnRemoveImg', 'btn', 'btn-danger')
                    button.textContent = "Xóa"
                    button.onclick = function() {
                        $(this).parents('.container-image').remove()
                        count_images--;
                    }

                    //element middle
                    var middle = document.createElement("div");
                    middle.classList.add('middle')

                    //add elements
                    middle.append(button)
                    div.append(elem)
                    div.append(middle)
                    $('#list_image_preview').append(div)
                    count_images++;

                }
            }
        } else {
            alert("Chọn tối đa 4 ảnh")
        }
    }

    function checkImageFileType(fileType) {
        var arrayType = ['jpg', 'png', 'jpeg'];
        var fileExtension = fileType.toString().split('/').pop();
        return arrayType.includes(fileExtension);
    }

    function checkImageSize(size) {
        return parseInt(size) < 500000;
    }

    function checkFileExist(fileName) {
        var bool = true;
        var path = "../../upload-images/" + fileName;
        var response = jQuery.ajax({
            url: path,
            type: 'HEAD',
            async: false
        }).status;

        return (response != "200") ? false : true;
    }
    </script>