<div class="breadcrumb">
	<div class="uk-container uk-container-center">
		<ul class="uk-breadcrumb">
			<li><a href="." title="Trang chủ">Trang chủ</a></li>
			<?php if(isset($DetailCatalogues_isset) && is_array($DetailCatalogues_isset) && count($DetailCatalogues_isset)){ ?>
			<?php 						
				$href = rewrite_url($DetailCatalogues_isset['canonical'], $DetailCatalogues_isset['slug'], $DetailCatalogues_isset['id'], 'products_catalogues');
				
			?>
			<li><a href="<?php echo $href; ?>" title="<?php echo $DetailCatalogues_isset['title']; ?>"><?php echo $DetailCatalogues_isset['title']; ?></a></li>
			<?php } ?>
			<li><a href="" title="Tìm kiếm nâng cao">Tìm kiếm nâng cao</a></li>
		</ul>
	</div>
</div><!-- .breadcrumb -->
<section class="main-content">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-collapse col-reverse-959">
			<div class="uk-width-large-1-4 uk-width-xlarge-1-5">
				<?php $this->load->view('homepage/frontend/common/aside');?>
			</div><!-- .uk-width -->
			<div class="uk-width-large-3-4  uk-width-xlarge-4-5">
				<div class="rightContent">
					<section class="productCatalogue"><!-- DANH MỤC SẢN PHẨM -->
						<header class="panel-head skin-1 uk-flex uk-flex-middle uk-flex-space-between">
							<h2 class="heading-1"><a href="" title="Tìm kiếm nâng cao" onclick="return false;">Tìm kiếm nâng cao</a></h2>
						</header>
						<?php if(isset($productsList) && is_array($productsList) && count($productsList)){ ?>
						<section class="panel-body">
							<div class="uk-grid lib-grid-15 uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-xlarge-1-4 list-product" data-uk-grid-match="{target:'.product-1 .product-title'}">
								<?php foreach($productsList as $keyPost => $valPost) { ?> 
								<?php 
									$title = $valPost['title'];
									$href = rewrite_url($valPost['canonical'], $valPost['slug'], $valPost['id'], 'products');
									$image = getthumb($valPost['images']);
									$price = $valPost['price'];
									$saleoff = $valPost['saleoff'];
									$percent = percent($price, $saleoff);
									$code = $valPost['code'];
								?>
								<div class="product-item">
									<div class="product-1 <?php echo (isset($saleoff) && $saleoff > 0)? 'double': ''; ?>">
										<?php if(isset($valPost['attributes']) && is_array($valPost['attributes']) && count($valPost['attributes'])){ ?>
										<?php foreach($valPost['attributes'] as $keyAttr => $valAttr){ ?>
										<?php if($valAttr['keyword'] != 'noi-bat') continue; ?>
											<div>
											<?php if(isset($valAttr['attr']) && is_array($valAttr['attr']) && count($valAttr['attr'])){ ?>
											<?php foreach($valAttr['attr'] as $keyAttribute => $valAttribute){ ?>
												<div class="product-<?php echo ($valAttribute['id'] == 1) ? 'new' : 'sale'; ?>"><?php echo ($valAttribute['id'] == 1) ? 'New' : 'Sale'; ?></div>
											<?php }} ?>
											</div>
										<?php }}?>
										<div class="product-thumb img-shine">
											<a class="product-image img-cover" href="<?php echo $href; ?>" title="<?php echo $title; ?>"><img src="<?php echo $image; ?>" alt="" /></a>
										</div>
										<div class="product-info">
											<h3 class="product-title"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h3>
											<div class="product-code">Mã sản phẩm: <?php echo $code; ?></div>
											<div class="product-price_sale uk-flex uk-flex-middle uk-flex-space-between">
												<div class="product-pricenew"><?php echo ($saleoff > 0) ? number_format($saleoff) : number_format($price); ?>đ</div>
												<?php if($saleoff > 0){ ?>
													<div class="product-priceold"><?php echo number_format($price); ?>đ</div>
													<div class="product-percent">-<?php echo $percent; ?>%</div>
												<?php } ?>
											</div>
										</div>
									</div><!-- .product-1 -->
								</div>
								<?php } ?>
							</div><!-- .list-product -->
							<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
						</section><!-- .panel-body -->
						<?php }else{ echo '<div class="mt10">Dữ liệu đang được cập nhật ...</div>'; }  ?>
					</section><!-- .productCatalogue -->
				</div><!-- .rightContent -->
			</div><!-- .uk-width -->
		</div><!-- .uk-grid -->
	</div><!-- .uk-container -->
</section>