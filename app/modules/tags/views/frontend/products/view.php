<div id="products-page" class="page-body">
	<div class="banner-page  uk-text-center" >
        <div class="absulute-page">
            <header class="panelhead" style="background: url('<?php echo $this->fcSystem['banner_banner1'] ?>');">
				<h2 class="heading detalhead uk-container"><span style="color: #fff;">Tag</span></h2>
			</header>
			<div class="breadcrumb">
				<div class="uk-container uk-container-center">
					<ul class="uk-breadcrumb">
						<li>
							<a href="<?php echo BASE_URL ?>" title="<?php echo $this->lang->line('home_page') ?>">
								<?php echo $this->lang->line('home_page'); ?>
							</a>
						</li>
						<li class="uk-active">
							<a>Từ khóa: <?php echo $DetailTags['title'] ?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<section class="design-catalogue mt30">
    	<section class="prd-catalogue-box">
			<div class="uk-container uk-container-center">
				<?php if(isset($ArticlesList) && is_array($ArticlesList) && count($ArticlesList)){ ?>
					<ul class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 list-products" data-uk-grid-match="{target: '.products .title'}">
						<?php foreach($ArticlesList as $key => $val) { ?> 
							<?php 
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products'); 
                                $price = $val['price'];
                                $saleoff = $val['saleoff'];
                                if ($price > 0) {
                                    $giaold = ''.str_replace(',', '.', number_format($price)).' <sub>đ</sub>';
                                }else{
                                    $giaold = 'Liên hệ';
                                }
                                if ($saleoff > 0) {
                                    $gia = '<span class="no-trike">'.str_replace(',', '.', number_format($saleoff)).' VNĐ</span>';
                                }else{
                                    $gia = '<span class="no-trike">Liên hệ</span>';
                                }
                            ?>
                    		<li class="mb30">
                                <div class="products">
                                    <div class="thumb">
                                        <a class="img-cover img" href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
                                            <img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                            <span class="title_detail uk-hidden"><?php echo $val['title'] ?></span>
                                        </a>
                                        <div class="groups-button">
		                                    <div class="quick-view">
						                        <a href="<?php echo $href ?>" class="quickview">
						                           <i class="fa fa-eye"> </i>
						                        </a>
						                    </div>
						                </div>
                                    </div>
                                    <div class="info uk-flex-middle uk-flex uk-flex-center">
                                    	<div class="box_center">
	                                        <h3 class="title">
	                                        	<a href="<?php echo $href ?>" title="<?php echo $val['title'] ?>">
	                                        		<?php echo $val['title'] ?>
	                                        	</a>
	                                        </h3>
	                                        <div class="star_item mt20"></div>
	                                    </div>
                                    </div>
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between box_infor">
                                    	<div class="date_khaigiang"><?php echo $val['code']; ?></div>
                                    	<div class="priceprd"><?php echo $giaold ?></div>
                                    </div>
                                </div>
                            </li>
						<?php } ?>
					</ul>
					<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
				<?php }else{ echo '<div class="mt10">'.$this->lang->line('no_data_table').'</div>';} ?>
			</div>
		</section>
	</section>
</div>