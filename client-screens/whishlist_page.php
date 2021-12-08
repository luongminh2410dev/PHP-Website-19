<?php
require('./inc/header.php');
?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container" id="whishlist-container">
        <!-- row -->
        <?php
        $user = $_SESSION['user'];
        $user_id = $user['id'];
        $sql = "SELECT * FROM tbl_product INNER JOIN tbl_whishlist ON tbl_product.id = tbl_whishlist.product_id 
            WHERE user_id = $user_id";
        $result = executeResult($sql);
        if (count($result) > 0 && $result != null) {
            foreach ($result as $item) {
                $sqlImg = "SELECT * FROM tbl_product_details WHERE id_product = " . $item['product_id'] . " LIMIT 1";
                $image = executeSingleResult($sqlImg);

                echo '<div style = "margin-top: 20px">';
                echo '<div style="display: flex;justify-content: space-between;align-items: center;">';

                echo '<div style="display:flex;align-items:center;width:400px;">';
                echo '<img src="../upload-images/' . $image["image_url"] . '" style="object-fit:contain;" alt="" width="150px" height="150px">';
                echo '<div style="padding:10px;display:flex;flex-direction:column">';
                echo '<a href="#">' . $item["name"] . '</a>';
                echo '<button style="margin-top:15px;width:180px" type="button" onclick="addToCart(' . $item["product_id"] . ')" class="primary-btn order-submit">Thêm vào giỏ</button>';
                echo '</div>';
                echo '</div>';

                if ($item["old_price"] != 0 && $item['price'] < $item['old_price']) {
                    $discount = 100 - (($item["price"] * 100) / $item["old_price"]);
                    echo '<div style="text-align: end;">';
                    echo '<b style="color: rgb(255, 66, 78);font-size: 20px;">' . number_format($item["price"], 0, ',', '.') . ' đ</b>';
                    echo '<div style="margin-top:5px">';
                    echo '<span style="font-size: 15px;color:rgb(128, 128, 137);text-decoration:line-through;">' . number_format($item["old_price"], 0, ',', '.') . ' đ </span>';
                    echo '<span> | </span>';
                    echo '<span style="color: rgb(255, 66, 78);background-color: rgb(255, 240, 241);border: 1px solid rgb(255, 66, 78);padding: 0px 4px;">-' . round($discount) . '%</span>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<div style="text-align: end;">';
                    echo '<b style="color: rgb(255, 66, 78);font-size: 20px;">' . number_format($item["price"], 0, ',', '.') . ' đ</b>';
                    echo '</div>';
                }
                echo '<div>';
                echo '<button class="btn" onclick="removeFromWhishlist(' . $item["product_id"] . ')" style="min-width:50px;background:#d85858;color:#fff;">Xóa</button>';
                echo '</div>';

                echo '</div>';
                echo '</div>';
            }
        }
        ?>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</div>
<?php
require('./inc/footer.php');
?>