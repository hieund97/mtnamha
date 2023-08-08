<style type="text/css" media="screen">

</style>
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
<?php $customer = $this->config->item('fcCustomer'); ?>
<header id="header-site" class="header">
    <div class="wrapper cf">
        <nav id="main-nav">
            <?php $main_nav = navigations_array( 'main', $this->fc_lang); ?>
            <?php if(isset($main_nav) && is_array($main_nav) && count($main_nav)){ ?>
            <ul class="second-nav">
                <?php foreach ($main_nav as $key=> $val) { ?>
                <li class="devices">
                    <a href="<?php echo $val['href'] ?>">
                        <?php echo $val[ 'title'] ?>
                    </a>
                    <?php if(isset($val[ 'child']) && is_array($val[ 'child']) && count($val[ 'child'])){ ?>
                    <ul>
                        <?php foreach ($val[ 'child'] as $key=> $val1) { ?>
                        <li class="mobile">
                            <a href="<?php echo $val1['href'] ?>">
                                <?php echo $val1[ 'title'] ?>
                            </a>
                            <?php if(isset($val1[ 'child']) && is_array($val1[ 'child']) && count($val1[ 'child'])){ ?>
                            <ul>
                                <?php foreach ($val1[ 'child'] as $key=> $val2) { ?>
                                <li>
                                    <a href="<?php echo $val2['href'] ?>">
                                        <?php echo $val2[ 'title'] ?>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>

                <?php foreach ($danhmuc as $key=> $val) {
                    $href = rewrite_url($val['canonical'],$val['slug'],$val['id'],'products_catalogues');
                    ?>
                    <li class="devices">
                        <a href="<?php echo $href?>">
                            <?php echo $val[ 'title'] ?>
                        </a>
                        <?php if(isset($val[ 'child']) && is_array($val[ 'child']) && count($val[ 'child'])){ ?>
                            <ul>
                                <?php foreach ($val[ 'child'] as $key=> $val1) {
                                    $href1 = rewrite_url($val1['canonical'],$val1['slug'],$val1['id'],'products_catalogues');
                                    ?>
                                    <li class="mobile">
                                        <a href="<?php echo $href1 ?>">
                                            <?php echo $val1[ 'title'] ?>
                                        </a>
                                        <?php if(isset($val1[ 'child']) && is_array($val1[ 'child']) && count($val1[ 'child'])){ ?>
                                            <ul>
                                                <?php foreach ($val1[ 'child'] as $key=> $val2) {
                                                    $href2 = rewrite_url($val2['canonical'],$val2['slug'],$val2['id'],'products_catalogues');
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $href2 ?>">
                                                            <?php echo $val2[ 'title'] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php if (!isset($customer) || !is_array($customer) || count($customer) == 0) { ?>
                <li><a href="<?php echo site_url('login') ?>" rel="nofollow">Đăng ký</a>
                </li>
                <li><a href="<?php echo site_url('login') ?>" rel="nofollow">Đăng nhập</a>
                </li>
                <?php } else{ ?>
                    <li><a href="<?php echo site_url('profile'); ?>" rel="nofollow">Xin chào <?php echo $customer['fullname'] ?></a>
                    </li>
                    <li><a href="<?php echo site_url('logout') ?>" rel="nofollow">Đăng xuất</a>
                    </li>
                <?php } ?>


            </ul>
            <?php } ?>
        </nav>
        <a class="toggle">
            <span></span>
        </a>
    </div>
    <!-- end mobile -->
    <div class="top-header up-main">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12">
                    <div class="item-top left-top">
                        <?php $main_nav_header = navigations_array( 'menu-rank', $this->fc_lang); ?>
                        <?php if(isset($main_nav_header) && is_array($main_nav_header) && count($main_nav_header)){ ?>
                        <ul class="ho-tro">
                            <?php foreach ($main_nav_header as $key => $val){ ?>
                            <li><a href="<?php echo $val['href'] ?>"><?php echo $val['title'] ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <div class="item-top right-top">

                        <?php if (!isset($customer) || !is_array($customer) || count($customer) == 0) { ?>
                        <ul>
                            <li><a href="<?php echo site_url('login') ?>" rel="nofollow">Đăng ký</a>
                            </li>
                            <li><a href="<?php echo site_url('login') ?>" rel="nofollow">Đăng nhập</a>
                            </li>
                        </ul>
                        <?php } else { ?>
                            <ul>
                            <li><a href="<?php echo site_url('profile'); ?>" rel="nofollow">Xin chào <?php echo $customer['fullname'] ?></a>
                            </li>
                            <li><a href="<?php echo site_url('logout') ?>" rel="nofollow">Đăng xuất</a>
                            </li>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="up-main">
    	<div class="container">
    		<ul class="ho-tro">
	    		<li>
                    <i class="fa fa-mobile"></i><a href="#"> Hỗ trợ trực tuyến</a> 
                    <ul class="ht-child">
                        <li>
                            <div class="title"><?php echo $this->fcSystem['contact_links_map'] ?></div>
                        </li>
                    </ul>
                </li>
	    		<li><i class="fa fa-desktop fa-fw"></i> <a href="xay-dung-cau-hinh.html">Xây dựng cấu hình</a></li>
	    	</ul>
    	</div>
    	
    </div> -->
    <div class="main-logo-shop">
        <div class="container pd-10">
        	
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <a href="<?php echo base_url() ?>" class="logo"><img class="lazy" data-src="<?php echo $this->fcSystem['homepage_logo'] ?>" alt="<?php echo $this->fcSystem['homepage_company'] ?>">
                    </a>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="search-shop-holine">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="search">
                                    <form action="tim-kiem.html" method="get" id="searchForm" class="form">
                                        <input type="text" name="key" class="keyword" placeholder="Nhập từ khóa tìm kiếm">
                                        <input type="submit" value="Tìm kiếm">
                                        <div class="searchResult"></div>
                                    </form>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#searchForm').on('submit', function () {
                                        var keyword = $('.keyword').val();
                                        if (keyword == '') {
                                            alert('Bạn phải nhập từ khóa');
                                            return false;
                                        }
                                    });
                                });
                            </script>
                            <div class="col-md-2 col-6 col-xs-6 cart-mobile-order">
                                <div class="cart">
                                    <a href="dat-mua.html" rel="nofollow"><img class="lazy" data-src="templates/frontend/resources/images/shop.png" alt="">Giỏ hàng (<span class="stt" id="total-cart"><?php echo number_format($this->cart->total_items(),0,',','.') ?></span>)</a>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 col-xs-6">
                                <div class="holine">
                                    <span class="title-holine">Hotline</span>
                                    <span class="phone-holine"><?php echo $this->fcSystem['contact_hotline'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div id="main-menu">
        <div class="container">
            <?php if(isset($main_nav) && is_array($main_nav) && count($main_nav)){ ?>
            <ul>
                <?php foreach ($main_nav as $key => $val) { ?>
                <li>
                    <a href="<?php echo $val['href'] ?>"><?php echo $val['title'] ?></a>
                    <?php if(isset($val['child']) && is_array($val['child']) && count($val['child'])){ ?>
                    <ul class="sub-menu">
                        <?php foreach ($val['child'] as $key => $val1) { ?>
                        <li>
                            <a href="<?php echo $val1['href'] ?>"><?php echo $val1['title'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php $this->load->view('homepage/frontend/common/menu') ?>
            </div>
        </div>
    </div>
</header>