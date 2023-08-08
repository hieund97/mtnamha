
<main class="main-site_bar">
	<div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
            	<div class="wp-content-left-dv">
            		<div class="title-page hide">
                        <h1 class="tt-page">Tìm kiếm từ khóa: <?php echo $keys ?></h1>
                    </div>
                    <div class="list-sp-page">
                        <div class="">
							<?php if(isset($result) && is_array($result) && count($result)){ ?>
								<?php foreach($result as $key => $val) { ?> 
									<?php 
										$title = $val['title'];
										$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles');
										$image = getthumb($val['images'], TRUE);
										$created = show_time($val['created'], 'd/m/Y');
										$description = cutnchar(strip_tags($val['description']), 250);
										$catalogues = Load_catagoies(json_decode($val['catalogues'], TRUE), 'articles');
									?>
									<div class="text-img-content">
				                        <div class="row">
				                            <div class="col-md-5">
				                                <div class="img-left-content">
				                                    <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="sửa điều hòa"></a>
				                                </div>
				                            </div>
				                            <div class="col-md-7">
				                                <div class="text-rght-content">
				                                    <h4><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h4>
				                                    <p><?php echo cutnchar(strip_tags($val['description']),300) ?></p>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
	                    		<?php } ?>
	                    		<div class="clearfix"></div>
								<?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
							<?php }else{ echo '<div class="mt10">'.$this->lang->line('no_data_table').'</div>';} ?>
						</div>
					</div>
				</div>
			</div>
			
			<?php echo $this->load->view('homepage/frontend/common/aside') ?>
			
		</div>
	</div>
</main>
<style type="text/css">
	.text-img-content{
		margin-bottom: 20px;
	}
	.text-img-content img{
		height: 160px;
		object-fit: contain;
	}
</style>