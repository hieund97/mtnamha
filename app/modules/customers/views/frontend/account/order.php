<style>
    body{background: #fff}
</style>
<section class="page-content" id="customers">
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
        <div class="container">
            <div class="relative">
                <ul class="nav nav-tabs">
                    <li class="<?php echo ($pageURL == site_url('profile')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('profile') ?>"><i class="fas fa-user-tie" aria-hidden="true"></i> Hồ sơ cá nhân</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('password')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('password') ?>"> <i class="fas fa-history" aria-hidden="true"></i> Đổi mật khẩu</a>
                    </li>
                    <li class="d-none d-lg-block <?php echo ($pageURL == site_url('list-post')) ? 'active' : '' ?>">
                        <a href="<?php echo site_url('list-post') ?>"> <i class="fas fa-coins" aria-hidden="true"></i> Đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="main-inner mt25">
                <div class="panel panel-default">
                    <div class="panel-heading"> <span style="font-weight: bold;"><i class="fas fa-history" aria-hidden="true"></i> Lịch sử đặt hàng </span> </div>
                    <div class="panel-body">
                        <?php if (isset($OrderList) && is_array($OrderList) && count($OrderList)) { ?>
                            <section class="order-list" style="overflow: auto;">
                                <table class="table table-striped table-table mb25 table-responsive">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày giao dịch</th>
                                        <th>Tình trạng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày cập nhật</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($OrderList as $key => $val): ?>

                                        <?php $price_gift = checkgiftcode_payment($val['discount_code'], $val['id']); ?>

                                        <?php $_payment_list_ = json_decode($val['data'], TRUE); ?>
                                        <?php $total_ship = 0; ?>
                                        <?php if (isset($_payment_list_) && is_array($_payment_list_) && count($_payment_list_)): ?>
                                            <?php foreach($_payment_list_ as $key => $item){ ?>
                                                <?php $total_ship += check_shipping_products($item['detail']['id'], $val['shipcode']); ?>
                                            <?php } ?>
                                        <?php endif ?>
                                        <tr>
                                            <td><?php echo ($key + 1) ?></td>
                                            <td><?php echo '#VAND'.($val['id'] + 100000) ?></td>
                                            <td><?php echo $val['quantity'] ?></td>
                                            <td><?php echo str_replace(',', '.', number_format($val['total_price'] + $total_ship - $price_gift)) ?> đ</td>
                                            <td><?php echo $val['created'] ?></td>
                                            <td>
                                                <button class="btn btn-white btn-sm btn-<?php echo $val['status'] ?>">
                                                    <?php echo $this->configbie->data('status', $val['status']) ?>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-white btn-sm <?php echo ((!empty($val['process'])) ? 'btn-success' : 'btn-danger') ?>">
                                                    <?php echo $this->configbie->data('process', $val['process']) ?>
                                                </button>
                                            </td>
                                            <td>
                                                <?php echo ((!empty($val['process'])) ? show_time($val['updated'], 'd-m-Y') : 'Chưa xác định') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </section>
                        <?php }else{ ?>
                            <div class="empty">Không tìm thấy kết quả nào.</div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .btn-opened, .btn-wait {background: #dd4b39; color:#fff;}
    .btn-processing {background: #f4c58f;color: #815621 !important; }
    .btn-success{background: #75a630; color:#fff}
    .btn-cancle{background: #333; color:#fff}
</style>