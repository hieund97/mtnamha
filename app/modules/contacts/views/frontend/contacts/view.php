<div id="main" class="wrapper main-product">
    <div class="bres">
       <div class="container pd-10">
          <ul>
             <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>
             <li>Liên hệ</li>
          </ul>
       </div>
    </div>
    <section class="main-content">
        <div id="main-contact" class="main">
            <div class="container pd-10">
                <div class="row">
                    <div class="col-md-9 col-sm-9 col-xs-12 rounded animation-element fade-left animated fadeInLeft">
                        <div class="content-contact">
                            <?php echo $this->fcSystem['contact_contact'] ?>
                        </div>
                        <div class="map-contact">
                           <?php echo $this->fcSystem['contact_map'] ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 rounded  animation-element fade-right animated fadeInRight">
                        <div class="form-contat">
                            <p class="desc">Liên hệ với chúng tôi bằng cách <strong>điền thông tin vào form sau
                            </p>
                            <form action="lien-he.html" method="post">
                                <?php $error = validation_errors(); echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px;background:rgb(195, 94, 94);color:#fff;margin-bottom:10px;">'.$error.'</div>' : '';?>
                                <input type="text" name="fullname" placeholder="Họ và tên *">
                                <input type="text" name="email" placeholder="Email *">
                                <input type="text" name="phone" placeholder="Số điện thoại">
                                <input type="text" name="title" placeholder="Tiêu đề *">
                                <textarea name="message" cols="40" rows="10" placeholder="Nội dung *"></textarea>
                                <div class="send-contact">
                                    <div class="item">
                                        <input type="submit" name="create" value="Gửi">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>