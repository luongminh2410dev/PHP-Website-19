<?php
require('./inc/header.php');
require('./functions/renderListProduct.php');
if (strpos($_SERVER['HTTP_REFERER'], '/BTL/client-screens/store.php') ? false : true) {
	unset($_SESSION['brand_filter']);
	unset($_SESSION['category_filter']);
	unset($_SESSION['type_filter']);
}
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$brand_filter = isset($_SESSION['brand_filter']) ? $_SESSION['brand_filter'] : array();
$category_filter = isset($_SESSION['category_filter']) ? $_SESSION['category_filter'] : array();
$type_filter = isset($_SESSION['type_filter']) ? $_SESSION['type_filter'] : 1;
// format thong tin can lay
$query_header = "SELECT tbl_product.id, tbl_product.name,tbl_product.price , tbl_product.old_price,
tbl_product.sold, tbl_product.create_date,tbl_product_details.image_url, tbl_category_type.name AS brand_type
FROM tbl_product INNER JOIN tbl_product_details INNER JOIN tbl_category_type INNER JOIN tbl_brand
WHERE tbl_product.type_id = tbl_category_type.id 
AND tbl_category_type.brand_id = tbl_brand.id
AND tbl_product_details.id_product = tbl_product.id";
// 3 loai filter
$query_type_filter = 'GROUP BY tbl_product.id';
$query_brand_filter = '';
$query_category_filter = '';

// GET VALUE REQUEST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// list brand checkbox
	if (!empty($_POST['brand_list'])) {
		$_SESSION['brand_filter'] = $_POST['brand_list'];
		$brand_filter = $_POST['brand_list'];
	}
	// list category checkbox
	elseif (!empty($_POST['category_list'])) {
		$_SESSION['category_filter'] = $_POST['category_list'];
		$category_filter = $_POST['category_list'];
	}
	// type filter
	elseif (!empty($_POST['drop-down-filter'])) {
		$type_filter = $_POST['drop-down-filter'];
		$_SESSION['type_filter'] = $_POST['drop-down-filter'];
	} elseif (empty($_POST['category_list']) && !empty($_SESSION['category_filter'])) {
		$_SESSION['category_filter'] = array();
		$category_filter = array();
	} elseif (empty($_POST['brand_list'])) {
		$_SESSION['brand_filter'] = array();
		$brand_filter = array();
	}

	$current_page = 1;
}
// Xac dinh query dieu kien
$query_brand_filter = !empty($brand_filter) ? 'AND tbl_brand.id IN(' . implode(",", $brand_filter) . ')' : '';
$query_category_filter = !empty($category_filter) ? 'AND tbl_category_type.id IN(' . implode(",", $category_filter) . ')' : '';
switch ($type_filter) {
	case 1:
		$query_type_filter = "GROUP BY tbl_product.id";
		break;
	case 2:
		$query_type_filter = "GROUP BY tbl_product.price ASC,tbl_product.id";
		break;
	case 3:
		$query_type_filter = "GROUP BY tbl_product.price DESC,tbl_product.id";
		break;
	case 4:
		$query_type_filter = "GROUP BY tbl_product.old_price - tbl_product.price DESC,tbl_product.id";
		break;
}
$query_filter = $query_brand_filter . ' ' . $query_category_filter . ' ' . $query_type_filter;
// 
// Phan trang
$totalProduct = null;
$get_total_item = $query_header . ' ' . $query_filter;
$row = executeResult($get_total_item);
$total_records = count($row);

$limit = 9;
$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}
// Tìm Start
$start = ($current_page - 1) * $limit;
// 
$query_footer = "LIMIT $start, $limit";
$query = $query_header . ' ' . $query_filter . ' ' . $query_footer;

