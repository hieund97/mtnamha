<section class="index-navigation margin-bottom-25px recovery-user-box">
	<div class="uk-container uk-container-center container pd-10">
		<div class="uk-grid">
			<div class="uk-width-2-6"></div>
			<div class="uk-width-2-6 row">
				<div class="uk-panel log-panel margin-bottom-25px col-lg-4 col-lg-push-4">
					<div class="fc-panel-body uk-panel-box">
<!--						<div class="button-social button-facebook" onclick="javascript: goSocial('facebook')">-->
<!--				            <span class="icon-facebook fa fa-facebook"></span>-->
<!--				            Đăng nhập bằng Facebook-->
<!--				        </div>-->
<!---->
<!--				        <div class="button-social button-google" onclick="javascript:goSocial('google')">-->
<!--				            <span class="icon-google-plus fa fa-google"></span>-->
<!--				            Đăng nhập bằng Google-->
<!--				        </div>-->
						
<!--						<div class="divider">-->
<!--				            <span> Hoặc đăng nhập bằng Email </span>-->
<!--				        </div>-->
						<?php $error = validation_errors(); echo !empty($error)?'<div class="callout callout-danger">'.$error.'</div>':'';?>
						<p class="login-box-msg">Nhập vào Email của bạn để hệ thống xác nhận</p>
						<form class="uk-form uk-form-horizontal" method="post" action="">
							<div class="uk-grid uk-grid-collapse uk-grid-width-1-1 uk-position-relative">
								<div class="log login">
									<div class="body">
										<div class="uk-form-row">
											<?php echo form_input('email', set_value('email'), 'placeholder="Email" required class="form-control"');?>
										</div>
										<div class="uk-form-row uk-text-center button-box-recovery">
											<button type="submit" name="recovery" value="recovery" class="uk-button login_button">Xác nhận</button>
											<a title="Đăng nhập" href="login.html" class="uk-button register_button">Đăng nhập</a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>