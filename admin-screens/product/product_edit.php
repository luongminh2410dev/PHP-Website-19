<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>

<?php
include "../../database/dbHelper.php";
$productId = $_GET['id'];
$sqlSelectProduct = "SELECT * FROM tbl_product WHERE id = $productId";
$product = executeSingleResult($sqlSelectProduct);
?>

<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Chỉnh sửa sản phẩm</h4>
            </div>
        </div>
    </div>
    <?php
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
        $intro = $_POST['productIntro'];
        $des = $_POST['productDes'];
        $type_id = $_POST['productTypeId'];
        $productImages = 'productImages';
        
        $sqlUpdate = "UPDATE tbl_product SET" . " " .
            "name = '$name'," .
            "price = '$price'," .
            "old_price = '$old_price'," .
            "cpu = '$cpu'," .
            "screen = '$screen'," .
            "ram = '$ram'," .
            "vga = '$vga'," .
            "storage = '$storage'," .
            "battery = '$pin'," .
            "connect = '$connect'," .
            "os = '$os'," .
            "introtext = '$intro'," .
            "description = '$des'," .
            "type_id = '$type_id'" . " " .
            "WHERE id = $productId";

        if (execute($sqlUpdate)) {
            $fileImgs = executeResult("SELECT * FROM tbl_product_details WHERE id_product = $productId");
            $sqlDeleteProductDetail = "DELETE FROM tbl_product_details WHERE id_product = $productId";
            execute($sqlDeleteProductDetail);
            foreach($fileImgs as $fileImg){
                unlink('../../upload-images/'.$fileImg['image_url']);
            }
            if(uploadImageAndSaveToDb($productImages, $productId)){
                echo '<div class="alert alert-success" role="alert">
                        Cập nhật sản phẩm thành công.
                      </div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Cập nhật sản phẩm thất bại.
                </div>';
        }
    }
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <form action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <label for="productName">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="productName" id="productName" required
                                        value="<?php echo $product["name"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập tên sản phẩm.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productOldPrice">Giá cũ</label>
                                    <input type="text" class="form-control" name="productOldPrice" id="productOldPrice"
                                        required value="<?php echo $product["old_price"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập giá bán.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productPrice">Giá hiện tại</label>
                                    <input type="text" class="form-control" name="productPrice" id="productPrice"
                                        required value="<?php echo $product["price"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập giá bán.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type_id">Loại sản phẩm</label>
                                    <select class="form-select" name="productTypeId" id="type_id" required>
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
                                    <label for="productCpu">Vi xử lý cpu</label>
                                    <input type="text" class="form-control" name="productCpu" id="productCpu" required
                                        value="<?php echo $product["cpu"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập cpu.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productScreen">Màn hình</label>
                                    <input type="text" class="form-control" name="productScreen" id="productScreen"
                                        required value="<?php echo $product["screen"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập màn hình.
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-lg-6">

                                <div class="form-group">
                                    <label for="productVga">Card đồ họa</label>
                                    <input type="text" class="form-control" name="productVga" id="productVga" required
                                        value="<?php echo $product["vga"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập card đồ họa.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productRam">Ram</label>
                                    <input type="text" class="form-control" name="productRam" id="productRam" required
                                        value="<?php echo $product["ram"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập ram.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productStorage">Ổ cứng</label>
                                    <input type="text" class="form-control" name="productStorage" id="productStorage"
                                        required value="<?php echo $product["storage"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập ổ cứng.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productPin">Pin</label>
                                    <input type="text" class="form-control" name="productPin" id="productPin" required
                                        value="<?php echo $product["battery"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập pin.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productConnect">Cổng kết nối</label>
                                    <input type="text" class="form-control" name="productConnect" id="productConnect"
                                        required value="<?php echo $product["connect"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập kết nối.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productOs">Hề điều hành</label>
                                    <input type="text" class="form-control" name="productOs" id="productOs" required
                                        value="<?php echo $product["os"] ?>">
                                    <div class="invalid-feedback">
                                        Vui lòng nhập hệ điều hành.
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-4">
                                <label for="productIntro">Mô tả ngắn về sản phẩm</label>
                                <textarea class="form-control" id="productIntro" name="productIntro" rows="3"
                                    required><?php echo $product["introtext"] ?></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập mô tả ngắn.
                                </div>
                            </div>

                            <div class="col-lg-12 mt-4">
                                <label>Hình ảnh sản phẩm</label>
                                <div>
                                    <div style="display: flex;">
                                        <div class="form-group">
                                            <label class="btn btn-primary" for="productImages">Chọn ảnh</label>
                                            <input hidden="true" type="file" name="productImages[]" id="productImages"
                                                onchange="previewFile(this)" required multiple>
                                            <div class="invalid-feedback">
                                                Vui lòng chọn hình ảnh sản phẩm.
                                            </div>
                                        </div>
                                        <div id="btnRemoveImages" style="display: none;">
                                            <a target="_blank" id="btnDelete" onclick="removeAllImages()"
                                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                                Xoá
                                            </a>
                                        </div>
                                    </div>

                                    <div id="list_image_preview" style="display: flex;">
                                        <?php
                                       
                                        $sqlImages = "SELECT * FROM tbl_product_details WHERE id_product = $productId";
                                        $listImages = executeResult($sqlImages);
                                        $count_images = count($listImages);
                                        if (count($listImages) > 0) {
                                            foreach ($listImages as $item) {
                                                echo '<div class="container-image">';
                                                echo '<img class="preview-image" src="../../upload-images/' . $item['image_url'] . '" height="200" width="200" alt="Anh">';
                                                echo '</div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-12 mt-4">
                                <div class="form-group">
                                    <label for="summernote">Bài viết</label>
                                    <br>
                                    <textarea id="summernote" name="productDes" required>
                                        <?php echo $product["description"] ?>
                                    </textarea>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập bài viết.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-primary" type="submit" name="sbm" value="Cập nhật"></input>
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
        object-fit: contain;
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

        $('#type_id').val(<?php echo $product["type_id"] ?>);

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

    function previewFile(input) {
        $('#list_image_preview').empty();
        var flag = 1;
        const max_images = 4;
        var images = Array.from(input.files);

        if (images.length <= max_images) {
            for (var i = 0; i < images.length; i++) {

                if (checkFileExist(images[i].name)) {
                    alert("File " + images[i].name + " đã tồn tại")
                    flag = 0;
                    break;
                }

                if (!checkImageFileType(images[i].type)) {
                    alert("File " + images[i].name + " không đúng định dạng file")
                    flag = 0;
                    break;
                }

                if (!checkImageSize(images[i].size)) {
                    alert("File " + images[i].name + " quá nặng ( tối đa 1Mb )")
                    flag = 0;
                    break;
                }

                if (flag == 1) {

                    //element container
                    var div = document.createElement("div");
                    div.classList.add("container-image")

                    //element image
                    var elem = document.createElement("img");
                    elem.classList.add("preview-image")
                    elem.setAttribute("src", URL.createObjectURL(images[i]));
                    elem.setAttribute("height", "200");
                    elem.setAttribute("width", "200");
                    elem.setAttribute("alt", "Anh");

                    //element middle
                    var middle = document.createElement("div");
                    middle.classList.add('middle');

                    //add elements
                    div.append(elem);
                    div.append(middle);
                    $('#list_image_preview').append(div);
                    $('#btnRemoveImages').css('display', 'block');

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
        return parseInt(size) < 1000000;
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

    function removeAllImages() {
        $('#list_image_preview').empty();
        $('#btnRemoveImages').css('display', 'none');
    }
    </script>