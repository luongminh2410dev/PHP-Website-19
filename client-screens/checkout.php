<?php
require('./inc/header.php')
?>

<!-- BREADCRUMB -->
<!-- <div id="breadcrumb" class="section"> -->
<!-- container -->
<!-- <div class="container"> -->
<!-- row -->
<!-- <div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li class="active">Checkout</li>
				</ul>
			</div>
		</div> -->
<!-- /row -->
<!-- </div> -->
<!-- /container -->
<!-- </div> -->
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">Thông tin đặt hàng</h3>
					</div>
					<div class="form-group">
						<input class="input" type="text" name="first-name" placeholder="Họ tên người nhận">
					</div>
					<!-- <div class="form-group">
						<input class="input" type="text" name="last-name" placeholder="Last Name">
					</div> -->
					<div class="form-group">
						<input class="input" type="email" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input class="input" type="text" name="address" placeholder="Địa chỉ nhận hàng">
					</div>
					<!-- <div class="form-group">
						<input class="input" type="text" name="city" placeholder="City">
					</div>
					<div class="form-group">
						<input class="input" type="text" name="country" placeholder="Country">
					</div> -->
					<div class="form-group">
						<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
					</div>
					<div class="form-group">
						<input class="input" type="tel" name="tel" placeholder="Số điện thoại">
					</div>
					<!-- <div class="form-group">
						<div class="input-checkbox">
							<input type="checkbox" id="create-account">
							<label for="create-account">
								<span></span>
								Create Account?
							</label>
							<div class="caption">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
								<input class="input" type="password" name="password" placeholder="Enter Your Password">
							</div>
						</div>
					</div> -->
				</div>
				<!-- /Billing Details -->

				<!-- Shiping Details -->
				<!-- <div class="shiping-details">
					<div class="section-title">
						<h3 class="title">Shiping address</h3>
					</div>
					<div class="input-checkbox">
						<input type="checkbox" id="shiping-address">
						<label for="shiping-address">
							<span></span>
							Ship to a diffrent address?
						</label>
						<div class="caption">
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
						</div>
					</div>
				</div> -->
				<!-- /Shiping Details -->

				<!-- Order notes -->
				<div class="order-notes">
					<textarea class="input" placeholder="Ghi chú"></textarea>
				</div>
				<!-- /Order notes -->
			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Đơn hàng của bạn</h3>
				</div>
				<div class="order-summary">
					<div class="order-col">
						<div><strong>Sản phẩm</strong></div>
						<div><strong>Số lượng</strong></div>
					</div>
					<div class="order-products">
						<div class="order-col">
							<div>1x Macbook Air M1 2020</div>
							<div>25.000.000 ₫</div>
						</div>
						<div class="order-col">
							<div>2x Laptop Dell Inspiron 4055</div>
							<div>19.990.000 ₫</div>
						</div>
					</div>
					<div class="order-col">
						<div>Phí giao hàng</div>
						<div><strong>FREE</strong></div>
					</div>
					<div class="order-col">
						<div><strong>Tổng tiền</strong></div>
						<div><strong class="order-total">64.980.000</strong></div>
					</div>
				</div>
				<div class="payment-method">
					<div style="margin-bottom: 12px;" class="order-col">
						<div><strong>Phương thức thanh toán</strong></div>
						<!-- <div><strong class="order-total">64.980.000</strong></div> -->
					</div>
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-1">
						<label for="payment-1">
							<span></span>
							Tài khoản ngân hàng
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-2">
						<label for="payment-2">
							<span></span>
							Ví điện tử
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<div class="input-radio">
						<input type="radio" name="payment" id="payment-3">
						<label for="payment-3">
							<span></span>
							Tiền mặt
						</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
				<div class="input-checkbox">
					<input type="checkbox" id="terms">
					<label for="terms">
						<span></span>
						Tôi đã đọc và đồng ý với <a href="#">các điều kiện & điều khoản</a>
					</label>
				</div>
				<a href="#" class="primary-btn order-submit">Đặt hàng</a>
			</div>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php
require('./inc/footer.php');
?>