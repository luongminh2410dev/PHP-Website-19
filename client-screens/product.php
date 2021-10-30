<?php
require('../functions/functionHelper.php');
require('./inc/header.php');
$product_id   = isset($_GET['product_id']) ? $_GET['product_id'] : 1;
// get image product
$sql	      = 'SELECT * FROM tbl_product_details WHERE tbl_product_details.id_product = ' . $product_id . '';
$listImage    = executeResult($sql);
// get details product
$sqlDetail    = 'SELECT * FROM tbl_product WHERE id = ' . $product_id . '';
$product      = executeResult($sqlDetail)[0];
// price
$price        = number_format($product['price'], 0, ',', '.');
if ($product['old_price'] > $product['price']) {
	$oldprice = number_format($product['old_price'], 0, ',', '.');
} else {
	$oldprice = 'none';
}
// status
$status 	  = $product['total'] <= $product['sold'] ? 'Đã hết hàng' : 'Thêm vào giỏ hàng';
$isDisable    = $product['total'] <= $product['sold'] ? 'disabled' : null;
$iconDisable  = $product['total'] <= $product['sold'] ? '<i class="fas fa-ban"></i>' : '<i class="fa fa-shopping-cart"></i>';
// get brand
$sqlBrand 	  = 'SELECT tbl_brand.name AS brand_name, tbl_category_type.name AS cat_name
				FROM tbl_brand INNER JOIN tbl_category_type 
				WHERE tbl_category_type.brand_id = tbl_brand.id
				AND tbl_category_type.id = ' . $product['type_id'] . '';
$brand    	  = executeResult($sqlBrand)[0];
?>

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<?php
					foreach ($listImage as $item) {
						echo '<div class="product-preview">
									<img src="' . $item['image_url'] . '" alt="">
								</div>';
					}
					?>
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<?php
					foreach ($listImage as $item) {
						echo '<div class="product-preview">
									<img style="width: auto; height:150px;" src="' . $item['image_url'] . '" alt="">
								</div>';
					}
					?>
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<?php
			echo '<div class="col-md-5">
			<div class="product-details">
				<h2 class="product-name">' . $product['name'] . '</h2>
				<div>
					<div class="product-rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
					</div>
					<a class="review-link" href="#">10 Review(s) | Add your review</a>
				</div>
				<div>
					<h3 class="product-price">₫ ' . $price . ' <del style="display: ' . $oldprice . '" class="product-old-price">₫ ' . $oldprice . '</del></h3>
				</div>
				<p>' . $product['introtext'] . '</p>

				<div class="product-options">
					<label>
						<p>Số lượng</p>
						<div class="input-number">
							<input type="number" value="1">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</label>
					<label>
						<p>Màu sắc</p>
						<select class="input-select">
							<option value="0">Xám</option>
							<option value="0">Vàng Gold</option>
							<option value="0">Hồng</option>
						</select>
					</label>
				</div>

				<div class="add-to-cart">
					<button class="add-to-cart-btn" ' . $isDisable . ' >' . $iconDisable . '' . $status . '</button>
				</div>

					<a href="#"><i class="fa fa-heart-o"></i> Thêm vào danh sách ước</a>
				<ul class="product-links">
					<li>Thương hiệu:</li>
					<li><a href="#">' . $brand['brand_name'] . '</a></li>
					<li><a href="#">' . $brand['cat_name'] . '</a></li>
				</ul>

				<ul class="product-links">
					<li>Share:</li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="#"><i class="fa fa-envelope"></i></a></li>
				</ul>

				</div>
			</div>';
			?>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Tổng quan</a></li>
						<li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
						<li><a data-toggle="tab" href="#tab3">Đánh giá (3)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<div class="blog-content">
										<?php
										echo $product['description'];
										?>
									</div>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<h3 class="modal-title">Thông số kỹ thuật</h3>
									<?php
									echo '<table style="max-width: 600px; margin-top: 12px; margin-inline: auto;" class="table table-striped">
										<tbody>
											<tr>
												<th scope="row">Loại CPU</th>
												<td>' . $product['cpu'] . '</td>
											</tr>
											<tr>
												<th scope="row">Loại card đồ họa</th>
												<td>' . $product['vga'] . '</td>
											</tr>
											<tr>
												<th scope="row">Dung lượng RAM</th>
												<td>' . $product['ram'] . '</td>
											</tr>
											<tr>
												<th scope="row">Ổ cứng</th>
												<td>' . $product['storage'] . '</td>
											</tr>
											<tr>
												<th scope="row">Màn hình</th>
												<td>' . $product['screen'] . '</td>
											</tr>
											<tr>
												<th scope="row">Cổng giao tiếp</th>
												<td>' . $product['connect'] . '</td>
											</tr>
											<tr>
												<th scope="row">Hệ điều hành</th>
												<td>' . $product['os'] . '</td>
											</tr>
											<tr>
												<th scope="row">Pin</th>
												<td>' . $product['battery'] . '</td>
											</tr>
										</tbody>
									</table>';
									?>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<span>4.5</span>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											</div>
										</div>
										<ul class="rating">
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 80%;"></div>
												</div>
												<span class="sum">3</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 60%;"></div>
												</div>
												<span class="sum">2</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
										</ul>
										<ul class="reviews-pagination">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form">
											<input class="input" type="text" placeholder="Your Name">
											<input class="input" type="email" placeholder="Your Email">
											<textarea class="input" placeholder="Your Review"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
												</div>
											</div>
											<button class="primary-btn">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Các sản phẩm cùng loại</h3>
				</div>
			</div>
			<?php
			$sqlRelateProduct = 'SELECT tbl_product.id, tbl_product.name, tbl_product.price, tbl_product.old_price, tbl_product.create_date, tbl_product.updated_date, tbl_category_type.name AS brand_type, tbl_product_details.image_url
			FROM `tbl_product` INNER JOIN `tbl_category_type` INNER JOIN `tbl_product_details`
			WHERE tbl_product.type_id = tbl_category_type.id
			AND tbl_product_details.id_product = tbl_product.id
			AND tbl_category_type.id = ' . $product['type_id'] . '
			AND tbl_product.id != ' . $product['id'] . '
			GROUP BY tbl_product.id
			LIMIT 0,4;';
			$grid = 'col-md-3 col-xs-6';
			renderListProduct($sqlRelateProduct, $grid);
			?>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<?php
require('./inc/footer.php')
?>