<div id="infomation-register" class="relative uk-width-large-1-4">
    <header class="panel-head">
        <div class="heading"><span>Yêu cầu cún con</span></div>
    </header>
    <section class="panel-body">
        <form class="uk-form form" action="<?php echo site_url('mailsubricre/frontend/mailsubricre/create') ?>" method="post" id="sform">
            <div class="error uk-alert"></div>
            <div class="uk-grid uk-grid-medium lib-grid-0">
                <div class="uk-width-large-1-1">
                    <div class="form-group mb15">
                        <div class="item_form">
                            <input type="text" name="fullname" value="" class="text uk-width-1-1 fullname" placeholder="Họ và tên *" />
                        </div>
                    </div>
                    <div class="form-group mb15">
                        <div class="item_form">
                            <input type="text" name="address" value="" class="text uk-width-1-1" placeholder="Giống chó" />
                        </div>
                    </div>
                    <div class="form-group mb15">
                        <div class="item_form">
                            <input type="text" name="phone" value="" class="text uk-width-1-1 phone" placeholder="Số điện thoại *" />
                        </div>
                    </div>
                    <div class="form-group mb15">
                        <div class="item_form">
                           <input type="text" name="email" value="" class="text uk-width-1-1" placeholder="Địa chỉ Email" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="item_form uk-text-center">
                    <input  name="title" value="Yêu cầu cún con" type="hidden">
                    <button type="submit" name="" class="style-form-submit search-form-submit">
                        <?php echo $this->lang->line('register') ?>
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#sform .error').hide();
        var uri = $('#sform').attr('action');
        $('#sform').on('submit',function(){
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, fullname: $('#sform .fullname').val(), phone: $('#sform .phone').val()},
            function(data){
                var json = JSON.parse(data);
                $('#sform .error').show();
                if(json .error.length){
                    $('#sform .error').removeClass('uk-alert-success').addClass('uk-alert-danger');
                    $('#sform .error').html('').html(json.error);
                }else{
                    $('#sform .error').removeClass('uk-alert-danger').addClass('uk-alert-success');
                    $('#sform .error').html('').html('Gửi yêu cầu tư vấn online thành công!.');
                    $('#sform').trigger("reset");
                    setTimeout(function(){ location.reload(); }, 5000);
                }
            });
            return false;
        });
    });
</script>
<p><?php echo $this->lang->line('social-company-des') ?></p>
<ul class="uk-list uk-list-social uk-clearfix mb15">
    <li>
        <a href="<?php echo $this->fcSystem['social_facebook'] ?>" class="fb"></a>
    </li>
    <li>
        <a href="<?php echo $this->fcSystem['social_twitter'] ?>" class="tw"></a>
    </li>
    <li>
        <a href="<?php echo $this->fcSystem['social_google'] ?>" class="gg"></a>
    </li>
    <li>
        <a href="<?php echo $this->fcSystem['social_rss'] ?>"  class="ins"></a>
    </li>
    <li>
        <a href="<?php echo $this->fcSystem['social_youtube'] ?>" class="you"></a>
    </li>
</ul>
<p><?php echo $this->lang->line('register-course-infomation') ?></p>
<form class="uk-form form" action="<?php echo site_url('contacts/ajax/contacts/create') ?>" method="post" id="sform2">
    <div class="error uk-alert"></div>
    <div class="form-group mb15">
        <div class="item_form relative">
            <input type="text" name="email" value="" class="text uk-width-1-1 email" placeholder="<?php echo $this->lang->line('address_customers') ?> Email" />
            <input  name="title" value="Đăng ký nhận bản tin" type="hidden">
            <button type="submit" name="" class="submit-btn"> </button>
        </div>
    </div>
</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#sform2 .error').hide();
        var uri = $('#sform2').attr('action');
        $('#sform2').on('submit',function(){
            var postData = $(this).serializeArray();
            $.post(uri, {post: postData, email: $('#sform2 .email').val()},
            function(data){
                var json = JSON.parse(data);
                $('#sform2 .error').show();
                if(json .error.length){
                    $('#sform2 .error').removeClass('uk-alert-success').addClass('uk-alert-danger');
                    $('#sform2 .error').html('').html(json.error);
                }else{
                    $('#sform2 .error').removeClass('uk-alert-danger').addClass('uk-alert-success');
                    $('#sform2 .error').html('').html('<?php echo $this->lang->line('message_success_subricre') ?>!.');
                    $('#sform2').trigger("reset");
                    setTimeout(function(){ location.reload(); }, 5000);
                }
            });
            return false;
        });
    });
</script>