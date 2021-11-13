<?php
require('./inc/header.php');
require('./functions/renderListProduct.php');

$search_content = isset($_GET['search']) ? $_GET['search'] : null;
$search_type = isset($_GET['option']) ? $_GET['option'] : null;

$query = "SELECT tbl_product.id, tbl_product.name, tbl_product.price, tbl_product.old_price, tbl_product.create_date, tbl_product.updated_date, tbl_category_type.name AS brand_type, tbl_product_details.image_url
FROM tbl_product INNER JOIN tbl_category_type INNER JOIN tbl_product_details INNER JOIN tbl_brand
WHERE tbl_product.id = tbl_product_details.id_product
AND tbl_product.type_id = tbl_category_type.id
AND tbl_brand.id = tbl_category_type.brand_id";
$query_filter  = "AND tbl_product.name LIKE '%$search_content%'";
$query_footer = "GROUP BY tbl_product.id";
if (isset($_GET['option'])) {
	switch ($search_type) {
		case 0:
			break;
		case 1:
			$query_filter  = "AND tbl_brand.name LIKE '%$search_content%'";
			break;
	}
}

$query_full = $query . ' ' . $query_filter . ' ' . $query_footer;
$result = executeResult($query_full);
$total_records = count($result);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 8;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}
$start = ($current_page - 1) * $limit;

?>
<!-- BREADCRUMB -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<?php
				$message = $total_records > 0 ?  'Kết quả tìm kiếm' : 'Không tìm thấy sản phẩm: ';
				echo '<span class="breadcrumb-header">' . $message . '</span><span>"' . $search_content . '"</span>';
				?>
			</div>
		</div>
		<div class="row">
			<?php
			if ($total_records > 0) {
				$sql = $query_full . ' LIMIT ' . $start . ',' . $limit;
				$grid = 'col-md-3 col-xs-6';
				renderListProduct($sql, $grid);
			}
			?>

		</div>
		<!-- /row -->
		<!-- store bottom filter -->
		<div class="store-filter clearfix">
			<ul class="store-pagination">
				<?php
				if ($total_records > $limit) {
					if ($current_page > 1 && $total_page > 1) {
						echo '<li><a href="blank.php?search=' . $search_content . '&page=' . ($current_page - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
					}
					for ($i = 1; $i <= $total_page; $i++) {
						if ($i == $current_page) {
							echo '<li class="active">' . $i . '</li>';
						} else {
							echo '<li><a href="blank.php?search=' . $search_content . '&page=' . $i . '">' . $i . '</a></li>';
						}
					}

					if ($current_page < $total_page && $total_page > 1) {
						echo '<li><a href="blank.php?search=' . $search_content . '&page=' . ($current_page + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
					}
				}
				?>
			</ul>
		</div>
		<!-- /store bottom filter -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<?php
require('./inc/footer.php');
?>