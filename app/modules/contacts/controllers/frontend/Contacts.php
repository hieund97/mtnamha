<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->fc_lang = $this->config->item('fc_lang');
		$this->load->model(array(
			'FrontendContacts_Model',
			'articles/FrontendArticles_Model',
			'BackendContactsReceiver_Model'
		));
		$this->load->library('ConfigBie');
	}
	public function create2(){
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('email', 'Địa chỉ Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required|integer');
		if ($this->form_validation->run($this)){
			$att = '';
			$data = array(
				'publish' => 0,
				'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
			);
			$post = $this->input->post('post');
			if(isset($post) && is_array($post)  && count($post)) {
				foreach ($post as $key => $val) {
					$att[$val['name']] = nl2br($val['value']);
				}
				foreach ($data as $key => $val) {
					$att[$key] = $val;
				}
			}
			$flag = $this->FrontendContacts_Model->InsertByParam($att);
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	public function view(){
		if( $this->input->post('create') ){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
			// $this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required');
			$this->form_validation->set_rules('email', $this->lang->line('address_customers').' Email', 'trim|required|valid_email');
			// $this->form_validation->set_rules('address', $this->lang->line('address_customers'), 'trim|required');
			$this->form_validation->set_rules('message', $this->lang->line('contact_message'), 'trim|required');
			if ($this->form_validation->run()){
				$flag = $this->FrontendContacts_Model->create();
				if($flag > 0){
					$this->session->set_flashdata('message-success', $this->lang->line('message_success_contact'));
					redirect('lien-he');
				}
			}
		}
		$data['meta_title'] = $this->lang->line('contact');
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'contacts/frontend/contacts/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

	public function view2(){
		if( $this->input->post('create') ){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
			$this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required');
			$this->form_validation->set_rules('email', $this->lang->line('address_customers').' Email', 'trim|required');
			// $this->form_validation->set_rules('address', $this->lang->line('address_customers'), 'trim|required');
			$this->form_validation->set_rules('message', $this->lang->line('contact_message'), 'trim|required');
			if ($this->form_validation->run()){
				$flag = $this->FrontendContacts_Model->create();
				if($flag > 0){
					$this->session->set_flashdata('message-success', $this->lang->line('message_success_contact'));
				}
			}
		}
		$data['meta_title'] = $this->lang->line('contact');
		$data['meta_keyword'] = '';
		$data['meta_description'] = '';
		$data['template'] = 'contacts/frontend/contacts/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}

	public function create(){
		if( $this->input->post('create') ){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', ' / ');
			$this->form_validation->set_rules('fullname', $this->lang->line('fullname_customers'), 'trim|required');
			$this->form_validation->set_rules('phone', $this->lang->line('phone_customers'), 'trim|required');
			$this->form_validation->set_rules('email', $this->lang->line('address_customers').' Email', 'trim|required');
			$this->form_validation->set_rules('address', $this->lang->line('address_customers'), 'trim|required');
			$this->form_validation->set_rules('message', $this->lang->line('contact_message'), 'trim|required');
			if ($this->form_validation->run()){
				$flag = $this->FrontendContacts_Model->create();
				if($flag > 0){
					$this->session->set_flashdata('message-success', $this->lang->line('message_success_contact'));
					redirect('lien-he');
				}
			}
		} else {
			echo 2; die;
		}
		$data['template'] = 'contacts/frontend/contacts/view';
		$this->load->view('homepage/frontend/layouts/home', isset($data)?$data:NULL);
	}
	
	public function registerMobiles(){
		$message = 0;
		$data['email'] = $this->input->post('email');
		$data['message'] = 'Bạn nhận được 1 đăng ký từ email: '.$data['email'];
		$data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
		$data['read'] = 0;
		$data['publish'] = 1;
		$data['receiverid'] = 1;
		$flag = $this->FrontendContacts_Model->InsertByParam($data);
		$message = (($flag > 0) ? 1 : 0);
		echo $message;die();
	}
	
	public function order(){
		$message = 0;
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
		);
		$data['message'] = 'Bạn nhận được một liên hệ đặt sản phẩm : '.$this->input->post('title').' <br> '.'Mã sản phẩm: '.$this->input->post('code').'<br>'.' với nội dung: '.$this->input->post('message');
		if(isset($data) && is_array($data) && count($data)){
			$flag = $this->FrontendContacts_Model->InsertByParam($data);
			$message = (($flag > 0) ? 1 : 0);
		}
		echo $message;die();
	}
}
