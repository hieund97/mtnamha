<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		/* KIỂM TRA TÌNH TRẠNG WEBSITE */
		if($this->fcSystem['homepage_website'] == 1){
			echo '<img src="'.base_url().'templates/backend/images/close.jpg'.'" style="width:100%;" />';die();
		}
		/* -------------------------- */
	}

	public function View($id = 0){
		$id = (int)$id;
		$DetailProducts = $this->FrontendProducts_Model->ReadByField('id', $id, $this->fc_lang );
		if(!isset($DetailProducts) && !is_array($DetailProducts) && count($DetailProducts) == 0){
			$this->session->set_flashdata('message-danger',  $this->lang->line('error_products_detail'));
			redirect(base_url());
		}
		$DetailCatalogues = $this->FrontendProductsCatalogues_Model->ReadByField('id', $DetailProducts['cataloguesid'], $this->fc_lang );
		if(!isset($DetailCatalogues) && !is_array($DetailCatalogues) && count($DetailCatalogues) == 0){
			$this->session->set_flashdata('message-danger',  $this->lang->line('error_products_catalogues'));
			redirect(base_url());
		}
		// Update Field
		$data['modules'] = 'products';
		$this->FrontendProducts_Model->UpdateViewed('id', $DetailProducts['id'], $this->fc_lang);
		$data['Breadcrumb'] = $this->FrontendProductsCatalogues_Model->Breadcrumb($DetailCatalogues['lft'], $DetailCatalogues['rgt'], $this->fc_lang);
		$data['TagsList'] = $this->FrontendTags_Model->ReadByModule($id, 'products');

		$data['idgoc'] = showcatidgoc($DetailCatalogues['id'], $DetailCatalogues['parentid'], 'products');
		$data['parentid_cat'] = $this->FrontendGallerysCatalogues_Model->ReadAllByField('parentid', $data['idgoc'], $this->fc_lang);
		
		$data['products_cat'] = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, description, lft, rgt, parentid',
            'where' => array('trash' => 0,'publish' => 1, 'alanguage' => ''.$this->fc_lang.''),
            'order_by' => 'order asc, id desc',
        ));

		$cataloguesid = $this->FrontendProducts_Model->_get_where(array(
			'select' => 'cataloguesid',
			'table' => 'catalogues_relationship',
			'where' => array(
				'modulesid' => $id,
				'modules' => 'products',
			),
		), TRUE);
		
		$data['products_same'] = $this->FrontendProducts_Model->_read_condition(array(
			'modules' => 'products',
			'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`,`pr`.`isfooter`,`pr`.`ishome`, `pr`.`images`, `pr`.`description`, `pr`.`viewed`, `pr`.`content2`, `pr`.`price`, `pr`.`saleoff`, `pr`.`psale`, `pr`.`description`, `pr`.`banner`, `pr`.`created`',
			'where' => '`pr`.`trash` = 0 AND `pr`.`id` != '.$id.' AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \''.$this->fc_lang .'\'',
			'limit' => 5,
			'order_by' => '`pr`.`order` asc, `pr`.`id` desc',
		), $cataloguesid);
		$data['module'] = 'products';
		$data['moduleid'] = $DetailProducts['id'];
		$data['urlbl'] = rewrite_url($DetailProducts['canonical'], $DetailProducts['slug'], $DetailProducts['id'], 'products');
		$data['meta_title'] = !empty($DetailProducts['meta_title'])?$DetailProducts['meta_title']:$DetailProducts['title'];
		$data['meta_keyword'] = $DetailProducts['meta_keyword'];
		$data['meta_description'] = !empty($DetailProducts['meta_description'])?$DetailProducts['meta_description']:cutnchar(strip_tags($DetailProducts['description']), 255);
		$data['meta_images'] = !empty($DetailProducts['images'])?base_url($DetailProducts['images']):'';
		$data['DetailProducts'] = $DetailProducts;
		$data['DetailCatalogues'] = $DetailCatalogues;
		$data['canonical'] = rewrite_url($DetailProducts['canonical'], $DetailProducts['slug'], $DetailProducts['id'], 'products', TRUE, TRUE);
		$data['template'] = 'products/frontend/products/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
}
