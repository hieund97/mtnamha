<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchs extends FC_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function Search() {
		$keyword = $this->input->post('keyword');
		// echo $keyword;die;
		$temp = NULL;
		$temp =  $this->Autoload_Model->_search_ajax(array(
			'select' => 'id, title, slug, canonical, price, code, saleoff, images',
			'table' => 'products',
			'keyword' => $keyword,
			'where' => array('publish' =>1, 'trash' => 0),
			'limit' => 90,
			'order_by' => 'id desc,order asc'
		),TRUE);
		$html = '';					
		if(isset($temp) && is_array($temp) && count($temp)) {
			$html .= '<div class=" listResult">';
			foreach ($temp as $key => $val) {
				$title = $val['title'];
    			$href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
    			$image = getthumb($val['images']);
    			$price = $val['price'];
    			$saleoff = $val['saleoff'];
				$html .= '<div class="result-item col-md-3"><div class="product uk-clearfix"><div class="thumb">';
				$html .= '<a class="image img-cover" href="'.$href.'" title="'.$title.'"><img src="'. $image.'" alt="'.$title.'" /></a></div><div class="info">';
				$html .= '<h2 class="title"><a href="'.$href.'" title="'.$title.'">'.$title.'</a></h2><div class="price">';
				if($saleoff > 0) {
					$html .= '<div class="new">'.number_format($saleoff).'đ</div><div class="old">'.number_format($price).'đ</div>';
				}else {
					$html .= '<div class="new">'.number_format($price).'đ</div>';
				}
				$html .="</div></div></div></div>";
			}
			// $html .='</div><div class="viewmore"><a href="tim-kiem-san-pham?keyword='.$keyword.'" title="">Xem toàn bộ </a></div>';
		}
		echo $html;die;
	}
}

											
										