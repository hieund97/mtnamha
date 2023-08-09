<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		$this->load->model(array(
			'slides/FrontendSlides_Model',
			'address/Frontendaddress_Model',
			'idea/FrontendIdea_Model',
			'contacts/FrontendContacts_Model',
			'products/FrontendProductsCatalogues_Model',
			'products/FrontendProducts_Model'
		));
		$this->load->library(array('lichhoc/configbie'));
		$this->fcCustomer = $this->config->item('fcCustomer');

	}

	public function Index($page = 1){
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}

        $data['slide_ads_home'] = $this->FrontendSlides_Model->Read('adversite-1',$this->fc_lang);

        $data['slide_customer_home'] = $this->FrontendSlides_Model->Read('customer-review',$this->fc_lang);
//		echo "<pre>";print_r($data['slide_ads_home']);die();

		/* -------------------------- */
		$config['total_rows'] = $this->FrontendProducts_Model->Count();
		$config['base_url'] = base_url();
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url();
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['prefix'] = 'trang-';
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 4;
			$config['uri_segment'] = 1;
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
			$data['listsp'] = $this->FrontendProducts_Model->ReadByCondition(array(
				'select' => 'id, title, slug, canonical, images, description,albums',
				'where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),
				'start' => ($page * $config['per_page']),
				'limit' => $config['per_page'],
			));

			if(!isset($data['canonical']) || empty($data['canonical'])){
				$data['canonical'] = $config['base_url'].$this->config->item('url_suffix');
			}
		}

		$data['canonical'] = $config['base_url'];
		
		// echo "<pre>";var_dump($data['listsp']);die();
		// $data['danhmuc'] = $this->FrontendProductsCatalogues_Model->_read(array(
		// 	'select' => 'id, title, slug, canonical, images, lft, rgt',
		// 	'where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),
		// 	'limit' => (100),
		// 	'order_by' => 'order asc, id desc',
		// 	'table' => 'products_catalogues'));

		// $config['total_rows'] = $this->FrontendProducts_Model->_count(array(
		// 	'select' => '`pr`.`id`',
		// 	'modules' => 'products',
		// ), $data['danhmuc'], $this->fc_lang);
		$data['listdm'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1 ,'alanguage' => ''.$this->fc_lang.''),'limit' => 100,'order_by' => 'order asc, id desc'));

		$data['list'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1,'ishome' => 1 ,'alanguage' => ''.$this->fc_lang.''),'limit' => 10,'order_by' => 'order asc, id desc'));
		if(isset($data['list']) && is_array($data['list']) && count($data['list'])){
			foreach($data['list'] as $key => $val){
				$data['list'][$key]['post'] = $this->FrontendProducts_Model->_read_condition(array(
					'modules' => 'products',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`isfooter`, `pr`.`ishome`, `pr`.`highlight`, `pr`.`code`,`pr`.`price`,`pr`.`saleoff`, `pr`.`description`, `pr`.`banner`, `pr`.`created`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 12,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));

				$data['list'][$key]['child'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1, 'parentid' => $val['id'], 'alanguage' => ''.$this->fc_lang.''),'limit' => 6,'order_by' => 'order asc, id desc'));
			}
		}

