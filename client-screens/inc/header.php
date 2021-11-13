<?php
require('../database/dbHelper.php');
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
    <!-- FIREBASE SDK -->
    <script type="module" src="./js/firebase-sdk.js"></script>
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
                        <a onclick="handleShowLoginForm()" id="btn_login" href="#">
                            <i class="far fa-user"></i>
                            <!-- <i class="fa fa-user-o"></i>  -->
                            Đăng nhập </a>
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
                                    <option value="0">Search</option>
                                    <option value="1">Gaming</option>
                                    <option value="2">Văn phòng</option>
                                </select>
                                <input class="input" name="search" placeholder="Bạn muốn tìm....">
                                <button name="btn_search" class="search-btn">Tìm kiếm</button>
                            </form>
                            <?php
                            if (isset($_POST['btn_search'])) {
                                $option = stripslashes($_POST['option_search']);
                                $search = trim(stripslashes($_POST['search']));
                                if (empty($search)) {
                                    echo "<script type='text/javascript'>alert('Bạn phải nhập từ khoá tìm kiếm');</script>";
                                } else {
                                    $search_url = 'Location:blank.php?search=' . $search;
                                    header($search_url);
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix" id="cart-whishlist">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div id="whishlist">
                                <a href="whishlist_page.php">
                                    <!-- <i class="fa fa-heart-o"></i> -->
                                    <i class="fas fa-heart"></i>
                                    <span>Wishlist</span>
                                    <?php 
                                        $sql = "SELECT * FROM tbl_whishlist WHERE user_id = 1";
                                        $result = executeResult($sql);
                                    ?>
                                    <div class="qty"><?php echo count($result) ?></div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown" id="cart">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ Hàng</span>
                                    <div class="qty"><?php
                                        if(empty($_SESSION['cart'])){
                                            echo 0;
                                        } else {
                                            echo count($_SESSION['cart']) ;
                                        }
                                     ?></div>
                                </a>
                                <div class="cart-dropdown">
                                    <?php
                                        if(empty($_SESSION['cart'])){
                                            echo "<p>Chưa có sản phẩm nào trong giỏ hàng</p>";
                                        } else {
                                          echo '<div class="cart-list">';
                                          $totalOrder = 0;
                                          $count = count($_SESSION['cart']);
                                          for ($i = 0; $i < $count; $i++) {
                                            $price = number_format($_SESSION['cart'][$i]["price"], 0, ',', '.');
                                            echo '<div class="product-widget">';
                                            echo '<div class="product-img">';
                                            echo '<img src="'.$_SESSION['cart'][$i]["imageUrl"].'" alt="">';
                                            echo '</div>';
                                            echo '<div class="product-body">';
                                            echo '<h3 class="product-name"><a href="#">'.$_SESSION['cart'][$i]["name"].'</a></h3>';
                                            echo '<h4 class="product-price"><span class="qty">'.$_SESSION['cart'][$i]["quantity"].'x</span>'.$price.' đ</h4>';
                                            echo '</div>';
                                            echo '<button class="delete" onclick="removeFromCart('.$i.')"><i class="fa fa-close"></i></button>';
                                            echo '</div>';
                                            $totalOrder += $_SESSION['cart'][$i]["total"];
                                          }      
                                          echo '</div>';
                                          echo '<div class="cart-summary">';
                                          echo '<small>'.$count.' Item(s) selected</small>';
                                          echo '<h5>SUBTOTAL: '.number_format($totalOrder, 0, ',', '.').' đ</h5>';
                                          echo '</div>';
                                          echo '<div class="cart-btns">';
                                          echo '<a href="cart_page.php">View Cart</a>';
                                          echo '<a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>';
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Hot Deals</a></li>
                    <li><a href="store.php">Laptop Theo Hãng</a></li>
                    <li><a href="#">Laptop Văn Phòng</a></li>
                    <li><a href="#">Laptops Gaming</a></li>
                    <li><a href="#">Linh, Phụ Kiện Laptop</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->