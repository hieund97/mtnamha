<style>
    .opened {font-weight: bold; font-size: 10px !important; padding: 3px 10px;background: #ed1830;color: #fff;border-radius: 5px;}
    .processing {font-weight: bold;font-size: 10px !important; padding: 3px 10px;background: #f4c58f;color: #815621 !important; border-radius: 5px;}
    .success{font-weight: bold; font-size: 10px !important;padding: 3px 10px; background: #75a630;color: #fff;border-radius: 5px;}
    .cancle{font-weight: bold; font-size: 10px !important;padding: 3px 10px; background: #333;color: #fff;border-radius: 5px;}

    .confirm {font-weight: bold; font-size: 10px !important;padding: 3px 10px; border-radius: 5px;}
    .confirm.no {background: #e5f2ce;color: #4b6319 !important;}
    .confirm.yes {background: #f7f7f7;  color: #777 !important;}
    body{background: #fff}
    .main-content.management-lading table img {height: 50px;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: #555;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
        cursor: default;
    }
</style>
<div class="uk-grid uk-grid-collapse container pd-10">
    <?php

    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
        $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }

    ?>
    <div class="top_barr customers-tabs_">
        <div class="container-box">
            <div class="relative">
                <ul class="nav nav-tabs mb-flex">
                    <li class="<?php echo ($pageURL == site_url('profile')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('profile') ?>"><i class="fas fa-user-tie" aria-hidden="true"></i> Hồ sơ cá nhân</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('password')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('password') ?>"> <i class="fas fa-history" aria-hidden="true"></i> Đổi mật khẩu</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('list-post')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('list-post') ?>"> <i class="fas fa-coins" aria-hidden="true"></i> Đơn hàng</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('logout')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('logout') ?>"> <i class="fas fa-coins" aria-hidden="true"></i> Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="uk-width-medium-4-5 uk-width-large-5-6">
        <div class="wrap-content">
            <div class="main-content management-lading">
                <div class="navbar-status mb15">
                    <ul class="uk-list uk-clearfix">
<!--                        <li class="item active"><a href="" class="link" title="">Tất cả (1)</a></li>-->
                        <!--<li class="item"><a href="" class="link" title="">Chờ Duyệt (0)</a></li>
                        <li class="item"><a href="" class="link" title="">Đã duyệt (0)</a></li>
                        <li class="item"><a href="" class="link" title="">Đang phát hàng (0)</a></li>
                        <li class="item"><a href="" class="link" title="">Phát thành công (0)</a></li>
                        <li class="item"><a href="" class="link" title="">Chuyển hoàn (0)</a></li>
                        <li class="item"><a href="" class="link" title="">Hủy đơn hàng (0)</a></li>-->
                    </ul>
                </div>
                <form action="" method="" class="form">
                    <div class="table-detail mb15">
                        <div class="uk-overflow-container">
                            <table class="table uk-table">
                                <thead>
                                <tr>
<!--                                    <th class="col-150">Stt</th>-->
                                    <th class="col-150">Ảnh</th>
                                    <th class="col-main">Sản phẩm</th>
                                    <th class="col-200">Thông tin</th>
                                    <th class="col-150">Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($ListDetail) && is_array($ListDetail) && count($ListDetail)){ ?>
                                    <?php $tong = 0; foreach($ListDetail as $key => $val){ ?>


                                        <?php $product = $this->FrontendProducts_Model->ReadByField('id', $val['productsid']); ?>
                                        <?php
                                        $title = $product['title'];
                                        $href = rewrite_url($product['canonical'], $product['slug'], $product['id'], 'products');
                                        ?>
                                        <tr>
<!--                                            <td class="uk-text-center">-->
<!--                                                --><?php //echo $key + 1;  ?>
<!--                                            </td>-->
                                            <td class="uk-text-center">
                                                <a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="ec-scaledow" style="height:100px;"><img src="<?php echo $product['images']; ?>" alt="<?php echo $title; ?>" /></a>
                                            </td>
                                            <td class="">
                                                <?php echo $product['title']; ?>
                                            </td>
                                            <td class="uk-text-right">
                                                <?php echo $val['quantity'] ?> x <?php echo str_replace(',','.',number_format($val['price'])); ?>
                                            </td>
                                            <td class="uk-text-right">
                                                <?php echo str_replace(',','.',number_format($val['quantity']*$val['price'])); ?> đ
                                            </td>
                                        </tr>
                                        <?php $tong = $tong + ($val['price']*$val['quantity']); ?>
                                    <?php }} ?>
                                <tr>
                                    <td colspan="3">Tổng</td>
                                    <td class="uk-text-right"><?php echo str_replace(',','.',number_format($tong)); ?> đ</td>
                                </tr>
                                </tbody>
                            </table><!-- .table -->
                        </div>
                    </div>
                </form><!-- .form -->
            </div><!-- .management-lading -->
        </div><!-- .main-content -->
    </div>
</div><!-- .uk-grid  -->
</div><!-- #body -->
<div id="send-contact" class="uk-modal modal">
    <div class="uk-modal-dialog">
        <form action="" class="uk-form form">
            <div class="modal-head">
                <div class="title uk-text-center">Gửi yêu cầu khiếu nại</div>
                <a class="uk-modal-close uk-close close-modal"></a>
            </div>
            <div class="modal-content">
                <div class="row mb15">
                    <select name="" class="uk-width-1-1 select">
                        <option value="">Chọn tiêu đề để gửi yêu cầu</option>
                        <option value="">Báo lấy hàng/lấy lại hàng</option>
                        <option value="">Báo giao hàng/phát gấp</option>
                        <option value="">Báo chuyển hoàn</option>
                        <option value="">Báo phát tiếp</option>
                        <option value="">Không cập nhật trạng thái đơn hàng</option>
                        <option value="">Phản ánh về bưu tá</option>
                    </select>
                </div>
                <div class="row mb30">
                    <label class="label mb5">Nội dung khách hàng yêu cầu hoặc góp ý</label>
                    <textarea name="" name="" class="uk-width-1-1 textarea"></textarea>
                </div>
                <div class="row action uk-text-right">
                    <div class="uk-flex-inline uk-flex-middle">
                        <input type="submit" value="Gửi yêu cầu" class="uk-button btn confirm">
                        <a href="" title="" class="uk-button btn cancel">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div><!-- .modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.lading-costs .label-insurrance').click(function() {
            if($('.lading-costs #input-insurrance').is(':checked')) {
                $('.lading-costs .insurrance').show();
            }else {$('.lading-costs .insurrance').hide();}
        });
    });
</script>