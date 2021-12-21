<?php
include "../../database/dbHelper.php";
$sql = "SELECT * FROM tbl_brand";
$listBrands = executeResult($sql);
$limitItem = 5;
$totalPage = ceil(count($listBrands) / $limitItem);
?>

<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Danh sách thương hiệu</h4>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div style="display: flex;align-items: center;">
                        <label for="name" class="me-4">Tên thương hiệu</label>
                        <div class="form-group" style="width: 75%;">
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <button type="submit" id="btnSearch" class="btn btn-primary"
                            style="margin-left: 20px;margin-bottom: 16px;">Tìm
                            kiếm</button>
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
                            <a target="_blank" id="btnDeleteMany"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Xoá
                            </a>
                            <a href="./brand_add.php" target="_blank"
                                class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Thêm mới
                            </a>
                        </div>
                    </div>
                    <h3 class="box-title">Danh sách thương hiệu</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="border-top-0">Tên thương hiệu</th>
                                    <th class="border-top-0">Ngày cập nhật</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">0 result</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul id="pagination" class="pagination-sm"></ul>
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

    $('#btnDeleteMany').click(function() {
        var ids = new Array();
        $('.input-check').each(function(index) {
            if ($(this).prop('checked')) {
                ids.push($(this).val());
            }
        });
        if (ids.length == 0) {
            alert('Bạn chưa chọn mục nào');
        } else {
            let confirmAction = confirm("Bạn có chắc chắn muốn xóa " + ids.length + " mục đã chọn?");
            if (confirmAction) {
                $.ajax({
                    url: "brand_delete.php",
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
        }
    });

    function deleteItem(id) {
        let confirmAction = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmAction) {
            $.ajax({
                url: "brand_delete.php",
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
                url: "brand_pagination_api.php",
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
                        var tdName = document.createElement("td");
                        tdName.innerHTML = item.name;
                        var tdDate = document.createElement("td");
                        tdDate.innerHTML = item
                            .updated_date;
                        var tdAction = document.createElement("td");
                        var strAction =
                            '<div class="action-item">' +
                            '<a onclick="deleteItem(' + item.id + ')">' +
                            '<i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                            '<a href="brand_edit.php?id=' + item.id +
                            '"><i class="fas fa-edit"></i></a>' +
                            '</div>';
                        tdAction.insertAdjacentHTML('beforeend', strAction);

                        tr.append(tdCheck);
                        tr.append(tdName);
                        tr.append(tdDate);
                        tr.append(tdAction);
                        $('tbody')
                            .append(tr);
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $('#btnSearch').click(function() {
        var name = $('#name').val();
        $.ajax({
            url: "brand_search.php",
            type: "post",
            dataType: "json",
            data: {
                name: name,
                type: "search"
            },
            success: function(data) {
                $('#messageSearch').text("Tìm thấy " + data.totalItem + " kết quả");
                if (data.totalItem == 0) {
                    $('tbody').html(
                        "<tr style='text-align:center;'><td colspan='8'></p>0 có dữ liệu</p></td></tr>"
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
                                url: "brand_pagination_api.php",
                                type: "post",
                                dataType: "json",
                                data: {
                                    currentPage: page,
                                    limitItem: 5,
                                    name: name,
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
                                                "tr")
                                        tr.innerHTML = ""

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
                                        var tdName = document
                                            .createElement("td");
                                        tdName.innerHTML = item
                                            .name;
                                        var tdDate = document
                                            .createElement("td");
                                        tdDate.innerHTML = item
                                            .updated_date;
                                        var tdAction = document
                                            .createElement("td");
                                        var strAction =
                                            '<div class="action-item">' +
                                            '<a onclick="deleteItem(' +
                                            item.id + ')">' +
                                            '<i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                            '<a href="brand_edit.php?id=' +
                                            item.id +
                                            '"><i class="fas fa-edit"></i></a>' +
                                            '</div>';
                                        tdAction.insertAdjacentHTML(
                                            'beforeend',
                                            strAction);

                                        tr.append(tdCheck);
                                        tr.append(tdName);
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
    </script>