<?php
function renderListProduct($sql)
{
	$listProduct = executeResult($sql);
	is_array($listProduct) ? array_splice($listProduct, 12) : null;
	// lay cac loai sp
	foreach ($listProduct as $item) {
		$price        = number_format($item['price'], 0, ',', '.');
		if ($item['old_price'] != 0) {
			$oldprice = number_format($item['old_price'], 0, ',', '.');
		} else {
			$oldprice = 'none';
		}
		// Check Discount
		$salePercent = null;
		$isDiscount = 'none';
		if ($item['old_price'] > $item['price']) {
			$salePercent = number_format((($item['old_price'] - $item['price']) * 100) / $item['price'], 0);
			$isDiscount = 'inline-block';
		}
		// Check Date
		$isNew = 'none';
		$date = strtotime($item['create_date']);
		$remaining =  time() - $date;
		if (floor($remaining / 86400) < 30) {
			$isNew = 'inline-block';
		}
		echo '<div class="col-md-4 col-xs-6">
		<div class="product">
			<div class="product-img">
				<img src=' . $item['image_url'] . ' style="object-fit:contain; padding: 0 10px 0 10px;"  height="280" alt="Image Product">
				<div class="product-label">
					<span style="display: ' . $isDiscount . '"  class="sale">- ' . $salePercent . '%</span>
					<span style="display: ' . $isNew . '" class="new">NEW</span>
				</div>
			</div>
			<div class="product-body">
				<p class="product-category">' . $item['brand_type'] . '</p>
				<h3 style="height: 32px;" class="product-name"><a href="#">' . $item['name'] . '</a></h3>
				<h4 class="product-price">₫ ' . $price . ' <del style="display: ' . $oldprice . '" class="product-old-price">₫ ' . $oldprice . '</del></h4>
				<div class="product-rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<div class="product-btns">
					<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
					<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
					<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
				</div>
			</div>
			<div class="add-to-cart">
				<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
			</div>
		</div>
		</div>';
	}
}
