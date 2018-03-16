<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/15/2018
 * Time: 2:55 PM
 */
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }
    public function index()
    {
        $total_rows = $this->product_model->get_total();
        //load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong cac san pham
        $config['base_url'] = admin_url('product/index');
        $config['per_page'] = 4; //so luong sp/1page
        $config['uri_segment'] = 4;
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'] , $segment);

        // kiem tra co dieu kien loc khong
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }

        $name = $this->input->get('name');
        $input['where'] = array();
        if($name)
        {
            $input['like'] = array('name', $name);
        }

        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if($catalog_id > 0)
        {
            $input['where']['catalog_id'] = $catalog_id;
        }
        //lay danh sach san pamm
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;
        //lay danh muc san pham
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        foreach ($catalogs as $row)
        {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        //
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/product/index';
        $this->data['total_rows'] = $total_rows;
        $this->load->view('admin/main', $this->data);
    }
}