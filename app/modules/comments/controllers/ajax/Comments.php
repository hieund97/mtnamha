<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends FC_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model(array('BackendComments_Model','FrontendComments_Model'));
		$this->load->library('ConfigBie');
	}

	public function addcomment(){
		$module = $this->input->post('module');
		$moduleid = $this->input->post('moduleid');
		$parentid = $this->input->post('parentid');
		$alert = array(
			'error' => '',
			'message' => '',
			'result' => ''
		);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', ' / ');
		$this->form_validation->set_rules('fullname', 'Tên hiển thị', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('contents', 'Nội dung', 'trim|required');
		if ($this->form_validation->run($this)){
			$post = $this->input->post('post');
			$data = '';
			if(isset($post) && is_array($post) && count($post)){
				// print_r($post);die;
				foreach($post as $key => $val){
					$data[$val['name']] = nl2br($val['value']) ;
				}
			}else{
				$data['fullname'] = $this->input->post('fullname');
				$data['message'] = $this->input->post('contents');
			}
			$data['parentid'] = $parentid;
			$data['module'] = $module;
			$data['moduleid'] = $moduleid;
			$data['publish'] = 0;
			$data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);

			if(isset($data) && is_array($data) && count($data)){
				$this->db->insert('comments', $data);
				$this->db->flush_cache();
			}
		}else{
			$alert['error'] = validation_errors();
		}
		echo json_encode($alert); die();
	}
	
	
	public function listComment(){
		$module = $this->input->post('module');
		$moduleid = $this->input->post('moduleid');
		$page = $this->input->post('page');
		$page = (int)$page;
		$config['total_rows'] = $this->FrontendComments_Model->Countall($module, $moduleid);
		if($config['total_rows'] > 0){
			$this->load->library('pagination');
			$config['base_url'] ='#" data-page="';
			$config['suffix'] = $this->config->item('url_suffix').(!empty($_SERVER['QUERY_STRING'])?('?'.$_SERVER['QUERY_STRING']):'');
			$config['first_url'] = $config['base_url'].$config['suffix'];
			$config['per_page'] = 10;
			$config['cur_page'] = $page;
			$config['page'] = $page; 
			$config['uri_segment'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;
			$config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right">';
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
			// print_r($data['listPagination']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$data['listComment'] = $this->FrontendComments_Model->View(($page * $config['per_page']),$config['per_page'], $module, $moduleid);
			$data['listComment'] = recursive($data['listComment']);
		}
		$member_log = json_decode($this->session->userdata('fc_customer_auth'), TRUE);
		$html = '';
		if(isset($data['listComment']) && is_array($data['listComment']) && count($data['listComment'])){
				$html = $html . '<h2 class="h2-title">BÌNH LUẬN CỦA KHÁCH HÀNG<span><i>('.$config['total_rows'].' bình luận)</i></span></h2>';
				// $html = $html .'<span class="flr">Sắp xếp theo: Mới nhất</span>';
			foreach($data['listComment'] as $key => $val){
				
				$alias = explode(' ', $val['fullname']);
				$num = count($alias) - 1;
				
			    if (is_array($alias) && count($alias)) {
			    	foreach ($alias as $key1 => $vals) {
			    		if ($num != $key1) continue;
			    		// echo $vals;
			    		$name_alias = substr(removeutf8($vals), 0, 1);
			    	}
			    }else
			    $name_alias = 'A';
			    

				$html = $html . '<div class="wp-item-cmt padding-15 border1 po-re">';
					$html = $html.'<div class="hoi">';
						$html = $html .'<div class="top-cmt">';
							
							$html = $html.'<div class="text-cmt-top">';
								$html = $html .'<p class="p1"><b>'.$val['fullname'].'</b> đã bình luận:</p>';
								$html = $html .'<p class="p2"><b>'.$val['created'].'</b></p>';
							$html = $html.'</div>';
							if ($val['type'] == 0) {
								//'.substr_first($val['fullname']).'
								$html = $html .'<div class="img-avt"><img src="templates/backend/images/avatar.jpg"></div>';
							}
						$html = $html .'</div>';
						$html = $html.'<div class="post-cmt">';
							$html = $html.'<p>'.$val['message'].'</p>';
						$html = $html.'</div>';
					$html = $html.'</div>';
					
					$html = $html.'<div class="amenu uk-flex uk-flex-middle lib-grid-20">';
						$html = $html.'<span class="item-reply" data-id="'.$val['id'].'"><i class="fa fa-reply"></i> Trả lời</span>';
						// $html = $html.'<span class="fright"><i class="fa fa-heart"></i> '.$val['like'].'</span>';
					$html = $html.'</div>';
					$html = $html.'<div class="reply-comment"></div>';
					if(isset($val['child']) && is_array($val['child']) && count($val['child'])){
						
						foreach($val['child'] as $keyg => $vals){
							$html = $html . '<div class="item-comments-sub mt10">';
								$html = $html . '<div class="item-comments '.(($vals['type'] == 1) ? 'uk-active-mod' : '').'">';
									$html = $html .'<div class="info uk-flex  mb5 lib-grid-10">';
										if ($vals['type'] == 0) {
											$html = $html .'<div class="avatar ec-cover"><img src="templates/backend/images/avatar.jpg"></div>';
										}
										$html = $html.'<div class="author">';
											$html = $html .'<div class="meta"><span class="user uk-text-bold">'.$vals['fullname'].'</span> </div>';
											$html = $html .'<div class="meta"><span class="date">'.$vals['created'].' </span> </div>';
										$html = $html.'</div>';
									$html = $html .'</div>';
									$html = $html.'<div class="content">';
										$html = $html.'<div>'.$vals['message'].'</div>';
									$html = $html.'</div>';
									// $html = $html.'<div class="amenu uk-flex uk-flex-middle lib-grid-20">';
										// $html = $html.'<span class="item-reply" data-id="'.$vals['id'].'"><i class="fa fa-reply"></i> Trả lời</span>';
										// $html = $html.'<span class="fright"><i class="fa fa-heart"></i> '.$vals['like'].'</span>';
									// $html = $html.'</div>';
									// $html = $html.'<div class="reply-comment"></div>';
								$html = $html.'</div>';
							$html = $html.'</div>';
						}
					
					}
				$html = $html . '</div>';
			}
			// $html = $html . '<li class="ajax-pagination">'.$data['listPagination'].'</li>';
		}else{
			$html = $html.'';
		}
		echo json_encode(array(
			'html' => $html,
		));
		// die();
	}
	
}
