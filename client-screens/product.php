<?php
require('./functions/renderListProduct.php');
require('./inc/header.php');
$product_id   = isset($_GET['product_id']) ? $_GET['product_id'] : 1;
// add product to recent_product_array
// if (isset($_SESSION['login-username'])) {
$product_recent_array = isset($_SESSION['product_recent']) ? $_SESSION['product_recent'] : array();
$index = array_search($product_id, $product_recent_array);
if ($index >= 0) {
	array_push($product_recent_array, $product_id);
	$product_recent_array = array_unique($product_recent_array);
} else {
	array_push($product_recent_array, $product_id);
}
$product_recent_array = array_slice($product_recent_array, -4);
$_SESSION['product_recent'] = $product_recent_array;
// }
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
									<img src="../upload-images/' . $item['image_url'] . '" alt="">
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
									<img style="width: auto; height:150px;" src="../upload-images/' . $item['image_url'] . '" alt="">
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
						<i class="fa fa-star"></i>
					</div>
					<a class="review-link" id="review-link-button">(10) Đánh giá | Thêm đánh giá</a>
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
					<button onclick="addToCartWithQuantity(' . $product['id'] . ')" class="add-to-cart-btn" ' . $isDisable . ' >' . $iconDisable . '' . $status . '</button>
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
						<li><a id="tab3-button" data-toggle="tab" href="#tab3">Đánh giá</a></li>
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
											<?php
											$queryComment = "SELECT tbl_user.name, tbl_comment.rate, tbl_comment.content,tbl_comment.create_date FROM tbl_comment INNER JOIN tbl_user
											WHERE tbl_user.id = tbl_comment.user_id
											AND tbl_comment.product_id = $product_id
											ORDER BY tbl_comment.create_date DESC";
											$resultComment = executeResult($queryComment);
											$totalRate = count($resultComment);
											$isEmpty = $totalRate == 0 ? true : false;
											$rate5 = 0;
											$rate4 = 0;
											$rate3 = 0;
											$rate2 = 0;
											$rate1 = 0;
											$totalStar = 0;
											if (!$isEmpty) {
												foreach ($resultComment as $item) {
													switch ($item['rate']) {
														case 1:
															$rate1++;
															break;
														case 2:
															$rate2++;
															break;
														case 3:
															$rate3++;
															break;
														case 4:
															$rate4++;
															break;
														case 5:
															$rate5++;
															break;
													}
													$totalStar += $item['rate'];
												}
											} else {
												$totalRate = 1;
											}
											$rateAVG = round($totalStar / $totalRate, 2);
											$number_star = floor($rateAVG);
											echo "<span>$rateAVG</span>";
											?>
											<div class="rating-stars">
												<?php
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $number_star) {
														echo '<i class="fa fa-star"></i>';
													} else {
														echo '<i class="fa fa-star-o"></i>';
													}
												}
												?>
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
												<?php
												$progressbar5 = round($rate5 / $totalRate, 2) * 100;
												echo '<div class="rating-progress">
													<div style="width: ' . $progressbar5 . '%;"></div>
												</div>
												<span class="sum">' . $rate5 . '</span>';
												?>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
												</div>
												<?php
												$progressbar4 =  round($rate4 / $totalRate, 2) * 100;
												echo '<div class="rating-progress">
													<div style="width: ' . $progressbar4 . '%;"></div>
												</div>
												<span class="sum">' . $rate4 . '</span>';
												?>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
												</div>
												<?php
												$progressbar3 =  round($rate3 / $totalRate, 2) * 100;
												echo '<div class="rating-progress">
													<div style="width: ' . $progressbar3 . '%;"></div>
												</div>
												<span class="sum">' . $rate3 . '</span>';
												?>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
												</div>
												<?php
												$progressbar2 =  round($rate2 / $totalRate, 2) * 100;
												echo '<div class="rating-progress">
													<div style="width: ' . $progressbar2 . '%;"></div>
												</div>
												<span class="sum">' . $rate2 . '</span>';
												?>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
													<i style="visibility: hidden;" class="fa fa-star"></i>
												</div>
												<?php
												$progressbar1 =  round($rate1 / $totalRate, 2) * 100;
												echo '<div class="rating-progress">
													<div style="width: ' . $progressbar1 . '%;"></div>
												</div>
												<span class="sum">' . $rate1 . '</span>';
												?>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div class="products-tabs" id="reviews">
										<?php
										if ($isEmpty) {
											echo '<p><i>Chưa có đánh giá nào...</i></p>';
										} else {
											$current_tab = 1;
											$total_tab = ceil($totalRate / 3);
											foreach ($resultComment as $key => $item) {
												$isActive = $current_tab == 1 ? 'active' : null;
												if ($key % 3 == 0) {
													echo '<div  id="tab_review' . $current_tab . '" class="tab-pane fade in ' . $isActive . '">';
													$current_tab++;
												}
												echo '<ul class="reviews">
											<li>
													<div class="review-heading">
														<h5 class="name">' . $item['name'] . '</h5>
														<p class="date">' . $item['create_date'] . '</p>
														<div class="review-rating">';
												for ($i = 1; $i <= 5; $i++) {
													if ($i <= $item['rate']) {
														echo '<i class="fa fa-star"></i>';
													} else {
														echo '<i class="fa fa-star-o empty"></i>';
													}
												}
												echo '</div>
															</div>
															<div class="review-body">
																<p>' . $item['content'] . '</p>
															</div>
														</li>
													</ul>';
												if ($key == $totalRate - 1) {
													$spare = 3 - ($totalRate % 3);
													for ($i = 1; $i <= $spare; $i++) {
														echo '<ul class="reviews">
													<li>
														<div class="review-heading">
														<h5 class="name"></h5>
														<p class="date"></p>
														<div class="review-rating">
														</div>
															</div>
															<div class="review-body">
																<p></p>
															</div>
													</li>
													</ul>';
													}
												}
												if (($key + 1) % 3 == 0 || $key == $totalRate - 1) echo '</div>';
											}
										}
										?>
										<ul class="reviews-pagination">
											<ul class="reviews-pagination">
												<?php
												if (!$isEmpty || $totalRate >= 3) {
													for ($i = 1; $i <= $total_tab; $i++) {
														if ($i == 1) {
															echo '<li style="margin-right: 4px" class="active"><a data-toggle="tab" href="#tab_review' . $i . '">' . $i . '</a></li>';
														} else {
															echo '<li style="margin-right: 4px"><a data-toggle="tab" href="#tab_review' . $i . '">' . $i . '</a></li>';
														}
													}
												}
												?>
											</ul>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<?php
									if (isset($_SESSION['user']) && $_SESSION['user']) {
										echo '<div id="review-form">
											<form class="review-form" method="POST">
												<!-- <input class="input" type="text" placeholder="Your Name">
												<input class="input" type="email" placeholder="Your Email"> -->
												<textarea class="input" id="rating_content" placeholder="Nhận xét về sản phẩm..."></textarea>
												<div class="input-rating">
													<span></span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
													</div>
												</div>
												<button id="rating-submit-button" type="button" class="primary-btn">Đánh giá</button>
											</form>
										</div>';
									} else {
										echo '<div id="review-form"><p>Bạn cần đăng nhập để có thể đánh giá</p></div>';
									}
									?>
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
					<h3 class="title">Các sản phẩm liên quan</h3>
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
<script>
	// 
	$('#review-link-button').click(function() {
		window.scroll({
			top: 700,
			behavior: 'smooth'
		});
		$('#tab3-button').click()
	})

	const rating_content = document.getElementById("rating_content");
	$('#rating-submit-button').click(function() {
		const rating_star = document.querySelector('input[name="rating"]:checked').value;
		const urlParams = new URLSearchParams(window.location.search);
		const product_id = urlParams.get('product_id');
		$.ajax({
			type: "POST",
			url: "./functions/handlePostComment.php",
			data: {
				'rating_content': rating_content.value,
				'rating_star': rating_star,
				'product_id': product_id
			}
		}).done(function(msg) {
			alert(msg);
			window.location.reload();
		});
	});
</script>
<?php
require('./inc/footer.php')
?>