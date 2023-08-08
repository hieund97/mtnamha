<footer id="footer-site">
    <div class="top-footer wow fadeInUp">
        <div class="container pd-10">
<!--            --><?php //$ft = navigations_array('footer',$this->fc_lang) ?>
<!--            --><?php //if(isset($ft) && is_array($ft) && count($ft)){ ?>
<!--            --><?php //foreach ($ft as $key => $val) { ?>
<!--            <div class="item">-->
<!--                <h3 class="title-footer">--><?php //echo $val['title'] ?><!--</h3>-->
<!--                --><?php //if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
<!--                <div class="nav-item-adress">-->
<!--                    <ul>-->
<!--                        --><?php //foreach ($val['child'] as $key => $val1) { ?>
<!--                        <li><a href="--><?php //echo $val1['href'] ?><!--" rel="nofollow"><i class="fal fa-angle-right"></i>--><?php //echo $val1['title'] ?><!--</a>-->
<!--                        </li>-->
<!--                        --><?php //} ?>
<!--                    </ul>-->
<!--                </div>-->
<!--                --><?php //} ?>
<!--            </div>-->
<!--            --><?php //}} ?>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="title-footer">TỔNG ĐÀI HỖ TRỢ</h3>
                    <div class="box-sp">
                        <div class="row">
                            <div class="col-lg-6 hotline-support item">
                                <div class="item-support">
                                    <?php echo $this->fcSystem['homepage_zalo_box_1'] ?>
                                </div>
                            </div>
                            <div class="col-lg-5 hotline-support second-support item">
                                <div class="item-support">
                                    <?php echo $this->fcSystem['homepage_zalo_box_2'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 item">
                    <h3 class="title-footer">Fanpage Facebook</h3>
                    <div class="nav-item-adress">
                        <div class="fb-page" data-href="<?php echo $this->fcSystem['social_facebook'] ?>" data-tabs="timeline" data-height="135" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $this->fcSystem['social_facebook'] ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $this->fcSystem['social_facebook'] ?>">Facebook</a></blockquote></div>
                    </div>
                </div>
                <div class="col-lg-3 item">
                    <h4 class="title">Liên kết mạng xã hội</h4>
                    <div class="nav-item-adress">
                        <ul class="social-footer">
                            <li><a href="<?php echo $this->fcSystem['social_facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a href="<?php echo $this->fcSystem['social_twitter'] ?>"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li><a href="<?php echo $this->fcSystem['social_linkedin'] ?>"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li><a href="<?php echo $this->fcSystem['social_youtube'] ?>"><i class="fab fa-youtube"></i></a>
                            </li>
                            <li><a href="<?php echo $this->fcSystem['social_google'] ?>"><i class="fab fa-google"></i></a>
                            </li>
                        </ul>
                        <div class="tb bo-cong-thuong">
                            <?php if(!empty($this->fcSystem['homepage_bct_img'])){ ?>
                            <a href='<?php echo $this->fcSystem['homepage_bct_link'] ?>'><img class="lazy" data-src="<?php echo $this->fcSystem['homepage_bct_img'] ?>" alt="Bộ công thương"></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="top-footer footer-bottom wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="<?php echo base_url() ?>" class="logo-footer">
                        <img class="lazy" data-src="<?php echo $this->fcSystem['homepage_logo1'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>">
                    </a>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="title-footer">
                        <?php echo $this->fcSystem['homepage_company'] ?>
                    </div>
                    <div class="nav-bottom">
                        <p><span>Địa chỉ ĐKKD: </span><?php echo $this->fcSystem['contact_address'] ?></p>
                        <p><span>Địa chỉ kinh doanh: </span><?php echo $this->fcSystem['contact_address1'] ?></p>
                        <p  style="color:#fff!important"><span>Điện thoại: </span><?php echo $this->fcSystem['contact_phone'] ?></p>
                        <p><span>Email: </span><?php echo $this->fcSystem['contact_email'] ?></p>
                        <p><span>Hotline: </span><?php echo $this->fcSystem['contact_hotline'] ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="row">
                        <?php $ft = navigations_array('footer',$this->fc_lang) ?>
                        <?php if(isset($ft) && is_array($ft) && count($ft)){ ?>
                            <?php foreach ($ft as $key => $val) { ?>
                                <div class="item col-lg-4 col-md-4">
                                    <h3 class="title-footer"><?php echo $val['title'] ?></h3>
                                    <?php if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
                                        <div class="nav-item-adress">
                                            <ul>
                                                <?php foreach ($val['child'] as $key => $val1) { ?>
                                                    <li><a href="<?php echo $val1['href'] ?>" rel="nofollow"><i class="fal fa-angle-right"></i><?php echo $val1['title'] ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }} ?>
                    </div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="map-footer">
                        <?php echo $this->fcSystem['contact_map'] ?>
                    </div>
                </div>
            </div>
        </div>

    </div>


<div class="copy-right">
     <div class="container">
        <div class="wp-copy text-center" style="color:#fff">
            <?php echo (!empty($this->fcSystem['homepage_coppyright'])) ? $this->fcSystem['homepage_coppyright'] : '' ?>
        </div>
     </div>
  </div>
</footer>

<div class="holine-footer">
    <div class="holine-footer1">
        <span class="title-holine">Hotline</span>
        <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"><span class="holine-phone"><?php echo $this->fcSystem['contact_hotline'] ?></span></a>
    </div>


</div>
<style type="text/css" media="screen">
.wp-copy.text-center{
    text-align: center;
}
.holine-footer1:after{
    content:"";
}
    .copy-right {
        width: 100%;
    display: inline-block;
    background: #0069c7;
    /*height: 44px;*/
    /*line-height: 44px;*/
    text-align: center;
    font-size: 14px;
    color: #bdbdbd;
    margin: 0;
    padding: 10px 0;
    /*border-top: 1px solid #fff;*/
    }
    .right-pc-position{
        position: fixed;
        bottom: 40%;
        right: 10px;
        z-index: 99999999;
    }
    @media (max-width: 1500px){
        .right-pc-position{
            position: fixed;
            bottom: 10%;
            right: 20px;
            z-index: 99999999;
        }
    }
    .right-pc-position ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: inline-block;
    }.right-pc-position ul li {
        padding-bottom: 10px;
        width: 30px;
        height: 30px;
        position: relative;
        margin-bottom: 5px;
    }
    .right-pc-position ul.social-footer li i{
        color: #000;
        color: #fff;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        position: absolute;
        padding: 5px 9px;
    }
    .right-pc-position ul li .fa-facebook-f{
        background: #3B5997;
    }
    .right-pc-position ul li .fa-twitter{
        background: #00ACF0;
    }
    .right-pc-position ul li .fa-instagram{
        background: #447397;
    } 
    .right-pc-position ul li .fa-youtube{
        background: #D12E2E;
    }
    .right-pc-position ul li .fa-google{
        background: #DB4F48;
        
    }

    body #divBannerFloatLeft{
        padding-right: 10px;
    }
    body #divBannerFloatRight{
        padding-left: 10px;
    }
    .fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title:after{

    }
