<?php 
$tintuc = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 1,'order_by' => 'order asc, id desc'));
        if(isset($tintuc) && is_array($tintuc) && count($tintuc)){
            foreach($tintuc as $key => $val){
                $tintuc[$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
                    'modules' => 'articles',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`created`, `pr`.`description`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
                    'limit' => 4,
                    'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
                    'cataloguesid' => $val['id'],
                ));
            }
        }
$sphot = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, banner,description','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
 ?>
<div class="stripe">
    <div class="container">
        <h3 class="dashStyle">Sản phẩm bán chạy</h3>
        <?php if(isset($sphot) && is_array($sphot) && count($sphot)){ ?>
        <div class="productsRow row best-seller" style="display: flex;">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <?php foreach ($sphot as $key => $val) {
                    if($key < 4){ ?>
                        <?php $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products') ?>
                    <div class="col-sm-6 col-xs-12 col-xs-12-ls">
                        <div class="productBox">
                            <div class="productImage hoverStyle">
                                <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>"></a>
                                <div class="hoverBox">
                                    <!-- <div class="hoverIcons">
                                        <a href="basic-add-to-cart.html" class="eye hovicon"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="heart hovicon"><i class="fa fa-heart-o"></i></a>
                                    </div> --><!-- ( HOVER ICONS END ) -->
                                    <a href="view-cart.html" class="cartBTN2">Thêm vào giỏ hàng</a>
                                </div><!-- ( HOVER BOX END ) -->
                            </div><!-- ( PRODUCT IMAGE END ) -->
                            <div class="productDesc">
                                <span class="product-title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></span>
                                <p><?php echo cutnchar(strip_tags($val['description']),100) ?></p>
                                <div class="stars">
                                    <span class="starsimgRating"></span>
                                </div><!-- ( STARS END ) -->
                                <strong class="productPrice"><?php if(!empty($val['saleoff'])){ echo str_replace(',', '.', number_format($val['saleoff'])).' ₫';}else{ echo str_replace(',', '.', number_format($val['price'])).' ₫';} ?></strong>
                            </div><!-- ( PRODUCT DESCRIPTION END ) -->
                        </div><!-- ( PRODUCT BOX END ) -->
                    </div>
                    <?php }} ?>
                </div>
            </div>
            <?php foreach ($sphot as $key => $val) {
                if($key == 4){ ?>
            <?php $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products') ?>
            <div class="col-md-6 col-sm-12">
                <div class="productBox big-sell">
                    <div class="productImage hoverStyle">
                        <div class="col-sm-6 col-xs-6 imgHeight">
                            <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>"></a>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <a href="#" class="onSalesBTN"><span>On</span>Sale!</a>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="text-left">
                                <h3><?php echo $val['title'] ?></h3>
                                <p><?php echo strip_tags($val['description']) ?></p>
                                <hr>
                            </div>
                        </div>
                        <div class="hoverBox">
                            <!-- div class="hoverIcons">
                                <a href="basic-add-to-cart.html" class="eye hovicon"><i class="fa fa-eye"></i></a>
                                <a href="#" class="heart hovicon"><i class="fa fa-heart-o"></i></a>
                            </div> --><!-- ( HOVER ICONS END ) -->
                            <a href="view-cart.html" class="cartBTN2">Thêm vào giỏ hàng</a>
                        </div><!-- ( HOVER BOX END ) -->
                    </div><!-- ( PRODUCT IMAGE END ) -->
                    <div class="productDesc">
                        <div class="row">
                            <div class="col-xs-8">
                                <span class="product-title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></span>
                                <p><?php echo strip_tags($val['description']) ?></p>
                                <div class="stars">
                                    <span class="starsimgRating"></span>
                                </div><!-- ( STARS END ) -->
                            </div>
                            <div class="col-xs-4">
                                <?php if($val['saleoff'] > 0){ ?>
                                <strong class="productPrice"><del><?php echo str_replace(',', '.', number_format($val['price'])).' ₫' ?></del></strong>
                                <strong class="big-sel-price"><?php echo str_replace(',', '.', number_format($val['saleoff'])).' ₫' ?></strong>
                                <?php }elseif ($val['price'] > 0 && $val['saleoff'] == 0) { ?>
                                    <strong class="big-sel-price"><?php echo str_replace(',', '.', number_format($val['price'])).' ₫' ?></strong>
                                <?php }else{ ?>
                                    <strong class="big-sel-price">Liên hệ</strong>
                                <?php } ?>
                            </div>
                        </div>
                    </div><!-- ( PRODUCT DESCRIPTION END ) -->
                </div><!-- ( PRODUCT BOX END ) -->
            </div>
            <?php }} ?>
        </div><!-- ( PRODUCTS ROW END ) -->
        <?php } ?>
    </div>
</div><!-- ( STRIPE END ) -->

<?php if(isset($tintuc) && is_array($tintuc) && count($tintuc)){ ?>
    <?php foreach ($tintuc as $key => $value) { ?>
<div class="stripe">
    <div class="container">
        <h3 class="dashStyle"><?php echo $value['title'] ?></h3>
        <?php if(isset($value['post']) && is_array($value['post']) && count($value['post'])){ ?>
        <div class="blogRow row">
            <?php foreach ($value['post'] as $key => $val) {
            $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'articles');
            $day = show_time($val['created'],'d');
            $month = show_time($val['created'],'m');
            $year = show_time($val['created'],'Y');
             ?>
            <div class="col-md-3 col-sm-6 col-xs-12 col-xs-12-ls">
                <div class="blogBox">
                    <div class="blogImage zoom">
                        <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>"></a>
                        <div class="blogDate">
                            <span><?php echo $day ?></span>
                            <hr>
                            <i><?php echo $month ?></i>
                            <hr>
                            <i><?php echo $year ?></i>
                        </div><!-- ( BLOG DATE END ) -->
                    </div><!-- ( BLOG IMAGE END ) -->
                    <div class="blogDesc">
                        <span class="blog-title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></span>
                        <p><?php echo cutnchar(strip_tags($val['description']),150) ?></p>
                        <a href="<?php echo $href ?>" class="more">Xem thêm...</a>
                    </div><!-- ( BLOG DESCRIPTION END ) -->
                </div><!-- ( BLOG BOX END ) -->
            </div>
            <?php } ?>
        </div><!-- ( BLOG ROW END ) -->
        <?php } ?>
    </div>
</div><!-- ( STRIPE END ) -->
<?php }} ?>