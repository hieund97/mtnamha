<section class="content-header">
	<h1>Thêm sản phẩm mới</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
		<li><a href="<?php echo site_url('products/backend/products/view');?>">sản phẩm</a></li>
		<li class="active"><a href="<?php echo site_url('products/backend/products/create');?>">Thêm sản phẩm mới</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<form class="hidden-form" style="display:none;" id="cat-form" method="post" action="">
			<input type="text" value="" id="str"/>
		</form>
		<form class="form-horizontal" method="post" action="">
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
						<!-- <li><a href="#tab-itinerary" data-toggle="tab">Tab thông số</a></li> -->
						<li><a href="#tab-album" data-toggle="tab">Album ảnh</a></li>
						<!-- <li><a href="#tab-review" data-toggle="tab">Phụ huynh đánh giá</a></li> -->
					</ul>
					<div class="tab-content">
						<div class="box-body">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						</div><!-- /.box-body -->
						<div class="tab-pane active" id="tab-info">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Tiêu đề</label>
									<div class="col-sm-8">
										<?php echo form_input('title', html_entity_decode(set_value('title', $DetailProducts['title'])), 'class="form-control form-static-link" placeholder="Tiêu đề"');?>
									</div>
									<div class="col-sm-2"><span class="btn btn-primary create-static-links">Tạo liên kết tĩnh</span></div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Liên kết</label>
									<label class="col-sm-3 control-label tp-text-left"><?php echo base_url(); ?></label>
									<div class="col-sm-5">
										<?php echo form_input('canonical', set_value('canonical', $DetailProducts['canonical']), 'class="form-control canonical" placeholder="Liên kết"');?>
										<?php echo form_hidden('canonical_original', $DetailProducts['canonical']);?>
									</div>
									<div class="col-sm-2" style="line-height: 34px;font-weight: 600;">.html</div>
								</div>

								<div class="form-group hide">
									<label class="col-sm-2 control-label tp-text-left">Chủ đề</label>
									<div class="col-sm-10">
										<?php echo form_dropdown('tagsid[]', $this->BackendTags_Model->Dropdown(), (isset($tagsid)?$tagsid:NULL), 'class="form-control select2" multiple="multiple" style="width: 100%;" id="tagsid"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Tiêu đề SEO</label>
									<div class="col-sm-10">
										<?php echo form_input('meta_title', set_value('meta_title', $DetailProducts['meta_title']), 'class="form-control" placeholder="Tiêu đề SEO"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Từ khóa SEO</label>
									<div class="col-sm-10">
										<?php echo form_input('meta_keyword', set_value('meta_keyword', $DetailProducts['meta_keyword']), 'class="form-control" placeholder="Từ khóa SEO"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Mô tả SEO</label>
									<div class="col-sm-10">
										<?php echo form_textarea('meta_description', set_value('meta_description', $DetailProducts['meta_description']), 'class="form-control" placeholder="Mô tả SEO" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
								<div class="attribute-list">
									<?php if(isset($attr) && is_array($attr) && count($attr)){ ?>
										<?php if(isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)){ ?>
											<?php foreach($attribute_catalogues as $key => $val){ ?>
											<?php if(in_array($val['id'], $cat_checked['attribute_catalogue']) == FALSE) continue; ?>
											<div class="form-group">
												<label class="col-sm-2 control-label tp-text-left"><?php echo $val['title']; ?></label>
												<div class="col-sm-10">
													<div class="checkbox">
													<?php if(isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])){ ?>
													<?php foreach($val['attributes'] as $keyAttr => $valAttr){ ?>
													<?php 
														if(isset($cat_checked['attribute'][$val['keyword']]) && in_array($valAttr['id'], $cat_checked['attribute'][$val['keyword']]) == false) continue;
													?>
														<label class="tpInputLabel" style="width: 168px;">
															<input name="attr[<?php echo $valAttr['id'] ?>]" type="checkbox" class="tpInputCheckbox" <?php echo ((isset($attr) && in_array($valAttr['id'], $attr)) ? 'checked' : '') ?>  value="<?php  echo $valAttr['id'] ?>"  />
															<span><?php echo $valAttr['title']; ?></span>
														</label>
													<?php } ?>
													<?php } ?>
													</div>
												</div>
											</div>
											<?php } ?>
										<?php } ?>
									<?php }else{ ?>
										<?php if(isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)){ ?>
										<?php if(isset($_static_cat_checked['attribute_catalogue']) && is_array($_static_cat_checked['attribute_catalogue']) && count($_static_cat_checked['attribute_catalogue'])){ ?>
											<?php foreach($attribute_catalogues as $key => $val){ ?>
											<?php if(in_array($val['id'], $_static_cat_checked['attribute_catalogue']) == FALSE) continue; ?>
											<div class="form-group">
												<label class="col-sm-2 control-label tp-text-left"><?php echo $val['title']; ?></label>
												<div class="col-sm-10">
													<div class="checkbox">
													<?php if(isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])){ ?>
													<?php foreach($val['attributes'] as $keyAttr => $valAttr){ ?>
													<?php 
														if(isset($_static_cat_checked['attribute'][$val['keyword']]) && in_array($valAttr['id'], $_static_cat_checked['attribute'][$val['keyword']]) == false) continue;
													?>
														<label class="tpInputLabel" style="width: 168px;">
															<input name="attr[<?php echo $valAttr['id'] ?>]" type="checkbox" class="tpInputCheckbox" <?php echo ((in_array($valAttr['id'],$attribute_checked)) ? 'checked' : ''); ?>  value="<?php  echo $valAttr['id'] ?>"  />
															<span><?php echo $valAttr['title']; ?></span>
														</label>
													<?php } ?>
													<?php } ?>
													</div>
												</div>
											</div>
											<?php } ?>
										<?php }} ?>
									<?php } ?>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Mô tả <br>(Descriptions)</label>
									<div class="col-sm-10">
										<?php echo form_textarea('description', htmlspecialchars_decode(set_value('description', $DetailProducts['description'])), 'id="txtDescription" class="ckeditor-description" placeholder="Mô tả" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
								
								<div class="form-group hide">
									<label class="col-sm-2 control-label tp-text-left">Thành phần cũ</label>
									<div class="col-sm-10">
										<?php echo form_textarea('content3', htmlspecialchars_decode(set_value('content3', $DetailProducts['content3'])), 'id="txtContent3" class="ckeditor-description" placeholder="Thành phần cũ" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Thông tin sản phẩm</label>
									<div class="col-sm-10">
										<?php echo form_textarea('content', htmlspecialchars_decode(set_value('content', $DetailProducts['content'])), 'id="txtContent" class="ckeditor-description" placeholder="Thông tin sản phẩm" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label tp-text-left">Đặc điểm nổi bật</label>
									<div class="col-sm-10">
										<?php echo form_textarea('content2', htmlspecialchars_decode(set_value('content2', $DetailProducts['content2'])), 'id="txtContent2" class="ckeditor-description" placeholder="Đặc điểm nổi bật" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-itinerary">
							<div class="box-body">
								<div class="form-group" id="from-itinerary">
									<?php 
										$itinerary = $this->input->post('itinerary');
										$iti = '';
										if(isset($itinerary) && is_array($itinerary) && count($itinerary)){
											foreach($itinerary['images'] as $key => $val){
												$iti[$key]['title'] = $slide['title'][$key];
												$iti[$key]['description'] = $slide['description'][$key];
											}
										}else{
											$iti = json_decode($DetailProducts['itinerary'], TRUE);
										}
									?>
									<?php if(isset($iti) && is_array($iti) && count($iti)){ ?>
									<?php foreach($iti as $key => $val){ ?>
									<div class="col-sm-12 itineraryItem">
										<div class="form-line">
											<input type="text" name="itinerary[title][]" value="<?php echo $iti[$key]['title'];?>" class="form-control title" placeholder="Tiêu đề"/>
										</div>
										<div class="form-line">
											<?php echo form_textarea('itinerary[description][]', htmlspecialchars_decode(set_value('itinerary[description][]', $iti[$key]['description'])), 'id="txtContent'.($key + 4).'" class="ckeditor-description" placeholder="Giá & Bao gồm" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
										</div>
										<div class="form-line">
											<button type="button" class="btn btnRemove1 remove2 btn-danger pull-right">Xóa bỏ</button>
										</div>
									</div>
									<?php } } ?>
									<div class="col-sm-3 itineraryItem">
										<button type="button" class="btn btnAddItem add2 pull-left">+</button>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-album">
							<div class="box-body">
								<div class="form-group" id="fromSlide">
								<?php 
									$slide = $this->input->post('album');
									$album = '';
									if(isset($slide) && is_array($slide) && count($slide)){
										foreach($slide['images'] as $key => $val){
											$album[$key]['images'] = $val;
											$album[$key]['title'] = $slide['title'][$key];
											$album[$key]['description'] = $slide['description'][$key];
										}
									}else{
										$album = json_decode($DetailProducts['albums'], TRUE);
									}
								?>
								<?php if(isset($album) && is_array($album) && count($album)){ ?>
								<?php foreach($album as $key => $val){ if(empty($album[$key]['images'])) continue;?>
								<div class="col-sm-3 slideItem">
								<div class="thumb"><img src="<?php echo $album[$key]['images'];?>" class="img-thumbnail img-responsive"/></div>
								<input type="hidden" name="album[images][]" value="<?php echo $album[$key]['images'];?>" />
								<input type="text" name="album[title][]" value="<?php echo $album[$key]['title'];?>" class="form-control title" placeholder="Tên ảnh" />
								<textarea name="album[description][]" cols="40" rows="10" class="form-control description" placeholder="Mô tả ảnh"><?php echo $album[$key]['description'];?></textarea>
								<button type="button" class="btn btnRemove remove1 btn-danger pull-right">Xóa bỏ</button>
								</div>
								<?php } ?>
								<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add1 pull-left">+</button></div>
								<?php } ?>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab-review">
							<div class="box-body">
								<div class="form-group" id="from-review">
									<?php 
										$review = $this->input->post('review');
										$rev = '';
										if(isset($review) && is_array($review) && count($review)){
											foreach($review['images'] as $key => $val){
												$rev[$key]['title'] = $slide['title'][$key];
												$rev[$key]['description'] = $slide['description'][$key];
											}
										}else{
											$rev = json_decode($DetailProducts['review'], TRUE);
										}
									?>
									<?php if(isset($rev) && is_array($rev) && count($rev)){ ?>
									<?php foreach($rev as $key => $val){ ?>
									<div class="col-sm-12 reviewItem">
										<div class="form-line">
											<input type="text" name="review[title][]" value="<?php echo $rev[$key]['title'];?>" class="form-control title" placeholder="Tên phụ huynh"/>
										</div>
										<div class="form-line">
											<input type="text" name="review[images][]" value="<?php echo $rev[$key]['images'];?>" class="form-control" onclick="openKCFinder(this)" placeholder="Ảnh đại diện"/>
										</div>
										<div class="form-line">
											<?php echo form_textarea('review[description][]', htmlspecialchars_decode(set_value('review[description][]', $rev[$key]['description'])), 'id="txtContentd'.($key + 4).'" class="ckeditor-description" placeholder="Nội dung" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
										</div>
										<div class="form-line">
											<button type="button" class="btn btnRemove1 remove3 btn-danger pull-right">Xóa bỏ</button>
										</div>
									</div>
									<?php } } ?>
									<div class="col-sm-3 reviewItem">
										<button type="button" class="btn btnAddItem add3 pull-left">+</button>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.tab-content -->
					<div class="box-footer">
						<button type="reset" class="btn btn-default">Làm lại</button>
						<button type="submit" name="update" value="action" class="btn btn-info pull-right">Cập nhật</button>
					</div><!-- /.box-footer -->
					
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
			<div class="col-md-3">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-info" data-toggle="tab">Nâng cao</a></li>
					</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-seo">
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Ảnh đại diện</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="avatar" style="margin-bottom: 10px;cursor: pointer;"><img src="<?php echo (!empty($DetailProducts['images']))? $DetailProducts['images']:'templates/not-found.png'; ?>" class="img-thumbnail" alt="" style="width: 100%;border-radius: 0;object-fit: scale-down;height: 200px;"/></div>
										<?php echo form_input('images', set_value('images', $DetailProducts['images']), 'class="form-control"  placeholder="Ảnh đại diện" onclick="openKCFinder(this)" ');?>
									</div>
								</div>
								<div class="form-group hidden">
									<label class="col-sm-12 control-label tp-text-left">Banner</label>
								</div>
								<div class="form-group hidden">
									<div class="col-sm-12">
										<?php echo form_input('banner', set_value('banner', $DetailProducts['banner']), 'class="form-control" placeholder="Banner" onclick="openKCFinder(this)" ');?>
									</div>
								</div>
								<div class="form-group hidden">
									<label class="col-sm-12 control-label tp-text-left">Video</label>
								</div>
								<div class="form-group hidden">
									<div class="col-sm-12">
										<?php echo form_input('video', set_value('video', $DetailProducts['video']), 'class="form-control" placeholder="video" onclick="openKCFinder(this,files)" ');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Giá tiền</label>
									<div class="col-sm-12">
										<?php echo form_input('price', set_value('price', str_replace(',','.',number_format($DetailProducts['price']))), 'class="form-control price" placeholder="Giá tiền"');?>
									</div>
									<label class="col-sm-12 control-label tp-text-left">Giá khuyến mãi</label>
									<div class="col-sm-12">
										<?php echo form_input('saleoff', set_value('saleoff', str_replace(',','.',number_format($DetailProducts['saleoff']))), 'class="form-control price-saleoff" placeholder="Giá tiền sau khuyến mãi"');?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Breadcrumb / Danh mục cha</label>
								</div>
								<?php $dropdown = $this->nestedsetbie->Dropdown(); ?>
								<?php if(isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="uk-scrollable-box">
											<ul class="uk-list tp-list-catalogue">
												<?php foreach ($dropdown as $key => $val) { if ($key == 0) continue; ?>
												<li>
													<label for="" class="catalogueid">
														<?php echo form_radio('cataloguesid', $key, set_radio('cataloguesid', $key, FALSE), (isset($DetailProducts['cataloguesid']) && $DetailProducts['cataloguesid'] == $key)?'checked="checked" class="check-box"':'class="check-box"');?>
													</label>
													<label for="" class="catalogue">
													<?php echo form_checkbox('catalogue[]', $key, set_checkbox('catalogue[]', $key, FALSE), (isset($catalogue) && count($catalogue) && is_array($catalogue) && in_array($key,$catalogue))?'checked="checked"': '');?>
														<?php echo $val; ?>
													</label>
												</li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Tình trạng</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('isfooter', $this->configbie->data('isfooter'), set_value('isfooter', $DetailProducts['isfooter']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Xuất sứ</label>
									<div class="col-sm-12">
										<?php echo form_input('code', set_value('code', $DetailProducts['code']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Xuất bản</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', $DetailProducts['publish']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Trang chủ</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('ishome', $this->configbie->data('ishome'), set_value('ishome', $DetailProducts['ishome']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group hide">
									<label class="col-sm-12 control-label tp-text-left">Aside</label>
								</div>
								<div class="form-group hide">
									<div class="col-sm-12">
										<?php echo form_dropdown('isaside', $this->configbie->data('isaside'), set_value('isaside', $DetailProducts['isaside']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Nổi bật</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_dropdown('highlight', $this->configbie->data('highlight'), set_value('highlight', $DetailProducts['highlight']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group hide">
									<label class="col-sm-12 control-label tp-text-left">Khuyến mại</label>
								</div>
								<div class="form-group hide">
									<div class="col-sm-12">
										<?php echo form_dropdown('psale', $this->configbie->data('psale'), set_value('psale', $DetailProducts['psale']), 'class="form-control" style="width: 100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label tp-text-left">Vị trí</label>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<?php echo form_input('order', set_value('order', $DetailProducts['order']), 'class="form-control" placeholder="Vị trí"');?>
									</div>
								</div>
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</form>
	</div> <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
	$(document).on('click', '.img-thumbnail', function(){
		openKCFinderAlbum($(this));
	});
	
	$(document).ready(function(){
		var time;
		$('.price, .price-saleoff').on('keyup', function(event) {
			var price = $(this).val();
			var _this = $(this);
			var url = 'products' +'/ajax/'+ 'products' + '/convert_commas_price';
			clearTimeout(time);
			time = setTimeout(function() {
				$.post(url, {price: price}, function(data){
					_this.val(data);
				});
			}, 300);
		});
		
		$('.check-box').change(function(){
			var str = '';
			$('.check-box').each(function(){
				if($(this).val() != 0  && $(this).prop('checked') == true){
					str = str + $(this).val() + '-';
				}
			});
			if(str.length > 0){
				str = str.substr(0, str.length - 1);
				$('#str').val(str);
			}else{
				$('#str').val('');
			}
			$('#cat-form').trigger('submit');
		});
		
		$('#cat-form').on('submit',function(){
			var postData = $('#str').val();
			var formURL = 'products/ajax/products/attributes';
			$.post(formURL, {
				post: postData,}, 
				function(data){
					$('.attribute-list').html(data);
				});
			return false;
		});
		
	});
	
</script>

<script type="text/javascript">
	$(window).load(function(){
		var item;
		item = '<div class="col-sm-3 slideItem">';
		item = item + '<div class="thumb"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
		item = item + '<input type="hidden" name="album[images][]" value="" />';
		item = item + '<input type="text" name="album[title][]" value="" class="form-control title" placeholder="Tên ảnh"/>';
		item = item + '<textarea name="album[description][]" cols="40" rows="10" class="form-control description" placeholder="Mô tả ảnh"></textarea>';
		item = item + '<button type="button" class="btn btnRemove remove1 btn-danger pull-right">Xóa bỏ</button>';
		item = item + '</div>';
		item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add1 pull-left">+</button></div>';
		if($('#fromSlide').html().trim() == ''){
			$('#fromSlide').append(item);
		}


		/* Thêm phần tử tiếp theo */
		$(document).on('click', '.btnAddItem.add1', function(){
			$('.btnAddItem.add1').parent().remove();
			$('#fromSlide').append(item);
		});

		/* Xóa phần tử */
		$(document).on('click', '.btnRemove.remove1', function(){
			$(this).parent().remove();
		});



		var item2;
		item2 = '<div class="col-sm-12 itineraryItem">';
		item2 = item2 + '<div class="form-line"><input type="text" name="itinerary[title][]" value="" class="form-control title" placeholder="Tiêu đề"/></div>';
		item2 = item2 + '<div class="form-line"><textarea name="itinerary[description][]" onclick="newEditor()" cols="40" rows="10" placeholder="Nội dung chi tiết" class="ckeditor-content" placeholder="Giá & Bao gồm" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></div>';
		item2 = item2 + '<div class="form-line"><button type="button" class="btn btnRemove1 remove2 btn-danger pull-right">Xóa bỏ</button></div>';
		item2 = item2 + '</div>';
		item2 = item2 + '<div class="col-sm-3 itineraryItem"><button type="button" class="btn btnAddItem add2 pull-left">+</button></div>';

		/* Thêm phần tử tiếp theo */
		$(document).on('click', '.btnAddItem.add2', function(){
			$('.btnAddItem.add2').parent().remove();
			$('#from-itinerary').append(item2);
		});

		/* Xóa phần tử */
		$(document).on('click', '.btnRemove1.remove2', function(){
			$(this).parent().parent().remove();
		});

		var item3;
		item3 = '<div class="col-sm-12 reviewItem">';
		item3 = item3 + '<div class="form-line"><input type="text" name="review[title][]" value="" class="form-control title" placeholder="Tên phụ huynh"/></div>';
		item3 = item3 + '<div class="form-line"><input type="text" name="review[images][]" value="" class="form-control" onclick="openKCFinder(this)" placeholder="Ảnh đại diện"/></div>';
		item3 = item3 + '<div class="form-line"><textarea name="review[description][]" onclick="newEditor()" cols="40" rows="10" placeholder="Nội dung" class="ckeditor-content" placeholder="Giá & Bao gồm" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea></div>';
		item3 = item3 + '<div class="form-line"><button type="button" class="btn btnRemove1 remove3 btn-danger pull-right">Xóa bỏ</button></div>';
		item3 = item3 + '</div>';
		item3 = item3 + '<div class="col-sm-3 reviewItem"><button type="button" class="btn btnAddItem add3 pull-left">+</button></div>';

		/* Thêm phần tử tiếp theo */
		$(document).on('click', '.btnAddItem.add3', function(){
			$('.btnAddItem.add3').parent().remove();
			$('#from-review').append(item3);
		});

		/* Xóa phần tử */
		$(document).on('click', '.btnRemove1.remove3', function(){
			$(this).parent().parent().remove();
		});
	});
</script>
<style>
	.form-line, .reviewItem{margin-bottom: 10px;}
</style>