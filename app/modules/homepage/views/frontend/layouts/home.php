<!DOCTYPE html>
<html>
<head>
<base href="<?php echo base_url();?>" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="vi" />
<link rel="alternate" href="<?php echo base_url();?>" hreflang="vi-vn" />
<meta name="robots" content="index,follow" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="author" content="<?php echo getSystem('homepage_brandname');?>" />
<meta name="copyright" content="<?php echo getSystem('homepage_brandname');?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta http-equiv="refresh" content="1800" />

<!-- for Google -->
<title><?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?></title>
<meta name="keywords" content="<?php echo isset($meta_keyword)?htmlspecialchars($meta_keyword):'';?>" />
<meta name="description" content="<?php echo isset($meta_description)?htmlspecialchars($meta_description):'';?>" />
<meta name="revisit-after" content="1 days">
<meta name="rating" content="general">
<?php echo isset($canonical)?'<link rel="canonical" href="'.str_replace('http://', 'https://', $canonical).'" />':'';?>

<!-- for Facebook -->
<meta property="og:title" content="<?php echo (isset($meta_title) && !empty($meta_title))?htmlspecialchars($meta_title):'';?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo (isset($meta_images) && !empty($meta_images))?$meta_images:base_url(getSystem('seo_meta_image'));?>" />
<?php echo isset($canonical)?'<meta property="og:url" content="'.str_replace('http://', 'https://', $canonical).'" />':'';?>
<meta property="og:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
<meta property="og:site_name" content="<?php echo getSystem('homepage_brandname');?>" />
<meta property="fb:admins" content="<?php echo getSystem('system_fbadmins');?>"/>
<meta property="fb:app_id" content="<?php echo getSystem('system_fbappid');?>" />

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?>" />
<meta name="twitter:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
<meta name="twitter:image" content="<?php echo (isset($meta_images) && !empty($meta_images))?$meta_images:base_url(getSystem('seo_meta_image'));?>" />
<link rel="icon" href="<?php echo $this->fcSystem['homepage_favicon']; ?>"  type="image/png" sizes="30x30">
<?php $this->load->view('homepage/frontend/common/head'); ?>
<?php echo $this->fcSystem['script_header']; ?>
<script type="text/javascript">
	var BASE_URL = '<?php echo base_url('','https'); ?>';
</script>

</head>
<body>   
	<div class="page-body-buong">
		<?php echo $this->fcSystem['script_body']; ?>
		<?php $this->load->view('homepage/frontend/common/header'); ?>
		<?php echo show_flashdata_frontend(); ?>
		<?php $this->load->view(isset($template) ? $template : ''); ?>
		<?php $this->load->view('homepage/frontend/common/footer'); ?>
        <div id="show_success_mss" style="position: fixed; top: 150px; right: 20px;z-index: 99999">
        <!-- <?php if ($this->session->flashdata('message-success')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('message-success'); ?>
            </div>
        <?php } ?> -->
    </div>


<!-- Load Facebook SDK for JavaScript -->
<!--      <div id="fb-root"></div>-->
<!--      <script>-->
<!--        window.fbAsyncInit = function() {-->
<!--          FB.init({-->
<!--            xfbml            : true,-->
<!--            version          : 'v4.0'-->
<!--          });-->
<!--        };-->
<!---->
<!--        (function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--      }(document, 'script', 'facebook-jssdk'));</script>-->

      <!-- Your customer chat code -->
<!--      <div class="fb-customerchat"-->
<!--        attribution=setup_tool-->
<!--        page_id="165562137174332">-->
<!--      </div>-->

