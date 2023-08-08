<div id="body" class="body-container">
    <div class="bres">
        <div class="container pd-10">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>
                <li>Thành viên </li>
            </ul>
        </div>
    </div>
    <?php

    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
        $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }

    ?>
    <div class="top_barr customers-tabs_">
        <div class="container">
            <div class="relative">
                <ul class="nav nav-tabs mb-flex">
                    <li class="<?php echo ($pageURL == site_url('profile')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('profile') ?>"><i class="fas fa-user-tie" aria-hidden="true"></i> Hồ sơ cá nhân</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('password')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('password') ?>"> <i class="fas fa-history" aria-hidden="true"></i> Đổi mật khẩu</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('list-post')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('list-post') ?>"> <i class="fas fa-coins" aria-hidden="true"></i> Đơn hàng</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('logout')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('logout') ?>"> <i class="fas fa-coins" aria-hidden="true"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	<div class="container pd-10">
		<?php $error = validation_errors(); echo !empty($error)?'<div class="uk-alert uk-alert-danger" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a> <p>'.$error.'</p></div>' : ''; ?>
		<div class="">
			<div class="">
				<section class="profile_box">
					<header class="panel-head">
						<div class="heading-2 heading-detail-user"><span>Thông tin thành viên</span></div>
					</header>
					<section class="panel-body pd-l-r-0">
						<div class="uk-panel-body profile project-create">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
							<form  method="post" action="">
								<div class="line-form mb20 bor_bor">
									<div class="box_title_2">
<!--										<span>Thông tin chung</span>-->
									</div>
									<div class="content_content content-form-user row">
										<div class="col-md-4">
                                            <div class="form-group">
                                                <div class="label-left bg_bg">
                                                    <label class="label-label">Email</label>
                                                </div>
                                                <label class="label-label">
                                                    <input type="text" readonly class="form-control" value="<?php echo $DetailUsers['email']; ?>">
                                                </label>
                                            </div>
											<div class="form-group">
												<div class="label-left bg_bg">
													<label class="label-label">Họ và tên</label>
												</div>
												<label class="label-label">
													<?php echo form_input('fullname', set_value('fullname', $DetailUsers['fullname']), 'class="form-control"');?>
												</label>
											</div>
											<div class="form-group">
												<div class="label-left bg_bg">
													<label class="label-label">Số điện thoại</label>
												</div>
												<label class="label-label">
													<?php echo form_input('phone', set_value('phone', $DetailUsers['phone']), 'class="form-control"');?>
												</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<div class="label-left bg_bg">
													<label class="label-label">Giới tính</label>
												</div>
												<label class="label-label">
													<?php echo form_dropdown('sex', $this->configbie->data('sex'), set_value('sex', $DetailUsers['sex']), 'class="form-control"'); ?>
												</label>
											</div>
											<div class="form-group hidden">
												<div class="label-left bg_bg">
													<label class="label-label">Đối tượng</label>
												</div>
												<label class="label-label">
													<?php echo form_dropdown('subjects', $this->configbie->data('subjects'), set_value('subjects', $DetailUsers['subjects']), 'class="form-control"'); ?>
												</label>
											</div>
											<div class="form-group">
												<div class="label-left bg_bg">
													<label class="label-label">Thành phố</label>
												</div>
												<label class="label-label">
													<?php echo form_dropdown('cityid', $location_dropdown, set_value('cityid', $DetailUsers['cityid']), 'class="form-control"');?>
												</label>
											</div>
                                            <div class="form-group">
                                                <div class="label-left bg_bg">
                                                    <label class="label-label">Địa chỉ</label>
                                                </div>
                                                <label class="label-label">
                                                    <?php echo form_input('address', set_value('address', $DetailUsers['address']), 'class="form-control"');?>
                                                </label>
                                            </div>
											<div class="form-group hidden">
												<div class="label-left bg_bg">
													<label class="label-label">Nick Skype</label>
												</div>
												<label class="label-label">
													<?php echo form_input('skype', set_value('skype', $DetailUsers['skype']), 'class="form-control"');?>
												</label>
											</div>
										</div>
										<div class="form-group col-md-4" style="border-top: 0;">
											<div class="label-left bg_bg">
												<label class="label-label">Mô tả bản thân</label>
											</div>
												<label class="label-label" style="line-height: 0;">
													<?php echo form_textarea('description', set_value('description', $DetailUsers['description']), 'class="form-control" placeholder="Giới thiệu về bản thân" style="padding: 5px;"');?>
												</label>
										</div>
										<div style="clear: both;"></div>
										<div class="form-group col-md-6 hidden">
											<div class="label-left bg_bg">
												<label class="label-label">Avatar</label>
											</div>
											<div class="label-right bdl0">
												<label class="label-label">
													<div class="box image-wapper">
							                            <div class="image-wapper-take" style="margin: 0;">
							                            	<div class="note_">Click để đổi hình đại diện</div>
							                                <div class="jfu-container">
							                                	<span class="jfu-btn-upload">
							                                		<?php  
							                                			if ($DetailUsers['avatar'] != '') {
							                                				?>
																				<img src="<?php echo $DetailUsers['avatar'] ?>" alt="<?php echo $DetailUsers['fullname'] ?>">
							                                				<?php
							                                			}
							                                			else
							                                			{
							                                		?>
<!-- 								                                	<span>
								                                		<span style="position:relative; cursor:pointer"> 
								                                			<i class="fa fa-camera camera-add-image"></i>
								                                			<i class="fa fa-plus-circle plus-add-image"></i>
								                                		</span>
								                                	</span> -->
								                                	<?php } ?>
								                                	<input  class="input-file jfu-input-file" accept="image/*" id="files" name="file[]" type="file">
								                                </span>
							                                </div>
								                        </div>
							                        </div>
							                        <div class="progress" style="display: none;">
													    <div id="progress-bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
													      0%
													    </div>
													</div>
													<div class="box_images_">
														<div class="list-error"></div>
														<ul class="list-group lib-grid-10 uk-flex uk-flex-middle uk-list">
															<input value="<?php echo $DetailUsers['avatar'] ?>" name="avatar" type="hidden">
														</ul>
													</div>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="uk-form-row-center uk-text-center">
									<input class="uk-button login_button" type="submit" name="update" value="Lưu thông tin" />
								</div>
							</form>
						</div>
					</section>
				</section>
			</div>
			
		</div><!-- .uk-grid  -->
	</div>
