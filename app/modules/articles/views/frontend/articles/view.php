<link href="https://fonts.googleapis.com/css?family=Noto+Serif&display=swap" rel="stylesheet">
<style type="text/css" media="screen">
    .main-content h1{
        font-family: "Noto Serif", "Adobe Blank";
        font-weight: 700;
        font-style: normal;
    }
</style>
<div id="main" class="wrapper main-product">
    <?php //$this->load->view('homepage/frontend/common/menu') ?>
    <div class="bres">
        <div class="container">
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
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php $this->load->view('homepage/frontend/common/aside') ?>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="nav-main-content">
                        <div class="content-detail-new">
                            <h1><?php echo $DetailArticles['title'] ?></h1>
                            <?php echo $DetailArticles['description'] ?>
                            <?php echo $DetailArticles['content'] ?>
                        </div>
                        <?php if(isset($articles_same) && is_array($articles_same) && count($articles_same)){ ?>
                        <div class="new-home other-new">
                            <h2 class="title22 wow fadeInUp">Tin tức liên quan</h2>
                            <?php foreach ($articles_same as $key => $val) { 
                                $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'articles') ?>
                            <div class="item-new wow fadeInUp">
                                <div class="image">
                                    <a href="<?php echo $href ?>"><img src="<?php echo $val['images'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="nav-image">
                                    <h3 class="title"><a href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                                    <p class="date"><?php echo show_time($val['created'],'d/m/Y') ?></p>
                                    <p class="desc"><?php echo strip_tags($val['description']) ?></p>
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
    
</div>