<!-- Facebook Pixel Code -->
<!--<script>-->
<!--  !function(f,b,e,v,n,t,s)-->
<!--  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?-->
<!--  n.callMethod.apply(n,arguments):n.queue.push(arguments)};-->
<!--  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';-->
<!--  n.queue=[];t=b.createElement(e);t.async=!0;-->
<!--  t.src=v;s=b.getElementsByTagName(e)[0];-->
<!--  s.parentNode.insertBefore(t,s)}(window, document,'script',-->
<!--  'https://connect.facebook.net/en_US/fbevents.js');-->
<!--  fbq('init', '893478067706055');-->
<!--  fbq('track', 'PageView');-->
<!--</script>-->
<!--<noscript><img height="1" width="1" style="display:none"-->
<!--  src="https://www.facebook.com/tr?id=893478067706055&ev=PageView&noscript=1"-->
<!--/></noscript>-->
<!-- End Facebook Pixel Code -->

    <div id="modal-cart" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="max-width:768px;">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="cart-content"></div>
                </div>
            </div>
        </div>
    </div>











    </div>
	<?php $this->load->view('homepage/frontend/common/script'); ?>
    <script>
        (function () {
            function logElementEvent(eventName, element) {
                console.log(Date.now(), eventName, element.getAttribute("data-src"));
            }

            var callback_enter = function (element) {
                logElementEvent("🔑 ENTERED", element);
            };
            var callback_exit = function (element) {
                logElementEvent("🚪 EXITED", element);
            };
            var callback_loading = function (element) {
                logElementEvent("⌚ LOADING", element);
            };
            var callback_loaded = function (element) {
                logElementEvent("👍 LOADED", element);
            };
            var callback_error = function (element) {
                logElementEvent("💀 ERROR", element);
                element.src =
                    "https://via.placeholder.com/440x560/?text=Error+Placeholder";
            };
            var callback_finish = function () {
                logElementEvent("✔️ FINISHED", document.documentElement);
            };
            var callback_cancel = function (element) {
                logElementEvent("🔥 CANCEL", element);
            };

            var ll = new LazyLoad({
                threshold: 0,
                // Assign the callbacks defined above
                // callback_enter: callback_enter,
                // callback_exit: callback_exit,
                // callback_cancel: callback_cancel,
                // callback_loading: callback_loading,
                // callback_loaded: callback_loaded,
                // callback_error: callback_error,
                // callback_finish: callback_finish
            });
        })();
    </script>
