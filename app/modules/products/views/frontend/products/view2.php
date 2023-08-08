<style>
    ul.menu-main-sub {
        display: none;
    }
</style>
<div id="article-page" class="page-body">
	<div class="uk-container uk-container-center">
		<div class="banner relative">
	        <div class="img-wrapper">
	            <img alt="<?php echo $DetailProducts['title'] ?>" src="<?php echo $DetailProducts['banner'] ?>">
	        </div>
			<?php if (isset($tabs) && is_array($tabs) && count($tabs)): ?>
	            <div class="tabs">
	                <ul class="uk-list uk-text-center tabControl-prd" data-uk-switcher="{connect:'#tabContent-prd'}">
						<?php foreach ($tabs as $key => $vals) { ?>
	                    	<li class="<?php echo (($key == 0) ? 'uk-active' : '') ?>"><?php echo $vals['title'] ?></li>
	                    <?php } ?>
	                </ul>
	            </div>
	    	<?php endif ?>
	    </div>
		<div class="uk-grid lib-grid-30 mt30">
			<div class="uk-width-large-1-4 uk-visible-large">
				<?php if (isset($products_aside) && is_array($products_aside) && count($products_aside)): ?>
					<aside class="aside">
						<section class="aside-products">
							<header class="panel-head">
								<div class="heading"><?php echo $this->lang->line('product_catalogues') ?></div>
							</header><!-- /header -->
							<section class="panel-body">
								<ul class="uk-list list-product-tab">
									<?php foreach ($products_aside as $key => $val) { ?>
										<?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');  ?>
										<li class="<?php echo (($href == $urlbl) ? 'uk-active' : '') ?>">
											<h3 class="title">
												<a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>
											</h3>
										</li>
									<?php } ?>
								</ul>
							</section>
						</section>
					</aside>
				<?php endif ?>
			</div>
			<div class="uk-width-large-3-4 mb30">
				<?php if (isset($tabs) && is_array($tabs) && count($tabs)): ?>
					<section class="course_prd">
					 	<ul id="tabContent-prd" class="uk-switcher tab-content">
							<?php foreach ($tabs as $keys => $valss) { ?>
								<li> 
									<header class="panel-head mb10">
										<div class="title_course"><?php echo $valss['title'] ?></div>
									</header>
									<section class="panel-body">
										<?php echo $valss['description'] ?>
									</section>
								</li>
							<?php } ?>
						</ul>
					</section>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<?php  
	$prdprice = $DetailProducts['price'];
	$prdsaleoff = $DetailProducts['saleoff'];
	if ($prdprice > 0) {
	    $DetailProductsgiaold = '<font>'.str_replace(',', '.', number_format($prdprice)).' <sub>₫</sub></font>';
	}else{
	    $DetailProductsgiaold  = '';
	}
	if ($prdsaleoff > 0) {
	    $DetailProductsgia = '<span>'.str_replace(',', '.', number_format($prdsaleoff)).' <sub>₫</sub></span>';
	}else{
	    $DetailProductsgia  = 'Liên hệ';
	}
	$tabs = json_decode($DetailProducts['itinerary'], TRUE); 
