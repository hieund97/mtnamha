<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Searchs extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('FrontendSearchs_Model','products/BackendProducts_Model','products/BackendProductsCatalogues_Model'));
		$this->load->library('nestedsetbie', array('table' => 'products_catalogues'));
	}

	public function view($page = 1){
		$catalogues = '';
		$cataloguesid = $this->input->get('cataloguesid');
		if($cataloguesid > 0){
			$catalogues = catalogues_relationship($cataloguesid, 'products', array('BackendProducts','BackendProductsCatalogues'), 'products_catalogues');
		}
		$config['total_rows'] = $this->FrontendSearchs_Model->CountAllAtrributes($catalogues);
		$config['base_url'] = 'tim-kiem-nang-cao';
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 24;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination"><ul class="uk-pagination uk-pagination-left">';
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
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['productsList'] = $this->FrontendSearchs_Model->ReadAllAtrributes($catalogues, ($page * $config['per_page']), $config['per_page']);
		}
		if(isset($data['productsList']) && is_array($data['productsList']) && count($data['productsList'])){
			foreach($data['productsList'] as $key => $val){
				$data['productsList'][$key]['attributes'] = $this->FrontendProducts_Model->AttributesAllTheTime($val['id']);
			}
		}
		
		
		$data['DetailCatalogues_isset'] = $this->FrontendProductsCatalogues_Model->ReadByField('id',$cataloguesid);
		$data['meta_title'] = 'Tìm kiếm nâng cao';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'searchs/frontend/searchs/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
	
	public function view_1($page = 1){
		$catalogues = '';
		$cataloguesid = $this->input->get('catalogueid');
		if($cataloguesid > 0){
			$catalogues = catalogues_relationship($cataloguesid, 'products', array('BackendProducts','BackendProductsCatalogues'), 'products_catalogues');
		}
		$config['total_rows'] = $this->FrontendSearchs_Model->CountAll($catalogues);
		$config['base_url'] = 'tim-kiem-san-pham';
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 24;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination"><ul class="uk-pagination uk-pagination-left">';
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
			$data['PaginationList'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$seoPage = ($page >= 2)?(' - Trang '.$page):'';
			if($page >= 2){
				$data['canonical'] = $config['base_url'].'/trang-'.$page.$this->config->item('url_suffix');
			}
			$page = $page - 1;
			$data['productsList'] = $this->FrontendSearchs_Model->ReadAll($catalogues, ($page * $config['per_page']), $config['per_page']);
		}
		if(isset($data['productsList']) && is_array($data['productsList']) && count($data['productsList'])){
			foreach($data['productsList'] as $key => $val){
				$data['productsList'][$key]['attributes'] = $this->FrontendProducts_Model->AttributesAllTheTime($val['id']);
			}
		}
		
		
		$data['meta_title'] = 'Tìm kiếm nâng cao';
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'searchs/frontend/searchs/view_1';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
}