</div>
<script>
	$(document).ready(function() {
	    var inputFile = $('input#files');
	    var uploadURI = '<?php echo site_url('customers/ajax/auth/ajax_upload') ?> ';
	    var processBar = $('#progress-bar');

	    $('input#files').change(function(event) {
	        var filesToUpload = inputFile[0].files;

	        if (filesToUpload.length > 0) {

	            var formData = new FormData();

	            for (var i = 0; i < filesToUpload.length ; i++) {
	                var file = filesToUpload[i];
	                formData.append('file[]', file, file.name);
	            }


	            $.ajax({
	                url: uploadURI,
	                type: 'post',
	                data : formData,
	                processData: false,
	                contentType: false,
	                success:  function (data)
	                {
	                    var json = JSON.parse(data);
	                    $('.list-group').html(json.html);
	                    $('.list-error').html(json.error);
	                },
	                xhr: function(){
	                    var xhr = new XMLHttpRequest();
	                    xhr.upload.addEventListener('progress', function(event){
	                        if (event.lengthComputable) {
	                            var percentComplete = Math.round((event.loaded / event.total)*100);
	                            $('.progress').show();
	                            processBar.css({width: percentComplete + "%"});
	                            processBar.text(percentComplete + "%");
	                        };
	                    }, false);
	                    return xhr;
	                }
	            });
	        }
	    });

	    $(document).on('click', '.remove-file', function(){
	        var me = $(this);
	        $.ajax({
	            url: uploadURI,
	            type: 'post',
	            data : {file_to_remove: me.attr('data-file')},
	            success:  function ()
	            {
	                me.closest('li').remove();
	            }
	        });
	    });

	    $(document).on('click', 'input[name=file]', function(){
	        $('.progress').hide();
	        processBar.css({width: "0%"});
	        processBar.text("0%");
	    });
	});
</script>
<style>
    body {
        background: #fff!important;
    }
</style>