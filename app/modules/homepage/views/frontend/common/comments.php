<style>
.top-box-comments h6 {
    font-size: 1.25em;
    font-weight: 500;
}
.form-comment {
    overflow: hidden;
    margin-top: 10px;
}
.input-account-form {
    margin-bottom: 15px;
}
.required {
    border: solid 1px #f00 !important;
    border-radius: 3px !important;
}
.comment-1 .info-form-comment, .comment-1 .input-comment {
    width: 100%;
    height: 160px;
    border: 1px solid #ddd;
    border-radius: 3px;
    text-indent: 5px;
    padding: 10px;
}
.form-item-title {
    width: 100%;
    font-weight: 600;
    line-height: 28px;
    display: block;
    font-size: 13px;
    font-family: Open Sans;
}
.prod-rate {
    position: relative;
    overflow: hidden;
    float: left;
}
.rating {
    border: none;
    margin: 0;
    padding: 0;
}
input[type="radio"], input[type="checkbox"] {
    display: none !important;
}
.rating > label {
    color: #ddd;
    float: right;
}
.rating > label::before {
    padding: 0 5px 0 0;
    font-size: 1.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
}
.rating > input:checked ~ label, .rating:not(:checked) > label:hover, .rating:not(:checked) > label:hover ~ label {
    color: #ffb909;
}
.rating > input:checked + label:hover, .rating > input:checked ~ label:hover, .rating > label:hover ~ input:checked ~ label, .rating > input:checked ~ label:hover ~ label {
    color: #ff8d00;
}
.form-comment .button-comment {
    width: 140px;
    height: 30px;
    line-height: 28px;
    border: 1px solid #0092db;
    background-color: #0092db;
    border-radius: 3px;
    color: #fff;
    cursor: pointer;
    margin: 0 auto;
    text-align: center;
}
.top-box-comments h3, .title-new-comment h3 {
    font-size: 15px;
    font-weight: 500;
}

#review-info .social-info {
    border-left: 1px solid #f0f0f0;
}
#review-info .input-form {
    width: 300px !important;
}
.input-form {
    border: 1px solid #ddd;
    background-color: #fdfdfd;
    height: 28px;
    color: #666;
    outline: none;
    text-indent: 5px;
    border-radius: 2px;
}
.login-socials .signin-openID.facebook {
    background: #546ea6 url('/templates/frontend/resources/img/Facebook.png') no-repeat 0 center;
}
.login-socials .signin-openID.google {
    background: #df5656 url('/templates/frontend/resources/img/GooglePlus.png') no-repeat 0 center;
}
.login-socials .signin-openID:first-child {
    margin-right: 14px;
}
.login-socials .signin-openID {
    padding-right: 10px;
    text-indent: 30px;
    line-height: 24px;
    border-radius: 12px;
    color: #fff;
    display: inline-block;
    min-width: 100px;
}
.fll{float: left;}
.flr{float: right;}
.total-cmt.uk-clearfix {
    padding: 10px 0;
    font-size: 13px;
	color: #666;
}
.total-cmt .fll {
    font-size: 15px;
    font-weight: 500;
    display: block; color: #333;
}
.avatar.ec-cover span {
    line-height: 20px;
    text-align: center;
    border-radius: 3px;
    font-weight: 500;
    box-shadow: 0 0 3px rgba(0,0,0,.5);
    text-shadow: 1px 1px 0 #fff;
    display: block;
    width: 20px;
    text-transform: uppercase;
}
.author .meta .user {
    font-size: 14px;
    line-height: 20px;
    margin-right: 10px;
    color: #68b205;
    font-family: 'Open Sans', sans-serif;
}
.item-comments .content {
    font-size: 14px;font-family: 'Open Sans', sans-serif;line-height: 24px;
}
.item-comments:nth-child(2n) {
    background: #f7f7f7;
    padding: 10px;
}
.item-comments{
    padding: 10px;
}

