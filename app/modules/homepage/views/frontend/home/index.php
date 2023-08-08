<h1 style="display: none;"><?php echo $meta_title ?></h1>

<div id="main" class="wrapper">
    <?php /* ?>
    <div class="slider-sale">
        <div class="container">
        	<div class="row">
        		<div class="col-md-2" style="padding-right: 0">
        			<div class="title-hh">
                        <h2 class="h2-title">Danh mục sản phẩm</h2>
                    </div>
        		</div>
        		<?php $top = navigations_array('top',$this->fc_lang) ?>
        		<div class="col-md-10">
        			<?php if(isset($top) && is_array($top) && count($top)){ ?>
                	<div class="menu-tren">
                		<ul>
                			<?php foreach ($top as $key => $val) { ?>
                			<li><a href="<?php echo $val['href'] ?>"><?php echo $val['title'] ?></a></li>
                			<?php } ?>
                		</ul>
                	</div>
                	<?php } ?>
        		</div>
        	</div>
            <div class="row">
            	<div class="col-md-2 col-sm-2 col-xs-12" style="padding-right: 0;">
            		<?php if(isset($danhmuc) && is_array($danhmuc) && count($danhmuc)){ ?>
            		<div class="wp-menu-left">
                        <!--  -->
                        <div class="list-menu">
                            <ul class="ul-b ul-list-menu">
                            	<?php foreach ($danhmuc as $key => $val) {
                            	$href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues') ?>
                                <li><a href="<?php echo $href ?>"><img src="<?php echo $val['icon'] ?>" alt=""><?php echo $val['title'] ?></a> </li>
                            	<?php } ?>
							</ul>
                        </div>
                   	</div>
                   	<?php } ?>
            	</div>
            	
                <div class="col-md-7 col-sm-7 col-xs-12">
                	
                    <?php $this->load->view('homepage/frontend/common/slider') ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <iframe width="100%" height="203" src="https://www.youtube.com/embed/<?php echo substr($this->fcSystem['homepage_vidu'], 32); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="sale">
                        <a href="<?php echo $this->fcSystem['common_banner2'] ?>"><img src="<?php echo $this->fcSystem['common_banner1'] ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php */ ?>

    <?php //$this->load->view('homepage/frontend/common/menu') 
    ?>
    <div class="banner-home">
        <div class="container pd-10">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="banner-home-left">
                        <?php //$this->load->view('homepage/frontend/common/menu') 
                        ?>
                    </div>
                    <div class="banner-home-right">
                        <div class="slider-homepage">
                            <?php $this->load->view('homepage/frontend/common/slider') ?>
                        </div>
                        <?php if (isset($slide_ads_home) && is_array($slide_ads_home) && count($slide_ads_home)) { ?>
                            <div class="banner-right-homepage">
                                <?php foreach ($slide_ads_home as $key => $val) {
                                    if ($key < 4) {
                                ?>
                                        <div class="item-n">
                                            <a href="<?php echo $val['url'] ?>"><img class="lazy" data-src="<?php echo (!empty($val['image'])) ? $val['image'] : 'templates/frontend/resources/images/not-found.png' ?>" alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        <?php } ?>

                        <?php if (isset($slide_ads_home) && is_array($slide_ads_home) && count($slide_ads_home) > 4) { ?>
                            <div class="banner-home-bot">
                                <?php foreach ($slide_ads_home as $key => $val) {
                                    if ($key >= 4) {
                                ?>
                                        <div class="item-n">
                                            <a href="<?php echo $val['url'] ?>"><img class="lazy" data-src="<?php echo (!empty($val['image'])) ? $val['image'] : 'templates/frontend/resources/images/not-found.png' ?>" alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="slider-sale" style="display: none">
        <div class="container pd-10">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12 col-edit-1">
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 col-edit-2">

                    <?php //$this->load->view('homepage/frontend/common/slider') 
                    ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 col-edit-3 mobile-display-none">
                    <iframe width="100%" height="160" src="https://www.youtube.com/embed/<?php echo substr($this->fcSystem['homepage_vidu'], 32); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="sale">
                        <a href="<?php echo $this->fcSystem['common_banner2'] ?>"><img class="lazy" data-src="<?php echo $this->fcSystem['common_banner1'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="top-content">
        <div class="container pd-10">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 fade-left animated fadeInLeft">
                    <div class="left-product">
                        <div class="content-product home-first">
                            <div class="title-primary wow fadeInUp">
                                <a href="<?php //echo $this->fcSystem['homepage_product_url'] 
                                            ?>">
                                    <h3 class="title1">Sản phẩm khuyến mại</h3>
                                </a>
                                <!-- <a href="" class="read-more">Xem tất cả</a> -->
                            </div>
                            <?php if (isset($sphot) && is_array($sphot) && count($sphot)) { ?>
                                <div class="nav-product">
                                    <div class="row">
                                        <div id="product-sale-home" class='owl-carousel'>
                                            <?php foreach ($sphot as $key => $val) {
                                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products') ?>
                                                <div class="wow fadeInUp">
                                                    <?php echo htmlItem($val, true) ?>
                                                </div>

                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 fade-Right animated fadeInRight col-edit-3 mobile-display-none" style="display: none">
                    <div class="right-new">
                        <div class="title-primary">
                            <a href="<?php echo $this->fcSystem['homepage_post_url'] ?>">
                                <h3 class="title1">Tin tức công nghệ</h3>
                            </a>

                        </div>
                        <?php if (isset($tinhome) && is_array($tinhome) && count($tinhome)) { ?>
                            <div class="nav-right-new">
                                <?php foreach ($tinhome as $key => $val) {
                                    $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles') ?>
                                    <div class="item">
                                        <div class="image">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                            </a>
                                        </div>
                                        <div class="nav-img">
                                            <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main-content main-content1">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="nav-main-content nav-main-content1 home-row-product">
                        <?php if (isset($list) && is_array($list) && count($list)) { ?>
                            <?php foreach ($list as $key => $val) { ?>
                                <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues') ?>
                                <div class="content-product">
                                    <div class="title-primary wow fadeInUp">
                                        <a href="<?php echo $href ?>">
                                            <h3 class="title1"><?php echo $val['title'] ?></h3>
                                        </a>
                                        <?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
                                            <ul>
                                                <?php foreach ($val['child'] as $keyC => $valC) {
                                                    $hrefC = rewrite_url($valC['canonical'], $valC['slug'], $valC['id'], 'articles') ?>
                                                    <li><a href="<?php echo $hrefC ?>"><?php echo $valC['title'] ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </div>
                                    <?php if (isset($val['post']) && is_array($val['post']) && count($val['post'])) { ?>
                                        <div class="nav-product">
                                            <div class="row">
                                                <?php foreach ($val['post'] as $keyP => $valP) { ?>
                                                    <?php $hrefP = rewrite_url($valP['canonical'], $valP['slug'], $valP['id'], 'products') ?>
                                                    <div class="col-xl-6 col-lg-2 col-md-3 col-sm-6 col-xs-6 box-item-product wow fadeInUp">
                                                        <?php echo htmlItem($valP, true) ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="no-result">Dữ liệu đang cập nhật!</div>
                                    <?php } ?>
                                    <?php if (!empty($val['images'])) { ?>
                                        <div class="category-banner" style="display: none">
                                            <div class="banner">
                                                <a href="<?php echo $href ?>"><img alt="ads2" class="img-responsive lazy" data-src="<?php echo $val['images'] ?>">
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ủng hộ khách hàng -->
    <section class="container-2019">
        <div class="hacom-customer">
            <div class="hacom-customer-img-fix">
                <img class="lazy loaded" data-src="https://hanoicomputercdn.com/media/lib/08-05-2023/demopink-1.png" src="https://prnt.sc/A6LYTkmiTn1T" alt="Khách Hàng Hacom" width="1" height="1" style="width: auto;height: auto;" data-was-processed="true">
            </div>
            <div class="wrap-hacom-customer">
                <div class="hacom-customer-title">Sự ủng hộ của khách hàng khắp mọi miền đất nước</div>

                <div id="js-footer-customer-container" class="loaded">
                    <div class="owl-carousel owl-theme hacom-customer-slider owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-41755px, 0px, 0px); transition: all 0.4s ease 0s; width: 85897px;">
                                <div class="owl-item cloned" style="width: 387.667px; margin-right: 10px;">
                                    <div class="item">
                                        <a href="" target="_blank">
                                            <img class="owl-lazy" data-src="https://hanoicomputercdn.com/media/banner/09_Junf82229d75b685c4ca6148c161cfc65d7.jpg" alt="" width="2048" height="1365">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 387.667px; margin-right: 10px;">
                                    <div class="item">
                                        <a href="" target="_blank">
                                            <img class="owl-lazy" data-src="https://hanoicomputercdn.com/media/banner/09_Junfab2fa26066782277e15835e3bc5ed09.jpg" alt="" width="2048" height="1365">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 387.667px; margin-right: 10px;">
                                    <div class="item">
                                        <a href="" target="_blank">
                                            <img class="owl-lazy" data-src="https://hanoicomputercdn.com/media/banner/06_June4551c0c17cad5f7631485fe0d2c88ff.jpg" alt="" width="2479" height="2048">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev">
                                <i class="far fa-chevron-left"></i>
                            </button>
                            <button type="button" role="presentation" class="owl-next">
                                <i class="far fa-chevron-right" style="margin-left:2px;"></i>
                            </button>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $chatluong = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description', 'where' => array('trash' => 0, 'publish' => 1, 'cataloguesid' => 72, 'alanguage' => '' . $this->fc_lang . ''), 'limit' => 5, 'order_by' => 'order asc, id desc'));
    ?>
    <?php if (isset($chatluong) && is_array($chatluong) && count($chatluong)) { ?>
        <section class="bottom-content">
            <div class="container" style="padding-top: 20px;">
                <div class="row">
                    <?php foreach ($chatluong as $key => $val) { ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp">
                            <div class="item">
                                <div class="icon"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                </div>
                                <div class="nav-icon">
                                    <h4 class="title"><?php echo $val['title'] ?></h4>
                                    <p class="desc"> <?php echo strip_tags($val['description']) ?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
</div>

<style>
    #main-menu1 ul .menu-main-sub {
        opacity: 1;
        transform: rotateX(0deg) !important;
        visibility: visible !important;
        transition: unset !important;
    }
</style>