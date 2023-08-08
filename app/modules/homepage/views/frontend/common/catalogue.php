
<div class="sidebar wow fadeInUp">
    <?php 
    $spmoi = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, banner,description','where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
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
                        <?php if($saleoff == 0 && $price > 0){ echo $price;}elseif($saleoff > 0){ echo $saleoff . '<span>'.$price.'</span>'; }elseif($saleoff == 0 && $price == 0){ echo 'Liên hệ';} ?>
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
    $tinnb = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description','where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
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