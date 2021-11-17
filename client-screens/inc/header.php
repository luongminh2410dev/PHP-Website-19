<?php
require('../database/dbHelper.php');
header('Content-Type: text/html; charset=UTF-8');
session_start();
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->

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
                        if (isset($_SESSION['username']) && isset($_SESSION['fullname'])) {
                            echo '<a onclick="handleRedirectProfile()" id="btn_login" href="#">
                                <i class="far fa-user"></i>
                                ' . $_SESSION['fullname'] . ' </a>';
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
                            <div>
                                <a href="#">
                                    <!-- <i class="fa fa-heart-o"></i> -->
                                    <i class="fas fa-heart"></i>
                                    <span>Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ Hàng</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./images/product01.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./images/product02.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
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