//		echo "<pre>";print_r($data['list']);die();
		
		// Tin tức - sự kiện
		$data['spmoi'] = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, banner,description','where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 4,'order_by' => 'order asc, id desc'));
		$data['sphot'] = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, isfooter,ishome, banner,description','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 20,'order_by' => 'order asc, id desc'));
		$data['spsale'] = $this->FrontendProducts_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, price, saleoff, banner,description','where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));

		$data['tintuc'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 10,'order_by' => 'order asc, id desc'));
		if(isset($data['tintuc']) && is_array($data['tintuc']) && count($data['tintuc'])){
			foreach($data['tintuc'] as $key => $val){
				$data['tintuc'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
					'modules' => 'articles',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`created`, `pr`.`description`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 40,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));
			}
		}
		$data['tophome'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 10,'order_by' => 'order asc, id desc'));
		if(isset($data['tophome']) && is_array($data['tophome']) && count($data['tophome'])){
			foreach($data['tophome'] as $key => $val){
				$data['tophome'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
					'modules' => 'articles',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`created`, `pr`.`description`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 5,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));
			}
		}
		$data['tinnb'] = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description','where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
		// echo "<pre>";var_dump($data['tinnb']);die();
		$data['camket'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'id' => 33, 'alanguage' => ''.$this->fc_lang.''),'limit' => 1,'order_by' => 'order asc, id desc'));
		if(isset($data['camket']) && is_array($data['camket']) && count($data['camket'])){
			foreach($data['camket'] as $key => $val){
				$data['camket'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
					'modules' => 'articles',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`viewed`, `pr`.`description`, `pr`.`content`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 10,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));
			}
		}
		$data['ykkh'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'id' => 60, 'alanguage' => ''.$this->fc_lang.''),'limit' => 1,'order_by' => 'order asc, id desc'));
		if(isset($data['ykkh']) && is_array($data['ykkh']) && count($data['ykkh'])){
			foreach($data['ykkh'] as $key => $val){
				$data['ykkh'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
					'modules' => 'articles',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`viewed`, `pr`.`description`, `pr`.`content`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 10,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));
			}
		}
		$data['chiase'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description, lft, rgt','where' => array('trash' => 0,'publish' => 1,'id' => 68, 'alanguage' => ''.$this->fc_lang.''),'limit' => 1,'order_by' => 'order asc, id desc'));
		if(isset($data['chiase']) && is_array($data['chiase']) && count($data['chiase'])){
			foreach($data['chiase'] as $key => $val){
				$data['chiase'][$key]['post'] = $this->FrontendArticles_Model->_read_condition(array(
					'modules' => 'articles',
					'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`viewed`, `pr`.`description`, `pr`.`content`',
					'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1  AND `pr`.`alanguage` = \''.$this->fc_lang.'\'',
					'limit' => 10,
					'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
					'cataloguesid' => $val['id'],
				));
			}
		}
		$data['dichvu'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt','where' => array('trash' => 0,'publish' => 1,'id' => 63 ,'alanguage' => ''.$this->fc_lang.''),'limit' => 10,'order_by' => 'order asc, id desc'));
		if(isset($data['dichvu']) && is_array($data['dichvu']) && count($data['dichvu'])){
			foreach($data['dichvu'] as $key => $val){
				$data['dichvu'][$key]['parent'] = $this->FrontendArticlesCatalogues_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, lft, rgt,description','where' => array('trash' => 0,'publish' => 1, 'parentid' => $val['id'], 'alanguage' => ''.$this->fc_lang.''),'limit' => 6,'order_by' => 'order asc, id desc'));
			}
		}
		
		// echo "<pre>";var_dump($data['dichvu']);die();

		$data['tinhome'] = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description,created,content','where' => array('trash' => 0,'publish' => 1,'ishome' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 5,'order_by' => 'order asc, id desc'));
		$data['tinnb'] = $this->FrontendArticles_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description,created,content','where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 20,'order_by' => 'order asc, id desc'));
		$data['glr'] = $this->FrontendGallerys_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images, , description','where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 4,'order_by' => 'order asc, id desc'));
		// var_dump($data['glr']);die();
		$data['video'] = $this->FrontendVideos_Model->ReadByCondition(array('select' => 'id, title, slug, canonical, images,description','where' => array('trash' => 0,'publish' => 1,'highlight' => 1, 'alanguage' => ''.$this->fc_lang.''),'limit' => 10,'order_by' => 'order asc, id desc'));
		if( $this->input->post('create') ){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
			$this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required');
			$this->form_validation->set_rules('email', $this->lang->line('address_customers').' Email', 'trim|required');
			// $this->form_validation->set_rules('address', $this->lang->line('address_customers'), 'trim|required');
			// $this->form_validation->set_rules('message', $this->lang->line('contact_message'), 'trim|required');
			if ($this->form_validation->run()){
				$flag = $this->FrontendContacts_Model->create1();
				if($flag > 0){
					$this->session->set_flashdata('message-success', $this->lang->line('message_success_contact'));
					redirect(BASE_URL);
				}
			}
		}
		$data['nomenu'] = 'a';
		$data['meta_title'] = $this->fcSystem['seo_meta_title'];
		$data['meta_keyword'] = $this->fcSystem['seo_meta_keywords'];
		$data['meta_description'] = $this->fcSystem['seo_meta_description'];
		$data['template'] = 'homepage/frontend/home/index';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
		
	}

	
	public function Sitemap($type = 'html'){
		$data['ArticlesNews'] = $this->FrontendArticles_Model->ReadAllForSitemap($this->fc_lang, 0, 0, 100 );
		$data['ArticlesCatalogues'] = $this->FrontendArticlesCatalogues_Model->ReadAllForSitemap($this->fc_lang);
		$this->load->view('homepage/frontend/home/sitemap_'.$type, isset($data)?$data:NULL);
	}
	public function email(){
		$data['email'] = $this->input->post('email');
		$data['message'] = 'Đăng ký nhận phiếu giảm giá'; 
		if(isset($data) && is_array($data) && count($data)){
			$this->db->insert('contacts', $data);
			$result = $this->db->affected_rows();
			$this->db->flush_cache();
		}
		if($result > 0){
			echo 'Gửi đăng kí thành công, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất';die();
		}
	}
	
	public function chungchi($page = 1){
		$page = (int)$page;
		$data['meta_title'] = 'Đăng ký trực tuyến';
		$data['meta_keywords'] = '';
		$data['meta_description'] = '';

		if($this->input->post('create')){

			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required');
			$this->form_validation->set_rules('phone', 'Số đện thoại', 'trim|required|is_natural');
			$this->form_validation->set_rules('cityid', 'Tỉnh / Thành phố', 'trim|callback__City');
			$this->form_validation->set_rules('register', 'Nơi đăng ký', 'trim|required');
			$this->form_validation->set_rules('register-2', 'Nơi nhập học', 'trim|required');
			if ($this->form_validation->run($this)){
				$resultid = $this->Frontendmailsubricre_Model->Create_arr();
				if($resultid > 0){
					$this->session->set_flashdata('message-success', 'Cảm ơn bạn đã đăng ký nhóm của chúng tôi! Chúng tôi sẽ liên lạc với bạn ngay.');
					redirect('dang-ky-truc-tuyen');
				}
			}
		}
		
		$data['template'] = 'homepage/frontend/home/chungchi';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	public function _City() {
		$cityid = $this->input->post('cityid');
		if(!isset($cityid) || $cityid == 0 || $cityid == '') {
			$this->form_validation->set_message('_City','Tỉnh / Thành phố trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
	public function _Degree() {
		$degree = $this->input->post('degree');
		if(!isset($degree) || $degree == 0 || $degree == '') {
			$this->form_validation->set_message('_Degree','Trình độ học vấn trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
	public function _Form() {
		$form = $this->input->post('form');
		if(!isset($form) || $form == 0 || $form == '') {
			$this->form_validation->set_message('_Form','Hình thức làm việc trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
	public function _Money() {
		$money = $this->input->post('money');
		if(!isset($money) || $money == 0 || $money == '') {
			$this->form_validation->set_message('_Money','Mức lương trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
	public function _Classify() {
		$classify = $this->input->post('classify');
		if(!isset($classify) || $classify == 0 || $classify == '') {
			$this->form_validation->set_message('_Classify','Xếp loại tốt nghiệp trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
}