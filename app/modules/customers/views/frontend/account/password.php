<style>
    body{background: #fff}
</style>
<div id="body" class="body-container">
    <div class="bres">
        <div class="container pd-10">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>
                <li>Đổi mật khẩu </li>
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
	<div class="uk-container uk-container-center container pd-10">
<!--		--><?php //$error = validation_errors(); echo !empty($error)?'<div class="uk-alert uk-alert-danger" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a> <p>'.$error.'</p></div>' : ''; ?>
		<div class="uk-grid uk-grid-medium mb20 page-change-password row">
			<div class="uk-width-large-2-3 col-lg-4 col-lg-push-4 pd-mb-0">
				<section class="profile_box">
<!--					<header class="panel-head">-->
<!--						<div class="heading-2"><span>Thông tin thành viên</span></div>-->
<!--					</header>-->
					<section class="panel-body height100 pd-l-r-0">
						<div class="uk-panel-body profile project-create">
							<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger alert alert-danger">'.$error.'</div>':'';?>
							<form  method="post" action="">
								<div class="line-form mb20 bor_bor">
									<div class="box_title_2">
										<span>Đổi mật khẩu</span>
									</div>
									<div class="content_content">
										<div class="uk-grid uk-flex-middle lib-grid-0">
											<div class="uk-width-1-2">
												<div class="uk-flex item-form uk-flex-middle">
													<div class="label-left bg_bg">
														<label class="label-label">Mật khẩu mới</label>
													</div>
													<div class="label-right uk-width-1-1 bdl0">
														<label class="label-label">
															<input type="password" class="uk-width-1-1" name="newpassword">
														</label>
													</div>
												</div>
											</div>
											<div class="uk-width-1-2">
												<div class="uk-flex item-form uk-flex-middle">
													<div class="label-left bg_bg">
														<label class="label-label">Nhập lại</label>
													</div>
													<div class="label-right uk-width-1-1 bdl0">
														<label class="label-label">
															<input type="password" class="uk-width-1-1" name="renewpassword">
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="uk-form-row-center uk-text-center">
									<input class="uk-button login_button" type="submit" name="update" value="Cập nhật" />
								</div>
							</form>
						</div>
					</section>
				</section>
			</div>
			<div class="uk-width-large-1-3">
				<?php //$this->load->view('homepage/frontend/common/customers_aside'); ?>
			</div>
		</div><!-- .uk-grid  -->
	</div>
</div>
