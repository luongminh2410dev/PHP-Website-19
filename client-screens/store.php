<?php
require('./inc/header.php');
require('../functions/functionHelper.php');

$query = 'select count(id) as total from tbl_product';
$row = executeOneResult($query);
$total_records = $row['total'];
//TÌM LIMIT VÀ CURRENT_PAGE
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 9;

// TÍNH TOÁN TOTAL_PAGE VÀ START
// tổng số trang
$total_page = ceil($total_records / $limit);

// Giới hạn current_page trong khoảng 1 đến total_page
if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}

// Tìm Start
$start = ($current_page - 1) * $limit;

?>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Nhãn hiệu</h3>
					<div class="checkbox-filter">
						<?php
						$sql = 'SELECT tbl_brand.name, COUNT(tbl_product.id) as total
						FROM tbl_brand INNER JOIN tbl_product INNER JOIN tbl_category_type
						WHERE tbl_brand.id = tbl_category_type.brand_id
						AND tbl_category_type.id = tbl_product.type_id
						GROUP BY tbl_brand.name;';
						$listBrand = executeResult($sql);
						foreach ($listBrand as $item) {
							echo '<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										' . $item['name'] . '
										<small>(' . $item['total'] . ')</small>
									</label>
								</div>';
						}
						?>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Giá trị</h3>
					<div class="price-filter">
						<div id="price-slider"></div>
						<div class="input-number price-min">
							<input id="price-min" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Dòng máy</h3>
					<div class="checkbox-filter">
						<?php
						$sql = 'SELECT tbl_category_type.name, COUNT(tbl_product.id) as total
						FROM tbl_product INNER JOIN tbl_category_type
						WHERE tbl_category_type.id = tbl_product.type_id
						GROUP BY tbl_category_type.name;';
						$listBrand = executeResult($sql);
						foreach ($listBrand as $item) {
							echo '<div class="input-checkbox">
							<input type="checkbox" id="brand-1">
							<label for="brand-1">
								<span></span>
								' . $item['name'] . '
								<small>(' . $item['total'] . ')</small>
							</label>
						</div>';
						}
						?>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Top bán chạy</h3>
					<?php
					$sql = 'SELECT tbl_product.name, tbl_product.price,tbl_product_details.image_url AS image, tbl_category_type.name AS brand_type 
					FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
					WHERE tbl_product.type_id = tbl_category_type.id
					AND tbl_product_details.id_product = tbl_product.id
					GROUP BY tbl_product_details.id_product';
					$listTopSelling = executeResult($sql);
					array_splice($listTopSelling, 5);
					foreach ($listTopSelling as $item) {
						$price          = number_format($item['price'], 0, ',', '.');
						$old_price		= number_format($item['price'] + 1000000, 0, ',', '.');
						echo '<div class="product-widget">
							<div class="product-img">
								<img src="' . $item['image'] . '" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">' . $item['brand_type'] . '</p>
								<h3 class="product-name"><a href="#">' . $item['name'] . '</a></h3>
								<h4 class="product-price">₫ ' . $price . ' <del class="product-old-price">₫ ' . $old_price . '</del></h4>
							</div>
						</div>';
					}
					?>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<label>
							Sắp xếp theo:
							<select class="input-select">
								<option value="0">Phổ biến</option>
								<option value="1">Giá từ thấp đến cao</option>
								<option value="1">Giá từ cao đến thấp</option>
								<option value="1">Giảm giá mạnh</option>
							</select>
						</label>
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">
					<?php
					$querySelectProduct = "SELECT tbl_product.id, tbl_product.name,tbl_product.price , tbl_product.old_price,
					tbl_product.sold, tbl_product.create_date,tbl_product_details.image_url, tbl_category_type.name AS brand_type
					FROM tbl_product INNER JOIN tbl_product_details INNER JOIN tbl_category_type
					WHERE tbl_product.type_id = tbl_category_type.id 
					AND tbl_product_details.id_product = tbl_product.id
					GROUP BY tbl_product.id
					LIMIT $start, $limit";
					// $listProduct = executeResult($querySelectProduct);
					renderListProduct($querySelectProduct, null);
					?>
				</div>
				<!-- /store products -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<ul class="store-pagination">
						<?php
						if ($current_page > 1 && $total_page > 1) {
							echo '<li><a href="store.php?page=' . ($current_page - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
						}
						// Lặp khoảng giữa
						for ($i = 1; $i <= $total_page; $i++) {
							// Nếu là trang hiện tại thì active thẻ
							// ngược lại thì echo ra bt
							if ($i == $current_page) {
								echo '<li class="active">' . $i . '</li>';
							} else {
								echo '<li><a href="store.php?page=' . $i . '">' . $i . '</a></li>';
							}
						}

						if ($current_page < $total_page && $total_page > 1) {
							echo '<li><a href="store.php?page=' . ($current_page + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
						}
						?>
					</ul>
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php
require('./inc/footer.php')
?>