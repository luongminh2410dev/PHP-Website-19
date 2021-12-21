<?php
include "../../database/dbHelper.php";
$sql = "SELECT * FROM tbl_user";
$listUsers = executeResult($sql);
$limitItem = 5;
$totalPage = ceil(count($listUsers) / $limitItem);
?>
<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>
<div class="page-wrapper">

    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Danh sách người dùng</h4>
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
                                <label for="price">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="role_id">Chức vụ</label>
                                <select class="form-select" name="role_id" id="role_id" required>
                                    <?php

                                    echo '<option value="0">Chọn chức vụ...</option>';

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
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone">Điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username">
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
                            <a target="_blank" id="btnDeleteMany"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Xoá
                            </a>
                            <a href="./user_add.php" target="_blank"
                                class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Thêm mới
                            </a>
                        </div>
                    </div>
                    <h3 class="box-title">Danh sách người dùng</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="border-top-0">Tên</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Số điện thoại</th>
                                    <th class="border-top-0">Địa chỉ</th>
                                    <th class="border-top-0">Tài khoản</th>
                                    <th class="border-top-0">Ngày cập nhật</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8">0 result</td>
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
                    url: "user_delete.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        ids: ids
                    },
                    success: function(data) {
                        if (data == 'success') {
                            alert("Xóa thành công");
                            location.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, errorThrown);
                    }
                })
            }
        }
    });

    function deleteItem(id) {
        let confirmAction = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmAction) {
            $.ajax({
                url: "user_delete.php",
                type: "post",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data == 'success') {
                        alert("Xóa thành công");
                        location.reload();
                    }
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
        startPage: 1,
        hideOnlyOnePage: true,
        onPageClick: function(event, page) {
            $.ajax({
                url: "user_pagination_api.php",
                type: "post",
                dataType: "json",
                data: {
                    currentPage: page,
                    limitItem: limitItem,
                    type: ""
                },
                beforeSend: function() {
                    $('tbody').html(
                        "<tr style='text-align:center;'><td colspan='8'></p>Đang tải danh sách dữ liệu...</p></td></tr>"
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
                            var tr = document.createElement("tr");
                            tr.innerHTML = "";

                            var tdCheck = document.createElement("td");
                            var strCheck =
                                ' <div class="form-check">' +
                                '<input class="form-check-input input-check" type="checkbox" value="' +
                                item.id + '">' +
                                '</div>';
                            tdCheck.insertAdjacentHTML('beforeend', strCheck);
                            var tdName = document.createElement("td");
                            tdName.innerHTML = item.name;
                            var tdPhone = document.createElement("td");
                            tdPhone.innerHTML = item.phone;
                            var tdEmail = document.createElement("td");
                            tdEmail.innerHTML = item.email;
                            var tdAddress = document.createElement("td");
                            tdAddress.innerHTML = item.address;
                            var tdUsername = document.createElement("td");
                            tdUsername.innerHTML = item.username;
                            var tdDate = document.createElement("td");
                            tdDate.innerHTML = item.updated_date;
                            var tdAction = document.createElement("td");
                            var strAction =
                                '<div class="action-item">' +
                                '<a onclick="deleteItem(' + item.id + ')">' +
                                '<i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                '<a href="user_edit.php?id=' + item.id +
                                '"><i class="fas fa-edit"></i></a>' +
                                '</div>';
                            tdAction.insertAdjacentHTML('beforeend', strAction);

                            tr.append(tdCheck);
                            tr.append(tdName);
                            tr.append(tdEmail);
                            tr.append(tdPhone);
                            tr.append(tdAddress);
                            tr.append(tdUsername);
                            tr.append(tdDate);
                            tr.append(tdAction);
                            $('tbody').append(tr);
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
        var phone = $('#phone').val();
        var email = $('#email').val();
        var role_id = $('#role_id').val();
        var address = $('#address').val();
        var username = $('#username').val();
        $.ajax({
            url: "user_search.php",
            type: "post",
            dataType: "json",
            data: {
                name: name,
                phone: phone,
                email: email,
                role_id: role_id,
                address: address,
                username: username,
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
                                url: "user_pagination_api.php",
                                type: "post",
                                dataType: "json",
                                data: {
                                    currentPage: page,
                                    limitItem: 5,
                                    name: name,
                                    phone: phone,
                                    email: email,
                                    role_id: role_id,
                                    address: address,
                                    username: username,
                                    type: "search"
                                },
                                beforeSend: function() {
                                    $('tbody').html(
                                        "<tr style='text-align:center;'><td colspan='8'></p>Đang tải danh sách dữ liệu...</p></td></tr>"
                                    );
                                },
                                success: function(data) {
                                    $('tbody').html("");
                                    $('tbody tr').remove();
                                    data.forEach(function showData(item,
                                        index) {
                                        var tr = document
                                            .createElement("tr")
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
                                        var tdPhone = document
                                            .createElement("td");
                                        tdPhone.innerHTML = item
                                            .phone;
                                        var tdEmail = document
                                            .createElement("td");
                                        tdEmail.innerHTML = item
                                            .email;
                                        var tdAddress = document
                                            .createElement("td");
                                        tdAddress.innerHTML = item
                                            .address;
                                        var tdUsername = document
                                            .createElement("td");
                                        tdUsername.innerHTML = item
                                            .username;
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
                                            '<a href="user_edit.php?id=' +
                                            item.id +
                                            '"><i class="fas fa-edit"></i></a>' +
                                            '</div>';
                                        tdAction.insertAdjacentHTML(
                                            'beforeend',
                                            strAction);

                                        tr.append(tdCheck);
                                        tr.append(tdName);
                                        tr.append(tdEmail);
                                        tr.append(tdPhone);
                                        tr.append(tdAddress);
                                        tr.append(tdUsername);
                                        tr.append(tdDate);
                                        tr.append(tdAction);
                                        $('tbody').append(tr);
                                    })
                                },
                                error: function(jqXHR, textStatus,
                                    errorThrown) {
                                    console.log(textStatus,
                                        errorThrown);
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