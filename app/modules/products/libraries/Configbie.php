<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigBie{
	
	function __construct($params = NULL){
		$this->params = $params;
	}

	public function data($field = 'process', $value = -1){
		$data['ishome'] = array(
			-1 => '- Chọn -',
			0 => 'Không hiển thị',
			1 => 'Hiện thị'
		);
		$data['isaside'] = array(
			-1 => '- Chọn -',
			0 => 'Không hiển thị',
			1 => 'Hiển thị'
		);
		$data['isfooter'] = array(
			0 => 'Còn hàng',
			1 => 'Hết hàng',
//			2 => 'Liên hệ',
		);
		$data['publish'] = array(
			-1 => '- Chọn xuất bản -',
			0 => 'Không xuất bản',
			1 => 'Xuất bản',
		);
		$data['highlight'] = array(
			-1 => '- Chọn nổi bật -',
			0 => 'Không nổi bật',
			1 => 'Nổi bật',
		);
		$data['psale'] = array(
			-1 => '- Chọn khuyến mại -',
			0 => 'Không khuyến mại',
			1 => 'Khuyến mại',
		);
		$data['huong'] = array(
			0 => 'Chọn hướng',
			1 => 'Đông',
			2 => 'Tây',
			3 => 'Nam',
			4 => 'Bắc',
			5 => 'Đông Bắc',
			6 => 'Đông Nam',
			7 => 'Tây Bắc',
			8 => 'Tây Nam',
		);
		if($value == -1){
			return $data[$field];
		}
		else{
			return $data[$field][$value];
		}
	}
}