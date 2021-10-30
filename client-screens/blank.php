<?php
require('./inc/header.php');
require('../functions/functionHelper.php');
$search_content = isset($_GET['search']) ? $_GET['search'] : null;
$query = "select count(id) as total from tbl_product where tbl_product.name like '%$search_content%'";
$row = executeResult($query)[0];
$total_records = $row['total'];
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
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<?php
				$message = $total_records > 0 ?  'Kết quả tìm kiếm' : 'Không tìm thấy sản phẩm nào';
				echo '<h4 class="breadcrumb-header">' . $message . ' "  ' . $search_content . '  "</h4>'
				?>
			</div>
		</div>
		<div class="row">
			<?php
			if ($total_records > 0) {
				$sql = "SELECT tbl_product.id, tbl_product.name, tbl_product.price, tbl_product.old_price, tbl_product.create_date, tbl_product.updated_date, tbl_category_type.name AS brand_type, tbl_product_details.image_url
				FROM `tbl_product` INNER JOIN `tbl_category_type` INNER JOIN `tbl_product_details`
				WHERE tbl_product.id = tbl_product_details.id_product
				AND tbl_product.type_id = tbl_category_type.id
				AND tbl_product.name LIKE '%$search_content%'
				GROUP BY tbl_product.id
				LIMIT $start, $limit";
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