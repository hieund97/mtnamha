<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendSearchs_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function CountAllAtrributes($catalogues = ''){
		$attr = $this->input->get('attr');
		$attribute['query'] = '';
		$attribute['total'] = 0;
		if(isset($attr) && is_array($attr) && count($attr)){
			foreach($attr as $key => $val){
				if($val == 0) continue;
				$attribute['query'] = $attribute['query'].(empty($attribute['query'])?('`att`.`attrid` = '.$val):(' OR `att`.`attrid` = '.$val));
				$attribute['total'] = $attribute['total'] + 1;
			}
		}
		$str_where = '';
		$str = '';
		if(isset($catalogues) && is_array($catalogues) && count($catalogues)){
			foreach($catalogues as $key => $val){
				$str = $str.$val.', ';
			}
		}
		$str = substr($str, 0, -2);
		
		if(!empty($str)){
			$str = '('.$str.')';
			$str_where = '`pr`.`id` IN '.$str.'';
		}
		
		$attribute['query'] = (!empty($attribute['query'])?' AND ('.$attribute['query'].')':'');
		$attribute['having'] = (($attribute['total'] > 0)?(' HAVING `total` = '.$attribute['total']):'');
		$count = $this->db->query('
			SELECT `pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`price`, `pr`.`saleoff`, `att`.`productsid`, COUNT(`productsid`) as `total`
			FROM `attributes_relationship` as `att`
			INNER JOIN `products` as `pr`
			WHERE `pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `att`.`productsid` = `pr`.`id`'.$attribute['query'].(!empty($str_where) ? ' AND '.$str_where:'').'
 			GROUP BY `att`.`productsid`'.$attribute['having'].'
			ORDER BY `pr`.`id`'.(isset($order_by) ? $order_by : 'desc').'
		')->num_rows();
		$this->db->flush_cache();
		return $count;
	}
	
	public function ReadAllAtrributes($catalogues = '', $start = 0, $limit = 10){
		$attr = $this->input->get('attr');
		$attribute['query'] = '';
		$attribute['total'] = 0;
		if(isset($attr) && is_array($attr) && count($attr)){
			foreach($attr as $key => $val){
				if($val == 0) continue;
				$attribute['query'] = $attribute['query'].(empty($attribute['query'])?('`att`.`attrid` = '.$val):(' OR `att`.`attrid` = '.$val));
				$attribute['total'] = $attribute['total'] + 1;
			}
		}
		$str_where = '';
		$str = '';
		if(isset($catalogues) && is_array($catalogues) && count($catalogues)){
			foreach($catalogues as $key => $val){
				$str = $str.$val.', ';
			}
		}
		$str = substr($str, 0, -2);
		if(!empty($str)){
			$str = '('.$str.')';
			$str_where = '`pr`.`id` IN '.$str.'';
		}
		$attribute['query'] = (!empty($attribute['query'])?' AND ('.$attribute['query'].')':'');
		$attribute['having'] = (($attribute['total'] > 0)?(' HAVING `total` = '.$attribute['total']):'');
		$data = $this->db->query('
			SELECT `pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`price`, `pr`.`saleoff`, `pr`.`code`, `att`.`productsid`, COUNT(`productsid`) as `total`
			FROM `attributes_relationship` as `att`
			INNER JOIN `products` as `pr`
			WHERE `pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `att`.`productsid` = `pr`.`id`'.$attribute['query'].(!empty($str_where) ? ' AND '.$str_where:'').'
 			GROUP BY `att`.`productsid`'.$attribute['having'].'
			ORDER BY `pr`.`id`'.(isset($order_by) ? $order_by : 'desc').'
			LIMIT '.($start * $limit).', '.$limit.'
		')->result_array();
		$this->db->flush_cache();
		return $data;
	}

	public function CountAll($catalogues = ''){
		$cataloguesid = $this->input->get('catalogueid');
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.' '.'%\')');
		}
		if(empty($keyword) && $cataloguesid > 0 && $catalogues == ''){
			return 0;
		}
		
		$this->db->select('id');
		$this->db->from('products');
		$this->db->where(array(
			'publish' => 1,
			'trash' => 0,
		));
		if(isset($catalogues) && is_array($catalogues) && count($catalogues) && $cataloguesid != 0){
			$this->db->where_in('id', $catalogues);
		}
		$count = $this->db->count_all_results();
		$this->db->flush_cache();
		return $count;
	}
	
	public function ReadAll($catalogues = '',$start = 0,  $limit = 0){
		$cataloguesid = $this->input->get('catalogueid');
		$keyword = $this->input->get('keyword');
		if(!empty($keyword)){
			$keyword = $this->db->escape_like_str($keyword);
			$this->db->where('(title LIKE \'%'.$keyword.' '.'%\')');
		}
		if(empty($keyword) && $cataloguesid > 0 && $catalogues == ''){
			return 0;
		}
		
		$this->db->select('id, title, slug, canonical, price, saleoff, images, created, description, code');
		$this->db->from('products');
		$this->db->where(array(
			'publish' => 1,
			'trash' => 0,
		));
		if(isset($catalogues) && is_array($catalogues) && count($catalogues)){
			$this->db->where_in('id', $catalogues);
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('order asc, id desc');
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}
	

}