</style>
<div class="right-pc-position">
    <ul class="social-footer">
        <li><a href="<?php echo $this->fcSystem['social_facebook'] ?>"><i class="fab fa-facebook-f"></i></a>
        </li>
        <li><a href="<?php echo $this->fcSystem['social_twitter'] ?>"><i class="fab fa-twitter"></i></a>
        </li>
        <li><a href="<?php echo $this->fcSystem['social_linkedin'] ?>"><i class="fab fa-instagram"></i></a>
        </li>
        <li><a href="<?php echo $this->fcSystem['social_youtube'] ?>"><i class="fab fa-youtube"></i></a>
        </li>
        <li><a href="<?php echo $this->fcSystem['social_google'] ?>"><i class="fab fa-google"></i></a>
        </li>
    </ul>
</div>
<div id="btn-top">
    <img src="templates/frontend/resources/images/btn-top.png" alt="">
</div>
<div class="adfloat" id="divBannerFloatLeft">
    <p>
        <a href="<?php echo $this->fcSystem['common_banner4'] ?>" target="_blank"><img src="<?php echo $this->fcSystem['common_banner3'] ?>" alt="">
        </a>
    </p>
</div>
<div class="adfloat" id="divBannerFloatRight">
    <p>
        <a href="<?php echo $this->fcSystem['common_banner6'] ?>" target="_blank"><img src="<?php echo $this->fcSystem['common_banner5'] ?>" alt="">
        </a>
    </p>
</div>
<style type="text/css" media="screen">
    i.fa.fa-plus.css-icon-plus.show:before{
        content: "\f107";
    }
    .fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title:after, .fa.fa-plus.css-icon-plus:before{
        content: "\f105";
        font-weight: bold;
    }
    .fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title.show:after{
        content: "\f107";
    }
</style>
<script type="text/javascript" charset="utf-8" async defer>
    // $('#main-menu1 > ul > li').attr('style','width: calc(100% / '+$('#main-menu1 > ul > li').length+')');
  
    if(jQuery(window).width() <= 768){
        $('.main-slider').attr('style',"padding-top: "+$('.nav-category-home.hello').height()+"px");
        $('.css-icon-plus').click(function(){
            if(jQuery(this).next().css('display') == 'none'){

                jQuery(this).next().attr('style', 'opacity: 1;display: block;visibility: inherit;position: inherit;left: 0px;');    
   
                // jQuery(this).next().css('display','block');

                jQuery(this).addClass('show');

            }else{

                jQuery(this).next().attr('style', 'opacity: 0;display: none;visibility: hidden;position: absolute;');
                // jQuery(this).next().css('display','none');

                jQuery(this).removeClass('show');

            }
            // $(this).parent().find('.vertical-dropdown-menu').attr('style', 'opacity: 1;display: block;visibility: inherit;');
        });
    }
    jQuery('.fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title').click(function(e){

        e.preventDefault();

        if(jQuery(this).next().css('display') == 'none'){

            jQuery(this).next().css('display','block');

            jQuery(this).addClass('show');

        }else{

            jQuery(this).next().css('display','none');

            jQuery(this).removeClass('show');

        }

        return false;

    });

   
    // jQuery(window).resize(function() {
    //     if(jQuery(window).width() <= 768){
    //         jQuery('.fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title').click(function(e){

    //             e.preventDefault();

    //             if(jQuery(this).next().css('display') == 'none'){

    //                 jQuery(this).next().css('display','block');

    //                 jQuery(this).addClass('show');

    //             }else{

    //                 jQuery(this).next().css('display','none');

    //                 jQuery(this).removeClass('show');

    //             }

    //             return false;

    //         });
    //     }
    // });
</script>
