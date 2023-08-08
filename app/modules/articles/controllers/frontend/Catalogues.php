<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogues extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		$this->fcCustomer = $this->config->item('fcCustomer');
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}
		/* -------------------------- */
	}

	public function View($id = 0, $page = 1){
		$id = (int)$id;
		$page = (int)$page;
		$seoPage = '';
		$DetailCatalogues = $this->FrontendArticlesCatalogues_Model->ReadByField('id', $id, $this->fc_lang);
		if(!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0){
			$this->session->set_flashdata('message-danger', $this->lang->line('error_articles_catalogues'));
			redirect(base_url());
		}
		$data['Breadcrumb'] = $this->FrontendArticlesCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);
        $data['tagall'] = $this->FrontendTags_Model->ReadByModules('products');
        $data['modules'] = 'articles_catalogues';

		$idgoc = showcatidgoc($DetailCatalogues['id'], $DetailCatalogues['parentid'], 'articles');
		$Cataloguesgoc = $this->FrontendArticlesCatalogues_Model->ReadByField('id', $idgoc, $this->fc_lang);
		if($Cataloguesgoc['rgt'] - $Cataloguesgoc['lft'] > 1){
			$data['list_child'] = $this->FrontendProductsCatalogues_Model->_get_where(array(
				'select' => 'id, title, slug, canonical',
				'table' => 'articles_catalogues',
				'where' => array('publish' => 1, 'alanguage' => $this->fc_lang, 'trash' => 0,'lft >=' => $Cataloguesgoc['lft'],'rgt <=' => $Cataloguesgoc['rgt']),
			), TRUE);
		}
		
		// if (isset($data['Cataloguesgoc']) && is_array($data['Cataloguesgoc']) && count($data['Cataloguesgoc'])) {
		// 	$data['list'] = $this->FrontendArticlesCatalogues_Model->ReadByFieldRow('id, title, slug, canonical', array('parentid' => $idgoc), $this->fc_lang );
		// }
		

		// Lấy ds Slide danh mục
		// if (isset($data['Breadcrumb']) && is_array($data['Breadcrumb']) && count($data['Breadcrumb'])) {
		// 	foreach ($data['Breadcrumb'] as $key => $val) {
		// 		if ($val['level'] != 2) continue;
		// 			$att['id'] = $val['id'];
		// 	}
		// }
		// if (isset($att) && is_array($att)) {
		// 	$data['slide_arr'] = $this->FrontendArticlesCatalogues_Model->ReadByFieldRow('albums', $att, $this->fc_lang);
			
		// }
		
		
		$config['total_rows'] = $this->FrontendArticles_Model->_count(array(
			'select' => '`pr`.`id`',
			'modules' => 'articles',
		), $DetailCatalogues, $this->fc_lang);
		$config['base_url'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'articles_catalogues', FALSE, TRUE);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 7;
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div class="pagenavi"><ul><li>';
			$config['full_tag_close'] = '</li></ul></div>';
			$config['first_tag_open'] = '<a>';
			$config['first_tag_close'] = '</a>';
			// $config['last_tag_open'] = '<li>';
			// $config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<a class="active">';
			$config['cur_tag_close'] = '</a>';
			// $config['next_tag_open'] = '<li>';
			// $config['next_tag_close'] = '</li>';
			// $config['prev_tag_open'] = '<li>';
			// $config['prev_tag_close'] = '</li>';
			// $config['num_tag_open'] = '<li>';
			// $config['num_tag_close'] = '</li>';
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
			$data['ArticlesList'] = $this->FrontendArticles_Model->_view(array(
				'select' => '`pr`.`id`, `pr`.`viewed`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`, `pr`.`catalogues`',
				'modules' => 'articles',
				'start' => ($page * $config['per_page']),
				'limit' => $config['per_page'],
				'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
			), $DetailCatalogues, $this->fc_lang);
			
		}
		$data['noibat'] = $this->FrontendArticles_Model->ReadByCondition(array(
			'select' => 'id, title, slug, canonical, images, description,content,albums',
			'where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),
			'limit' => 3,
			'order_by' => 'order asc, id desc'
		));

		if(!isset($data['canonical']) || empty($data['canonical'])){
			$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
		}
		
		$data['is_article'] = 'Articles';
		$data['meta_title'] = (!empty($DetailCatalogues['meta_title'])?$DetailCatalogues['meta_title']:$DetailCatalogues['title']).$seoPage;
		$data['meta_keyword'] = $DetailCatalogues['meta_keyword'];
		$data['meta_description'] = (!empty($DetailCatalogues['meta_description'])?$DetailCatalogues['meta_description']:cutnchar(strip_tags($DetailCatalogues['description']), 255)).$seoPage;
		$data['meta_images'] = !empty($DetailCatalogues['images'])?base_url($DetailCatalogues['images']):'';
		$data['DetailCatalogues'] = $DetailCatalogues;
		$data['canonicalcata'] = rewrite_url($DetailCatalogues['canonical'], $DetailCatalogues['slug'], $DetailCatalogues['id'], 'articles_catalogues');
		// if ($DetailCatalogues['rgt'] - $DetailCatalogues['lft'] > 1) {
		// 	$data['catalogues_child'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt, level','where' => array('trash' => 0,'publish' => 1,'parentid' => $DetailCatalogues['id']), 'order_by' => 'order asc, id desc'));
		// 	if(isset($data['catalogues_child']) && is_array($data['catalogues_child']) && count($data['catalogues_child'])){
		// 		foreach($data['catalogues_child'] as $key => $val){
		// 			$data['catalogues_child'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
		// 				'modules' => 'articles',
		// 				'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`, `pr`.`viewed`, `pr`.`catalogues`',
		// 				'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1',
		// 				'limit' => 6,
		// 				'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
		// 				'cataloguesid' => $val['id'],
		// 			));
		// 		}
		// 	}
		// 	$data['template'] = 'articles/frontend/catalogues/view2';
		// }else{
			$data['template'] = 'articles/frontend/catalogues/view';
		// }
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

	public function Viewnew($page = 1){
		$page = (int)$page;
		$seoPage = '';
		$config['total_rows'] = $this->FrontendArticlesCatalogues_Model->_count(array(
			'select' => '`pr`.`id`',
			'modules' => 'articles_catalogues',
			'where' => '`pr`.`parentid` = 0 AND  `pr`.`is_show` = 1',
		), '', $this->fc_lang);
		$config['base_url'] = 'tin-tuc';
		if($config['total_rows'] > 0){
			$data['per_page']= 10;
			$this->load->library('pagination');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = $data['per_page']; //số sản phẩm trên 1 trang
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
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
			$data['ArticlesList'] = $this->FrontendArticlesCatalogues_Model->_view(array(
				'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`viewed`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`created`',
				'modules' => 'articles_catalogues',
				'where' => '`pr`.`publish` = 1 AND `pr`.`parentid` = 0 AND `pr`.`is_show` = 1',
				'start' => ($page * $config['per_page']),
				'limit' => $config['per_page'],
				'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
				'limitsub' => 5,
			), '', $this->fc_lang);
		}
		$data['is_article'] = 'Articles';
		$data['link'] = 'products.html';
		$data['meta_title'] = 'Tin tức'.$seoPage;
		$data['meta_keyword'] = 'Tin tức';
		$data['meta_description'] = 'Tin tức'.$seoPage;
		$data['meta_images'] = !empty($DetailCatalogues['images'])?base_url($DetailCatalogues['images']):'';
		$data['DetailCatalogues'] = array('title' => 'Tin tức', 'canonical' => '' ,'slug' => 'Tin tức','id' => '', 'images' => '');
		$data['template'] = 'articles/frontend/catalogues/viewall';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

}
