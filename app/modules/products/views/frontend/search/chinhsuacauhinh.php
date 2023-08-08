<div id="main" class="wrapper main-product">
    <div class="bres">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a>/</li>

                <li>Chỉnh sửa cấu hình máy</li>

            </ul>
        </div>
    </div>

    <section class="main-content"id="xaydungcauhinh">
        <div class="container">
            <div class="row">

                <div class="col-md-9 col-sm-9 col-xs-12" id="pc_part_process">
                    <!--                <div class="col-md-9 col-sm-9 col-xs-12">-->

                </div>

                <div class="col-xs-3" id="box-pc_part_select">
                    <?php $cauhinh = $this->session->userdata('cauhinh'); ?>
                    <?php if (!empty($cauhinh)): ?>
                        <?= $cauhinh ?>
                    <?php else: ?>
                        <h3 style="font-size: 24px;">Danh sách bạn đã chọn</h3>
                        <div id="pcbuilder_box" class="view-content">
                            <div id="pc_part_select">
                                <ul>
                                    <?php
                                        $danhmucsearch = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
                                        'select' => 'id, title, slug, canonical, images, lft, rgt,order',
                                        'where' => array('isaside' => 1, 'trash' => 0, 'publish' => 1, 'alanguage' => '' . $this->fc_lang . ''),
                                        'limit' => 100, 'order_by' => 'order asc, id desc'));
                                    ?>
                                    <?php 
                                        if (isset($danhmucsearch) && is_array($danhmucsearch) && count($danhmucsearch)) {
                                            foreach ($danhmucsearch as $key => $val) { ?>
                                                <li>
                                                    <a href="javascript:pcbuilder_go_step(<?php echo $val['order'] ?>)"><?php echo $val['order'] ?>
                                                        : <?php echo $val['title'] ?></a>

                                                    <div id="part_selected_<?php echo $val['order'] ?>"></div>
                                                </li>
                                            <?php }
                                        } 
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="view-title">
                            <p>Cấu hình - <a href="javascript:pcbuilder_viewpc()" style="color: #1b76bd;">Xem &amp; In</a></p>

                            <div id="pc_part_total_price"></div>
                        </div>
                     <?php endif ?>
                    
                   
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .title-buitl {
        background: #F4F4F4;
        padding: 5px 10px;
        margin-bottom: 15px;
    }

    .title-buitl h3 {
        margin: 0;
        font-size: 20px;
    }

    .title-buitl h3 a {
        margin: 0 0 0 5px;
        font-size: 13px;
    }

    div.view-content ul {
        padding: 0px;
        margin: 0px;
    }

    div.view-content ul li {
        padding-bottom: 7px;
        display: block;
        border-bottom: 1px dashed #d5d5d5;
        margin-bottom: 7px;
    }

    div.view-content ul li > a {
        font-size: 13px;
        text-transform: uppercase;
        display: block;
        color: #333;
    }

    div.view-content ul li div p {
        margin-bottom: 0px;
    }

    div.view-content ul li div p a {
        margin-bottom: 3px;
        color: #1b76bd;
    }

    div.view-content ul li div p b {
        color: Red;
        margin-right: 5px;
    }
</style>
<?php 
    $pc_part_id = $this->session->userdata('pc_part_id'); 
    $pc_total_price = $this->session->userdata('pc_total_price'); 
?>
<input type="hidden" id="pc_part_id" value="<?php echo !empty($pc_part_id) ? $pc_part_id : ','; ?>"/>
<input type="hidden" id="pcbuilder_step" value="1"/>
<input type="hidden" id="pcbuilder_step_back" value="0"/>
<input type="hidden" id="pc_total_price" value="<?php echo !empty($pc_total_price) ? $pc_total_price : 0; ?>"/>
<input type="hidden" id="attrsearch" value="0"/>

<script>
    function getval(sel)
    {
        $('#attrsearch').val(sel.value);
        pcbuilder_select_parts("pc_part_process");
    }
