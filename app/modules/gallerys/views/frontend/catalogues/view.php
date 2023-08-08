<div id="main" class="wrapper main-album">
    <div class="bres">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>">Trang chủ</a>
                </li>
                <li class="active"> <?php echo $DetailCatalogues['title'] ?></li>
            </ul>
        </div>
    </div>
    <div id="content-library" class="abulm-home">
        <div class="container">
            <div id="content-library" class="nav-album">
                <?php if(isset($gallerysList) && is_array($gallerysList) && count($gallerysList)){ ?>
                <h2 class="title-sub-category"> <i class="fa fa-picture-o" aria-hidden="true"></i> Ảnh theo chủ đề</h2>
                <div class="row">
                   <?php foreach ($gallerysList as $key => $val) { ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="item  wow fadeInUp ">
                            <img class="example-image" src="<?php echo $val['images'] ?>" alt="<?php echo $val['title'] ?>" />
                            <a class="example-image-link" href="<?php echo $val['images'] ?>" data-lightbox="example-set" data-title="<?php echo $val['title'] ?>">
                                <span class="image-hover"> </span>
                                <span class="icon">
                           <i class="fas fa-eye"></i><br><span class="image-title"><?php echo $val['title'] ?></span>
                                </span>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
                <nav class="nav-page" aria-label="Page navigation navigation-page wow fadeInUp">
                    <?php echo (isset($PaginationList)?$PaginationList:'') ?>
                </nav>
            </div>
        </div>
    </div>
</div>