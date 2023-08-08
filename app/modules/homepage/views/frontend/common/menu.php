<?php $danhmuc = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,icon','where' => array('trash' => 0,'publish' => 1 , 'parentid' => 0,'alanguage' => ''.$this->fc_lang.''),'limit' => 13,'order_by' => 'order asc, id desc'));
    if(isset($danhmuc) && is_array($danhmuc) && count($danhmuc)){
        foreach($danhmuc as $key => $val){
            $danhmuc[$key]['child']  = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1, 'parentid' => $val['id'], 'alanguage' => ''.$this->fc_lang.''),'limit' => 60,'order_by' => 'order asc, id desc'));
        }
        foreach($danhmuc as $key => $val){
            foreach($val['child'] as $keyC => $valC){
                $danhmuc[$key]['child'][$keyC]['child']  = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1, 'parentid' => $valC['id'], 'alanguage' => ''.$this->fc_lang.''),'limit' => 60,'order_by' => 'order asc, id desc'));
            }
        }
    }
 ?>
<div class="category-menu">
    <div class="container-box-category">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 col-edit-1" style="display: none">
                <div class="relative-category" style="display: none">
                    <div class="top-category">
                        <h3 class="title-category">DANH MỤC SẢN PHẨM<i class="fa fa-bars"></i></h3>
                    </div>
                    <div class="nav-category-home <?php if(isset($nomenu)){ echo 'hello';} ?>" >
                        <?php if(isset($danhmuc) && is_array($danhmuc) && count($danhmuc)){ ?>
                        <ul>
                            <?php foreach ($danhmuc as $key => $val) {
                            $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues') ?>
                            <li>
                                <a href="<?php echo $href ?>"  style="<?php echo (isset($val['child']) && is_array($val['child']) && count($val['child'])) ? 'width: calc(100% - 30px);' : ''; ?>"><img src="<?php echo $val['icon'] ?>" alt="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a>

                                <?php if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
                                <i class="fa fa-plus css-icon-plus cssssss" style="max-width: 30px;"></i>
                                <div class="vertical-dropdown-menu">
                                    <div class="row">
                                       <div class="vertical-groups">
                                        <div class="mega-group">
                                           <!-- <h4 class="mega-group-header"><span>Thương hiệu</span></h4> -->
                                           <ul class="group-link-default">
                                            <?php foreach ($val['child'] as $key => $val1) {
                                            $hr = rewrite_url($val1['canonical'],$val1['slug'],$val1['id'],'products_catalogues') ?>
                                              <li><a href="<?php echo $hr ?>"><?php echo $val1['title'] ?></a></li>
                                            <?php } ?>
                                           </ul>
                                        </div>
                                     </div>
                                    </div>  
                                </div>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <?php 
            $camket = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description','where' => array('trash' => 0,'publish' => 1,'cataloguesid' => 71, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
             ?>
             <?php $top = navigations_array('top',$this->fc_lang) ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if(isset($top) && is_array($top) && count($top)){ ?>
                <div id="main-menu1">
                    <ul>
                        <li class="menu-item first-category-box">
                            <a>
                                <div class="nav_horizontal_item">
                                    <div class="nav_horizontal_text">
                                        <p class="newBigText">Danh mục sản phẩm <i class="fa fa-angle-down" aria-hidden="true"></i></p>
                                    </div>
                                </div>
                            </a>
                            <?php
                            if(isset($danhmuc) && is_array($danhmuc) && count($danhmuc)){
                                ?>
                                <div class="header-new-bot">
                                    <div class="list-content">
                                        <div class="item-n menu-main item-n-first">
                                            <ul class="menu-main-sub">
                                                <?php
                                                foreach ($danhmuc as $key => $val){
                                                    $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues');
                                                    $icon = $val['icon'];
                                                    $title = $val['title'];
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $href ?>" class="itop" style="background: url('<?php echo $icon ?>') no-repeat;"><?php echo $title ?></a>
                                                        <?php if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
                                                            <div class="box-sub-cat">
                                                                <?php
                                                                foreach ($val['child'] as $keyC => $valC){
                                                                    $hrefC = rewrite_url($valC['canonical'],$valC['slug'],$valC['id'],'products_catalogues');
                                                                    $titleC = $valC['title'];
                                                                    ?>
                                                                    <div class="box-cat">
                                                                        <a href="<?php echo $hrefC ?>" class="cat2"><?php echo $titleC?></a>
                                                                        <?php if(isset($valC['child']) && is_array($valC['child']) && count($valC['child'])){ ?>
                                                                            <?php foreach ($valC['child'] as $keyCC => $valCC){
                                                                                $hrefCC = rewrite_url($valCC['canonical'],$valCC['slug'],$valCC['id'],'products_catalogues');
                                                                                $titleCC = $valCC['title'];
                                                                                ?>
                                                                                <a href="<?php echo $hrefCC ?>" class="cat3"><?php echo $titleCC ?></a>
                                                                            <?php } } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                        <?php foreach ($top as $key => $val) { ?>
                        <li class="menu-item">
                            <a href="<?php echo $val['href'] ?>">
                                <div class="nav_horizontal_item">
                                    <div class="nav_horizontal_text">
                                      <p class="newBigText"><?php echo $val['title'] ?>
                                    </div>
                                </div>
                            </a>
                            <?php if (!empty($val[ 'child'])): ?>
                                <ul class="sub-menu">
                                    <?php foreach ($val[ 'child'] as $key => $value): ?>
                                        <li>
                                            <a href="<?php echo $value['href'] ?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a>
                                            <?php if (!empty($value[ 'child'])): ?>
                                                <i class="fal fa-angle-right"></i>
                                                <ul class="sub-menu level3">
                                                    <?php foreach ($value[ 'child'] as $key => $values): ?>
                                                        <li>
                                                            <a href="<?php echo $values['href'] ?>" title="<?php echo $values['title'] ?>"><?php echo $values['title'] ?></a>
                                                            
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            <?php endif ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- new -->
<?php
if(isset($danhmuc) && is_array($danhmuc) && count($danhmuc)){
?>
<div class="header-new-bot" style="display: none">
    <div class="list-content">
        <div class="item-n menu-main item-n-first">
            <ul class="menu-main-sub">
                <?php
                foreach ($danhmuc as $key => $val){
                    $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues');
                    $icon = $val['icon'];
                    $title = $val['title'];
                    ?>
                <li>
                    <a href="<?php echo $href ?>" class="itop" style="background: url('<?php echo $icon ?>') no-repeat;"><?php echo $title ?></a>
                    <?php if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
                    <div class="box-sub-cat">
                        <?php
                        foreach ($val['child'] as $keyC => $valC){
                        $hrefC = rewrite_url($valC['canonical'],$valC['slug'],$valC['id'],'products_catalogues');
                        $titleC = $valC['title'];
                        ?>
                        <div class="box-cat">
                            <a href="<?php echo $hrefC ?>" class="cat2"><?php echo $titleC?></a>
                            <?php if(isset($valC['child']) && is_array($valC['child']) && count($valC['child'])){ ?>
                                <?php foreach ($valC['child'] as $keyCC => $valCC){
                                $hrefCC = rewrite_url($valCC['canonical'],$valCC['slug'],$valCC['id'],'products_catalogues');
                                $titleCC = $valCC['title'];
                                ?>
                                <a href="<?php echo $hrefCC ?>" class="cat3"><?php echo $titleCC ?></a>
                            <?php } } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php } ?>
<style type="text/css">
    #main-menu1 ul li{
        position: relative;
    }
    #main-menu1 ul.sub-menu{
        display: none;
        position: absolute;
        width: 250px;
        background-color: #333333;
        top: 100%;
        z-index: 999999;
        margin-top: 0px;
        padding-top: 0px;
    }
    #main-menu1 ul.sub-menu i{
        float: right;
        color: #fff;
    }
    #main-menu1 ul.sub-menu.level3{
        top: 0%;
        left: 100%;
        display: none!important;
    }
    #main-menu1 ul.sub-menu li{
        padding: 10px 15px;
        border-bottom: 1px dashed #333333;
    }
    #main-menu1 ul.sub-menu li a{
        color: #fff;
    }
    #main-menu1 ul.sub-menu li{
        width: 100%;
    }

    #main-menu1 li:hover .sub-menu{
        display: block;
        padding-left: 0;
        list-style: none;
        background: #0676da;
    }
    #main-menu1 li:hover .sub-menu:hover{
        display: block;
    }
    #main-menu1 ul.sub-menu li:hover ul.sub-menu.level3{
        display: block!important;
    }
    .hello{
        display: block !important;
    }
    .css-icon-plus.cssssss{
        display: block;
    }
   /*  .nav-category-home ul li:hover i.css-icon-plus.cssssss:before{
        content: ;
    } */
</style>
<script type="text/javascript">
    $(document).ready(function(){
      $(".top-category").click(function(){
        $(".nav-category-home").slideToggle();
      });
    });
</script>