</script>
<script type="text/javascript">
    function load_filter() {
        $('#Formfilter').on('submit',function(e){
            var attr = $('#attr').val();
            var page = $('#page').val();
            var cataloguesid = $('#cataloguesid').val();
            var stepid = $('#stepid').val();
            var postData = $(this).serializeArray();
            var formURL = 'filter_product_selection.html';
            $.post(formURL, {
                    post: attr, page:page,cataloguesid:cataloguesid,stepid:stepid},
                function(data){
                    var json = JSON.parse(data);
                    if(json.html.length){
                        $('#dPro').html('').html(json.html);
                    }else{
                        $('#dPro').html('Không có dữ liệu phù hợp');
                    }

                });
            return false;
        });


        $('.filter').change(function(e){
            var str = '';
            $('.filter').each(function(){
                if($(this).val() != 0  && $(this).prop('checked') == true){
                    str = str + $(this).val() + '-';
                }
            });
            if(str.length > 0){
                str = str.substr(0, str.length - 1);
                $('#attr').val(str);
            }else{
                $('#attr').val('');
            }
            e.stopImmediatePropagation();
            $('#filter_submit').click();
        });

        $('input.filter').click(function() {
            var id = $(this).prop('id');
            var name = $(this).prop('name');
            $('input[name="'+name+'"]:not(#'+id+')').prop('checked',false);
        });
        $('.tpInputLabel').on('click', function() {
            var line = $(this).attr('data-line');
            $('.'+line+'').removeClass('checked');
            if($(this).find('.filter').is(':checked')) {
                $(this).addClass('checked');
            }else {
                $(this).removeClass('checked');
            }
        });
        $(document).on('click','#ajax-pagination li a',function(e){
            var page = $(this).attr('data-ci-pagination-page');
            $('#page').val(page);
            e.stopImmediatePropagation();
            $('#filter_submit').click();
            return false;
        });
    }

</script>


