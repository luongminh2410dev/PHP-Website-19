<?php
require('./inc/header.php');
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
}

if (isset($_POST['sbm']) && isset($_SESSION['cart'])) {
	$user_id = $_POST['user_id'];
	$username = $_POST['first-name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$phone = $_POST['tel'];
	$totalAll = $_POST['totalOrder'];
	$sqlAddOrder =  "INSERT INTO tbl_order (user_id, user_name, user_phone, user_email, user_address, total, status)" .
		" VALUES ('$user_id', '$username', '$phone', '$email','$address', '$totalAll', 'Đang xử lý')";
	$idReturn = executeReturnId($sqlAddOrder);
	if ($idReturn > 0) {
		$count = count($_SESSION['cart']);
		$flag = 1;
		for ($i = 0; $i < $count; $i++) {
			$productId = $_SESSION['cart'][$i]['id'];
			$productQuantity = $_SESSION['cart'][$i]['quantity'];
			$productPrice = $_SESSION['cart'][$i]['price'];
			$productTotal = $_SESSION['cart'][$i]['total'];
			$sqlAddOrderDetails =  "INSERT INTO tbl_detail_order (product_id, order_id, quantity, price, total)" .
				" VALUES ($productId, $idReturn, $productQuantity, $productPrice, $productTotal)";
			if (execute($sqlAddOrderDetails)) {
				$flag = 1;
			} else {
				$flag = 0;
				break;
			}
		}
		if ($flag == 1) {
			unset($_SESSION["cart"]);
			header("location: success_order_page.php");
		}
	}
}
?>
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<form action="" method="POST">
				<div class="col-md-7">
					<!-- Billing Details -->
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Thông tin đặt hàng</h3>
						</div>
						<input type="hidden" name="user_id" value=" <?php echo $user["id"] ?>" />
						<div class="form-group">
							<input class="input" type="text" name="first-name" placeholder="Họ tên người nhận" value="<?php echo $user["name"] ?>">
						</div>
						<div class="form-group">
							<input class="input" type="email" name="email" placeholder="Email" value="<?php echo $user["email"] ?>">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="address" placeholder="Địa chỉ nhận hàng" value="<?php echo $user["address"] ?>">
						</div>
						<div class="form-group">
							<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
						</div>
						<div class="form-group">
							<input class="input" type="tel" name="tel" placeholder="Số điện thoại" value="<?php echo $user["phone"] ?>">
						</div>
					</div>
					<!-- Order notes -->
					<div class="order-notes">
						<textarea class="input" placeholder="Ghi chú"></textarea>
					</div>
					<!-- /Order notes -->
				</div>

				<!-- Order Details -->
				<?php
				if (!empty($_SESSION['cart'])) {
					echo '<div class="col-md-5 order-details">';
					echo '<div class="section-title text-center">';
					echo '<h3 class="title">Giỏ hàng</h3>';
					echo '</div>';
					echo '<div class="order-summary">';
					echo '<div class="order-col">';
					echo '<div><strong>Sản phẩm</strong></div>';
					echo '<div><strong>Thành tiền</strong></div>';
					echo '</div>';
					echo '<div class="order-products">';
					$totalOrder = 0;
					$count = count($_SESSION['cart']);
					for ($i = 0; $i < $count; $i++) {
						echo '<div class="order-col">';
						echo '<div>' . $_SESSION['cart'][$i]["quantity"] . 'x ' . $_SESSION['cart'][$i]["name"] . '</div>';
						echo '<div>' . number_format($_SESSION['cart'][$i]["total"], 0, ',', '.') . ' đ</div>';
						echo '</div>';
						$totalOrder += $_SESSION['cart'][$i]["total"];
					}
					echo '<input type="hidden" name="totalOrder" value="' . $totalOrder . '"/>';
					echo '</div>';
					echo '<div class="order-col"><div>Phí giao hàng</div><div><strong>FREE</strong></div></div>';
					echo '<div class="order-col">';
					echo '<div><strong>Tổng tiền</strong></div>';
					echo '<div><strong class="order-total">' . number_format($totalOrder, 0, ',', '.') . ' đ</strong></div>';
					echo '</div>';
					echo '<div class="payment-method">
						 <div style="margin-bottom: 12px;" class="order-col">
							<div><strong>Phương thức thanh toán</strong></div>
						 </div>
						 <div class="input-radio">
							<input type="radio" name="payment" id="payment-1">
							<label for="payment-1">
								<span></span>
								Tài khoản ngân hàng
							</label>
							<div class="caption">
								<p>	Sắp ra mắt.</p>
							</div>
						 </div>
						 <div class="input-radio">
							<input type="radio" name="payment" id="payment-2">
							<label for="payment-2">
								<span></span>
								Ví điện tử
							</label>
							<div class="caption">
								<p>	Sắp ra mắt.</p>
							</div>
						 </div>
						 <div class="input-radio">
							<input type="radio" name="payment" id="payment-3">
							<label for="payment-3">
								<span></span>
								Tiền mặt
							</label>
						 </div>
					     </div>
					     <div class="input-checkbox">
						 <input type="checkbox" id="terms">
						 <label for="terms">
							<span></span>
							Tôi đã đọc và đồng ý với <a href="#">các điều kiện & điều khoản</a>
						 </label>
					     </div>
					     <input type="submit" name="sbm" class="primary-btn order-submit" value="Đặt hàng" />
				         </div>';
				} else {
					echo "";
				}
				?>
			</form>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<?php
require('./inc/footer.php');
?>