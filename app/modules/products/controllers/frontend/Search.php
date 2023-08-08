<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends FC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->fc_lang = $this->config->item('fc_lang');
        /* KIỂM TRA TÌNH TRẠNG WEBSITE */
        if ($this->fcSystem['homepage_website'] == 1) {
            echo '<img src="' . base_url() . 'templates/backend/images/close.jpg' . '" style="width:100%;" />';
            die();
        }
        /* -------------------------- */
    }

    public function pcbuilder()
    {

        $sort = '';
        $selected_saleoff_desc = '';
        $selected_saleoff_asc = '';
        $selected_news = '';
        $order = $this->input->get('step');
        $sort = $this->input->get('sort');
//        var_dump($sort);
        if ($sort == 'price-desc') {
            $order_by = '`pr`.`saleoff` desc';
            $selected_saleoff_desc = 'selected';
        } else if ($sort == 'price-asc') {
            $order_by = '`pr`.`saleoff` asc';
            $selected_saleoff_asc = 'selected';
        } else if ($sort == 'new') {

            $order_by = '`pr`.`id` desc';
            $selected_news = 'selected';

        } else {
            $order_by = '`pr`.`order` asc, `pr`.`id` desc';
            $selected_news = 'selected';
        }
        $danhmuc = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
            'select' => 'id, title, slug, canonical, images, lft, rgt,attributes',
            'where' => array('order' => $order, 'isaside' => 1, 'trash' => 0, 'publish' => 1, 'alanguage' => '' . $this->fc_lang . ''),
            'limit' => 100, 'order_by' => 'order asc, id desc'));
        if (isset($danhmuc) && is_array($danhmuc) && count($danhmuc)) {
            foreach ($danhmuc as $key => $val) {
                $danhmuc[$key]['post'] = $this->FrontendProducts_Model->_read_condition(array(
                    'modules' => 'products',
                    'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`code`,`pr`.`price`,`pr`.`saleoff`, `pr`.`description`, `pr`.`banner`, `pr`.`created`',
                    'where' => '`pr`.`trash` = 0 AND `pr`.`publish` = 1 AND `pr`.`alanguage` = \'' . $this->fc_lang . '\'',
                    'limit' => 10000,
                    'order_by' => $order_by,
                    'cataloguesid' => $val['id'],
                ));
//                echo $this->db->last_query();
            }
        }
        if (isset($danhmuc) && is_array($danhmuc) && count($danhmuc)) {
            foreach ($danhmuc as $key => $val) {
                $title = $val['id'];
                //laays thuoocj tinhs
                $attribute = json_decode($val['attributes'], TRUE);
                if ($attribute['attribute_catalogue'] != '') {
                    $attributes_catalogues = $this->Autoload_Model->_get_where(array(
                        'select' => 'id, title, keyword',
                        'table' => 'attributes_catalogues',
                        'order' => 'order desc, id desc',
                        'where' => array('publish' => 1, 'trash' => 0),
                        'where_in' => $attribute['attribute_catalogue'],
                        'where_in_field' => 'id'
                    ), TRUE);
                }
                if (isset($attributes_catalogues) && is_array($attributes_catalogues) && count($attributes_catalogues)) {
                    foreach ($attributes_catalogues as $keyatt => $valatt) {
                        $attributes_catalogues[$keyatt]['attributes'] = $this->Autoload_Model->_get_where(array(
                            'select' => 'id, title',
                            'table' => 'attributes',
                            'order' => 'order desc, id desc',
                            'where' => array('publish' => 1, 'trash' => 0, 'cataloguesid' => $valatt['id']),
                        ), TRUE);
                    }
                }

                //end lay thuoc tinh
                echo '<div id="pPro">
                        <div class="title-buitl"><h3>Bước ' . $order . ' : ' . $val['title'] . ' -  <a href="javascript:pcbuilder_next_step()">Bỏ qua</a></h3></div>
                        <div class="row">
                           <div class="col-xs-3 nav-sidebar nav-sidebar-mobile-fill">';
                //thuoc timnh
                if (isset($attributes_catalogues) && is_array($attributes_catalogues) && count($attributes_catalogues)) {
                    echo '<div class="aside-fillter"> <section class="fillter_bl"><div class="content_fillter">';
                    foreach ($attributes_catalogues as $keyatt => $valatt) {
                        echo '<div class="group-fillter fill-key-' . $keyatt . '">
                                            <div class="attribute-title">
                                                <label class="form-label tpInputLabel">' . $valatt['title'] . '</label>
                                            </div>';

                        if (isset($valatt['attributes']) && is_array($valatt['attributes']) && count($valatt['attributes'])) {
                            echo '<div class="attribute-group">';
                            foreach ($valatt['attributes'] as $keyAttributes => $valAttributes) {
                                if (isset($attribute['attribute'][$valatt['keyword']]) && count($attribute['attribute'][$valatt['keyword']]) && in_array($valAttributes['id'], $attribute['attribute'][$valatt['keyword']]) == false) continue;
                                echo '<label class="fillter-label tpInputLabel fill-line-' . $keyatt . '" data-line="fill-line-' . $keyatt . '">
								<input class="filter" type="checkbox" name="attr[' . $valatt['keyword'] . ']" value="' . $valAttributes['id'] . '" id="item-' . $valAttributes['id'] . '" />
								<label for="item-' . $valAttributes['id'] . '">' . $valAttributes['title'] . '</label>
							</label>';
                            }

                            echo '</div>';


                        }
                        echo '</div>';

                    }


                    echo '</div></section></div>';

                }

                echo '<form  id="Formfilter" method="post" action="" class="hidden">
    <input type="text" value="" name="attr" id="attr" class="confirm-filter" />
    <input type="text" value="1" name="page" id="page" class="" />
    <input type="text" value="' . $order . '" name="page" id="stepid" class="" />
    <input type="text" value="' . $title . '" name="cataloguesid" id="cataloguesid" class="" />
    <input type="submit" value="" name="submit" id="filter_submit" class="" />
</form>';


                //end thuoocj tinh
                echo '</div>
                            <div class="col-xs-9">
                                <div id="dPro">

                                   <select name="ddlSortP" id="ddlSortP" class="form-control" onchange="getval(this);" style="width: auto;float: right;margin-bottom: 10px;border-radius: 0px">
	<option value="new" ' . $selected_news . '>Sản phẩm mới</option>
	<option value="price-desc" ' . $selected_saleoff_desc . '>Giá giảm dần</option>
	<option value="price-asc" ' . $selected_saleoff_asc . '>Giá tăng dần</option>

</select>


                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Sản&nbsp;phẩm</th>
                                            <th>Lựa&nbsp;chọn</th>
                                        </tr>';
                if (isset($val['post']) && is_array($val['post']) && count($val['post'])) {
                    foreach ($val['post'] as $keyP => $valP) {
                        $idproduct = $valP['id'];
                        $hrefP = rewrite_url($valP['canonical'], $valP['slug'], $valP['id'], 'products');
                        echo '<tr>
                                                                    <td align="center" style="vertical-align:middle"><img style="max-width:100px;max-height:100px" src="' . $valP['images'] . '" alt="' . $valP['title'] . '"></td>
                                                                    <td>
                                                                        <p class="p-built"><a style="font-size:14px;font-weight:700;color:#1b76bd" href="' . $hrefP . '" target="_blank">' . $valP['title'] . '</a></p>

                                                                        <p class="p-built" style="font-size:11px;color:#777">

                                                                        ' . $valP['description'] . '

                                                                        </p>
                                                                    </td>
                                                                    <td style="vertical-align:middle">
                                                                        <p class="p-built"><b style="color:red">';
                        if ($valP['saleoff'] > 0) {
                            echo number_format($valP['saleoff']);
                        } else {
                            echo 'Liên hệ';
                        }
                        echo '</b></p>';
                        echo '<input type="number" id="amount_' . $idproduct . '" value="1" min="1" style="width: 50px;">';
                        echo '<p class="p-built" style="font-size:11px"><a style="margin-bottom: 10px;color: #1b76bd;" href="javascript:pcbuilder_select_part(' . $idproduct . ',' . $order . ',' . $order . ',' . $title . ');">Chọn sản phẩm</a></p>';
                        echo '<input type="hidden" id="price_' . $idproduct . '" value="' . $valP['saleoff'] . '">
                                                                        <input type="hidden" id="name_' . $idproduct . '" value="' . $valP['title'] . '">
                                                                        <input type="hidden" id="url_' . $idproduct . '" value="' . $hrefP . '">
                                                                    </td>
                                                                </tr>';
                    }
                }


                echo '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }


    }

    public function Xaydungcauhinh()
    {
        $data['meta_title'] = 'Xây dựng cấu hình máy ';
        $data['meta_keywords'] = 'Xây dựng cấu hình máy ';
        $data['meta_description'] = 'Xây dựng cấu hình máy ';
        $data['template'] = 'products/frontend/search/xaydungcauhinh';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }

    public function chinhsuacauhinh()
    {
        if ( !$this->session->has_userdata('cauhinh') && !$this->session->has_userdata('pc_part_id') && !$this->session->has_userdata('pc_total_price') ) {
            redirect('xay-dung-cau-hinh');
        }
        $data['meta_title'] = 'Chỉnh sửa cấu hình máy ';
        $data['meta_keywords'] = 'Chỉnh sửa cấu hình máy ';
        $data['meta_description'] = 'Chỉnh sửa cấu hình máy ';
        $data['template'] = 'products/frontend/search/chinhsuacauhinh';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }

    public function sessionCauhinh(){
        $data_cauhinh = $this->input->post('data_cauhinh');
        $data_pc_part_id = $this->input->post('pc_part_id');
        $data_pc_total_price = $this->input->post('pc_total_price');
        $this->session->set_userdata('cauhinh', $data_cauhinh);
        $this->session->set_userdata('pc_part_id', $data_pc_part_id);
        $this->session->set_userdata('pc_total_price', $data_pc_total_price);
        echo 1;die;
    }
    
    public function Xemvaincauhinh()
    {
        $id = '';
        $_insert_[] = '';
        $id = explode(",", $this->input->get('str'));
        $i=0;
        $id_2 = array();
        foreach ($id as $val) {
            if ($val != '') {
                $data_ex = explode('t', $val);
                $_insert_[] = $data_ex['0'];
                $data_ex_2 = explode("-", $data_ex['0']);
                $id_2[] = $data_ex_2['0'];
                $data['id_3'][$data_ex_2['0']] = $data_ex_2['1'];
            }
        }
        //echo "<pre>";var_dump($data['id_3']);die;
        if (!empty($id_2)) {
            $data['listProduct'] = $this->FrontendProducts_Model->ReadAll($id_2, $this->fc_lang);
        }else{
            redirect('xay-dung-cau-hinh');
        }
        
        //echo '<pre>';var_dump($data['listProduct']); $this->db->last_query();die;
        //echo $this->db->last_query();die;

//        foreach($data['listProduct'] as $key=>$val){
//            $globalprice = ($val['saleoff'])?$val['saleoff']:$val['price'];
//            $_insert_cart_[] = array(
//                'id' => $val['id'],
//                'name' => $val['title'],
//                'qty' => $data['id_3'][$key],
//                'price' => $globalprice,
//            );
//        }
//        $this->cart->insert($_insert_cart_);

        $data['meta_title'] = 'Cấu hình đã chọn';
        $data['meta_keywords'] = 'Cấu hình đã chọn';
        $data['meta_description'] = 'Cấu hình đã chọn';
        $data['template'] = 'products/frontend/search/xemvaincauhinh';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
    public function Xemvaincauhinhredirect()
    {
        $id = '';
        $_insert_[] = '';
        $id = explode(",", $this->input->get('str'));
        $i=0;
        foreach ($id as $val) {
            if ($val != '') {
                $data_ex = explode('t', $val);
                $_insert_[] = $data_ex['0'];
                $data_ex_2 = explode("-", $data_ex['0']);
                $id_2[] = $data_ex_2['0'];
                $data['id_3'][$data_ex_2['0']] = $data_ex_2['1'];
            }
        }
        //echo "<pre>";var_dump($data['id_3']);die;

        $data['listProduct'] = $this->FrontendProducts_Model->ReadAll($id_2, $this->fc_lang);
        //echo '<pre>';var_dump($data['listProduct']); $this->db->last_query();die;
        //echo $this->db->last_query();die;

        foreach($data['listProduct'] as $key=>$val){
            $globalprice = ($val['saleoff'])?$val['saleoff']:$val['price'];
            $_insert_cart_[] = array(
                'id' => $val['id'],
                'name' => $val['title'],
                'qty' => $data['id_3'][$val['id']],
                'price' => $globalprice,
            );
        }
        $this->cart->insert($_insert_cart_);
        redirect('dat-mua');

    }
    public function export_download(){

        $id = '';
        $_insert_[] = '';
        $id = explode(",", $this->input->get('str'));
        $i=0;
        foreach ($id as $val) {
            if ($val != '') {
                $data_ex = explode('t', $val);
                $_insert_[] = $data_ex['0'];
                $data_ex_2 = explode("-", $data_ex['0']);
                $id_2[] = $data_ex_2['0'];
                $data['id_3'][] = $data_ex_2['1'];
            }
        }
        //echo "<pre>";var_dump($data['id_3']);die;

        $data['listProduct'] = $this->FrontendProducts_Model->ReadAll($id_2, $this->fc_lang);
        $data['meta_title'] = 'In cấu hình';
        $data['meta_keywords'] = 'In cấu hình';
        $data['meta_description'] = 'In cấu hình';
        $data['template'] = 'products/frontend/search/export_download';
        $this->load->view('homepage/frontend/layouts/homenone', isset($data) ? $data : NULL);

    }

    public function filter()
    {

        $post = $this->input->post('post');

        $attribute = explode('-', $post);
        $page = $this->input->post('page');
        $cataloguesid = $this->input->post('cataloguesid');
        $order = $this->input->post('stepid');
        $temp_attribute['cataloguesid'] = $this->input->post('cataloguesid');
        $page = (int)$page;
        $config['total_rows'] = $this->FrontendProducts_Model->countajaxproduct($attribute, $temp_attribute['cataloguesid'], $this->fc_lang);
        // echo $this->db->last_query();die;
        $result = '';

        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['base_url'] = '#" data-page="';
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 24;
            $config['cur_page'] = $page;
            $config['page'] = $page;
            $config['uri_segment'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="pagination mb30"><ul class="uk-pagination uk-pagination-right" id="ajax-pagination">';
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $page = $page - 1;
            $data['listProduct'] = $this->FrontendProducts_Model->viewajaxproduct(($page * $config['per_page']), $config['per_page'], $attribute, $temp_attribute['cataloguesid'], $this->fc_lang);
        // echo $this->db->last_query();die;

        }
        

        $html = '';
        if (isset($data['listProduct']) && is_array($data['listProduct']) && count($data['listProduct'])) {
            $html = $html . '<table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Sản&nbsp;phẩm</th>
                                            <th>Lựa&nbsp;chọn</th>
                                        </tr>';
            foreach ($data['listProduct'] as $key => $val) {
                
                // check total và danh mục cha do một sản phẩm được phép nhiều anh mục cha nên cần check để in ra khi lọc
                $count_cataloguesid = count(json_decode($val['catalogues'],true));
                $count_attribute = count($attribute);
                if (empty($attribute[0])) {
                    $count_attribute = 0;
                }
                if ($count_cataloguesid*$count_attribute < $val['total'] && $count_attribute > 1) {
                    continue;
                }

                $id = $val['id'];
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products');
                $image = getthumb($val['images']);
                $description = strip_tags($val['description']);
                $price = $val['price'];
                $saleoff = $val['saleoff'];
                if ($price > 0) {
                    $pri_old = '<font>' . str_replace(',', '.', number_format($price)) . ' <sub>₫</sub></font>';
                } else {
                    $pri_old = '';
                }
                if ($saleoff > 0) {
                    $pri_sale = str_replace(',', '.', number_format($saleoff));
                } else {
                    $pri_sale = 'Liên hệ';
                }

                $html = $html . '<tr>
                                                                    <td align="center" style="vertical-align:middle"><img style="max-width:100px;max-height:100px" src="' . $val['images'] . '" alt="' . $val['title'] . '"></td>
                                                                    <td>
                                                                        <p class="p-built"><a style="font-size:14px;font-weight:700;color:#1b76bd" href="' . $href . '" target="_blank">' . $val['title'] . '</a></p>

                                                                        <p class="p-built" style="font-size:11px;color:#777">

                                                                        ' . $val['description'] . '

                                                                        </p>
                                                                    </td>
                                                                    <td style="vertical-align:middle">
                                                                        <p class="p-built"><b style="color:red">';

                $html = $html . '' . $pri_sale . '</b></p>';
                $html = $html . '<input type="number" id="amount_' . $id . '" value="1" min="1" style="width: 50px;">';

                $html = $html . '<p class="p-built" style="font-size:11px"><a style="    color: #1b76bd;" href="javascript:pcbuilder_select_part(' . $id . ',' . $order . ',' . $order . ',' . $cataloguesid . ');">Chọn sản phẩm</a></p>';
                $html = $html . '<input type="hidden" id="price_' . $id . '" value="' . $val['saleoff'] . '">
                                                                        <input type="hidden" id="name_' . $id . '" value="' . $val['title'] . '">
                                                                        <input type="hidden" id="url_' . $id . '" value="' . $href . '">
                                                                    </td>
                                                                </tr>';


            }
            $html = $html . '</tbody></table>';

        }


        echo json_encode(array(
            'html' => $html,
        ));
        die();
    }

    public function View($page = 1)
    {

        $page = (int)$page;
        $seoPage = '';
        if ($this->input->get('key')) {
            $data['keys'] = $this->input->get('key');
        }
        $categories = (int)$this->input->get('categories');
        if (!empty($categories) && $categories != 0) {
            $DetailCatalogues = $this->FrontendProductsCatalogues_Model->ReadByField('id', $categories, $this->fc_lang);
        } else {
            $DetailCatalogues = '';
        }

        $config['total_rows'] = $this->FrontendProductsCatalogues_Model->Countsearch(array(
            'select' => '`pr`.`id`',
        ), $DetailCatalogues, $this->fc_lang);

        // echo $this->db->last_query();die;

        $config['base_url'] = rewrite_url('tim-kiem', '', '', '', FALSE, TRUE);
        if ($config['total_rows'] > 0) {
            $this->load->library('pagination');
            $config['suffix'] = $this->config->item('url_suffix') . (!empty($_SERVER['QUERY_STRING']) ? ('?' . $_SERVER['QUERY_STRING']) : '');
            $config['prefix'] = 'trang-';
            $config['first_url'] = $config['base_url'] . $config['suffix'];
            $config['per_page'] = 12;
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
            $totalPage = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page <= 0) ? 1 : $page;
            $page = ($page > $totalPage) ? $totalPage : $page;
            $seoPage = ($page >= 2) ? (' - Trang ' . $page) : '';
            if ($page >= 2) {
                $data['canonical'] = $config['base_url'] . '/trang-' . $page . $this->config->item('url_suffix');
            }
            $page = $page - 1;
            $data['result'] = $this->FrontendProductsCatalogues_Model->search(array(
                'select' => '`pr`.`id`, `pr`.`title`, `pr`.`slug`, `pr`.`canonical`, `pr`.`images`, `pr`.`description`, `pr`.`price`, `pr`.`saleoff`, `pr`.`code`, `pr`.`highlight`, `pr`.`psale`, `pr`.`isfooter`',
                'order_by' => '`pr`.`order` asc ,`pr`.`id` desc',
                'start' => ($page * $config['per_page']),
                'limit' => $config['per_page'],
            ), $DetailCatalogues, $this->fc_lang);
        }

        $data['DetailCatalogues'] = $DetailCatalogues;
        $data['meta_title'] = 'Suche ' . $this->input->post('key');
        $data['meta_keywords'] = $this->input->post('key');
        $data['meta_description'] = $this->input->post('key');
        $data['total_rows'] = $config['total_rows'];

        $data['template'] = 'products/frontend/search/view';
        $this->load->view('homepage/frontend/layouts/home', isset($data) ? $data : NULL);
    }
}
