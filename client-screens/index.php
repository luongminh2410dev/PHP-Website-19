<?php
require('./inc/header.php');
require('./functions/renderListProduct.php');
?>
<!-- COUNTDOWN Script -->
<script>
	var end = new Date("Dec 31, 2021 00:00:00").getTime();

	var _second = 1000;
	var _minute = _second * 60;
	var _hour = _minute * 60;
	var _day = _hour * 24;
	var timer;

	function showRemaining() {
		var now = new Date().getTime();
		var distance = end - now;
		if (distance < 0) {
			clearInterval(timer);
			return;
		}
		var days = Math.floor(distance / _day);
		var hours = Math.floor((distance % _day) / _hour);
		var minutes = Math.floor((distance % _hour) / _minute);
		var seconds = Math.floor((distance % _minute) / _second);
		document.getElementById('countdown_days').innerHTML = days;
		document.getElementById('countdown_hours').innerHTML = hours;
		document.getElementById('countdown_minutes').innerHTML = minutes;
		document.getElementById('countdown_seconds').innerHTML = seconds;
	}
	timer = setInterval(showRemaining, 1000);
</script>
<!-- UNHANDLE -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img style="max-height: 260px; width: auto; " src="images/asus-rog.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Laptop<br>Asus</h3>
						<a href="blank.php?search=asus&option=2" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img style="max-height: 260px; width: auto; " src="images/macbook.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Laptop<br>iMac/Macbook</h3>
						<a href="blank.php?search=apple&option=2" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img style="max-height: 260px; width: auto; " src="images/vivobook.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Laptop<br>Dell</h3>
						<a href="blank.php?search=dell&option=2" class="cta-btn">Xem ngay <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /UNHANDLE -->

<!-- NEW PRODUCTS -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Hàng mới về</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<?php
							?>
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab0" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-0">
								<?php
								$sql = 'SELECT DISTINCT tbl_product.id, tbl_product.name, tbl_product.price, tbl_product.old_price, tbl_product.create_date, tbl_product.updated_date, tbl_category_type.name AS brand_type, tbl_product_details.image_url
									FROM `tbl_product` INNER JOIN `tbl_category_type` INNER JOIN `tbl_brand` INNER JOIN `tbl_product_details`
									WHERE tbl_product.type_id = tbl_category_type.id
									AND   tbl_category_type.brand_id = tbl_brand.id
									AND tbl_product_details.id_product = tbl_product.id
									GROUP BY tbl_product.id
									ORDER BY tbl_product.create_date DESC
									LIMIT 0,12;';
								renderListProduct($sql, null);
								?>
							</div>
							<div id="slick-nav-0" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEW PRODUCTS -->

<!-- COUNTDOWN Section -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<ul class="hot-deal-countdown">
						<li>
							<div>
								<h3 id="countdown_days">9</h3>
								<span>Days</span>
							</div>
						</li>
						<li>
							<div>
								<h3 id="countdown_hours">9</h3>
								<span>Hours</span>
							</div>
						</li>
						<li>
							<div>
								<h3 id="countdown_minutes">9</h3>
								<span>Mins</span>
							</div>
						</li>
						<li>
							<div>
								<h3 id="countdown_seconds">9</h3>
								<span>Secs</span>
							</div>
						</li>
					</ul>
					<h2 class="text-uppercase">Khuyến mãi sốc trong tuần</h2>
					<p>Sale Up to 60%</p>
					<a class="primary-btn cta-btn" href="promotion.php">Xem ngay</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /COUNTDOWN Section -->

<!-- TOP BÁN CHẠY -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Top bán chạy</h3>
					<div class="section-nav">
						<ul class="section-tab-nav tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Tất cả</a></li>
							<li><a data-toggle="tab" href="#tab2">Laptop văn phòng</a></li>
							<li><a data-toggle="tab" href="#tab3">Laptop Gaming</a></li>
							<li><a data-toggle="tab" href="#tab4">Macbook/iMac</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<!-- product -->
								<?php
								$sql = 'SELECT tbl_product.id,tbl_product.name, tbl_product.price, tbl_product.old_price,
								tbl_product.create_date, tbl_category_type.name AS brand_type, 
								tbl_product_details.image_url, tbl_product.sold 
								FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
								WHERE tbl_product.type_id = tbl_category_type.id
								AND tbl_product_details.id_product = tbl_product.id
								GROUP BY tbl_product.sold DESC, tbl_product.id
								LIMIT 0,8;';
								renderListProduct($sql, null);
								?>
								<!-- /product -->
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<div id="tab2" class="tab-pane fade in">
							<div class="products-slick" data-nav="#slick-nav-2">
								<!-- product -->
								<?php
								$sql = 'SELECT tbl_product.id,tbl_product.name, tbl_product.price, tbl_product.old_price,
								tbl_product.create_date, tbl_category_type.name AS brand_type, 
								tbl_product_details.image_url, tbl_product.sold 
								FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
								WHERE tbl_product.type_id = tbl_category_type.id
								AND tbl_product_details.id_product = tbl_product.id
								AND tbl_category_type.id IN(1,4,9,10,11,12,13)
								GROUP BY tbl_product.sold DESC, tbl_product.id
								LIMIT 0,8;';
								renderListProduct($sql, null);
								?>
								<!-- /product -->
							</div>
							<div id="slick-nav-2" class="products-slick-nav"></div>
						</div>
						<div id="tab3" class="tab-pane fade in">
							<div class="products-slick" data-nav="#slick-nav-3">
								<!-- product -->
								<?php
								// Lay cac san pham tu database
								$sql = 'SELECT tbl_product.id,tbl_product.name, tbl_product.price, tbl_product.old_price,
								tbl_product.create_date, tbl_category_type.name AS brand_type, 
								tbl_product_details.image_url, tbl_product.sold 
								FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
								WHERE tbl_product.type_id = tbl_category_type.id
								AND tbl_product_details.id_product = tbl_product.id
								AND tbl_category_type.id IN(2,3,7,8)
								GROUP BY tbl_product.sold DESC, tbl_product.id
								LIMIT 0,8;';
								renderListProduct($sql, null);
								?>
								<!-- /product -->
							</div>
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
						<div id="tab4" class="tab-pane fade in">
							<div class="products-slick" data-nav="#slick-nav-4">
								<!-- product -->
								<?php
								// Lay cac san pham tu database
								$sql = 'SELECT tbl_product.id,tbl_product.name, tbl_product.price, tbl_product.old_price,
								tbl_product.create_date, tbl_category_type.name AS brand_type, 
								tbl_product_details.image_url, tbl_product.sold 
								FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details
								WHERE tbl_product.type_id = tbl_category_type.id
								AND tbl_product_details.id_product = tbl_product.id
								AND tbl_category_type.id IN(5,6,14)
								GROUP BY tbl_product.sold DESC, tbl_product.id
								LIMIT 0,8;';
								renderListProduct($sql, null);
								?>
								<!-- /product -->
							</div>
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>

				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /TOP BÁN CHẠY -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->


<?php
require('./inc/footer.php');
?>