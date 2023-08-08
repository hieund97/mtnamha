<div id="main" class="wrapper main-product">
    <?php //$this->load->view('homepage/frontend/common/menu') ?>
    <div class="bres">
        <div class="container pd-10">
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

    <section class="main-content product-catalogue-product">
        <div class="container pd-10">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="sidebar wow fadeInUp">
                        <div class="sidebar-box wow fadeInUp">
                            <?php  
                                $DetailCatalogues['sub'] = $this->FrontendProductsCatalogues_Model->ReadAllByField(array('parentid' => $DetailCatalogues['id']));
                                if ($DetailCatalogues['parentid'] != 0) {
                                    $DetailCatalogues['sub'] = $this->FrontendProductsCatalogues_Model->ReadAllByField(array('parentid' => $DetailCatalogues['parentid']));
                                    $DetailCataloguesP = $this->FrontendProductsCatalogues_Model->ReadByField('id',$DetailCatalogues['parentid']);
                                }
                            ?>
                            <?php if (!empty($DetailCatalogues['sub'])): ?>
                                <div class="item-sb side-category">
                                    <div class="category">
                                        <?php if (!empty($DetailCataloguesP['title'])): ?>
                                            <h3 class="title" style="margin-top: 0px;"><i class="fa fa-bars"></i><?php echo $DetailCataloguesP['title'] ?></h3>
                                        <?php else: ?>
                                            <h3 class="title" style="margin-top: 0px;"><i class="fa fa-bars"></i><?php echo $DetailCatalogues['title'] ?></h3>
                                        <?php endif ?>
                                        
                                    </div>
                                    <ul>
                                        <?php foreach ($DetailCatalogues['sub'] as $key => $value): ?>
                                            <?php $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'products_catalogues'); ?>
                                            <li style="position: relative;">
                                                <a style="<?php echo ($DetailCatalogues['id'] == $value['id']) ? 'color:#b1a662' : ''; ?>" href="<?php echo $href; ?>" title=""><?php echo $value['title'];  ?></a>
                                                <?php if (!empty($value['sub'])): ?>
                                                    <i class="fal fa-angle-right"></i>
                                                    <ul class="sub">
                                                        <?php foreach ($value['sub'] as $k => $val): ?>
                                                            <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues'); ?>
                                                            <li><a href="<?php echo $href; ?>" title=""><?php echo $val['title'];  ?></a></li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                        
                                                <?php endif ?>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif ?>
                        </div>
                        <?php $this->load->view('homepage/frontend/common/filter') ?>
                    </div>
                    <?php $this->load->view('homepage/frontend/common/aside') ?>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="nav-main-content">
                        <div class="content-product">
                            <div class="title-primary wow fadeInUp">
                                <h1 class="title1"><?php echo $DetailCatalogues['title'] ?></h1>

                            </div>
                            <?php if(isset($productsList) && is_array($productsList) && count($productsList)){ ?>
                            <div class="nav-product" id="list-filter-ajax">
                                <div class="row">
                                    <?php foreach ($productsList as $key => $val) { ?>
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
                                <div class="description" style="margin-bottom: 20px;">
                                    <?php echo $DetailCatalogues['description'] ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>