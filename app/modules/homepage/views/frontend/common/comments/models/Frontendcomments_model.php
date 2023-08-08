<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontendComments_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function Countall($module = '', $moduleid = 0){
		$this->db->where(array('trash' => 0, 'publish' => 1, 'module' => $module, 'moduleid' => $moduleid));
		$this->db->from('comments');
		$result = $this->db->count_all_results();
		$this->db->flush_cache();
		return $result;
	}

	public function View($start = 0, $limit = 0, $module = '', $moduleid = 0){
		$this->db->where(array('trash' => 0, 'publish' => 1, 'module' => $module, 'moduleid' => $moduleid));
		$this->db->from('comments');
		$this->db->order_by('id DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get()->result_array();
		$this->db->flush_cache();
		return $result;
	}

	// public function countall($module = '', $moduleid = 0){

	// 	$count = $this->db->query('
	//    		SELECT `cm`.`id`, `cm`.`message`, `cm`.`created`, `us`.`fullname`, `us`.`avatar`
	// 		FROM `comments` as `cm`
	//    		INNER JOIN `customers` as `us` ON `cm`.`star` = `us`.`id`

	//    		WHERE `cm`.`trash` = 0 AND `cm`.`publish` = 1 ORDER BY `cm`.`id` desc')->num_rows();

	//   	$this->db->flush_cache();
	//   	return $count;

	// }

	// public function view($start = 0, $limit = 0, $module = '', $moduleid = 0){
	// 	$result = $this->db->query('
	//    		SELECT `cm`.`id`, `cm`.`message`, `cm`.`created`, `us`.`fullname`, `us`.`avatar`
	// 		FROM `comments` as `cm`
	//    		INNER JOIN `customers` as `us` ON `cm`.`star` = `us`.`id`

	//    		WHERE `cm`.`trash` = 0 AND `cm`.`publish` = 1 ORDER BY `cm`.`id` desc LIMIT '.($start).', '.$limit.'')->result_array();
	// 	$this->db->flush_cache();
	// 	return $result;
	// }


}