<?php  
    // if (!empty($is_article)) {
    //     $articleCategory = $this->FrontendArticlesCatalogues_Model->ReadAllByField('isaside', 1);
    //     if (!empty($articleCategory)) {
    //         foreach ($articleCategory as $key => $value) {
    //             $articleCategory[ $key ]['sub'] = $this->FrontendArticlesCatalogues_Model->ReadAllByField(array('isaside' => 1, 'parentid' => $value['id']));
    //         }
    //     }
    // }
    // if (empty($DetailCatalogues['id'])) {
    //     $DetailCatalogues['id'] = 0;
    // }  
  
?>
<style type="text/css" media="screen">
    .side-category .title{
        background: linear-gradient(#caad5c -16%, #f2e386 47%, #caad5c 82%);
        padding: 12px 15px;
        font-weight: 600;
        margin-bottom: 0px;
        background: #0676da;
        color: #fff;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }
    .side-category .title i{
        margin-right: 7px;
    }
    .side-category ul{
        background-color: #040404;
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .side-category ul li{
        color: #fff;
        padding: 10px 15px;
        border-bottom: 1px dashed #333333;
        background: #fff;
    }
    .side-category ul li i{
        float: right;
    }
    .side-category ul li a{
        color: #333;
        text-transform: uppercase;
    }
    .side-category ul.sub{
        position: absolute;
        width: 250px;
        z-index: 999;
        left: 100%;
        top: 0%;
        display: none;
    }
    .side-category ul li:hover > a, .side-category ul li:hover > i{
        color: #b1a662;
    }
    .side-category ul li:hover > ul{
        display: block;
    }
    @media (max-width: 600px){
        .side-category ul.sub{
            display: none!important;
        }
        .side-category ul li i{
            display: none!important;
        }
    }
</style>
<div class="sidebar wow fadeInUp">
    <?php if (!empty($articleCategory_ss)): ?>
        <div class="item-sb side-category">
            <div class="category">
                <h3 class="title"><i class="fa fa-bars"></i>TIN TỨC</h3>
            </div>
            <ul>
                <?php foreach ($articleCategory as $key => $value): ?>
                    <?php $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues'); ?>
                    <li style="position: relative;">
                        <a href="<?php echo $href; ?>" style="<?php echo ($DetailCatalogues['id'] == $value['id']) ? 'color:#b1a662' : ''; ?>" title=""><?php echo $value['title'];  ?></a>
                        <?php if (!empty($value['sub'])): ?>
                            <i class="fal fa-angle-right"></i>
                            <ul class="sub">
                                <?php foreach ($value['sub'] as $k => $val): ?>
                                    <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues'); ?>
                                    <li><a href="<?php echo $href; ?>" style="<?php echo ($DetailCatalogues['id'] == $value['id']) ? 'color:#b1a662' : ''; ?>" title=""><?php echo $val['title'];  ?></a></li>
                                <?php endforeach ?>
                            </ul>
                                
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
    
    <div class="item-sb">
        <h3 class="title-sb">
            Tư vẫn và hỗ trợ
        </h3>
        <div class="support item">
            <div class="images">
                <img class="lazy" data-src="templates/frontend/resources/images/suport.png" alt="Tư vẫn và hỗ trợ">
            </div>
            <div class="holine">
                <div class="icon">
                    <img class="lazy" data-src="templates/frontend/resources/images/icon-holine.png" alt="Tư vẫn và hỗ trợ">
                </div>
                <div class="nav-icon">
                    <span class="sp1">Hotline</span>
                    <span class="sp2" style="font-weight: bold;"><?php echo $this->fcSystem['contact_hotline'] ?></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- <div class="problem">
                <div class="item">
                    <h4>Nhân viên tư vấn khách hàng</h4>
                    <ul>
                        <li>
                            <img src="templates/frontend/resources/images/fb.png" alt="">
                        </li>
                        <li>
                            <img src="templates/frontend/resources/images/sky.png" alt="">
                        </li>
                    </ul>
                </div>
                <div class="item">
                    <h4>Nhân viên tư vấn khách hàng</h4>
                    <ul>
                        <li>
                            <img src="templates/frontend/resources/images/fb.png" alt="">
                        </li>
                        <li>
                            <img src="templates/frontend/resources/images/sky.png" alt="">
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
    <?php 
    $spmoi = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, banner,description','where' => array('trash' => 0,'publish' => 1,'ishome' => 1 , 'alanguage' => ''.$this->fc_lang.''),'limit' => 15,'order_by' => 'order asc, id desc'));
     ?>
    <?php if(isset($spmoi) && is_array($spmoi) && count($spmoi)){ ?>
    <div class="item-sb">
        <h3 class="title-sb">
            Sản Phẩm
        </h3>
        <div class="nav-product-sb">
            <?php foreach ($spmoi as $key => $val) {
            $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products') ?>
            <?php 
            $price = number_format($val['price']);
            $saleoff = number_format($val['saleoff']);
             ?>
            <div class="item">
                <div class="image">
                    <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                    </a>
                </div>
                <div class="nav-image">
                    <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                    <p class="price">
                        <?php if($saleoff == 0 && $price > 0){ echo $price;}elseif($saleoff > 0){ echo $saleoff . ' <span class="css-price-d"></span><span>'.(!empty($price) ? $price : '').'</span>'; }elseif($saleoff == 0 && $price == 0){ echo 'Liên hệ';} ?>
                       <!--  399.000₫ <span>500.000₫</span> -->
                    </p>
                    <a href="<?php echo $href ?>" class="readmore">Xem chi tiết<i class="fas fa-angle-right"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php 
    $tinnb = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
     ?>
    <?php if(isset($tinnb) && is_array($tinnb) && count($tinnb)){ ?>
    <div class="item-sb">
        <h3 class="title-sb">
            Tin tức
        </h3>
        <div class="nav-right-new">
            <?php foreach ($tinnb as $key => $val) {
            $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'articles') ?>
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
    </div>
    <?php } ?>
</div>