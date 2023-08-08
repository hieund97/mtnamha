<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'BackendProducts_Model',
			'FrontendProducts_Model',
			'tags/BackendTags_Model',
		));
		$this->load->library(array('configbie'));
		$this->fc_lang = $this->config->item('fc_lang');
	}

	//* LẤY ĐỊA ĐIỂM *//
	public function ajax_change_location(){
		$id = $this->input->post('id');
		$_html = '';
		$this->location = $this->BackendProducts_Model->location_dropdown(array(
			'where' => array('parentid' => $id),
		), true);
		if(isset($this->location) && is_array($this->location) && count($this->location)){
			foreach($this->location as $key => $val){
				$_html = $_html . '<option value="'.$key.'">'.$val.'</option>';
			}
		}
		echo json_encode(array(
			'html' => $_html,
		));
		die();
		
	}

	public function ajax_get_project_list(){
		$data['cityid'] = $this->input->post('cityid');
		$data['districtid'] = $this->input->post('districtid');
		$data['wardid'] = $this->input->post('wardid');
		$param['where'] = '';
		$_html = '';
	
		if($data['cityid'] > 0 && $data['districtid'] == 0){
			$param['where'] = array(
				'cityid' => $data['cityid'],
			);
		}else if($data['cityid'] > 0 && $data['districtid'] > 0 && $data['wardid']  == 0){
			$param['where'] = array(
				'cityid' => $data['cityid'],
				'districtid' => $data['districtid'],
			);
		}else if($data['cityid'] > 0 && $data['districtid'] > 0 && $data['wardid']  > 0){
			$param['where'] = array(
				'cityid' => $data['cityid'],
				'districtid' => $data['districtid'],
				'wardid' => $data['wardid'],
			);
		}else{
			echo $_html;die();
		}
		$param['where']['trash'] = 0;
		
		$listProject = $this->Autoload_Model->_get_where(array(
			'select' => 'id, title',
			'table' => 'places',
			'where' => $param['where'],
			'order_by' => 'title asc',
		), TRUE);
		
		if(isset($listProject) && is_array($listProject) && count($listProject)){
			$_html = $_html.'<option value="0">[Chọn dự án]</option>';
			foreach($listProject as $key => $val){
				$_html = $_html.'<option value="'.$val['id'].'">'.$val['title'].'</option>';
			}
		}else{
			$_html = $_html.'<option value="0">Không có dự án phù hợp</option>';
		}
		
		echo json_encode(array(
			'html' => $_html,
		)); die();
	}
	public function sort(){
		$data = NULL;
		$post = $this->input->post();
		foreach($post['order'] as $key => $val){
			$data[] = array(
				'id' => $key,
				'order' => $val,
			);
		}
		$flag = $this->BackendProducts_Model->UpdateBatchByField($data, 'id');
	}

	public function viewed(){
		$id = $this->input->post('id');
		if(!isset($_COOKIE['products_viewed_'.$id])){
			$flag = $this->FrontendProducts_Model->UpdateViewed('id', $id);
			setcookie('products_viewed_'.$id, 1, NULL, '/');
		}
	}
	public function createLink() {
		$link = $this->input->post('canonical');
		$link = slug($link);
	}
	public function sort_order() {
		sleep(0.5);
		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data = $this->input->post('number');
		if(isset($table) && !empty($table) && $id > 0) {
			$this->BackendProducts_Model->_update_sort_order($table, $id, $data);
		}
	}
	
	public function convert_commas_price(){
		$price = $this->input->post('price');
		$price_explode = explode('.',$price);
		if(count($price_explode) == 1){
			$price = (int)$price;
			
		}else{
			$price = str_replace('.','',$price);
			$price = (int)$price;
		}
		$price = str_replace(',','.',number_format($price));
		
		echo $price;die();
	}
	
	public function attributes(){
		$post = $this->input->post('post');
		$post_array = explode('-', $post);
		$temp = '';
		$_cat_ = '';
		$_attribute_cat = '';
		$_str = '';
		if(isset($post_array) && is_array($post_array) && count($post_array)){
			$_cat_ = $this->BackendProducts_Model->_get_where(array(
				'select' => 'id, title, slug, canonical, attributes',
				'table' => 'products_catalogues',
				'where' => array('trash' => 0,),
				'where_in' => $post_array,
				'where_in_field' => 'id',
			), TRUE); 
		}
		
		if(isset($_cat_) && is_array($_cat_) && count($_cat_)){
			foreach($_cat_ as $key => $val){
				$attributes_decode = json_decode($val['attributes'], TRUE);
				$temp['attribute_catalogue'] = $attributes_decode['attribute_catalogue'];
				$temp['attribute'] = $attributes_decode['attribute'];
			}
		}
		if(count($temp['attribute_catalogue']) == 0 || $temp['attribute_catalogue'][0] == ''){
			echo $_str;die();
		}
	
		
		if(isset($_cat_) && is_array($_cat_) && count($_cat_)){
			$_attribute_cat = $this->BackendAttributes_Model->_get_where(array(
				'select' => 'id, title, keyword',
				'table' => 'attributes_catalogues',
				'where' => array('trash' => 0),
				'where_in' => $temp['attribute_catalogue'],
				'where_in_field' => 'id'
			), TRUE);
		}
		
		if(isset($_attribute_cat) && is_array($_attribute_cat) && count($_attribute_cat)){
			foreach($_attribute_cat as $key => $val){
				$_attribute_cat[$key]['attributes'] = $this->BackendAttributes_Model->_get_where(array(
					'select' => 'id, title',
					'table' => 'attributes',
					'where' => array('trash' => 0,'cataloguesid' => $val['id']),
				), TRUE);
			}
		}
		
		if(isset($_attribute_cat) && is_array($_attribute_cat) && count($_attribute_cat)){
			foreach($_attribute_cat as $key => $val){
				$_str = $_str.'<div class="form-group">';
					$_str = $_str.'<label class="col-sm-2 control-lanel">'.$val['title'].'</label>';
					$_str = $_str.'<div class="col-sm-10">';
					if(isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])){
						$_str = $_str.'<div class="checkbox" style="padding:0;">';
						foreach($val['attributes'] as $keyAttr => $valAttr){
							if(isset($temp['attribute'][$val['keyword']]) && in_array($valAttr['id'], $temp['attribute'][$val['keyword']]) == false) continue;
							$_str = $_str.'<label class="tpInputLabel" style="width:168px;">';
								$_str = $_str.'<input name="attr['.$valAttr['id'].']" type="checkbox" class="tpInputCheckbox" value="'.$valAttr['id'].'" /><span>'.$valAttr['title'].'</span>';
							$_str = $_str.'</label>';
						}
						$_str = $_str.'</div>';
					}
					$_str = $_str.'</div>';
				$_str = $_str.'</div>';
				$_str = $_str.'<script>$(document).ready(function() {$(".tpInputLabel").on("click", function() {if($(this).find(".tpInputCheckbox").is(":checked")) {$(this).addClass("checked");}else {$(this).removeClass("checked");}});});</script>';
			}
		}
		echo $_str;die();
	}
	
	public function delete(){
		$error = true;
		$message = '';
		$id = $this->input->post('post');
		if(isset($id) && is_array($id) && count($id)){
			foreach($id as $key => $val){
				$DetailProducts = $this->BackendProducts_Model->ReadByField('id', $val);
				$flag = $this->BackendProducts_Model->DeleteByField('id', $val);
				if($flag > 0){
					if(!empty($DetailProducts['canonical'])){
						$this->BackendRouters_Model->Delete($DetailProducts['canonical'], 'products/frontend/products/view', $DetailProducts['id'], 'number');
					}
					$this->BackendProducts_Model->_delete_relationship('products', $val);
					$this->BackendTags_Model->DeleteByModule($val, 'products');
					$error = false;
					$message = 'Bản ghi đã được xóa thành công';
				}
			}
		}else{
			$message = 'Có lỗi trong quá trình xóa bản ghi, vui lòng kiểm tra lại';
		}
		echo json_encode(array(
			'error' => $error,
			'message' => $message,
		)); die();
	}

	public function filter(){
		
		$post = $this->input->post('post');
		$attribute = explode('-', $post);
		$page = $this->input->post('page');
		$temp_attribute['cataloguesid'] = $this->input->post('cataloguesid');
		$page = (int)$page;
		$config['total_rows'] = $this->FrontendProducts_Model->countajaxproduct($attribute, $temp_attribute['cataloguesid'], $this->fc_lang);
		$result = '';
		// echo $this->db->last_query();die;
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 24;
			$config['cur_page'] = $page;
			$config['page'] = $page;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right" id="ajax-pagination">';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="uk-active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$data['listPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['listProduct'] = $this->FrontendProducts_Model->viewajaxproduct(($page * $config['per_page']), $config['per_page'], $attribute, $temp_attribute['cataloguesid'], $this->fc_lang);	
		}
		$html = '';
		if(isset($data['listProduct']) && is_array($data['listProduct']) && count($data['listProduct'])){ 
			$html = $html . '<div class="nav-product">';
			$html = $html . '<div class="row">';
			foreach($data['listProduct'] as $key => $val){

				// check total và danh mục cha do một sản phẩm được phép nhiều anh mục cha nên cần check để in ra khi lọc
				$count_cataloguesid = count(json_decode($val['catalogues'],true));
				$count_attribute = count($attribute);
				if (empty($attribute[0])) {
					$count_attribute = 0;
				}
				if ($count_cataloguesid*$count_attribute < $val['total'] && $count_attribute > 1) {
					continue;
				}

				$id = $val['id'];
				$title = $val['title'];
				$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
				$image = getthumb($val['images']);
				$description = strip_tags($val['description']);
				$price = $val['price'];
                $saleoff = $val['saleoff'];
                if ($price > 0) {
                    $pri_old = '<span class="gia-cu">'.str_replace(',', '.', number_format($price)).' đ </span>';
                }else{
                    $pri_old  = '.-';
                }
                if ($saleoff > 0) {
                    $pri_sale = '<span class="gia-moi">'.str_replace(',', '.', number_format($saleoff)).'<span class="css-size-d"> đ</span> </span>';
                }else{
                    $pri_sale  = 'Liên hệ';
                }
                $html = $html.'<div class="col-md-3 col-sm-6 col-xs-6 wow fadeInUp">';
                $html = $html .htmlItem($val, false);
//                    $html = $html.'<div class="item-product">';
//                        $html = $html.'<div class="image">';
//                            $html = $html.'<a href="'.$href.'" class="thubmail-img"><img src="'.$image.'" alt="'.$title.'">';
//                            $html = $html.'</a>';
//                            $html = $html.'<div class="new-pr"><img src="templates/frontend/resources/images/new.png" alt="">';
//                            $html = $html.'</div>';
//                            $html = $html.'<div class="sale-pr"><img src="templates/frontend/resources/images/sale.png" alt="">';
//                            $html = $html.'</div>';
//                        $html = $html.'</div>';
//                        $html = $html.'<div class="price-c">';
//                            $html = $html.'<p class="price">'.$pri_old;
//                                $html = $html.'<br>'.$pri_sale;
//                            $html = $html.'</p>';
//                            if($val['price'] > $val['saleoff']){
//                            	 $html = $html.'<div class="sale-off-show">-'.(round((($val['price']-$val['saleoff'])*100)/$val['price'])).'%</div>';
//                            }
//                        $html = $html.'</div>';
//                        $html = $html.'<h3 class="title"><a href="'.$href.'">'.$title.' </a></h3>';
//                        $html = $html.'<div class="add-cart">';
//                            $html = $html.'<a href="'.$href.'" class="ajax-addtocart" data-quantity="1" data-id="'.$id.'" data-price="'.$saleoff.'">Cho vào giỏ</a>';
//                            $html = $html.'<a href="'.$href.'" class="mh ajax-addtocart" data-redirect="redirect" data-quantity="1" data-id="'.$id.'" data-price="'.$saleoff.'">Mua hàng</a>';
//                        $html = $html.'</div>';
//                    $html = $html.'</div>';
                $html = $html.'</div>';



				// $html = $html.'<div class="col-md-3 col-sm-4 col-xs-6 col-edit-0">';
    //                 $html = $html.'<div class="wp-item-sp">';
    //                     $html = $html.'<div class="img-item-sp">';
    //                         $html = $html.'<a href="'.$href.'" class="h_2"><img src="'.$image.'" alt=""></a>';
    //                     $html = $html.'</div>';
    //                     $html = $html.'<div class="text-item-sp text-sp-nho">';
    //                         $html = $html.'<h4 class="h4-title-sp">';
    //                             $html = $html.'<a href="'.$href.'">'.$title.'</a>';
    //                         $html = $html.'</h4>';
    //                         $html = $html.'<div class="ngan-text">';
    //                             $html = $html.'<span class="span-hang">'.$val['banner'].'</span>';
    //                         $html = $html.'</div>';
    //                         $html = $html.'<div class="div-post-sp">';
    //                             $html = $html.'<div class="price-nho">';
    //                                 $html = $html.'<span class="price-ins">1.900.000 đ <span class="del">2.000.000 đ</span></span>';
    //                             $html = $html.'</div>';
    //                             $html = $html.'<div class="mota-spnho">';
    //                                 $html = $html.'<button class="btn btn-info btn-mua ajax-addtocart" data-redirect="redirect" data-id="'.$id.'" data-quantity="1">Mua ngay</button>';
    //                             $html = $html.'</div>';
    //                         $html = $html.'</div>';
    //                     $html = $html.'</div>';
    //                 $html = $html.'</div>';
    //             $html = $html.'</div>';
			}
			$html = $html.'</div>';
			$html = $html.'</div>';
		}
		echo json_encode(array(
			'html' => $html,
		));
		die();
	}

	// Search Products
	public function search(){
		$keyword = $this->input->post('keyword');
		$id = $this->input->post('id');
		$prdid = $this->input->post('prdid');
		$html = '';
		if (!empty($keyword)) {
			$result = $this->Autoload_Model->_get_where(array(
				'select' => 'id, title, slug, canonical, images, description, price, saleoff',
				'table' => 'products',
				'keyword' => $keyword,
				'where' => array('publish' =>1, 'trash' => 0, 'id !=' => $prdid),
				'where_not_in' => explode('-', $id),
				'where_not_in_field' => 'id',
				'order_by' => 'id desc, order asc'
			),TRUE);
		
			if(isset($result) && is_array($result) && count($result)) {
				$html .= '<table class="table" id="diagnosis-list">';
					$html .= '<thead><tr>';
						$html .= '<th>Tiêu đề</th>';
						$html .= '<th></th>';
					$html .= '</tr>';			
					$html .= '</thead><tbody>';			
					foreach ($result as $key => $val) {
						$image = getthumb($val['images']);
						$description = cutnchar(strip_tags($val['description']), 250);
						$price = $val['price'];
                        $saleoff = $val['saleoff'];
						if ($price > 0) {
	                        $pri_old = '<span class="span-gia">'.str_replace(',', '.', number_format($price)).' đ<span>';
	                    }else{
	                        $pri_old  = '';
	                    }
	                    if ($saleoff > 0) {
	                        $pri_sale = str_replace(',', '.', number_format($saleoff)).' đ';
	                    }else{
	                        $pri_sale  = 'Liên hệ';
	                    }
						$html .= '<tr class="add-item" data-id="'.$val['id'].'">';
							$html .= '<td style="width:650px;">';
								$html .= '<article class="article-view-1 text-left">';
									$html .= '<div class="col-sm-2 thumb">';
										$html .= '<div class="tp-cover"><img  src="'.$image.'" alt="'.$val['title'].'" /></div>';
									$html .= '</div>';
									$html .= '<div class="col-sm-10">';
										$html .= '<div class="title">'.$val['title'].'</div>';
										$html .= '<div class="description">'.$description.'</div>';
										$html .= '<div class="meta">';
											$html .= $pri_sale.((!empty($price) && !empty($saleoff) && $price > $saleoff) ? $pri_old : '');
										$html .= '</div>';
									$html .= '</div>';
								$html .= '</article>';
							$html .= '</td>';
							$html .= '<td class="text-right">';
								$html .= '<div class="btn btn-default data-active" data-id="'.$val['id'].'">';
									$html .= '<span class="fa fa-trash"></span>';
								$html .= '</div>';
							 $html .= '</td>';
						$html .= '</tr>';
					}
				$html .= '</table>';
			}
		}
		echo json_encode(array('html'=>$html));die;
	}
}
