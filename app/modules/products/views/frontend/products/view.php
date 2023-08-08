<link href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css" rel="stylesheet" />


<!-- <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700&display=swap&subset=vietnamese" rel="stylesheet"> -->
<!-- <link rel="stylesheet" type="text/css" href="templates/frontend/resources/css/zoom.css"> -->
<style type="text/css" media="screen">
    .product-tabs table{
        width: auto!important;
    }
    .product-tabs img{
        /*width: 100%!important;*/
        height: auto!important;
    }
    @media (max-width: 767px){
        .product-tabs img{
            max-width: 100%;
            height: auto;
        }
    }
    .product-tabs .other-product .thubmail-img img{
       width: 100% !important;
height: 179px !important;
object-fit: contain;
text-align: center;
    }
    .product-tabs .nav-pills {
        border-bottom: 2px solid #e0cb73;
    }
    .product-image > .product-full img{
        height: 420px;
        object-fit: scale-down;
        /* background-color: rgba(0,0,0,.1); */
        width: 100%;
    }
    .product-image > .product-full{
        margin-bottom: 10px;
    }
    #gallery_01 {
      position: relative;
      margin-top: 10px;
    }
    #gallery_01 img {
      border: 2px solid white;
      width: 96px;
    }

    #gallery_01 .active img {
      border: 2px solid #333;
    }
    /*.zoomContainer{*/
    /*    height: 400px!important;*/
    /*    width: 400px!important;*/
    /*}*/
    .zoomLens{
        width: 200px!important;
        height: 200px!important;
    }
    .zoomWindowContainer > div{
        left: 400px!important;
    }
    /*#zoom{*/
    /*    width: 400px!important;*/
    /*    height: 400px!important;*/
    /*}*/
    /*ul.menu-main-sub {*/
    /*    display: none;*/
    /*}*/
