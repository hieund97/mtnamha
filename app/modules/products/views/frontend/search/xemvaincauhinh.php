<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="pnPCBuiltView" style="margin:15px auto 0;">

                <h2 class="text-center" style="font-size:24px;color: #000;font-weight: bold">Cấu hình đã chọn</h2>

                <div style="padding-top:0">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr style="background:#f4f4f4">
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Sản phẩm</th>
                            
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody class="price_slae">


                        <?php if (isset($listProduct) && is_array($listProduct) && count($listProduct)) {
                           $i=0; foreach ($listProduct as $key => $val) { $i++;

                                $id = $val['id'];
                                $title = $val['title'];
                                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                                $price = $val['price'];
                                $saleoff = $val['saleoff'];
                                if ($price > 0) {
                                    $pri_old = '<font>' . str_replace(',', '.', number_format($price)) . ' <sub>₫</sub></font>';
                                } else {
                                    $pri_old = '';
                                }
                                if ($saleoff > 0) {
                                    $pri_sale = str_replace(',', '.', number_format($saleoff)) . 'VNĐ';
                                } else {
                                    $pri_sale = 'Liên hệ';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td ><img
                                            style="max-width:100px;max-height:100px"
                                            src="<?php echo base_url($val['images']) ?>" alt="<?php echo $title ?>"></td>
                                    <td>
                                        <h2><a style="font-size:14px;font-weight:700"
                                               href="<?php echo $href?>"
                                               target="_blank"><?php echo $title ?></a></h2>

                                        <p class="p-built"><?php echo strip_tags($val['description']) ?> </p>

                                    </td>
                                    <td>
                                        <?php echo $id_3[$val['id']]?>
                                    </td>
                                    <td>
                                       
                                        <p><?php echo $pri_sale?> VNĐ</p>
                                       
                                    </td>
                                    <td>
                                    	 <input class="price" value="<?php echo $val['saleoff']*(int)$id_3[$val['id']] ?>" type="hidden">
                                    	  <p style="color: red;font-weight: bold"><?php echo number_format($val['saleoff']*(int)$id_3[$val['id']]) ?> VNĐ</p>
                                    </td>
                                    
                                </tr>

                            <?php } ?>
                        <?php } ?>


                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-xs-7 text-right text-sm-left">
                            <a id="btnCartA" class="btn btn-danger" href="chinh-sua-cau-hinh.html"
                               style="border-radius:0">Chỉnh sửa cấu hình</a>
                            <a id="btnCartA" class="btn btn-danger" href="xem-va-in-cau-hinh-redirect.html?str=<?php echo $this->input->get('str');?>"
                               style="border-radius:0">Đặt hàng</a>
<!--                            <a class="printPage btn btn-danger" style="border-radius:0" onclick="printContent('pnPCBuiltView');">In cấu hình</a>-->
                            <a class="printPage btn btn-danger" style="border-radius:0" href="export_download?str=<?php echo $this->input->get('str');?>" target="_blank">Xem và in cấu hình</a>
                        </div>
                        <div class="col-xs-5 text-right text-sm-left">
                            <div class="total-box" id="totalPoints">
                                <h2 style="margin:0;padding:0;border:none;font-size:14px">Tổng thành tiền: <b style="color:red" id="result"> </b></h2>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

<script>
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        var enteredtext = $('#text').val();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        $('#text').html(enteredtext);
    }
</script>
<script>
    $(document).ready(function(){
        $('.price').each(function() {
            calculateSum();
        });
    });
    function calculateSum() {
        var sum = 0;
        var sum1 = 0;
        $(".price").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        var sumnumber_format = number_format(sum, 0, '.', '.');
        $('#result').text(sumnumber_format+' VNĐ');
    };
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
