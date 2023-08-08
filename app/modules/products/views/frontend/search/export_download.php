<div style="width: 800px;margin: 0 auto;" id="pnPCBuiltView">
    <table width="800">
        <tr>
            <td colspan="3" valign="top">
                <a href="<?php echo base_url()?>" target="_blank"><img src="<?php echo $this->fcSystem['homepage_logo1'] ?>"
                     alt="<?php echo $this->fcSystem['homepage_company'] ?>"/></a>
            </td>
            <td colspan="5" align="right" style="line-height: 19px;">
                <b style="color: #1B76BD;font-size: 20px;"><?php echo $this->fcSystem['homepage_company'] ?></b><br/>
                Địa chỉ: <?php echo $this->fcSystem['contact_phone'] ?><br>
                Email: <?php echo $this->fcSystem['contact_email'] ?><br/>
                Điện thoại: <?php echo $this->fcSystem['contact_address'] ?><br/>
                Hotline: <?php echo $this->fcSystem['contact_hotline'] ?> * Website: <?php echo base_url() ?>

            </td>
        </tr>
        <tr>
            <td colspan="8"></td>
        </tr>
        <tr>
            <td colspan="8"
                style="border-top: 4px double #ccc;;font-size:21px; font-weight:bold; text-align:center; padding:15px 0;">
                BÁO GIÁ BÁN HÀNG
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
    </table>
    <table width="800">
        <tr>
            <td colspan="5" align="left"></td>
            <td colspan="3" align="right">
                Ngày báo giá: <span id="price_time"><?php echo date('d-m-y')?></span>
            </td>
        </tr>
        <tr>
            <td colspan="5" align="left"></td>
            <td colspan="3" align="right">
                <i>Đơn vị tính: VNĐ</i>
            </td>
        </tr>
    </table>

    <div style="padding: 10px;"></div>

    <table width="800" class="list_table" border="1">
        <tr style="color: #ffffff; background-color:#1B76BD;">
            <td>STT</td>
            <td colspan="2">Tên sản phẩm</td>
            <td>ĐVT</td>
            <td>Đơn giá</td>
            <td>Số lượng</td>
            <td>Thành tiền</td>
            <td>Thông tin</td>

        </tr>


        <?php if (isset($listProduct) && is_array($listProduct) && count($listProduct)) {
            $i = 0;
            foreach ($listProduct as $key => $val) {
                $i++;

                $id = $val['id'];
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                $price = $val['price'];
                $saleoff = $val['saleoff'];
                $description = cutnchar(strip_tags($val['description']), 100);

                if ($price > 0) {
                    $pri_old = '<font>' . str_replace(',', '.', number_format($price)) . ' <sub>₫</sub></font>';
                } else {
                    $pri_old = '';
                }
                if ($saleoff > 0) {
                    $pri_sale = str_replace(',', '.', number_format($saleoff));
                } else {
                    $pri_sale = 'Liên hệ';
                }
                ?>

                <tr>
                    <input class="price" value="<?php echo $val['saleoff']*(int)$id_3[$key] ?>" type="hidden" data-amout="<?php echo (int)$id_3[$key] ?>">
                    <input class="amout" value="<?php echo (int)$id_3[$key] ?>" type="hidden">

                    <td><?php echo $i ?></td>
                    <td colspan="2"><a href="<?php echo $href ?>" target="_blank"><?php echo $title ?></a></td>
                    <td>chiếc</td>
                    <td><?php echo $pri_sale ?></td>
                    <td><?php echo $id_3[$key] ?></td>
                    <td><?php echo number_format($val['saleoff'] * (int)$id_3[$key]) ?></td>
                    <td><?php echo $description ?></td>

                </tr>
                <!--1-->

            <?php } ?>
        <?php } ?>


        <tr>
            <td colspan="5"></td>
            <td colspan="2" style="background:#b8cce4;">Tổng tiền</td>
            <td style="background:#b8cce4;"><p class="result"> </p></td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="2" style="background:#b8cce4;">Số lượng</td>
            <td style="background:#b8cce4;"><p  class="result_amout"> </p></td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="2" style="background:#b8cce4;">Tổng tiền thanh toán</td>
            <td style="background:#b8cce4;"><p  class="result"> </p></td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
    </table>

    <table width="800">
        <tr>
            <td colspan="8"><b>Quý khách lưu ý:</b>
                Giá trên đã bao gồm 10% VAT và phí vận chuyển<br>
                Điều kiện bảo hành:<br>
                -Bảo hành có giới hạn theo tiêu chuẩn nhà sản xuất<br>
                -Những điều kiện sau đây không được bảo hành:<br>
                +Hết hạn bảo hành<br>
                +Tem bảo hành gốc của nhà sản xuất, chủ hàng và công ty bị rách, phiếu bảo hành bị mất, bị sửa đổi, sai S/N hoặc ngày bảo hành ghi trên tem và phiếu BH không trùng nhau<br>
                +Hư hỏng do thiên tai, tai nạn, nguồn điện không ổn đinh, cháy, chập nổ, xước méo, gãy chân CPU, vỡ SATA HDD, bị biến dạng, nước vào...<br>
                -Hiệu lực của báo giá: Kể từ ngày báo giá đến ngày ………………<br>

            </td>
        </tr>
        <tr>
            <td colspan="8">
                Để biết thêm chi tiết, Quý khách vui lòng liên hệ qua tổng đài <?php echo $this->fcSystem['contact_hotline']?> hoặc email: <a href="mailto:<?php echo $this->fcSystem['contact_email']?>"><?php echo $this->fcSystem['contact_email']?></a>
            </td>
        </tr>
        <tr>
            <td colspan="8">Một lần nữa <?php echo $this->fcSystem['homepage_brandname']?> cảm ơn quý khách!</td>
        </tr>
    </table>

    <div style="text-align: center;padding: 20px 0;">
        <a onclick="printContent('pnPCBuiltView');" style="    width: 100px;
    display: inline-block;
    background: #1B76BD;
    border: 0px;" class="btn_orange">In đơn hàng</a>
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
        $('.amout').each(function() {
            calculateSumAmout();
        });

    });
    function calculateSum() {
        var sum = 0;

        $(".price").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        var sumnumber_format = number_format(sum, 0, '.', '.');
        $('.result').text(sumnumber_format);
    };
    function calculateSumAmout() {
        var sum = 0;
        $(".amout").each(function() {
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }

        });
        $('.result_amout').text(sum);
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