</style>
<div id="main" class="wrapper main-product main-product-detail">

    <?php //$this->load->view('homepage/frontend/common/menu') ?>
    <div class="bres">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-edit-4 pd-pc-15">
                    <ul>
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>
                        <?php if(isset($Breadcrumb) && is_array($Breadcrumb) && count($Breadcrumb)){
                            foreach ($Breadcrumb as $key => $val) {
                                $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues') ?>
                                <li ><?php echo $val['title'] ?> </li>
                            <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="main-content">
        <div class="container">
            <div class="inner-page-detail">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="nav-main-content">
                            <div class="content-product">
                                <div class="content-detail-product">
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                            <div class="title-page-detail">
                                                <h1 class="name-product"><?php echo $DetailProducts['title'] ?></h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                            <div class="product-image">
                                                <img id="zoom" src="<?php echo $DetailProducts['images'] ?>" data-zoom-image="<?php echo $DetailProducts['images'] ?>" width="411">

                                                <div id="gallery_01">
                                                    <a href="#" class="elevatezoom-gallery active" data-image="<?php echo $DetailProducts['images'] ?>" data-zoom-image="<?php echo $DetailProducts['images'] ?>">
                                                        <img src="<?php echo $DetailProducts['images'] ?>" width="100">
                                                    </a>

                                                    <?php $listItem = json_decode($DetailProducts['albums'], TRUE); ?>
                                                    <?php if (isset($listItem) && is_array($listItem) && count($listItem)) { ?>
                                                        <?php foreach ($listItem as $key => $val) { ?>
                                                            <a href="#" class="elevatezoom-gallery active" data-image="<?php echo $val['images'] ?>" data-zoom-image="<?php echo $val['images'] ?>">
                                                                <img src="<?php echo $val['images'] ?>" width="100">
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                            <div class="nav-img-detail">
                                                <!-- <div class="pro-brand">
                                                    <span class="title">Thương hiệu: <a href="#">Khác</a></span>
                                                </div>
                                                <div class="pro-type">
                                                    <span class="title">Loại: <a href="#">Khác</a></span>
                                                </div>
                                                <span class="product-sku">
                                                    Mã sản phẩm: <span id="ProductSku" class="ProductSku">HHDHGHD543</span>
                                                </span> -->
                                                <?php if($DetailProducts['saleoff'] > 0){ ?><p class="old-price">Giá bán: <span><?php echo number_format($DetailProducts['price']).' đ' ?></span></p><?php } ?>
                                                <form action="#" method="post">
                                                    <div class="price-container">
                                                        Giá khuyến mại:
                                                        <span id="ProductPrice" class="h2 ProductPrice" itemprop="price" content="5000000">
                                                        <?php if($DetailProducts['saleoff'] > 0){ echo number_format($DetailProducts['saleoff']);}
                                                        elseif ($DetailProducts['saleoff'] == 0 && $DetailProducts['price'] > 0) {
                                                            echo number_format($DetailProducts['price']);
                                                        }elseif ($DetailProducts['saleoff'] == 0 && $DetailProducts['price'] == 0) {
                                                            echo 'Liên hệ';
                                                        } ?>

                                                    </span>
                                                        <!-- <s id="ComparePrice" class="ComparePrice">6,000,000₫</s> -->
                                                        <span class="about-detail-pr">
                                                            <span class="bd-r" style="margin-left: 20px;">Tình trạng: <b style="color: red;"><?php if($DetailProducts['isfooter'] == 0){ echo 'Còn hàng';}else if($DetailProducts['isfooter'] == 1){ echo 'Hết hàng';}else{echo 'Liên hệ';} ?></b></span>
                                                            <span style="margin-left: 10px;">Lượt xem: <b style="color: #333;"><?php echo $DetailProducts['viewed'] ?></b></span>
                                                        </span>
                                                    </div>
                                                    <div class="p-short-description">
                                                        <?php echo $DetailProducts['description'] ?>
                                                        <!-- <ul>
                                                            <li><strong><span>Model: SKI70IQ</span></strong>
                                                            </li>
                                                            <li><span>Số cấp&nbsp;lọc: 07 cấp lọc</span>
                                                            </li>
                                                            <li><span>Công suất lọc nước: &nbsp;10 lít/giờ</span>
                                                            </li>
                                                            <li><span>Công suất tiêu thụ điện: 24W (3kw/tháng)</span>
                                                            </li>
                                                            <li><span>Điện áp vào: 220v/ 50Hz &nbsp;- Hạ áp bởi Adapter còn 24VDC</span>
                                                            </li>
                                                            <li><span>Dung tích bình chứa nước: 10 lít</span>
                                                            </li>
                                                            <li><span>Kích thước máy có tủ : Rộng x Cao x Sâu =43 x 90 x 33 (cm)</span>
                                                            </li>
                                                            <li><span>Trọng lượng: 21Kg</span>
                                                            </li>
                                                            <li><span>Xuất xứ: Karofi</span>
                                                            </li>
                                                            <li><span>Bảo hành: 24 tháng.</span><span></span>
                                                            </li>
                                                        </ul> -->
                                                    </div>
                                                    <br>
                                                    <div style="clear: both;"></div>
                                                    <!-- <label for="Quantity" class="quantity-selector">Số lượng</label>
                                                    <div class="js-qty">
                                                        <input type="number" value="1" min="1">
                                                    </div> -->
                                                    <div class="mua-hang">
                                                        <a href="" class="muahang ajax-addtocart" data-quantity="1" data-id="<?php echo $DetailProducts['id'] ?>" data-price="<?php echo $DetailProducts['saleoff'] ?>" data-redirect="redirect"><span>ĐẶT MUA NGAY</span><br> (Nhanh chóng, thuận tiện)</a>
                                                        <a href="<?php echo (!empty($this->fcSystem['homepage_link_page'])) ? $this->fcSystem['homepage_link_page'] : '' ?>" class="add-cart-detaol" data-quantity="1" data-id="<?php echo $DetailProducts['id'] ?>" data-price="<?php echo $DetailProducts['saleoff'] ?>"><span>Mua hàng trả góp</span><br> (Thủ tục đơn giản)</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-tabs">
                                        <div id="sticky-wrapper" class="sticky-wrapper">
                                            <div class="main-menu-bar sticky-header-enable">
                                                <ul class="nav nav-pills">
                                                    <li>
                                                        <a href="#1a">Thông tin sản phẩm</a>
                                                    </li>
                                                    <li>
                                                        <a href="#2a">Đặc điểm nổi bật</a>
                                                    </li>
<!--                                                    <li>-->
<!--                                                        <a href="#4a">Video so sánh</a>-->
<!--                                                    </li>-->
                                                    <li><a href="#5a">Bình luận</a>
                                                    </li>
                                                    <li>
                                                        <a href="#3a">Sản phẩm tương đương</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content clearfix">
                                            <div class="" id="1a">
                                                <h3>Thông tin sản phẩm</h3>
                                                <?php echo $DetailProducts['content'] ?>
                                            </div>
                                            <div class="" id="2a">
                                                <h3>Đặc điểm nổi bật</h3>
                                                <?php echo $DetailProducts['content2'] ?>
                                            </div>
<!--                                            <div class="" id="4a">-->
<!--                                                <h3>Video so sánh</h3>-->
<!---->
<!--                                                --><?php //if($DetailProducts['video'] != ""){ ?>
<!---->
<!--                                                    <div class="fc-video-player">-->
<!--                                                        <video width="100%" height="400" controls>-->
<!--                                                            <source src="--><?php //echo base_url().$DetailProducts['video']; ?><!--" type="video/mp4">-->
<!--                                                            Your browser does not support HTML5 video.-->
<!--                                                        </video>-->
<!--                                                    </div>-->
<!---->
<!--                                                --><?php //} ?>
<!---->
<!---->
<!--                                            </div>-->
                                            <div class="" id="5a">
                                                <h3>Bình luận</h3>
                                                <div class="fb-comments" data-href="<?php echo $urlbl ?>" width="100%" data-numposts="5"></div>
                                            </div>

                                            <div class="" id="3a">
                                                <h3>Sản phẩm tương đương</h3>
                                                <?php if(isset($products_same) && is_array($products_same) && count($products_same)){ ?>
                                                    <section class="other-product">
                                                        <div class="container-orther-box">

                                                            <div class="nav-product row">
                                                                <?php foreach ($products_same as $key => $val) {
                                                                    $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products') ?>
                                                                    <div class="col-lg-3 col-md-4 col-6 col-xs-6 item-other wow fadeInUp ">
<!--                                                                        <div class="item-product">-->
<!--                                                                            <div class="image">-->
<!--                                                                                <a href="--><?php //echo $href ?><!--" class="thubmail-img"><img src="--><?php //echo $val['images'] ?><!--" alt="--><?php //echo $val['title'] ?><!--">-->
<!--                                                                                </a>-->
<!--                                                                                <div class="new-pr"><img src="templates/frontend/resources/images/new.png" alt="">-->
<!--                                                                                </div>-->
<!--                                                                                <div class="sale-pr"><img src="templates/frontend/resources/images/sale.png" alt="">-->
<!--                                                                                </div>-->
<!--                                                                            </div>-->
<!--                                                                            <div class="price-c">-->
<!--                                                                                <p class="price"><span class="gia-cu">--><?php //if($val['price'] > 0){echo number_format($val['price']).' đ';}else{ echo '.-';} ?><!--</span>-->
<!--                                                                                    <br><span class="gia-moi">--><?php //if($val['saleoff'] > 0){echo number_format($val['saleoff']).'<span class="css-size-d"> đ</span>';}else{ echo 'Liên hệ';} ?><!--</span> </p>-->
<!--                                                                                --><?php //if($val['price'] > $val['saleoff']){ ?>
<!--                                                                                    <div class="sale-off-show">---><?php //echo round((($val['price']-$val['saleoff'])*100)/$val['price']); ?><!--%</div>-->
<!--                                                                                --><?php //} ?>
<!--                                                                            </div>-->
<!--                                                                            <h3 class="title"><a href="--><?php //echo $href ?><!--">--><?php //echo $val['title'] ?><!-- </a></h3>-->
<!--                                                                            <div class="add-cart">-->
<!--                                                                                <a href="" class="ajax-addtocart" data-quantity="1" data-id="--><?php //echo $val['id'] ?><!--" data-price="--><?php //echo $val['saleoff'] ?><!--">Cho vào giỏ</a>-->
<!--                                                                                <a href="" class="mh ajax-addtocart" data-redirect="redirect" data-quantity="1" data-id="--><?php //echo $val['id'] ?><!--" data-price="--><?php //echo $val['saleoff'] ?><!--">Mua hàng</a>-->
<!--                                                                            </div>-->
<!--                                                                        </div>-->
                                                                        <?php echo htmlItem($val, true) ?>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <?php $this->load->view('homepage/frontend/common/aside') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<style type="text/css">
    .product-image #gallery_01 img {
        height: 60px;
        object-fit: contain;
        border: 1px solid #ddd;
        margin-bottom: 5px;
    }
	.product-tabs h3{
		border-bottom: solid 2px #111;
	    /*padding: 10px;*/
	    font-size: 20px;
	    font-weight: bold;
	}
	.sticky-wrapper.header-sticky {
    top: 0;
    position: fixed;
    width: 100%;
    z-index: 999999;
    transition: 1.0s ease;
    background:#fff;
    padding:10px 0;
    border-bottom: 1px solid rgba(173, 171, 171, 0.35);
        display: none;
}
</style>
<script type="text/javascript">
	 $(function() {
	        $('a[href*=#]:not([href=#])').click(function() {
	            var target = $(this.hash);
	            target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
	            if (target.length) {
	                $('html,body').animate({
	                  scrollTop: target.offset().top - 100
	                }, 1500);
	                return false;
	            }
	        });
	    });
 </script>
  <script type="text/javascript">
            $(document).ready(function(){
    var stickyTop = $("#sticky-wrapper").offset().top;
      jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() > stickyTop)
        {
          jQuery('.sticky-wrapper').addClass('header-sticky');
        }
        else
        {
          jQuery('.sticky-wrapper').removeClass('header-sticky');
        }
      });



    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
<!-- <script type="text/javascript" src="templates/frontend/resources/js/zoom-image.js"></script> -->
<script type="text/javascript">
    jQuery(function($) {

  // define the gallery object
  var $gallery = $('#gallery_01');

  // Build array of objects to open in Fancybox.
  var $imgs = [];
  $('a', $gallery).each(function() {
    $imgs.push({'src': $(this).data('zoom-image')});
  });

  // Initiate ElevateZoom
  $("#zoom").elevateZoom({
    gallery: $gallery.attr('id'),
    cursor: 'pointer',
    galleryActiveClass: 'active',
    imageCrossfade: true,
    loadingIcon: '//www.elevateweb.co.uk/spinner.gif'
  });

  // Bind Fancybox to clicking the zoom image.
  // Open it to the currently active index.
  $("#zoom").on("click", function(e) {
    e.preventDefault();
    var active_index = $('a.active', $gallery).index();
    $.fancybox.open($imgs, false, active_index);
  });

});
    // $('.show').zoomImage();
// $('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
// $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
// $('.show-small-img').click(function () {
//   $('#show-img').attr('src', $(this).attr('src'))
//   $('#big-img').attr('src', $(this).attr('src'))
//   $(this).attr('alt', 'now').siblings().removeAttr('alt')
//   $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
//   if ($('#small-img-roll').children().length > 4) {
//     if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
//       $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
//     } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
//       $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
//     } else {
//       $('#small-img-roll').css('left', '0')
//     }
//   }
// })
// // 点击 '>' 下一张
// $('#next-img').click(function (){
//   $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
//   $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
//   $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
//   $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
//   if ($('#small-img-roll').children().length > 4) {
//     if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
//       $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
//     } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
//       $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
//     } else {
//       $('#small-img-roll').css('left', '0')
//     }
//   }
// })
// // 点击 '<' 上一张
// $('#prev-img').click(function (){
//   $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
//   $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
//   $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
//   $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
//   if ($('#small-img-roll').children().length > 4) {
//     if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
//       $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
//     } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
//       $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
//     } else {
//       $('#small-img-roll').css('left', '0')
//     }
//   }
// })
</script>