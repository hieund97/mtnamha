<style type="text/css" media="screen">
    .new-home h3 a{
        font-weight: 700;
    }
</style>
<section class="main-content" style="margin-top: 0px;">
    <?php $this->load->view('homepage/frontend/common/menu') ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="sidebar wow fadeInUp" style="margin-top:20px;">
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
                </div>
                <?php $this->load->view('homepage/frontend/common/aside') ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="nav-main-content">
                    <div class="new-home">
                        <?php if (!empty($ArticlesList)): ?>
                            <?php foreach ($ArticlesList as $key => $value): ?>
                                <?php $href = rewrite_url($value['canonical'],$value['slug'],$value['id'],'articles_catalogues'); ?>
                                <div>
                                    <h3 style="font-size: 24px;"><?php echo $value['title'] ?></h3>
                                </div>
                                <?php if (!empty($value['sub'])): ?>
                                    <div class="box-border">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="img">
                                                    <img src="<?php echo $value['sub'][0]['images'] ?>" alt="<?php echo $value['sub'][0]['title'] ?>">
                                                </div>
                                                <h3><a href="<?php echo rewrite_url($value['sub'][0]['canonical'], $value['sub'][0]['slug'], $value['sub'][0]['id'], 'articles'); ?>"><?php echo $value['sub'][0]['title'] ?></a></h3>
                                                <p class="date">Ngày đăng: <?php echo show_time($value['sub'][0]['created'],'d/m/Y') ?> - Lượt xem: <?php echo $value['sub'][0]['viewed'] ?></p>
                                            </div>
                                            <?php 
                                                $value['sub'][0] = ''; 
                                                unset($value['sub'][0])
                                            ?>
                                            <?php if (!empty($value['sub'])): ?>
                                                <div class="col-md-6">
                                                    <?php foreach ($value['sub'] as $key => $val): ?>
                                                        <?php $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'articles'); ?>
                                                        <div class="item-new">
                                                            <div class="image">
                                                                <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>">
                                                                </a>
                                                            </div>
                                                            <div class="nav-image">
                                                                <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                                                                <p class="date">Ngày đăng: <?php echo show_time($val['created'],'d/m/Y') ?> - Lượt xem: <?php echo $val['viewed'] ?></p>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <?php echo (isset($PaginationList)?$PaginationList:'') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css" media="screen">
    .new-home .item-new .image img{
        height: 74px;
    }
    .new-home .item-new{
        padding-bottom: 10px;
    }
    .box-border{
        border-bottom: 1px solid #eee;
    }
    .box-border img{
        height: 240px;
        width: 100%;
    }
</style>