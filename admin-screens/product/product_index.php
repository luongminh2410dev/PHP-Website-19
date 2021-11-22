<?php
include "../../database/dbHelper.php";
$sql = "SELECT * FROM tbl_product INNER JOIN tbl_product_details ON tbl_product.id = tbl_product_details.id_product GROUP BY tbl_product.id";
$listProducts = executeResult($sql);
$limitItem = 5;
$totalPage = ceil(count($listProducts) / $limitItem);
?>

<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Danh sách sản phẩm</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Tên</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="text" class="form-control" name="price" id="price">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type_id">Loại sản phẩm</label>
                                <select class="form-select" name="type_id" id="type_id" required>
                                    <?php

                                    echo '<option value="0">Chọn loại sản phẩm...</option>';

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
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cpu">Vi xử lý cpu</label>
                                <input type="text" class="form-control" name="cpu" id="cpu">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="screen">Màn hình</label>
                                <input type="text" class="form-control" name="screen" id="screen">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ram">Ram</label>
                                <input type="text" class="form-control" name="ram" id="ram">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="storage">Ổ cứng</label>
                                <input type="text" class="form-control" name="storage" id="storage">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pin">Pin</label>
                                <input type="text" class="form-control" name="pin" id="pin">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="connect">Kết nối</label>
                                <input type="text" class="form-control" name="connect" id="connect">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="os">Hệ điều hành</label>
                                <input type="text" class="form-control" name="os" id="os">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" id="btnSearch" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="white-box">
                    <div style="display: flex;justify-content: space-between;align-items: center;">
                        <div>
                            <p id="messageSearch"></p>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <a target="_blank" id="btnDelete"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Xoá
                            </a>
                            <a href="./product_add.php" target="_blank"
                                class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Thêm mới
                            </a>
                        </div>
                    </div>
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="border-top-0">Hình ảnh</th>
                                    <th class="border-top-0">Tên sản phẩm</th>
                                    <th class="border-top-0">Giá bán</th>
                                    <th class="border-top-0">Ngày cập nhật</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class='product-id'></td>
                                    <td>
                                        <div style='display: flex; align-items: center;'>
                                            <img src='https://lumen.thinkpro.vn//backend/uploads/product/avatar/2021/10/16/nitro5-an515-57-bl-rgb-an515-57-54mv-thinkprojpg'
                                                alt='' width='70' height='70' class="image">
                                            <div>
                                                <p class="name">Tên</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">Giá</td>
                                    <td class="date">Ngày</td>
                                    <td>
                                        <div class='action-item'>
                                            <a onclick='showDetailProduct($productId)' class=''><i
                                                    class='fas fa-info'></i></a>
                                            <a href=''><i class='fas fa-trash-alt'></i></a>
                                            <a href='product_edit.php?id=$productId' class=''><i
                                                    class='fas fa-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul id="pagination" class="pagination-sm"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal detail product-->
    <div class="modal fade" id="modalDetailProduct" tabindex="-1" aria-labelledby="modalDetailProductLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="images">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label><strong>Tên sản phẩm: </strong></label>
                                <span id="NAME"></span>
                            </div>
                            <div>
                                <label><strong>Vi xử lý: </strong></label>
                                <span id="CPU"></span>
                            </div>
                            <div>
                                <label><strong>Màn hình: </strong></label>
                                <span id="SCREEN"></span>
                            </div>
                            <div>
                                <label><strong>Card đồ họa: </strong></label>
                                <span id="VGA"></span>
                            </div>
                            <div>
                                <label><strong>RAM: </strong></label>
                                <span id="RAM"></span>
                            </div>
                            <div>
                                <label><strong>Lưu trữ: </strong></label>
                                <span id="STORAGE"></span>
                            </div>
                            <div>
                                <label><strong>Pin: </strong></label>
                                <span id="PIN"></span>
                            </div>
                            <div>
                                <label><strong>Kết nối: </strong></label>
                                <span id="CONNECT"></span>
                            </div>
                            <div>
                                <label><strong>Hệ điều hành: </strong></label>
                                <span id="OS"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../layouts/footer.php" ?>
    <script>
    $("#checkAll").click(function() {
        if ($(this).prop('checked')) {
            $('.input-check').prop('checked', true);
        } else {
            $('.input-check').prop('checked', false);
        }
    });

    $('#btnDelete').click(function() {
        var ids = new Array();
        $('.input-check').each(function(index) {
            if ($(this).prop('checked')) {
                ids.push($(this).val());
            }
        });
        let confirmAction = confirm("Bạn có chắc chắn muốn xóa " + ids.length + " mục đã chọn?");
        if (confirmAction) {
            $.ajax({
                url: "product_delete.php",
                type: "post",
                dataType: "json",
                data: {
                    ids: ids
                },
                success: function(data) {
                    alert("Xóa thành công");
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
        }
    });

    function deleteItem(id) {
        let confirmAction = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmAction) {
            $.ajax({
                url: "product_delete.php",
                type: "post",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    alert("Xóa thành công");
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, errorThrown);
                }
            })
        }
    }

    var totalPage = <?php echo $totalPage; ?>;
    var limitItem = <?php echo $limitItem; ?>;
    $('#pagination').twbsPagination({
        totalPages: totalPage,
        visiblePages: 5,
        hideOnlyOnePage: true,
        startPage: 1,
        onPageClick: function(event, page) {
            $.ajax({
                url: "product_pagination_api.php",
                type: "post",
                dataType: "json",
                data: {
                    currentPage: page,
                    limitItem: limitItem,
                    type: ""
                },
                beforeSend: function() {
                    $('tbody').html(
                        "<tr style='text-align:center;'><td colspan='6'></p>Đang tải danh sách dữ liệu...</p></td></tr>"
                    );
                },
                success: function(data) {
                    $('tbody').html("");
                    $('tbody tr').remove();
                    if (data == null) {
                        $('tbody').html(
                            "<tr style='text-align:center;'><td colspan='8'></p>0 có dữ liệu</p></td></tr>"
                        );
                    } else {
                        data.forEach(function showData(item, index) {
                            var tr = document.createElement("tr")
                            tr.innerHTML = ""

                            var tdCheck = document.createElement("td");
                            var strCheck =
                                ' <div class="form-check">' +
                                '<input class="form-check-input input-check" type="checkbox" value="' +
                                item.id + '">' +
                                '</div>';
                            tdCheck.insertAdjacentHTML('beforeend', strCheck);
                            var tdImage = document.createElement("td");
                            var strImage =
                                '<img src="../../upload-images/' + item.image_url +
                                '" ' +
                                'alt = "" style="object-fit:contain" width = "70" height = "70"class = "image">';
                            tdImage.insertAdjacentHTML('beforeend', strImage);
                            var tdName = document.createElement("td");
                            tdName.innerHTML = item.name;
                            var tdPrice = document.createElement("td");
                            var price = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(item.price);
                            tdPrice.innerHTML = price;
                            var tdDate = document.createElement("td");
                            tdDate.innerHTML = item
                                .updated_date;
                            var tdAction = document.createElement("td");
                            var strAction =
                                '<div class="action-item">' +
                                '<a onclick="showDetailProduct(' + item.id +
                                ')"><i class="fas fa-eye"></i>' +
                                '</a>' +
                                '<a onclick="deleteItem(' + item.id +
                                ')"><i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                '<a href="product_edit.php?id=' + item.id +
                                '"><i class="fas fa-edit"></i></a>' +
                                '</div>';
                            tdAction.insertAdjacentHTML('beforeend', strAction);

                            tr.append(tdCheck);
                            tr.append(tdImage);
                            tr.append(tdName);
                            tr.append(tdPrice);
                            tr.append(tdDate);
                            tr.append(tdAction);
                            $('tbody')
                                .append(tr);
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $('#btnSearch').click(function() {
        var name = $('#name').val();
        var price = $('#price').val();
        var type_id = $('#type_id').val();
        var cpu = $('#cpu').val();
        var screen = $('#screen').val();
        var ram = $('#ram').val();
        var storage = $('#storage').val();
        var pin = $('#pin').val();
        var connect = $('#connect').val();
        var os = $('#os').val();
        $.ajax({
            url: "product_search.php",
            type: "post",
            dataType: "json",
            data: {
                name: name,
                price: price,
                type_id: type_id,
                cpu: cpu,
                screen: screen,
                ram: ram,
                storage: storage,
                pin: pin,
                connect: connect,
                os: os,
                type: "search"
            },
            success: function(data) {
                $('#messageSearch').text("Tìm thấy " + data.totalItem + " kết quả");
                if (data.totalItem == 0) {
                    $('tbody').html(
                        "<tr style='text-align:center;'><td colspan='6'></p>0 có dữ liệu</p></td></tr>"
                    );
                } else {
                    $('#pagination').twbsPagination('destroy');
                    $('#pagination').twbsPagination({
                        totalPages: data.totalPage,
                        visiblePages: 5,
                        hideOnlyOnePage: true,
                        startPage: 1,
                        onPageClick: function(event, page) {
                            $.ajax({
                                url: "product_pagination_api.php",
                                type: "post",
                                dataType: "json",
                                data: {
                                    currentPage: page,
                                    limitItem: 5,
                                    name: name,
                                    price: price,
                                    type_id: type_id,
                                    cpu: cpu,
                                    screen: screen,
                                    ram: ram,
                                    storage: storage,
                                    pin: pin,
                                    connect: connect,
                                    os: os,
                                    type: "search"
                                },
                                beforeSend: function() {
                                    $('tbody').html(
                                        "<tr style='text-align:center;'><td colspan='6'></p>Đang tải danh sách dữ liệu...</p></td></tr>"
                                    );
                                },
                                success: function(data) {
                                    $('tbody').html("");
                                    $('tbody tr').remove();
                                    data.forEach(function showData(item,
                                        index) {
                                        var tr = document
                                            .createElement(
                                                "tr");
                                        tr.innerHTML = "";

                                        var tdCheck = document
                                            .createElement("td");
                                        var strCheck =
                                            ' <div class="form-check">' +
                                            '<input class="form-check-input input-check" type="checkbox" value="' +
                                            item.id + '">' +
                                            '</div>';
                                        tdCheck.insertAdjacentHTML(
                                            'beforeend',
                                            strCheck);
                                        var tdImage = document
                                            .createElement("td");
                                        var strImage =
                                            '<img src="../../upload-images/' +
                                            item.image_url +
                                            '" ' +
                                            'alt = "" style="object-fit:contain" width = "70" height = "70"class = "image">';
                                        tdImage.insertAdjacentHTML(
                                            'beforeend',
                                            strImage);
                                        var tdName = document
                                            .createElement("td");
                                        tdName.innerHTML = item
                                            .name;
                                        var tdPrice = document
                                            .createElement("td");
                                        var price = new Intl
                                            .NumberFormat('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND'
                                            }).format(item.price);
                                        tdPrice.innerHTML = price;
                                        var tdDate = document
                                            .createElement("td");
                                        tdDate.innerHTML = item
                                            .updated_date;
                                        var tdAction = document
                                            .createElement("td");
                                        var strAction =
                                            '<div class="action-item">' +
                                            '<a onclick="showDetailProduct(' +
                                            item.id +
                                            ')"><i class=" fas fa-eye"></i>' +
                                            '</a>' +
                                            '<a onclick="deleteItem(' +
                                            item.id + ')">' +
                                            '<i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                            '<a href="product_edit.php?id=' +
                                            item.id +
                                            '"><i class="fas fa-edit"></i></a>' +
                                            '</div>';
                                        tdAction.insertAdjacentHTML(
                                            'beforeend',
                                            strAction);

                                        tr.append(tdCheck);
                                        tr.append(tdImage);
                                        tr.append(tdName);
                                        tr.append(tdPrice);
                                        tr.append(tdDate);
                                        tr.append(tdAction);
                                        $('tbody')
                                            .append(tr);
                                    })
                                },
                                error: function(jqXHR, textStatus,
                                    errorThrown) {
                                    console.log(textStatus, errorThrown);
                                    console.warn(jqXHR.responseText)
                                }
                            });
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        })
    })

    function showDetailProduct(productId) {
        $('#images img').remove();
        var myModal = new bootstrap.Modal(document.getElementById('modalDetailProduct'))
        $.ajax({
            url: "product_detail_api.php",
            type: "post",
            dataType: "json",
            data: {
                productId: productId
            },
            success: function(response) {
                response.images.forEach(function showImages(item, index) {
                    var strImage =
                        '<img src="../../upload-images/' + item.image_url + '" ' +
                        'alt = "" style="object-fit:contain" width = "150" height = "150">';
                    $('#images').append(strImage);
                })
                $('#NAME').text(response.product.name)
                $('#CPU').text(response.product.cpu)
                $('#SCREEN').text(response.product.screen)
                $('#VGA').text(response.product.vga)
                $('#RAM').text(response.product.ram)
                $('#STORAGE').text(response.product.storage)
                $('#PIN').text(response.product.battery)
                $('#CONNECT').text(response.product.connect)
                $('#OS').text(response.product.os)
                myModal.show()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, errorThrown);
            }
        });
    }
    </script>