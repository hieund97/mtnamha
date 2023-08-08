<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller{
	
	public $action;
	
	public function __construct(){
		parent::__construct();
		$this->fcUser = $this->config->item('fcUser');
		$this->fclang = $this->config->item('fclang');
		if(!$this->fcUser) redirect('admin/login');
		$this->load->model(array(
			'BackendProducts_Model',
			'BackendProductsCatalogues_Model',
			'tags/BackendTags_Model',
			'routers/BackendRouters_Model',
		));
		$this->load->library(array('configbie'));
		$this->load->library('nestedsetbie', array('table' => 'products_catalogues'));
		
		$this->action = array(
			'publish' => 'Xuất bản',
			'highlight' => 'Nổi bật'
		);
		
	}

	public function View($page = 1){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/view'
		));
		$page = (int)$page;
		$products_id = '';
		$userid = 0;
		$where = '';
		$cataloguesid = $this->input->get('cataloguesid');
		$filter = $this->input->get('filter');
		if($cataloguesid > 0){
			$products_id = catalogues_relationship($cataloguesid, 'products', array('BackendProducts','BackendProductsCatalogues'), 'products_catalogues');
		}
		//var_dump($products_id);
		if(in_array('products/backend/products/limit', $this->fcUser['group']) == FALSE){
			$userid = $this->fcUser['id'];
		}
		if(isset($this->action[$filter])){
			$where = array($filter => 1);
		}else{
			$prefix = substr($filter, 2);
			if(!empty($prefix)){
				$where = array($prefix.'<=' => 0);
			}
		}
		$config['total_rows'] = $this->BackendProducts_Model->CountAll($products_id, array('userid' => $userid,'where' => $where), $this->fclang);
		//echo $this->db->last_query();die;
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] = base_url('products/backend/products/view');
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['uri_segment'] = 5;
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
			$data['ListPagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['Listproducts'] = $this->BackendProducts_Model->ReadAll(($page * $config['per_page']), $config['per_page'], $products_id, array('userid' => $userid, 'where' => $where), $this->fclang);	
		}
		$data['template'] = 'products/backend/products/view';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Create(){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/create'
		));
		if($this->input->post('create')){
			$attr = $this->input->post('attr');
			$data['tagsid'] = $this->input->post('tagsid');
			$data['avatar'] = $this->input->post('images');
			$data['catalogue'] = $this->input->post('catalogue'); // mảng danh mục
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'sản phẩm', 'trim|required');
			$this->form_validation->set_rules('canonical', 'Canonical', 'trim|callback__Canonical');
			$this->form_validation->set_rules('cataloguesid', 'Breadcrumb', 'trim|required');
			$this->form_validation->set_rules('catalogue', 'Danh mục cha', 'trim|callback__Catalogue');
			$this->form_validation->set_rules('description', 'Mô tả', 'trim');
			// $this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			if ($this->form_validation->run($this)){
				
				$album = $this->input->post('album');
				$album_data = '';
				if(isset($album['images']) && is_array($album['images'])  && count($album['images'])) {
					foreach ($album['images'] as $key => $val) {
						$album_data[] = array('images' => $val); 
					}
				}
				if(isset($album_data) && is_array($album_data)  && count($album_data) && isset($album['title']) && is_array($album['title']) && count($album['title']) && isset($album['description']) && is_array($album['description']) && count($album['description'])) {
					foreach ($album_data as $key => $val) {
						$album_data[$key]['title'] = $album['title'][$key];
						$album_data[$key]['description'] = $album['description'][$key];
					}
				}

				$itinerary = $this->input->post('itinerary');
				$itinerary_data = '';
				if(isset($itinerary['title']) && is_array($itinerary['title'])  && count($itinerary['title'])) {
					foreach ($itinerary['title'] as $key => $val) {
						$itinerary_data[] = array('title' => $val); 
					}
				}
				if(isset($itinerary_data) && is_array($itinerary_data)  && count($itinerary_data) && isset($itinerary['description']) && is_array($itinerary['description']) && count($itinerary['description'])) {
					foreach ($itinerary_data as $key => $val) {
						$itinerary_data[$key]['description'] = $itinerary['description'][$key];
					}
				}

				$review = $this->input->post('review');
				$review_data = '';
				if(isset($review['title']) && is_array($review['title'])  && count($review['title'])) {
					foreach ($review['title'] as $key => $val) {
						$review_data[] = array('title' => $val); 
					}
				}
				if(isset($review_data) && is_array($review_data)  && count($review_data) && isset($review['description']) && is_array($review['description']) && count($review['description']) && is_array($review['images']) && count($review['images'])) {
					foreach ($review_data as $key => $val) {
						$review_data[$key]['description'] = $review['description'][$key];
						$review_data[$key]['images'] = $review['images'][$key];
					}
				}

				
				$resultid = $this->BackendProducts_Model->Create($this->fcUser,$data['catalogue'], $album_data, $itinerary_data, $review_data, $this->fclang);
				if($resultid > 0){
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$this->BackendRouters_Model->Create($canonical, 'products/frontend/products/view', $resultid, 'number');
					}
					$temp = '';
					foreach($data['catalogue'] as $key => $val){
						$temp[] = array(
							'modules' => 'products',
							'modulesid' => $resultid,
							'cataloguesid' => $val,
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->BackendProducts_Model->create_batch(array('data' => $temp,'table' => 'catalogues_relationship'));
					$this->BackendTags_Model->InsertByModule($resultid, 'products');
					$this->BackendAttributes_Model->InsertAttr($resultid, $attr);
					$this->session->set_flashdata('message-success', 'Thêm sản phẩm mới thành công');
					redirect('products/backend/products/view');
				}
			}
			$_attribute_cat = '';
			$radio_cat_checked = $this->input->post('cataloguesid');
			$data['attr'] = $this->input->post('attr');
			$cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $radio_cat_checked, $this->fclang);
			$cat_checked = json_decode($cat_checked['attributes'], TRUE);
			$data['cat_checked'] = $cat_checked;
		}
		
		$data['attribute_catalogues'] = $this->BackendAttributesCatalogues_Model->AttributesCataloguesList(FALSE);
		if(isset($data['attribute_catalogues']) && is_array($data['attribute_catalogues']) && count($data['attribute_catalogues'])){
			foreach($data['attribute_catalogues'] as $key => $val){
				$data['attribute_catalogues'][$key]['attributes'] = $this->BackendAttributes_Model->ReadAtrributes($val['id']);
			}
		}
		
		$data['template'] = 'products/backend/products/create';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Read($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/read'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}
		$data['template'] = 'products/backend/products/read';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Update($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/update'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}
		$data['tagsid'] = $this->BackendTags_Model->ReadByModule($id, 'products');
		$data['catalogue'] = json_decode($data['DetailProducts']['catalogues'], TRUE);
		$catalogues = $this->input->post('catalogue');
		if($this->input->post('update')){
			$attr = $this->input->post('attr');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('title', 'sản phẩm', 'trim|required');
			$this->form_validation->set_rules('canonical', 'Canonical', 'trim|callback__Canonical');
			$this->form_validation->set_rules('cataloguesid', 'Breadcrumb', 'trim|required');
			$this->form_validation->set_rules('catalogue', 'Danh mục cha', 'trim|callback__Catalogue');
			$this->form_validation->set_rules('description', 'Mô tả', 'trim|required');
			// $this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
			if ($this->form_validation->run($this)){

				$itinerary = $this->input->post('itinerary');
				$itinerary_data = '';
				if(isset($itinerary['title']) && is_array($itinerary['title'])  && count($itinerary['title'])) {
					foreach ($itinerary['title'] as $key => $val) {
						$itinerary_data[] = array('title' => $val); 
					}
				}
				if(isset($itinerary_data) && is_array($itinerary_data)  && count($itinerary_data) && isset($itinerary['description']) && is_array($itinerary['description']) && count($itinerary['description'])) {
					foreach ($itinerary_data as $key => $val) {
						$itinerary_data[$key]['description'] = $itinerary['description'][$key];
					}
				}

				$review = $this->input->post('review');
				$review_data = '';
				if(isset($review['title']) && is_array($review['title'])  && count($review['title'])) {
					foreach ($review['title'] as $key => $val) {
						$review_data[] = array('title' => $val); 
					}
				}
				if(isset($review_data) && is_array($review_data)  && count($review_data) && isset($review['description']) && is_array($review['description']) && count($review['description']) && is_array($review['images']) && count($review['images'])) {
					foreach ($review_data as $key => $val) {
						$review_data[$key]['description'] = $review['description'][$key];
						$review_data[$key]['images'] = $review['images'][$key];
					}
				}

				$album = $this->input->post('album');
				$album_data = '';
				if(isset($album['images']) && is_array($album['images'])  && count($album['images'])) {
					foreach ($album['images'] as $key => $val) {
						$album_data[] = array('images' => $val); 
					}
				}
				if(isset($album_data) && is_array($album_data)  && count($album_data) && isset($album['title']) && is_array($album['title']) && count($album['title']) && isset($album['description']) && is_array($album['description']) && count($album['description'])) {
					foreach ($album_data as $key => $val) {
						$album_data[$key]['title'] = $album['title'][$key];
						$album_data[$key]['description'] = $album['description'][$key];
					}
				}
				
				$flag = $this->BackendProducts_Model->UpdateByPost('id', $id, $this->fcUser, $catalogues, $album_data, $itinerary_data, $review_data);
				if($flag > 0){
					$temp = '';
					foreach($catalogues as $key => $val){
						$temp[] = array(
							'modules' => 'products',
							'modulesid' => $id,
							'cataloguesid' => $val,
							'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
						);
					}
					$this->BackendProducts_Model->_delete_batch('modulesid', $id,'catalogues_relationship','products');
					$this->BackendProducts_Model->create_batch(array('data' => $temp,'table' => 'catalogues_relationship'));
					$canonical = slug($this->input->post('canonical'));
					if(!empty($canonical)){
						$this->BackendRouters_Model->Delete($canonical, 'products/frontend/products/view', $id, 'number');
						$this->BackendRouters_Model->Create($canonical, 'products/frontend/products/view', $id, 'number');
					}
					else{
						$this->BackendRouters_Model->Delete($canonical, 'products/frontend/products/view', $id, 'number');
					}
					$this->BackendTags_Model->DeleteByModule($id, 'products');
					$this->BackendTags_Model->InsertByModule($id, 'products');
					$this->BackendAttributes_Model->DeleteAttr($id);
					$this->BackendAttributes_Model->InsertAttr($id, $attr);
					$this->session->set_flashdata('message-success', 'Cập nhật sản phẩm thành công');
					redirect_custom('products/backend/products/view');
				}
			}
			$_attribute_cat = '';
			$radio_cat_checked = $this->input->post('cataloguesid');
			$data['attr'] = $this->input->post('attr');
			$cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $radio_cat_checked, $this->fclang);
			$cat_checked = json_decode($cat_checked['attributes'], TRUE);
			$data['cat_checked'] = $cat_checked;
		}
		
		$_static_cat_checked = $this->BackendProductsCatalogues_Model->ReadByField('id', $data['DetailProducts']['cataloguesid'], $this->fclang);
		
		$_static_cat_checked = json_decode($_static_cat_checked['attributes'], TRUE);
		$data['_static_cat_checked'] = $_static_cat_checked;
		// print_r($data['_static_cat_checked']);die();
		
		$data['attribute_catalogues'] = $this->BackendAttributesCatalogues_Model->AttributesCataloguesList(FALSE);
		if(isset($data['attribute_catalogues']) && is_array($data['attribute_catalogues']) && count($data['attribute_catalogues'])){
			foreach($data['attribute_catalogues'] as $key => $val){
				$data['attribute_catalogues'][$key]['attributes'] = $this->BackendAttributes_Model->ReadAtrributes($val['id']);
			}
		}
		$data['attribute_checked'] = $this->BackendAttributes_Model->AttributesChecked($id);
		if (!is_array($data['attribute_checked']) || count($data['attribute_checked']) < 0) {
			$data['attribute_checked'] = array('100000');
		}
		$data['template'] = 'products/backend/products/update';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function Delete($id = 0){
		$this->commonbie->Permissions(array(
			'uri' => 'products/backend/products/delete'
		));
		$id = (int)$id;
		$data['DetailProducts'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		if(!isset($data['DetailProducts']) && !is_array($data['DetailProducts']) && count($data['DetailProducts']) == 0){
			$this->session->set_flashdata('message-danger', 'sản phẩm không tồn tại');
			redirect_custom('products/backend/products/view');
		}
		if($this->input->post('delete')){
			$flag = $this->BackendProducts_Model->DeleteByField('id', $id);
			if($flag > 0){
				if(!empty($data['DetailProducts']['canonical'])){
					$this->BackendRouters_Model->Delete($data['DetailProducts']['canonical'], 'products/frontend/products/view', $data['DetailProducts']['id'], 'number');
				}
				$this->BackendProducts_Model->_delete_relationship('products', $id);
				$this->BackendTags_Model->DeleteByModule($id, 'products');
				$this->BackendProducts_Model->delete_attribute($id);
				
				$this->session->set_flashdata('message-success', 'Xóa sản phẩm thành công');
				redirect('products/backend/products/view');
			}
		}
		$data['template'] = 'products/backend/products/delete';
		$this->load->view('dashboard/backend/layouts/home', isset($data)?$data:NULL);
	}

	public function _Canonical(){
		$canonical = slug($this->input->post('canonical'));
		$canonical_original = slug($this->input->post('canonical_original'));
		if(empty($canonical)){
			return TRUE;
		}
		if($canonical != $canonical_original){
			$count = $this->BackendRouters_Model->count($canonical);
			if($count > 0){
				$this->form_validation->set_message('_Canonical', 'Canonical đã tồn tại');
				return FALSE;
			}
		}
		return TRUE;
	}
	public function _Catalogue() {
		$catalogue = $this->input->post('catalogue');
		if(!isset($catalogue) || count($catalogue) == 0 || !is_array($catalogue)) {
			$this->form_validation->set_message('_Catalogue','Danh mục cha trường bắt buộc');
			return FALSE;
		}
		return TRUE;
	}
	public function set($type = NULL, $id = 0){
		$redirect = $this->input->get('redirect');
		$id = (int)$id;
		$data['products'] = $this->BackendProducts_Model->ReadByField('id', $id, $this->fclang);
		$temp[$type] = (($data['products'][$type] == 1)?0:1);
		$temp['userid_updated'] = $this->fcUser['id'];
		$temp['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$this->db->where('id', $id);
		$this->db->update('products', $temp);
		redirect((!empty($redirect)) ? $redirect : 'products/backend/products/view');
	}
}