?>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- Aside Brand -->
				<div class="aside">
					<h3 class="aside-title">Thương hiệu</h3>
					<div class="checkbox-filter">
						<form action="#" method="POST">
							<?php
							$sql = 'SELECT tbl_brand.name,tbl_brand.id, COUNT(tbl_product.id) as total
							FROM tbl_brand INNER JOIN tbl_product INNER JOIN tbl_category_type
							WHERE tbl_brand.id = tbl_category_type.brand_id
							AND tbl_category_type.id = tbl_product.type_id
							GROUP BY tbl_brand.name;';
							$listBrand = executeResult($sql);
							foreach ($listBrand as $item) {
								$isChecked = null;
								foreach ($brand_filter as $i) {
									if ($i == $item['id']) {
										$isChecked = 'checked';
										break;
									}
								}
								echo '<div class="input-checkbox">
										<input type="checkbox" ' . $isChecked . ' class="brand" onclick="this.form.submit()" name="brand_list[]" value="' . $item['id'] . '" id="brand-' . $item['name'] . '">
										<label for="brand-' . $item['name'] . '">
											<span></span>
											' . $item['name'] . '
											<small>(' . $item['total'] . ')</small>
										</label>
									</div>';
							}
							?>
						</form>
					</div>
				</div>
				<!-- /Aside Brand -->

				<!-- Aside Price -->
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
				<!-- /Aside Price -->

				<!-- Aside Brand Category -->
				<div class="aside">
					<h3 class="aside-title">Dòng máy</h3>
					<div class="checkbox-filter">
						<form action="#" method="POST">
							<?php
							$query_cat = $brand_filter ? 'AND tbl_brand.id IN(' . implode(",", $brand_filter) . ')' : '';
							$sql = 'SELECT tbl_category_type.name,tbl_category_type.id, COUNT(tbl_product.id) as total
								FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_brand
								WHERE tbl_category_type.id = tbl_product.type_id
								AND tbl_brand.id = tbl_category_type.brand_id
								' . $query_cat . '
								GROUP BY tbl_category_type.name;';
							$listCategory = executeResult($sql);
							foreach ($listCategory as $item) {
								$isChecked = null;
								foreach ($category_filter as $i) {
									if ($i == $item['id']) {
										$isChecked = 'checked';
										break;
									}
								}
								echo '<div class="input-checkbox">
									<input type="checkbox" ' . $isChecked . ' name="category_list[]" onclick="this.form.submit()" value="' . $item['id'] . '" id="brand-category-' . $item['name'] . '">
									<label for="brand-category-' . $item['name'] . '">
										<span></span>
										' . $item['name'] . '
										<small>(' . $item['total'] . ')</small>
									</label>
								</div>';
							}
							?>
						</form>
					</div>
				</div>
				<!-- /Aside Brand Category -->

				<!-- Aside Top Sale -->
				<div class="aside">
					<h3 class="aside-title">Top bán chạy</h3>
					<?php
					$sql = 'SELECT tbl_product.id, tbl_product.name,tbl_product.sold, tbl_product.price,tbl_product_details.image_url AS image, tbl_category_type.name AS brand_type 
					FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
					WHERE tbl_product.type_id = tbl_category_type.id
					AND tbl_product_details.id_product = tbl_product.id
					GROUP BY tbl_product_details.id_product
                    ORDER BY tbl_product.sold DESC
                    LIMIT 0,5;';
					$listTopSelling = executeResult($sql);
					foreach ($listTopSelling as $item) {
						$price          = number_format($item['price'], 0, ',', '.');
						$old_price		= number_format($item['price'] + 1000000, 0, ',', '.');
						echo '<div onclick="handleRedirectProduct(' . $item['id'] . ')" class="product-widget">
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
				<!-- /Aside Top Sale -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<form action="" method="POST">
							<label>
								Sắp xếp theo:
								<select name="drop-down-filter" onchange="this.form.submit()" class="input-select">
									<option <?php if ($type_filter == 1) echo "selected";  ?> value="1">Phổ biến</option>
									<option <?php if ($type_filter == 2) echo "selected";  ?> value="2">Giá từ thấp đến cao</option>
									<option <?php if ($type_filter == 3) echo "selected";  ?> value="3">Giá từ cao đến thấp</option>
									<option <?php if ($type_filter == 4) echo "selected";  ?> value="4">Giảm giá mạnh</option>
								</select>
							</label>
						</form>
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
					renderListProduct($query, null);
					?>
				</div>
				<!-- /store products -->

				<!-- store paging -->
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
							if ($total_page == 1) {
								echo '';
							} elseif ($i == $current_page) {
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
				<!-- /store paging -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
<?php
require('./inc/footer.php');
?>