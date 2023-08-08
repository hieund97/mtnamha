<section class="main-content" style="margin-top: 0px;">
    <?php //$this->load->view('homepage/frontend/common/menu') ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="sidebar wow fadeInUp" style="margin-top:20px;">
                    <?php  
                        $DetailCatalogues['sub'] = $this->FrontendArticlesCatalogues_Model->ReadAllByField(array('isaside' => 1,'parentid' => $DetailCatalogues['id']));
                        if ($DetailCatalogues['parentid'] != 0) {
                            $DetailCatalogues['sub'] = $this->FrontendArticlesCatalogues_Model->ReadAllByField(array('isaside' => 1,'parentid' => $DetailCatalogues['parentid']));
                            $DetailCataloguesA = $this->FrontendArticlesCatalogues_Model->ReadByField('id',$DetailCatalogues['parentid']);
                        }
                    ?>
                    <?php if (!empty($DetailCatalogues['sub'])): ?>
                        <div class="item-sb side-category">
                            <div class="category">
                                <?php if (!empty($DetailCataloguesA['title'])): ?>
                                    <h3 class="title" style="margin-top: 0px;"><i class="fa fa-bars"></i><?php echo $DetailCataloguesA['title'] ?></h3>
                                <?php else: ?>
                                    <h3 class="title" style="margin-top: 0px;"><i class="fa fa-bars"></i><?php echo $DetailCatalogues['title'] ?></h3>
                                <?php endif ?>
                                
                            </div>
                            <ul>
                                <?php foreach ($DetailCatalogues['sub'] as $key => $value): ?>
                                    <?php $href = rewrite_url($value['canonical'], $value['slug'], $value['id'], 'articles_catalogues'); ?>
                                    <li style="position: relative;">
                                        <a style="<?php echo ($DetailCatalogues['id'] == $value['id']) ? 'color:#b1a662' : ''; ?>" href="<?php echo $href; ?>" title=""><?php echo $value['title'];  ?></a>
                                        <?php if (!empty($value['sub'])): ?>
                                            <i class="fal fa-angle-right"></i>
                                            <ul class="sub">
                                                <?php foreach ($value['sub'] as $k => $val): ?>
                                                    <?php $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'articles_catalogues'); ?>
                                                    <li><a href="<?php echo $href; ?>" title=""><?php echo $val['title'];  ?></a></li>
                                                <?php endforeach ?>
                                            </ul>
                                                
                                        <?php endif ?>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <?php
                            if (!empty($is_article)) {
                                $articleCategory = $this->FrontendArticlesCatalogues_Model->ReadAllByField(array('isaside' => 1, 'parentid' => 0));
                                if (!empty($articleCategory)) {
                                    foreach ($articleCategory as $key => $value) {
                                        $articleCategory[ $key ]['sub'] = $this->FrontendArticlesCatalogues_Model->ReadAllByField(array('isaside' => 1, 'parentid' => $value['id']));
                                    }
                                }
                            }
                            if (empty($DetailCatalogues['id'])) {
                                $DetailCatalogues['id'] = 0;
                            } 
                        ?>
                        <?php if (!empty($articleCategory)): ?>
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
                    <?php endif ?>
                </div>
                <?php $this->load->view('homepage/frontend/common/aside') ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="nav-main-content page-article-catalogues">

                    <div class="new-home">
                        <h2 class="title22 wow fadeInUp"><?php echo $DetailCatalogues['title'] ?></h2>
                        <?php if(isset($ArticlesList) && is_array($ArticlesList) && count($ArticlesList)){ ?>
                            <?php foreach ($ArticlesList as $key => $val) {
                            $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'articles') ?>
                        <div class="item-new wow fadeInUp">
                            <div class="image">
                                <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                </a>
                            </div>
                            <div class="nav-image">
                                <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                                <p class="date"><?php echo show_time($val['created'],'d/m/Y') ?></p>
                                <p class="desc"><?php echo strip_tags($val['description']) ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php }} ?>
                    </div>
                    <?php echo (isset($PaginationList)?$PaginationList:'') ?>
                   <!--  <div class="pagenavi">
                        <ul>
                            <li>
                                <a href="" class="active">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <a href="">4</a>
                                <a href="">5</a>
                                <a href="">6</a>
                                <a href="">...</a>
                                <a href="">Trang cuối</a>
                            </li>
                        </ul>
                    </div> -->


                </div>
            </div>
        </div>
    </div>
</section>