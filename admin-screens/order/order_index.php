<?php
include "../../database/dbHelper.php";
$sql = "SELECT * FROM tbl_order";
$listOrders = executeResult($sql);
$limitItem = 5;
$totalPage = ceil(count($listOrders) / $limitItem);
?>

<?php include "../layouts/header.php" ?>
<?php include "../layouts/sidebar.php" ?>

<div class="page-wrapper">
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Danh sách hóa đơn</h4>
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
                                <label for="orderId">Mã hóa đơn</label>
                                <input type="text" class="form-control" name="name" id="orderId">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="width: 106%;">
                                <div>
                                    <label for="dateRange">Chọn khoảng thời gian</label>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1"
                                        name="datefilter" id="dateRange" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user_id">Khách hàng</label>
                                <select class="form-select" name="user_id" id="user_id">
                                    <?php
                                    echo '<option value="0">Chọn khách hàng...</option>';
                                    $sqlSelectUser = "SELECT * FROM tbl_user";
                                    $listUsers = executeResult($sqlSelectUser);

                                    if (count($listUsers) > 0) {

                                        foreach ($listUsers as $item) {

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
                                <label for="status">Trạng thái</label>
                                <select class="form-select" id="orderStatus">
                                    <option value="0">Chọn trạng thái...</option>
                                    <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                                    <option value="Đang xử lý">Đang xử lý</option>
                                    <option value="Đang giao">Đang giao</option>
                                    <option value="Hoàn thành">Hoàn thành</option>
                                    <option value="Đã hủy">Đã hủy</option>
                                </select>
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
                                Hủy
                            </a>
                            <a href="./order_add.php" target="_blank"
                                class="btn btn-primary  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Thêm mới
                            </a>
                        </div>
                    </div>
                    <h3 class="box-title">Danh sách hóa đơn</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        </div>
                                    </th>
                                    <th class="border-top-0">Mã hóa đơn</th>
                                    <th class="border-top-0">Khách hàng</th>
                                    <th class="border-top-0">Địa chỉ</th>
                                    <th class="border-top-0">Tổng tiền</th>
                                    <th class="border-top-0">Trạng thái</th>
                                    <th class="border-top-0">Ngày bán</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: center;">
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
    <!-- Modal detail product-->
    <div class="modal fade" id="modalDetailProduct" tabindex="-1" aria-labelledby="modalDetailProductLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin chi tiết đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="user-info">
                        <div>
                            <label><strong>Tên khách hàng: </strong></label>
                            <span id="userName"></span>
                        </div>
                        <div>
                            <label><strong>Số điện thoại: </strong></label>
                            <span id="userPhone"></span>
                        </div>
                        <div>
                            <label><strong>Địa chỉ: </strong></label>
                            <span id="userAddress"></span>
                        </div>
                        <div>
                            <label><strong>Email: </strong></label>
                            <span id="userEmail"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Sản phẩm</th>
                                    <th class="border-top-0">Số lượng</th>
                                    <th class="border-top-0">Đơn giá</th>
                                    <th class="border-top-0">Thành tiền</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody id="bodyDetailOrder">
                                <tr>
                                    <td colspan='8'>0 result</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../layouts/footer.php" ?>
    <script>
    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        linkedCalendars: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

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
        if (ids.length == 0) {
            alert('Bạn chưa chọn mục nào');
        } else {
            let confirmAction = confirm("Bạn có chắc chắn muốn hủy " + ids.length + " hóa đơn đã chọn?");
            if (confirmAction) {
                $.ajax({
                    url: "order_cancel.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        ids: ids
                    },
                    success: function(data) {
                        alert("Hủy hóa đơn thành công");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, errorThrown);
                    }
                })
            }
        }
    });

    function deleteItem(id) {
        let confirmAction = confirm("Bạn có chắc chắn muốn hủy hóa đơn này?");
        if (confirmAction) {
            $.ajax({
                url: "order_cancel.php",
                type: "post",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    alert("Hủy hóa đơn thành công");
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
                url: "order_pagination_api.php",
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
                            var tr = document.createElement("tr")
                            tr.innerHTML = ""

                            var tdCheck = document.createElement("td");
                            var strCheck =
                                ' <div class="form-check">' +
                                '<input class="form-check-input input-check" type="checkbox" value="' +
                                item.id + '">' +
                                '</div>';
                            tdCheck.insertAdjacentHTML('beforeend', strCheck);
                            var tdId = document.createElement("td");
                            tdId.innerHTML = item.id;
                            var tdName = document.createElement("td");
                            tdName.innerHTML = item.user_name;
                            var tdAddress = document.createElement("td");
                            tdAddress.innerHTML = item.user_address;
                            var tdTotalPrice = document.createElement("td");
                            var totalPrice = new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(item.total);
                            tdTotalPrice.innerHTML = totalPrice;
                            var tdStatus = document.createElement("td");
                            tdStatus.innerHTML = item.status;
                            var tdDate = document.createElement("td");
                            tdDate.innerHTML = item
                                .created_date;
                            var tdAction = document.createElement("td");
                            var strAction =
                                '<div class="action-item">' +
                                '<a onclick="deleteItem(' + item.id +
                                ')"><i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                '<a href="order_edit.php?id=' + item.id +
                                '"><i class="fas fa-edit"></i></a>' +
                                '</div>';
                            tdAction.insertAdjacentHTML('beforeend', strAction);

                            tr.append(tdCheck);
                            tr.append(tdId);
                            tr.append(tdName);
                            tr.append(tdAddress);
                            tr.append(tdTotalPrice);
                            tr.append(tdStatus);
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
        var id = $('#orderId').val();
        var dateRange = $('#dateRange').val();
        var user_id = $('#user_id').val();
        var status = $('#orderStatus').val();
        console.log(dateRange)
        $.ajax({
            url: "order_search.php",
            type: "post",
            dataType: "json",
            data: {
                id: id,
                dateRange: dateRange,
                user_id: user_id,
                status: status,
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
                                url: "order_pagination_api.php",
                                type: "post",
                                dataType: "json",
                                data: {
                                    currentPage: page,
                                    limitItem: 5,
                                    id: id,
                                    dateRange: dateRange,
                                    user_id: user_id,
                                    status: status,
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
                                        var tdId = document
                                            .createElement("td");
                                        tdId.innerHTML = item.id;
                                        var tdName = document
                                            .createElement("td");
                                        tdName.innerHTML = item
                                            .user_name;
                                        var tdAddress = document
                                            .createElement("td");
                                        tdAddress.innerHTML = item
                                            .user_address;
                                        var tdTotalPrice = document
                                            .createElement("td");
                                        var totalPrice = new Intl
                                            .NumberFormat('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND'
                                            }).format(item.total);
                                        tdTotalPrice.innerHTML =
                                            totalPrice;
                                        var tdStatus = document
                                            .createElement("td");
                                        tdStatus.innerHTML = item
                                            .status;
                                        var tdDate = document
                                            .createElement("td");
                                        tdDate.innerHTML = item
                                            .created_date;
                                        var tdAction = document
                                            .createElement("td");
                                        var strAction =
                                            '<div class="action-item">' +
                                            '<a href="product_delete.php?id=' +
                                            item.id +
                                            '"><i class="fas fa-trash-alt" style="color:#f33155;"></i></a>' +
                                            '<a href="order_edit.php?id=' +
                                            item.id +
                                            '"><i class="fas fa-edit"></i></a>' +
                                            '</div>';
                                        tdAction.insertAdjacentHTML(
                                            'beforeend',
                                            strAction);

                                        tr.append(tdCheck);
                                        tr.append(tdId);
                                        tr.append(tdName);
                                        tr.append(tdAddress);
                                        tr.append(tdTotalPrice);
                                        tr.append(tdStatus);
                                        tr.append(tdDate);
                                        tr.append(tdAction);
                                        $('tbody').append(tr);
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

    function showDetailOrder(orderId) {
        var myModal = new bootstrap.Modal(document.getElementById('modalDetailProduct'))
        $.ajax({
            url: "order_detail_api.php",
            type: "post",
            dataType: "json",
            data: {
                orderId: orderId
            },
            success: function(response) {
                console.log(response)
                $('#userName').text(response.user_name)
                $('#userPhone').text(response.user_phone)
                $('#userAddress').text(response.user_address)
                $('#userEmail').text(response.user_email)
                $('#bodyDetailOrder').html("");
                $('#bodyDetailOrder tr').remove();
                if (response == null) {
                    $('tbody').html(
                        "<tr style='text-align:center;'><td colspan='8'></p>0 có dữ liệu</p></td></tr>"
                    );
                } else {
                    response.data.forEach(function showData(item, index) {
                        var tr = document.createElement("tr")
                        tr.innerHTML = ""

                        var tdName = document.createElement("td");
                        tdName.innerHTML = item.name;
                        var tdQuantity = document.createElement("td");
                        tdQuantity.innerHTML = item.quantity;
                        var tdPrice = document.createElement("td");
                        var price = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(item.price);
                        tdPrice.innerHTML = price;
                        var tdTotalPrice = document.createElement("td");
                        var totalPrice = new Intl.NumberFormat('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).format(item.total);
                        tdTotalPrice.innerHTML = totalPrice;

                        tr.append(tdName);
                        tr.append(tdQuantity);
                        tr.append(tdPrice);
                        tr.append(tdTotalPrice);
                        $('#bodyDetailOrder').append(tr);
                        myModal.show()
                    })
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, errorThrown);
            }
        });
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    </script>