<script>

    function pcbuilder_viewpc() {
        data_cauhinh = '';
        var a = $("#pc_part_id").val();
        var pc_total_price = $("#pc_total_price").val();
        console.log(pc_total_price);
        if ($('#box-pc_part_select').length > 0) {
            data_cauhinh = $('#box-pc_part_select').html();
        }
        $.post("luu-tam-cau-hinh.html", {
            data_cauhinh: data_cauhinh,
            pc_part_id: a,
            pc_total_price: pc_total_price,
        }, function (data) {
            window.location = "xem-va-in-cau-hinh.html?str=" + a
        })
        
    };

    function pcbuilder_select_parts(a) {
        $("#" + a).html("<img src='/ajax/loader_large_blue.gif'>");
        var c = parseInt($("#pcbuilder_step_back").val());
        var b = parseInt($("#pcbuilder_step").val());
        var s = $("#attrsearch").val();
        var d = (c > 0) ? c : b;
        $.get("pcbuilder_product_selection.html", {
            holder: a,
            pc_part_id: $("#pc_part_id").val(),
            step: d,
            sort: s
        }, function (e) {
//            alert("#" + a);
            $("#" + a).html(e);
            load_filter();

        })
    }

    function pcbuilder_go_step(a) {
        $("#pcbuilder_step").val(a);
        pcbuilder_select_parts("pc_part_process");


    }

    function pcbuilder_next_step() {
        var a = parseInt($("#pcbuilder_step_back").val());
        if (a > 0) {
            $("#pcbuilder_step_back").val(0)
        }
        var c = $("#pcbuilder_step").val();
        if ($("#part_selected_" + c).html().length < 1) {
            $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ', 0, 0, 0)">Chọn lại</a>')
        }
        pcbuilder_go_step(parseInt(c) + 1)
    }

    function pcbuilder_select_part(d, h, c, l) {
        var amount = $("#amount_" + d).val();
//        alert(amount);
        var m = $("#price_" + d).val();
        var i = $("#name_" + d).val();
        var e = $("#url_" + d).val();
        var total = parseFloat(amount*m);
       // alert(total);
        var j = "";
        if ($("#part_selected_" + c).length == 0) {
            j += "<h2>" + c + ": " + l + ":</h2>";
            j += "<div id='part_selected_" + c + "'>";
            j += "<p class='cssName'><a href='" + e + "' target=_blank>" + i + "</a></p><p>Số lượng:"+ amount +"</p><p>Giá:"+ writeStringToPrice(m) +"VNĐ</p><p class='cssSelect'><b>" + writeStringToPrice(total + "") + " VNĐ</b>";
            j += "Số lượng:"+ amount;
            j += '<a href="javascript:pcbuilder_back_step(' + c + ", " + d + ", " + h + ", " + m + ')">Chọn lại</a> - <a href="javascript:pcbuilder_remove_part(' + c + ", " + d + ", " + h + ", " + m + ')">Xóa bỏ</a></p>';
            j += "</div>";
            $("#pc_part_select").append(j)
        } else {
            j += "<p class='cssName'><a href='" + e + "' target=_blank>" + i + "</a></p><p>Số lượng:"+ amount +"</p><p>Giá:"+ writeStringToPrice(m) +"VNĐ</p><p class='cssSelect'><b>(" + writeStringToPrice(total + "") + " VNĐ)</b>";

            j += '<a href="javascript:pcbuilder_back_step(' + c + ", " + d + ", " + h + ", " + m + ')">Chọn lại</a> - <a href="javascript:pcbuilder_remove_part(' + c + ", " + d + ", " + h + ", " + m + ')">Xóa bỏ</a></p>';
            $("#part_selected_" + c).html(j)
        }
        var g = $("#pc_part_id").val();

        var reg = new RegExp(",[0-9]*-[0-9]*t" + h + ",", 'g');
        var data_search = g.match(reg);
        if (data_search != null) {
            console.log(data_search[0]);
            if (Array.isArray(data_search)) {
                var k = g.replace(data_search[0], "," + d+ "-"+amount + "t" + h+ ",");
            }else{
                var k = g.replace(data_search, "," + d+ "-"+amount + "t" + h+ ",");
            }
        }else{
            var k = g + d+ "-"+amount + "t" + h+ ",";
        }

        $("#pc_part_id").val(k);
        var f = parseInt($("#pc_total_price").val()) + parseInt(total);
        $("#pc_total_price").val(f);
        $("#pc_part_total_price").html("<b>Tổng giá: <span style='color:red'>" + writeStringToPrice(f + "") + " VNĐ</span></b>");
        var b = parseInt($("#pcbuilder_step_back").val());
        var a = parseInt($("#pcbuilder_step").val());
        if (b > 0) {
            if (b > 0) {
                $("#pcbuilder_step_back").val(0)
            }
            pcbuilder_go_step(a)
        } else {
            pcbuilder_next_step()
        }
    }

    function pcbuilder_remove_part(c, b, g, f) {
        var d = $("#pc_part_id").val();
        var reg = new RegExp("," + b + "-[0-9]*t" + g + ",", 'g');
        var result = d.match(reg);
        var a = d;
        if (result != null) {
            var a = d.replace(result, ',');
        }
        $("#pc_part_id").val(a);
        $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ", " + b + ", " + g + ", " + f + ')">Chọn lại</a>');
        var e = parseInt($("#pc_total_price").val()) - parseInt(f);
        $("#pc_total_price").val(e);
        $("#pc_part_total_price").html("<b>Tổng giá: <span style='color:red'>" + writeStringToPrice(e + "") + " VNĐ</span></b>");
    }

    function pcbuilder_back_step(c, b, g, f) {
        var d = $("#pc_part_id").val();
        var reg = new RegExp("," + b + "-[0-9]*t" + g + ",", 'g');
        var result = d.match(reg);
        if (result != null) {
            var a = d.replace(result, ',');
            $("#pc_part_id").val(a);
            $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ", " + b + ", " + g + ", " + f + ')">Chọn lại</a>');
            var e = parseInt($("#pc_total_price").val()) - parseInt(f);
            $("#pc_total_price").val(e);
            $("#pc_part_total_price").html("<b>Tổng giá: <span style='color:red'>" + writeStringToPrice(e + "") + " VNĐ</span></b>");
        }
        $("#pcbuilder_step_back").val(c);
        pcbuilder_select_parts("pc_part_process");
    }
    
    // function pcbuilder_remove_part(c, b, g, f) {
    //     var d = $("#pc_part_id").val();
    //     var a = d.replace("," + b + "t" + g + ",", ",");
    //     $("#pc_part_id").val(a);
    //     $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ", " + b + ", " + g + ", " + f + ')">Chọn lại</a>');
    //     var e = parseInt($("#pc_total_price").val()) - parseInt(f);
    //     $("#pc_total_price").val(e);
    //     $("#pc_part_total_price").html("Tổng giá: " + writeStringToPrice(e + ""))
    // }

    // function pcbuilder_back_step(c, b, g, f) {
    //     var d = $("#pc_part_id").val();
    //     if (d.search("," + b + "t" + g + ",") != -1) {
    //         var a = d.replace("," + b + "t" + g + ",", ",");
    //         $("#pc_part_id").val(a);
    //         $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ", " + b + ", " + g + ", " + f + ')">Chọn lại</a>');
    //         var e = parseInt($("#pc_total_price").val()) - parseInt(f);
    //         $("#pc_total_price").val(e);
    //         $("#pc_part_total_price").html("Tổng giá: " + writeStringToPrice(e + ""))
    //     }
    //     $("#pcbuilder_step_back").val(c);
    //     pcbuilder_select_parts("pc_part_process")
    // }


    // function pcbuilder_back_step(c, b, g, f) {
    //     var d = $("#pc_part_id").val();
    //     var reg = new RegExp("," + d + "-[0-9]*t" + g + ",", 'g');
  		// var result = str.match(reg);
  		// if (result != null) {
  		// 	var a = d.replace("," + d + "t" + g + ",", result);
  		// }
    //     if (d.search("," + b + "t" + g + ",") != -1) {
    //         var a = d.replace("," + b + "t" + g + ",", ",");
    //         $("#pc_part_id").val(a);
    //         $("#part_selected_" + c).html('<a href="javascript:pcbuilder_back_step(' + c + ", " + b + ", " + g + ", " + f + ')">Chọn lại</a>');
    //         var e = parseInt($("#pc_total_price").val()) - parseInt(f);
    //         $("#pc_total_price").val(e);
    //         $("#pc_part_total_price").html("Tổng giá: " + writeStringToPrice(e + ""))
    //     }
    //     $("#pcbuilder_step_back").val(c);
    //     pcbuilder_select_parts("pc_part_process")
    // }

    // function pcbuilder_viewpc() {
    //     var a = $("#pc_part_id").val();
    //     window.location = "xem-va-in-cau-hinh.html?str=" + a
    // }
    // ;
    function pcbuilder_viewpc_mobile() {
        var a = $("#pc_part_id").val();
        window.location = "/xem-va-in-cau-hinh.html?str=" + a
    }
    ;
    pcbuilder_select_parts("pc_part_process");

    function writeStringToPrice(e) {
        var t = e.substr(0, e.length % 3);
        var n = e.replace(t, "");
        var r = n.length / 3;
        var i = "";
        for (var s = 0; s < r; s++) {
            group_of_three = n.substr(s * 3, 3);
            i += group_of_three;
            if (s != r - 1) i += ","
        }
        if (t.length > 0) {
            if (i != "") return t + "," + i;
            else return t
        } else {
            if (i != "") return i;
            else return ""
        }
    }
    function loadAjaxContent(e, t) {
        if ($("#anchor_top").length > 0) {
            var n = $("#anchor_top").offset();
            var r = n.top;
            $("html, body").animate({
                scrollTop: r
            }, 500)
        }
        $("#" + e).load(t);
    }
</script>

<!--search fillter-->
<style>
    .content_fillter {
        border: 1px solid #f0f0f0;
    }
    .attribute-title {
        line-height: 34px;
        padding: 0px 10px 0px !important;
        color: #333;
        border-bottom: solid 1px #ccc;
        text-shadow: 1px 1px 0 #fff;
        background: #eee;
        font-weight: bold;
        font-size: 16px;
    }
    .attribute-group .fillter-label {
        padding-left: 10px;
        display: block;
        line-height: 30px;
        font-size: 13px;
        position: relative;
        height: 30px;
        overflow: hidden;
    }


</style>
<script type="text/javascript" charset="utf-8" async defer>
    
    $('#xaydungcauhinh').on('click','.fillter_bl .content_fillter [class^="group-fillter fill-key-"] .attribute-title', function(e){

        e.preventDefault();

        if(jQuery(this).next().css('display') == 'none'){

            jQuery(this).next().css('display','block');

            jQuery(this).addClass('show');

        }else{

            jQuery(this).next().css('display','none');

            jQuery(this).removeClass('show');

        }

        return false;

    });
</script>