<div id="main" class="wrapper main-product">
    <?php //$this->load->view('homepage/frontend/common/menu') ?>
    <div class="bres">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>
                <li><a>Tìm kiếm</a>/</li>
            </ul>
        </div>
    </div>

    <section class="main-content page-search">
        <div class="container pd-10">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="sidebar wow fadeInUp">
                        <?php $this->load->view('homepage/frontend/common/aside') ?>

                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="nav-main-content">
                        <div class="content-product">
                            <div class="title-primary wow fadeInUp">
                                <h1 class="title1"><span><?php echo $this->lang->line('keyword') ?>: <?php echo ((isset($keys)) ? $keys : '') ?></span></h1>

                            </div>
                            <?php if(isset($result) && is_array($result) && count($result)){ ?>
                            <div class="nav-product" id="list-filter-ajax">
                                <div class="row">
                                    <?php foreach ($result as $key => $val) { ?>
                                        <?php $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products') ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6 box-item-product wow fadeInUp">
<!--                                        <div class="item-product">-->
<!--                                            <div class="image">-->
<!--                                                <a href="--><?php //echo $href ?><!--" class="thubmail-img"><img src="--><?php //echo $val['images'] ?><!--" alt="--><?php //echo $val['title'] ?><!--">-->
<!--                                                </a>-->
<!--                                                <div class="new-pr"><img src="templates/frontend/resources/images/new.png" alt="">-->
<!--                                                </div>-->
<!--                                                <div class="sale-pr"><img src="templates/frontend/resources/images/sale.png" alt="">-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="price-c">-->
<!--                                                <p class="price"><span class="gia-cu">--><?php //if($val['price'] > 0){echo number_format($val['price']).' đ';}else{ echo '.-';} ?><!--</span>-->
<!--                                                    <br><span class="gia-moi">--><?php //if($val['saleoff'] > 0){echo number_format($val['saleoff']).'<span class="css-size-d"> đ</span>';}else{ echo 'Liên hệ';} ?><!--</span>-->
<!--                                                </p>-->
<!--                                                --><?php //if($val['price'] > $val['saleoff']){ ?>
<!---->
<!--                                                     <div class="sale-off-show">---><?php //echo round((($val['price']-$val['saleoff'])*100)/$val['price']); ?><!--%</div>-->
<!--                                                --><?php //} ?>
<!--                                            </div>-->
<!--                                            <h3 class="title"><a href="--><?php //echo $href ?><!--">--><?php //echo $val['title'] ?><!-- </a></h3>-->
<!--                                            <div class="add-cart">-->
<!--                                                <a href="" class="ajax-addtocart" data-quantity="1" data-id="--><?php //echo $val['id'] ?><!--" data-price="--><?php //echo $val['saleoff'] ?><!--">Cho vào giỏ</a>-->
<!--                                                <a href="" class="mh ajax-addtocart" data-redirect="redirect" data-quantity="1" data-id="--><?php //echo $val['id'] ?><!--" data-price="--><?php //echo $val['saleoff'] ?><!--">Mua hàng</a>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <?php echo htmlItem($val, true) ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php echo (isset($PaginationList)?$PaginationList:'') ?>
                            </div>
                            <?php }else{echo 'Không tìm được kết quả nào. Vui lòng thử lại với từ khóa khác';} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
