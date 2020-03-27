<div role="main" class="main shop">
	<div class="container">
		<hr class="tall">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<h2><a href="type/3-san-pham-hot">Sản Phẩm <strong>Nổi Bật</strong></a></h2>
					</div>
					<ul class="products product-thumb-info-list">
						<?php if (empty($hot_products)) : ?>
							<h3 class="col-sm-12">Không có sản phẩm nào trong danh mục này.</h3>
						<?php endif; ?>
						<?php foreach ($hot_products as $hot_product) : ?>
							<li class="col-sm-3 col-xs-12 product">
								<?php if ($hot_product['saleoff'] != 0) : ?>
									<a href="type/3-san-pham-dang-giam-gia">
										<span class="onsale">-<?php echo $hot_product['percentoff']; ?>%</span>
									</a>
								<?php endif; ?>
								<span class="product-thumb-info">
									<form action="cart/add/<?php echo $hot_product['id']; ?>" method="post">
										<input type="hidden" name="number_cart" value="1">
										<button type="submit" href="cart/add/<?php echo $hot_product['id']; ?>" class="add-to-cart-product">
											<span><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</span>
										</button>
									</form>
									<a href="product/<?php echo $hot_product['id']; ?>-<?php echo $hot_product['slug']; ?>">
										<span class="product-thumb-info-image">
											<span class="product-thumb-info-act">
												<span class="product-thumb-info-act-left"><em>View</em></span>
												<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
											</span>
											<img alt="" class="img-responsive" src="public/upload/products/<?php echo $hot_product['img1']; ?>">
										</span>
									</a>
									<span class="product-thumb-info-content">
										<a href="product/<?php echo $hot_product['id']; ?>-<?php echo $hot_product['slug']; ?>/">
											<h4><?php echo $hot_product['product_name']; ?></h4>
											<span class="price">
												<?php if ($hot_product['saleoff'] != 0) { ?>
													<del><span class="amount"><?php echo number_format($hot_product['product_price'], 0, ',', '.');  ?></span></del>
													<ins><span class="amount"><?php echo number_format(($hot_product['product_price']) - (($hot_product['product_price'] * $hot_product['percentoff']) / 100), 0, ',', '.'); ?> VNĐ</span></ins>
												<?php } else { ?>
													<ins><span class="amount"><?php echo number_format($hot_product['product_price'], 0, ',', '.');  ?> VNĐ</span></ins>
												<?php } ?>
											</span>
										</a>
									</span>
								</span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>