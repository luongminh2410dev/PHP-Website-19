<?php
require('../database/dbHelper.php');
header('Content-Type: text/html; charset=UTF-8');
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Electro - Laptop Market</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="./css/slick.css" />
    <link type="text/css" rel="stylesheet" href="./css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="./css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./fonts/fontawesome-free-5.13.1-web/css/all.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="./css/style.css" />
    <!-- AJAX -->
    <!-- jQuery Plugins -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.zoom.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +84-921-955-184 </a></li>
                    <li><a href="#"><i class="far fa-envelope"></i> luongminh2410dev@gmail.com </a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Số 3 Cầu Giấy </a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> VNĐ</a></li>
                    <li>
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '
                                <div class="dropdown">
                                <a onclick="handleRedirectProfile()" id="btn_login" href="#">
                                <i class="far fa-user"></i>
                                ' . $_SESSION['user']['name'] . ' </a>
                                    <div class="dropdown-content">
                                        <a style="color: black;" onclick="handleRedirectProfile()">Thông tin tài khoản</a>
                                        <a style="color: black;" href="user_order.php">Đơn mua</a>
                                        <a id="sign-out-button" type="button" style="color: black;">Đăng xuất</a>
                                    </div>
                                </div>';
                        } else {
                            echo '<a onclick="handleShowLoginForm()" id="btn_login" href="#">
                                <i class="far fa-user"></i>
                                Đăng nhập </a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="index.php" class="logo">
                                <img src="./images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form method="POST">
                                <select name="option_search" class="input-select">
                                    <option value="0">Theo tên</option>
                                    <option value="1">Theo hãng</option>
                                    <!-- <option value="2">Theo hãng</option> -->
                                </select>
                                <input class="input" name="search" placeholder="Bạn muốn tìm....">
                                <button name="btn_search" class="search-btn">Tìm kiếm</button>
                            </form>
                            <?php
                            $search_type = 0;
                            if (isset($_POST['btn_search'])) {
                                if (!empty($_POST['option_search'])) {
                                    $search_type = $_POST['option_search'];
                                }
                                $option = stripslashes($_POST['option_search']);
                                $search = trim(stripslashes($_POST['search']));
                                if (empty($search)) {
                                    echo "<script type='text/javascript'>alert('Bạn phải nhập từ khoá tìm kiếm');</script>";
                                } else {
                                    $search_url = 'Location:blank.php?search=' . $search . '&option=' . $search_type . '';
                                    header($search_url);
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div id="whishlist">
                                <?php
                                if (isset($_SESSION['user'])) {
                                    echo '<a href="whishlist_page.php">';
                                    echo '<i class="fas fa-heart"></i>';
                                    echo '<span>Wishlist</span>';
                                    $user = $_SESSION['user'];
                                    $user_id = $user['id'];
                                    $sql = "SELECT * FROM tbl_whishlist WHERE user_id = $user_id";
                                    $result = executeResult($sql);
                                    echo '<div class="qty">' . count($result) . '</div>';
                                    echo '</a>';
                                } else {
                                    echo '<a href="#" onclick="handleShowLoginForm()">';
                                    echo '<i class="fas fa-heart"></i>';
                                    echo '<span>Wishlist</span>';
                                    echo '<div class="qty">0</div>';
                                    echo '</a>';
                                }
                                ?>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown" id="cart">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ Hàng</span>
                                    <div class="qty">
                                        <?php
                                        if (empty($_SESSION['cart'])) {
                                            echo 0;
                                        } else {
                                            echo count($_SESSION['cart']);
                                        }
                                        ?>
                                    </div>
                                </a>
                                <div class="cart-dropdown">
                                    <?php
                                    if (empty($_SESSION['cart'])) {
                                        echo "<p>Chưa có sản phẩm nào trong giỏ hàng</p>";
                                    } else {
                                        echo '<div class="cart-list">';
                                        $totalOrder = 0;
                                        $count = count($_SESSION['cart']);
                                        for ($i = 0; $i < $count; $i++) {
                                            $price = number_format($_SESSION['cart'][$i]["price"], 0, ',', '.');
                                            echo '<div class="product-widget">';
                                            echo '<div class="product-img">';
                                            echo '<img src="../upload-images/' . $_SESSION['cart'][$i]["imageUrl"] . '" alt="">';
                                            echo '</div>';
                                            echo '<div class="product-body">';
                                            echo '<h3 class="product-name"><a href="#">' . $_SESSION['cart'][$i]["name"] . '</a></h3>';
                                            echo '<h4 class="product-price"><span class="qty">' . $_SESSION['cart'][$i]["quantity"] . 'x</span>' . $price . ' đ</h4>';
                                            echo '</div>';
                                            echo '<button class="delete" onclick="removeFromCart(' . $i . ')"><i class="fa fa-close"></i></button>';
                                            echo '</div>';
                                            $totalOrder += $_SESSION['cart'][$i]["total"];
                                        }
                                        echo '</div>';
                                        echo '<div class="cart-summary">';
                                        echo '<small>' . $count . ' Item(s) selected</small>';
                                        echo '<h5>SUBTOTAL: ' . number_format($totalOrder, 0, ',', '.') . ' đ</h5>';
                                        echo '</div>';
                                        echo '<div class="cart-btns">';
                                        echo '<a href="cart_page.php">View Cart</a>';
                                        if (isset($_SESSION['user'])) {
                                            echo '<a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>';
                                        } else {
                                            echo '<a href="#" onclick="handleShowLoginForm()">Checkout <i class="fa fa-arrow-circle-right"></i></a>';
                                        }
                                        echo '</div>';
                                    }
                                    ?>

                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li <?php echo strpos($_SERVER['REQUEST_URI'], 'index.php') ?  'class="active"' : null; ?>><a href="index.php">Trang chủ</a></li>
                    <li <?php echo strpos($_SERVER['REQUEST_URI'], 'store.php') ?  'class="active"' : null; ?>><a href="store.php">Sản phẩm</a></li>
                    <li <?php echo strpos($_SERVER['REQUEST_URI'], 'promotion.php') ?  'class="active"' : null; ?>><a href="promotion.php">Khuyến mại</a></li>
                    <li <?php echo strpos($_SERVER['REQUEST_URI'], 'policyWarranty.php') ?  'class="active"' : null; ?>><a href="policyWarranty.php">Chính sách bảo hành</a></li>
                    <li <?php echo strpos($_SERVER['REQUEST_URI'], 'contact.php') ? 'class="active"' : null; ?>><a href="contact.php">Liên hệ</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
    <script>
        $('#sign-out-button').click(function() {
            $.ajax({
                type: "POST",
                url: "./functions/handleLogout.php"
            }).done(function(msg) {
                msg ? window.location.replace("index.php") : alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
            });
        });
    </script>