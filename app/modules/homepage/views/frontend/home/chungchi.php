<div id="body" class="body-container">
	<div class="relative">
        <span class="img-cover"><img src="<?php echo $this->fcSystem['banner_banner1'] ?>" alt="banner header" style="filter: brightness(0.6);"></span>
        <h1 class="heading-posiontion uk-text-center"><span class="title">Đăng ký trực tuyến</span></h1>
    </div>
	<div class="uk-container uk-container-center"> 
		<section class="panel-register">
			<div class="note-partner-werden">
				<p>Để thuận tiện cho việc đăng ký dự thi của thí sinh, chúng tôi mời bạn đăng ký vào mẫu đăng ký dự thi trực tuyến bên cạnh. Đây là căn cứ để chúng tôi có thể giới thiệu cho bạn những thông tin sát thực, cập nhật nhất về kỳ tuyển sinh của trường ĐH FPT.</p>

				<p>Xin điền đầy đủ thông tin tại các mục có dấu (*).</p>

				<p>Chỉ cần đăng ký 01 lần duy nhất, thông tin của bạn sẽ được lưu trữ trong hệ thống. Chúng tôi sẽ chủ động liên hệ với bạn trong vòng 10 ngày kể từ khi bạn gửi bản đăng ký thông tin sơ bộ này.</p>
			</div>
			<?php $error = validation_errors(); echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px; background: rgb(195, 94, 94); color:#fff; margin-bottom:10px;">'.$error.'</div>' : ''; ?>
			<?php 
				$location_dropdown = $this->BackendProjects_Model->location_dropdown(array(
					'where' => array('parentid' => 0)
				));
			?>
			<form action="" method="post" accept-charset="utf-8">
				<div class="line-form bor_bor">
					<div class="uk-grid uk-grid-medium uk-grid-width-medium-1-2 content_content">
						<div class="item-form mb15">
							<label>Họ và tên <font color="red">*</font></label>
							<?php echo form_input('fullname', set_value('fullname'), 'placeholder="Họ và tên" class="uk-width-1-1"');?>
						</div>
						<div class="item-form mb15">
							<label>Điện thọai <font color="red">*</font></label>
							<?php echo form_input('phone', set_value('phone'), 'placeholder="Số đện thoại" class="uk-width-1-1"');?>
						</div>
						<div class="item-form mb15">
							<label>Ngày sinh</label>
							<?php echo form_input('birthday', set_value('birthday'), 'placeholder="Ngày sinh của bạn" class="uk-width-1-1"');?>
						</div>
						<div class="item-form mb15">
							<label>Email</label>
							<?php echo form_input('email', set_value('email'), 'placeholder="Địa chỉ email" class="uk-width-1-1"');?>
						</div>
						<div class="item-form mb15">
							<label>Trường THPT / Đại học</label>
							<?php echo form_input('school', set_value('school'), 'placeholder="Trường THPT / Đại học" class="uk-width-1-1"');?>
						</div>
						<div class="item-form mb15">
							<label>Tỉnh / Thành phố <font color="red">*</font></label>
							<div class="arrow_select relative">
								<?php echo form_dropdown('cityid', $location_dropdown, set_value('cityid', 0), 'class="uk-width-1-1"');?>
							</div>
						</div>
						<div class="item-form mb15">
							<label>Links Facebook của bạn</label>
							<?php echo form_input('facebook', set_value('facebook'), 'placeholder="Links Facebook của bạn" class="uk-width-1-1"');?>
						</div>
					</div>
				</div>
				<div class="line-form bor_bor">
					<div class="content_content">
						<div class="item-form mb15">
							<label>Đăng ký <font color="red">*</font></label>
							<div class="uk-flex uk-flex-middle lib-grid-15">
								<span class="uk-flex uk-flex-middle">
									<input id="for-1" type="radio" name="register" value="Dự thi" checked="">
									<label for="for-1">Dự thi</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-2" type="radio" name="register" value="Xét tuyển">
									<label for="for-2">Xét tuyển</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-3" type="radio" name="register" value="Thi thử">
									<label for="for-3">Thi thử</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-4" type="radio" name="register" value="Tư vấn">
									<label for="for-4">Tư vấn</label>
								</span>
							</div>
						</div>
						<div class="item-form mb15">
							<label>Nơi đăng ký dự thi</label>
							<div class="uk-flex uk-flex-middle lib-grid-15">
								<span class="uk-flex uk-flex-middle">
									<input id="for-5" type="radio" name="register-1" value="Hà Nội" checked="">
									<label for="for-5">Hà Nội</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-6" type="radio" name="register-1" value="TP.Hồ Chí Minh">
									<label for="for-6">TP.Hồ Chí Minh</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-7" type="radio" name="register-1" value="Cần Thơ">
									<label for="for-7">Cần Thơ</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-8" type="radio" name="register-1" value="Đà Nẵng">
									<label for="for-8">Đà Nẵng</label>
								</span>
							</div>
						</div>
						<div class="item-form mb15">
							<label>Nơi nhập học  <font color="red">*</font></label>
							<div class="uk-flex uk-flex-middle lib-grid-15">
								<span class="uk-flex uk-flex-middle">
									<input id="for-9" type="radio" name="register-2" value="Hà Nội" checked="">
									<label for="for-9">Hà Nội</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-10" type="radio" name="register-2" value="TP.Hồ Chí Minh">
									<label for="for-10">TP.Hồ Chí Minh</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-11" type="radio" name="register-2" value="Cần Thơ">
									<label for="for-11">Cần Thơ</label>
								</span>
								<span class="uk-flex uk-flex-middle">
									<input id="for-12" type="radio" name="register-2" value="Đà Nẵng">
									<label for="for-12">Đà Nẵng</label>
								</span>
							</div>
						</div>
						<div class="item-form mb15">
							<div class="label-right uk-width-1-1">
								<input type="hidden" value="Đăng ký trực tuyến" name="title">
								<button type="submit" name="create" value="action" class="btn btn-info">Đăng ký ngay</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<section class="comment-page">
	            <div class="fb-comments" data-href="<?php echo base_url('dang-ky-truc-tuyen') ?>" data-numposts="5" data-width="100%"></div>
	        </section>
		</section>
	</div>
</div>