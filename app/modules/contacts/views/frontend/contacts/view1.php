<div id="main" class="main-product">
   <div class="breadcrumb">
      <ul>
         <li><a href="<?php echo base_url(); ?>">Trang chủ></a></li>
         <li class="atino">Liên hệ</li>
      </ul>
   </div>
   <div class="row">
      <?php $this->load->view('homepage/frontend/common/aside') ?>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div class="product-home contact-form">
            <h1 class="title0">THÔNG TIN LIÊN HỆ</h1>
            <h2 class="title2"><?php echo $this->fcSystem['homepage_company'] ?></h2>
            <div class="informatiom-ct">
               <div class="item">
                  <div class="key">
                     Địa chỉ:
                  </div>
                  <div class="space">
                    <?php echo $this->fcSystem['contact_address'] ?>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="item">
                  <div class="key">
                    Điện thoại:
                  </div>
                  <div class="space">
                   <?php echo $this->fcSystem['contact_phone'] ?>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="item">
                  <div class="key">
                    Fax:
                  </div>
                  <div class="space">
                  <?php echo $this->fcSystem['contact_fax'] ?>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="item">
                  <div class="key">
                   Email:
                  </div>
                  <div class="space">
                  <a href=""> <?php echo $this->fcSystem['contact_email'] ?></a>
                
                  </div>
                  <div class="clearfix"></div>
               </div>
                <div class="item">
                  <div class="key">
                   Website:
                  </div>
                  <div class="space">
                <a href=""><?php echo $this->fcSystem['contact_web'] ?></a>
                  </div>
                  <div class="clearfix"></div>
               </div>

            </div>
            <h2 class="title0">THÔNG TIN PHẢN HỒI</h2>
            <p class="desc">Xin vui lòng điền các yêu cầu vào form dưới đây và gửi cho chúng tôi. Chúng tôi sẽ trả lời bạn ngay sau khi nhận được.<br>
              Xin chân thành cảm ơn!</p>
              <?php $error = validation_errors(); echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px;background:rgb(195, 94, 94);color:#fff;margin-bottom:10px;">'.$error.'</div>' : '';?>
              <form action="" method="post">
                 <div class="item">
                    <div class="left">
                       <label for="">Họ tên</label>
                    </div>
                    <div class="right"><input type="text" name="fullname"></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item">
                    <div class="left">
                       <label for="">Địa chỉ</label>
                    </div>
                    <div class="right"><input type="text" name="address"></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item">
                    <div class="left">
                       <label for="">Email</label>
                    </div>
                    <div class="right"><input type="text" name="email"></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item">
                    <div class="left">
                       <label for="">Số điện thoại</label>
                    </div>
                    <div class="right"><input type="text" name="phone"></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item">
                    <div class="left">
                       <label for="">Tiêu đề</label>
                    </div>
                    <div class="right"><input type="text" name="title"></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item">
                    <div class="left">
                       <label for="">Nội dung</label>
                    </div>
                    <div class="right"><textarea name="message" id="" cols="30" rows="10"></textarea></div>
                    <div class="clearfix"></div>
                 </div>
                 <div class="item"><input type="submit" name="create" value="Gửi"></div>
                 
              </form>
              <div class="map">
                 <h3 class="title0">Bản đồ</h3>
                 <?php echo $this->fcSystem['contact_map'] ?>
              </div>
         </div>
      </div>
   </div>
</div>