?>
<div id="products-page" class="page-body">
	<?php $this->load->view('homepage/frontend/common/slider'); ?>
    <div class="breadcrumb uk-hidden">
        <div class="uk-container uk-container-center">
            <ul class="uk-breadcrumb">
                <li>
                    <a href="<?php echo BASE_URL ?>" title="<?php echo $this->lang->line('home_page') ?>">
                        <?php echo $this->lang->line('home_page') ?>
                    </a>
                </li>
                <?php foreach($Breadcrumb as $key => $val){ ?>
                    <?php 
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
                    ?>
                    <li class="uk-active">
                        <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
	<div class="uk-container uk-container-center">
    	<section class="design-detail">
    		<header class="panel-head uk-text-center mb30">
                <h2 class="heading"><span class="title"><?php echo $DetailCatalogues['title'] ?></span></h2>
            </header>
			<section class="panel-body">
				<div class="uk-grid lib-grid-30">
					<div class="uk-width-large-1-2">
						<script>
					    	$(document).ready(function() {
								$("#content-slider").lightSlider({
					                loop:true,
					                keyPress:true
					            });
					            $('#image-gallery').lightSlider({
					                gallery:true,
					                item:1,
					                thumbItem: 3,
					                slideMargin: 0,
					                speed:2500,
					                auto:false,
					                loop:true,
					                onSliderLoad: function() {
					                    $('#image-gallery').removeClass('cS-hidden');
					                }  
					            });
							});
					    </script>
						<section class="prd-albums-box">
							<!-- Hình ảnh -->
							<div class="gallerys">
								<div class="slider">
									<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
										<li data-thumb="<?php echo $DetailProducts['images']; ?>">
				                        	<a href="<?php echo $DetailProducts['images']; ?>" data-uk-lightbox="{group:'gallerys'}" class="img-cover relative" title="<?php echo $DetailProducts['title'] ?>">
				                        		<img src="<?php echo $DetailProducts['images']; ?>" alt="<?php echo $DetailProducts['title'] ?>" />
				                        		<span class="bo-vien"></span>
				                        	</a>
				                        </li>
										<?php $album = json_decode($DetailProducts['albums'], TRUE); ?>
										<?php if(isset($album) && is_array($album) && count($album)){ ?>
											<?php foreach($album as $key => $val){ ?>
												<?php if ($val['images'] == '') continue; ?>
												<li data-thumb="<?php echo $val['images']; ?>">
						                        	<a href="<?php echo $val['images']; ?>" data-uk-lightbox="{group:'gallerys'}" class="img-cover" title="<?php echo $val['title'] ?>">
						                        		<img src="<?php echo $val['images']; ?>" alt="<?php echo $val['title'] ?>" />
						                        	</a>
						                        </li>
											<?php } ?>
										<?php } ?>
					                </ul>
								</div>
							</div><!-- .gallerys -->
						</section>
					</div>
					<div class="uk-width-large-1-2">
						<div class="box_detail_product">
							<h1 class="title-prd"><?php echo $DetailProducts['title'] ?></h1>
							<div class="uk-share mt20 mb20"><?php links_share() ?></div>
							<div class="price-detail">Giá bán: <?php echo $DetailProductsgia.' '.$DetailProductsgiaold ?></div>
							<div class="description"><?php echo $DetailProducts['description'] ?></div>
							<div class="buy mt20">
								<div class="number uk-flex uk-flex-middle mb20 lib-grid-15">
									<div class="label" style="width: 100px;line-height: 32px;font-size: 13px;">Số lượng</div>
									<div class="quantity-box uk-clearfix">
										<span class="btn btn-up">-</span>
										<input type="text" name="" value="1" class="quantity" />
										<span class="btn btn-down">+</span>
									</div>
									<div class="buy-item">
										<div class="action-button ajax-addtocart" data-quantity="1" data-id="<?php echo $DetailProducts['id'] ?>" data-price="<?php echo $DetailProductsgia ?>">Thêm vào giỏ hàng</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
		<section class="product-detail mb20 mt20 uk-hidden">
			<!-- Thông tin sản phẩm -->
			<header class="panel-head">
				<h4 class="heading">
					<span>Thông tin chung</span>
				</h4>
			</header>
			<section class="panel-body" id="tour_overview">
				<?php echo $DetailProducts['content'] ?>
			</section>
		</section>
		<!-- Otther -->
		<?php if (isset($products_same) && is_array($products_same) && count($products_same)): ?>
			<section class="product_otther mtb30">
				<header class="panel-head uk-text-center mb20">
					<h4 class="heading">
						<span>Các món khác</span>
					</h4>
				</header>
				<section class="panel-body">
                    <ul class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 list-product-catalog" data-uk-grid-match="{target: '.product .title'}">
                        <?php foreach ($products_same as $key => $val) { ?>
                            <?php 
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products'); 
                                $image = getthumb($val['images'], TRUE);
                                $price = $val['price'];
                                $saleoff = $val['saleoff'];
                                if ($price > 0) {
                                    $pri_old = '<font>'.str_replace(',', '.', number_format($price)).' <sub>₫</sub></font>';
                                }else{
                                    $pri_old  = '';
                                }
                                if ($saleoff > 0) {
                                    $pri_sale = '<span>'.str_replace(',', '.', number_format($saleoff)).' <sub>₫</sub></span>';
                                }else{
                                    $pri_sale  = '<span>Liên hệ</span>';
                                }
                            ?>
                            <li class="mb15">
                                <div class="product mt5 uk-text-center">
                                    <div class="thumb relative">
                                        <a class="img-scaledown" href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                            <img src="<?php echo $image ?>" alt="<?php echo $val['title'] ?>">
                                            <span class="bo-vien"></span>
                                        </a>
                                    </div>
                                    <div class="infor">
                                        <h3 class="title">
                                            <a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                                <?php echo $val['title'] ?>
                                            </a>
                                        </h3>
                                        <div class="price-prd">Giá: <?php echo $pri_sale; ?></div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
			</section>
		<?php endif ?>
	</div><!-- .uk-container -->
</div>