.amenu i{font-size: 11px;}
.item-reply{color: #0092db;cursor: pointer;}
.item-reply i {
    color: #0092db;
}
.fright i{
    color: #ff0000;
}
.reply-comment, .item-comments-sub {
    padding-left: 15px;margin-top: 10px;
}
.rep-box-comment {
    background: #f5f5f5;
    padding: 10px;
    position: relative;
    border: 1px solid #e9e9e9;
}
.rep-box-comment:after, .rep-box-comment:before{
	content: '';
	width:0px;
	height:0px;
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	position: absolute;
}
.rep-box-comment:after{
	left: 5px; top: -10px; border-bottom: 10px solid #f5f5f5;
}
.rep-box-comment:before{
	left: 5px; top: -11px; border-bottom:10px solid #e9e9e9;
}
.rep-box-comment .txt-reply-comm {
    width: 100%;
    border: 1px solid #eee;
    background: #fff;
    height: 100px;
    padding: 10px;
    font-family: Open Sans;
    font-size: 14px;
}
.rep-box-comment .info-contact-comm {
    line-height: 26px;
    border: 1px solid #eee;
    min-width: 250px;
    text-indent: 8px;
    outline: none;
    font-family: Open Sans;
    font-size: 14px;
    border-right: 0;
}
.send-comment.btn-send {
    display: inline-block;
    margin-left: -4px;
    border-radius: 0;
    line-height: 26px;
    width: 120px;
    border: 1px solid #19abe0;
    background: #19abe0;
    color: #fff;text-align: center;
}
.item-comments-sub .item-comments {
    padding: 5px;
    background: #f0f0f0;
    border: 1px solid #e9e9e9;
    margin-bottom: 20px;
}
.uk-active-mod .user.uk-text-bold {
    color: #ff0000;
}
.uk-active-mod.item-comments .content, .uk-active-mod.item-comments .amenu,.comment-list{padding-left: 0 !important;}
.item-comments .info .avatar {
    width: 60px;
    height: 60px;
}
.item-comments .info .author {
    width: -webkit-calc(100% - 60px);
    width: -moz-calc(100% - 60px);
    width: -ms-calc(100% - 60px);
    width: -o-calc(100% - 60px);
    width: calc(100% - 60px);
    padding-left: 10px;
}
</style>

 <div class="form-cmt form-group">
    
    <h2 class="h2-title">Bình luận</h2>
    <form id="rateform" action="<?php echo site_url('comments/ajax/comments/addcomment'); ?>" method="post">
        <div class="error uk-alert"></div>
        <div class="form-group row">
            <div class="col-md-6 col-sm-6 col-xs-12 wp-input-form">
                <input type="text" name="fullname" id="rate-name" class="form-control" placeholder="Họ và tên">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 wp-input-form">
                <input type="text" name="email" id="rate-email" class="form-control" placeholder="Email">
            </div>
        </div>
        <textarea name="message" id="rate-content" rows="4" class="form-control form-group" placeholder="Bình luận"></textarea>
        <button class="btn btn-info">Bình luận</button>
    </form>
    <br>
    <div class="wp-cmt-kh form-group comment-list" data-page="1"></div>
</div>
<!-- <div class="wp-cmt-kh form-group">
    <h2 class="h2-title">BÌNH LUẬN CỦA KHÁCH HÀNG &nbsp;<span><i>(22 bình luận)</i></span></h2>
    <div class="wp-item-cmt padding-15 border1 po-re">
        <div class="hoi">
            <div class="top-cmt">
                <div class="text-cmt-top">
                    <p class="p1"><b>e ten quyet ah</b> đã bình luận:</p>
                    <p class="p2"><b>Tháng Mười Một 1, 2017 at 6:02 sáng</b></p>
                </div>
                <div class="img-avt">
                    <img src="templates/frontend/resources/custom/images/avt.jpg" alt="">
                </div>
            </div>
            <div class="post-cmt">
                <p>Chào bác sỹ! <br>
                Khoảng 2-3 năm nay em bị đi ngoài 1 lần trong ngày nhưng phân lỏng, có lẫn chất nhầy, không có máu, bụng thì đau lâm râm 2 bên sườn, nhưng đi ngoài xong là đau bụng giảm. Nhưng nếu em lo lắng, căng thảng là triệu chứng lại tái phát. Không biết em bị làm sao nữa?</p>
            </div>
        </div>
        <div class="rep padding-15 border1 po-re">
            <div class="top-cmt">
                <div class="text-cmt-top">
                    <p class="p1"><b>Chuyên gia tư vấn</b> đã trả lời:</p>
                    <p class="p2"><b>Tháng Mười Một 1, 2017 at 6:02 sáng</b></p>
                </div>
                <div class="img-avt">
                    <img src="templates/frontend/resources/custom/images/avt.jpg" alt="">
                </div>
            </div>
            <div class="post-cmt">
                <p>Chào bác sỹ! <br>
                Khoảng 2-3 năm nay em bị đi ngoài 1 lần trong ngày nhưng phân lỏng, có lẫn chất nhầy, không có máu, bụng thì đau lâm râm 2 bên sườn, nhưng đi ngoài xong là đau bụng giảm. Nhưng nếu em lo lắng, căng thảng là triệu chứng lại tái phát. Không biết em bị làm sao nữa?</p>
            </div>
        </div>
    </div>
</div> -->
<!-- <section class="comment-1 mb30 mt20">
	<div class="top-box-comments" id="rate-box">
        <h6>Bình luận của bạn</h6>
        <div class="error uk-alert"></div>
        <div class="form-comment">
            <form id="rateform" action="<?php echo site_url('comments/ajax/comments/addcomment'); ?>" method="post" class="uk-form form">
                <div id="review-info">
                    <div class="form-item mb10">
                        <span class="form-item-title">Họ và tên:</span>
                        <input name="fullname" class="input-form" id="rate-name" placeholder="Nhập tên của bạn" value="" type="text">
                    </div>
                    <div class="form-item mb10">
                        <span class="form-item-title">Email:</span>
                        <input title="Nhập địa chỉ Email" name="email" id="rate-email" class="input-form" placeholder="Địa chỉ email" value="" type="text">
                    </div>
                </div>
                <div class="row input-account-form">
                    <span class="form-item-title">Bình luận</span>
                    <textarea title="Nhập nội dung bình luận / nhận xét" name="message" id="rate-content" placeholder="Nhập nội dung bình luận / nhận xét..." class="info-form-comment uk-width-1-1" aria-required="true"></textarea>
                </div>
                <div id="review-info-pad">
                    <div class="rate-stars-row">
                        <div class="form-item uk-flex uk-flex-middle lib-grid-20">
                            <div>
                            	<input type="submit" name="" class="button button-comment" id="btn-review-send" value="Gửi bình luận" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
	<ul class="uk-list uk-clearfix comment-list" data-page="1"></ul>
</section> --><!-- .comment-1 -->
<script type="text/javascript">
	$(function(){
		$('.error').hide();
		var module = '<?php echo $module ?>';
		var moduleid = '<?php echo $moduleid ?>';
		listComment(module, moduleid, $('.comment-list').attr('data-page'));

		var uri = $('#rateform').attr('action');
		$('#rateform').on('submit',function(){
			var postData = $(this).serializeArray();
			var fullname = $('#rate-name').val();
            var email = $('#rate-email').val();
			var contents = $('#rate-content').val();
			$.post(uri, {
				post: postData, module: module, moduleid: moduleid,fullname: fullname, email: email, contents: contents, parentid : 0},
				function(data){
					var json = JSON.parse(data);
					$('.error').show();
					if (fullname == '') {
						$('#rate-name').addClass('required');
					}
                    if (email == '') {
                        $('#rate-email').addClass('required');
                    }
					if (contents == '') {
						$('#rate-content').addClass('required');
					}
					if(json.error.length){
						$('.error').removeClass('alert alert-success').addClass('alert alert-danger');
						$('.error').html('').html(json.error);
					}else{
						$('.error').removeClass('alert alert-danger').addClass('alert alert-success');
						$('.error').html('').html('Gửi bình luân thành công!.');
						$('#rateform').trigger("reset");
						setTimeout(function(){ window.location.href='<?php echo $canonical ?>'; }, 3000);
					}
				});
			return false;
		});
		$(document).on('click','.ajax-pagination .uk-pagination li a',function(){
			var page = $(this).attr('data-ci-pagination-page');
			listComment(module, moduleid, page);
			return false;
		});
	});
	function listComment(module, moduleid, page){
		var uri = '<?php echo site_url('comments/ajax/comments/listComment'); ?>';
		$.post(uri, {
			module: module, moduleid: moduleid, page:page},
		function(data){
			var json = JSON.parse(data);
			$('.comment-list').html(json.html);
		});
	}
	$(document).on('click','.item-reply',function(){
		$('.reply-comment').html('');
		var id = $(this).attr('data-id');
		var item = '<div class="rep-box-comment mb20">' + 
			'<div class="error_comm uk-alert"></div>'+
			'<textarea id="content_comm" class="txt-reply-comm" placeholder="Nội dung trả lời"></textarea>'+
			'<input name="parentid" id="parentid" value="'+id+'" type="hidden">'+
            '<input class="info-contact-comm" id="email_comm" placeholder="Email" type="text">'+
			'<input class="info-contact-comm" id="name_comm" placeholder="Họ và tên bạn" type="text">'+
			'<a class="send-comment btn-send" title="Bấm vào đây để gửi bình luận">Gửi yêu cầu</a>'+
		'</div>';
		$(this).parent().next().append(item);
		$('.error_comm').hide();
		return false;
	});
	$(document).on('click','.send-comment',function(){
		var module = '<?php echo $module ?>';
		var moduleid = '<?php echo $moduleid ?>';
		var parentid = $('#parentid').val();
		var contents = $('#content_comm').val();
        var email = $('#email_comm').val();
		var fullname = $('#name_comm').val();
		var uri = '<?php echo site_url('comments/ajax/comments/addcomment'); ?>';
		$(this).html('Đang xử lý');
		$.post(uri, {
			module: module, moduleid: moduleid, fullname: fullname, email: email, contents: contents, parentid : parentid},
		function(data){
			var json = JSON.parse(data);
			$('.error_comm').show();
			if (fullname == '') {
				$('#review-info').show();
				$('#name_comm').addClass('required');
			}
            if (email == '') {
                $('#review-info').show();
                $('#email_comm').addClass('required');
            }
			if (contents == '') {
				$('#content_comm').addClass('required');
			}
			if(json.error.length){
				$('.error_comm').removeClass('alert alert-success').addClass('alert alert-danger');
				$('.error_comm').html('').html(json.error);
			}else{
				$('.error_comm').removeClass('alert alert-danger').addClass('alert alert-success');
				$('.error_comm').html('').html('Gửi bình luân thành công!.');
				setTimeout(function(){ window.location.href='<?php echo $canonical ?>'; }, 3000);
			}
		});
		return false;
	});
</script>