<script type="text/javascript">
    $(document).ready(function () {
            $('.ajax-addtocart').click(function(){
                // alert('ss')
                var product = $(this);
                //$.post('<?php //echo site_url("products/ajax/cart/addtocart",'http');?>//', {
                $.post('<?php echo site_url("products/ajax/cart/addtocart");?>', {
                    id : product.attr('data-id'),
                    quantity : product.attr('data-quantity'),
                },function(data){
                    if(product.attr('data-redirect') == 'redirect'){
                        window.location.href = BASE_URL + 'dat-mua' + '.html';
                    }else{
                        var json = JSON.parse(data);
                        $('#modal-cart .cart-content').html(json.html);
                        $('.cart-item .count').html(json.item);
                        $('#total-cart').html(json.item);
                        $('#modal-cart').modal('toggle');
                    }
                });
                return false;
            });
            if ($('.btn-up')) {
                $('.btn-up').click(function () {
                    var $_input = $(this).parent().find('.quantity');
                    var quantity = parseInt($_input.val());
                    if (quantity <= 1) {
                        quantity = 1;
                    } else {
                        quantity -= 1;
                    }
                    $_input.val(quantity);
                    $('.action-button.ajax-addtocart').attr('data-quantity', quantity);
                });
            }
            if ($('.btn-down')) {
                $('.btn-down').click(function () {
                    var $_input = $(this).parent().find('.quantity');
                    var quantity = parseInt($_input.val());
                    quantity += 1;
                    $_input.val(quantity);
                    $('.action-button.ajax-addtocart').attr('data-quantity', quantity);
                });
            }
            $(document).on('click', '#ec-module-cart .augment', function () {
                var item = $(this);
                var quantity = parseInt($(this).parent().find('.quantity').val());
                quantity = quantity + 1;
                item.parent().find('.quantity').val(quantity);
                ajax_cart_update();
                return false;
            });
            $(document).on('click', '#ec-module-cart .abate', function () {
                $(".panel-foot1").hide();
                $(".panel-foot2").show();
            })
            $(document).on('click', '#ec-module-cart .augment', function () {
                $(".panel-foot1").hide();
                $(".panel-foot2").show();
            })
            $(document).on('click', '#ec-module-cart .abate', function () {
                var item = $(this);
                var quantity = parseInt($(this).parent().find('.quantity').val());
                if (quantity <= 1) {
                    quantity = 1
                } else {
                    quantity = quantity - 1;
                }
                item.parent().find('.quantity').val(quantity);
                ajax_cart_update();
                return false;
            });

            $(document).on('click', '#ec-module-cart .delete', function () {
                var item = $(this);
                item.parent().parent().parent().parent().parent().find('.quantity').val(0);
                item.parent().parent().parent().parent().parent().addClass('uk-hidden').removeClass('item');
                ajax_cart_update();
                return false;
            });
            $(document).on('click', '#ec-module-cart .delete', function () {
                $(".panel-foot1").hide();
                $(".panel-foot2").show();
            })
            $(document).on('click', '.ec-cart-continue', function () {
                UIkit.modal('#modal-cart').hide();
                return false;
            });

            $('.augment').click(function () {
                var num_order = parseInt($(this).parent().find('.quantity').val());
                num_order += 1;
                $(this).parent().find('.quantity').val(num_order);
            });
            $('.abate').click(function () {
                var cart_class = $(this).attr('data-cart');
                var num_order = parseInt($(this).parent().find('.quantity').val());
                if (num_order <= 1) {
                    num_order = 1
                } else {
                    num_order -= 1;
                }
                $(this).parent().find('.quantity').val(num_order);
            });

            $(document).on('click', '.delete_item', function () {
                var item = $(this);
                var idprd = item.parent().parent().parent().parent().find('.quantity').val();
                ajax_cart_update1(idprd);
                return false;
            });

        });
        function ajax_cart_update1(idprd) {
            $.post('<?php echo site_url("products/ajax/cart/deletecart");?>', {idprd: idprd}, function (data) {
                window.location.href = 'dat-mua.html';
            });
        }

        function ajax_cart_update() {
            $.post('<?php echo site_url("products/ajax/cart/updatetocart");?>', $('#ajax-cart-form').serialize(), function (data) {
                var price = JSON.parse(data);
                $('#ajax-cart-form').html(price.html);
                $('#total-cart').html(price.item);
            });
            return false;
        }
        $(function () {
            $('.label-star').on('click', function () {
                var value = $(this).attr('data-value');
                $('#hidden_star').attr('data-star', value);
            });

            $('#commentForm').on('submit', function () {
                var postData = $(this).serializeArray();
                var formURL = $(this).attr('action');
                var fullname = $('#fullname').val();
                var phone = $('#phone').val();
                var message = $('#message').val();
                var star = $('#hidden_star').attr('data-star');
                var module = $('#hidden_star').attr('data-module');
                var moduleid = $('#hidden_star').attr('data-module-id');
                var html = '';
                $.post(formURL, {
                        post: postData,
                        fullname: fullname,
                        phone: phone,
                        message: message,
                        star: star,
                        module: module,
                        moduleid: moduleid
                    },
                    function (data) {
                        var json = JSON.parse(data);
                        if (json.error.length > 0) {
                            $('.validate_error').html(json.error);
                        } else {
                            $('#commentlist').html(json.result);
                        }
                        return false;
                    });
                return false;
            });
        });
        //end
    
        $(document).ready(function() {
			var time;
			$('.keyword').on('keyup', function() {
			var keyword = $(this).val();
			var numberKey = keyword.length;
			if(numberKey >=2) {
				clearTimeout(time);
				time = setTimeout(function() {
					$.ajax({
						url: 'searchs/ajax/searchs/search',
						method: 'POST',
						dataType: 'JSON',
						data: {keyword:keyword},
						complete: function(data) {
						console.log(data.responseText);
						if(data.responseText.length > 0) {
							$('.header .searchResult').show();
							$('.header .searchResult').html(data.responseText);
						}

					}
				});
				}, 100);
				}else {
				$('.header .searchResult').hide();
				}
			});
		});

	</script>
    <style type="text/css">
        .buynow-2 {max-width:740px;margin:0 auto;background:#fff;}
        .buynow-2 .panel-head.mb15 {padding-right: 15px;margin-bottom: 20px;}
        .buynow-2 .heading{position:relative;cursor:pointer;padding-left:40px;line-height: 0;margin: 0;}
        .buynow-2 .heading:before{content:"";position:absolute;width:22px;height:20px;left:10px;top:0;background-image:url(templates/backend/images/spritesheet.png);background-repeat:no-repeat;background-position:-459px -360px}
        .buynow-2 .heading .text{display:inline-block;font-size:14px;line-height:20px;font-weight:600;color:#555}
        .buynow-2 .heading .text:hover{color:#0388cd}
        .buynow-2 .panel-body{padding: 0;}
        .buynow-2 .list-cart-heading{width:100%;background:#f7f7f7;font-size:12px;color:#333;padding:0}
        .buynow-2 .list-cart-heading .item{float:left;padding: 10px 15px;text-transform:none;font-weight: bold}
        .buynow-2 .list-cart-heading .item+.item{border-left:1px solid #fff}
        .buynow-2 .list-cart-heading .product,
        .buynow-2 .list-order .product{width:330px}
        .buynow-2 .list-cart-heading .price,
        .buynow-2 .list-order .price{width:130px}
        .buynow-2 .list-cart-heading .count,
        .buynow-2 .list-order .count{width:114px}
        .buynow-2 .list-cart-heading .prices,
        .buynow-2 .list-order .prices{width:130px}
        .buynow-2 .list-order>.item{padding:15px 0}
        .buynow-2 .list-order>.item+.item{border-top:1px dotted #ccc}
        .buynow-2 .list-order .product .thumb{width:80px;border:1px solid #d8d8d8}
        .buynow-2 .list-order .price,.buynow-2 .list-order .prices{padding-right:15px;font-size:12px;font-weight:700}
        .buynow-2 .list-order .prices span{font-size: 12px;margin-bottom: 5px;display:block}
        .buynow-2 .list-order .prices span.old {text-decoration: line-through;font-weight: normal;color: #777;font-style: italic;}
        .buynow-2 .list-order .prices span.saleoff {color: #fff;padding: 5px;display: inline-block;background-color: #c80000;border-radius: 5px;font-size: 11px;}
        .buynow-2 .list-order .list-item-cart>*{float:left}
        .buynow-2 .list-order .product .info{width:250px;padding:0 15px}
        .buynow-2 .list-order .product .info .title{font-size:13px;line-height:18px;font-weight:700}
        .buynow-2 .list-order .product .info .title .link{color:#333;font-size:12px}
        .buynow-2 .list-order .product .info .title .link:hover{color:#0388cd}
        .buynow-2 .list-order .product .delete{border:none;background:#fff;font-size:11px;color:#6f0600;cursor:pointer;padding: 0}
        .buynow-2 .list-order .product .delete i{color:#959595;margin-right:5px}
        .buynow-2 .list-order .price .old{text-decoration:line-through;color:#959595;font-weight:400}
        .buynow-2 .list-order .price .saleoff{color:#d60c0c;font-weight:400}
        .buynow-2 .list-order .count{text-align:center}
        .buynow-2 .list-order .count>*{display:inline-block;position: relative;}
        .buynow-2 .list-order .count .btns{position:absolute;width:30px;height:30px;border:1px solid #dfdfdf;top:0;cursor:pointer}
        .buynow-2 .list-order .count .abate:before,
        .buynow-2 .list-order .count .augment:before{width:12px;height:2px;margin:14px auto;content:"";display:block}
        .buynow-2 .list-order .count .abate{left:-30px;border-right:none}
        .buynow-2 .list-order .count .abate:before{background:#ccc}
        .buynow-2 .list-order .count .augment{right:-30px;border-left:none}
        .buynow-2 .list-order .count .augment:before{background:#288ad6}
        .buynow-2 .list-order .count .augment:after{content:"";width:2px;height:12px;background:#288ad6;display:block;margin:0 auto;position:absolute;top:9px;left:0;right:0}
        .buynow-2 .list-order .count .quantity{width:30px;height:30px;text-align:center;font-size: 12px;border:1px solid #dfdfdf}
        .buynow-2 .panel-foot{padding:15px 0px 0;font-size:14px;line-height:20px;color:#333;border-top:1px solid #eee}
        .buynow-2 .panel-foot .total .price strong{color:#d60c0c}
        .buynow-2 .panel-foot .total p{font-size:13px}
        .buynow-2 .panel-foot .action .continue {font-size: 13px;color: #0388cd;background-color: #f8f8f8;border: 1px solid #e8e8e8;line-height: 30px;padding: 0 10px;border-radius: 2px;cursor: pointer;}
        .buynow-2 .panel-foot .action .purchase{display:block;position:relative;padding:8px 40px 8px 20px;background:#d60c0c;color:#fff;border:none;font-size:13px;line-height:20px;font-weight:700;cursor:pointer;border-radius:4px}
        .buynow-2 .panel-foot .action .purchase:after{content:"";display:block;position:absolute;width:12px;height:8px;background:url(templates/backend/images/spritesheet.png) -264px -81px no-repeat;top:14px;right:15px}
        #scrrolbar{max-height:320px}
        #scrrolbar::-webkit-scrollbar{height:100%;width:6px}
        #scrrolbar::-webkit-scrollbar-thumb{background:#ccc;height:10px;width:7px;border-radius:3px}
        #modal-cart .uk-modal-dialog{width:740px!important;padding:20px 0 10px!important}
        #modal-cart .uk-modal-dialog>.uk-close:first-child{margin:-16px -15px 0 0}
        .action.uk-flex.uk-flex-middle.uk-flex-space-between {width: 100%;}
        .cart-scrrolbar {max-height: 320px;overflow: auto;}
        .cart-scrrolbar::-webkit-scrollbar {height: 100%; width: 6px;}
        .cart-scrrolbar::-webkit-scrollbar-thumb { background: #ccc; height: 10px; width: 7px; border-radius: 3px; }
        #scrollbar {min-width: 700px;}
        .mt-scaledown, .mt-scaledown img{width: 100%; height: 100%;display: block;}
        .mt-scaledown img{object-fit: scale-down}
        #modal-cart .modal-dialog {margin: 0; width: 100%; position:  absolute;top: 50%;left: 50%;-webkit-transform: translate(-50%, -50%);-moz-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);-o-transform: translate(-50%, -50%);transform: translate(-50%, -50%);}
        .mt-flex {display: -ms-flexbox; display: -webkit-flex; display: flex }
        .mt-flex-middle {-ms-flex-align: center; -webkit-align-items: center; align-items: center }
        .mt-flex-bottom {-ms-flex-align: end; -webkit-align-items: flex-end; align-items: flex-end }
        .mt-flex-center {-ms-flex-pack: center; -webkit-justify-content: center; justify-content: center }
        .mt-flex-right {-ms-flex-pack: end; -webkit-justify-content: flex-end; justify-content: flex-end }
        .mt-flex-space-between {-ms-flex-pack: justify; -webkit-justify-content: space-between; justify-content: space-between }
        .mt-clearfix:after {content: ""; clear: both; display: block; }
        .mt-clearfix {clear: both;padding: 0 }
        .uk-list li{list-style: none;}
    </style>

<!--<div id="fb-root"></div>-->
<!--<script>(function(d, s, id) {-->
<!--  var js, fjs = d.getElementsByTagName(s)[0];-->
<!--  if (d.getElementById(id)) return;-->
<!--  js = d.createElement(s); js.id = id;-->
<!--  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=456763814831300&autoLogAppEvents=1';-->
<!--  fjs.parentNode.insertBefore(js, fjs);-->
<!--}(document, 'script', 'facebook-jssdk'));</script>-->

</body>
</html>