<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/9/2018
 * Time: 2:36 PM
 */
Class Admin extends  MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    function create()
    {
        $data = array();
        $data['username'] = 'hungtm';
        $data['password'] = 'hungtm';
        $data['name'] = 'hungtm';
        if($this->admin_model->create($data))
            echo 'Create thanh cong';
        else
            echo 'Khong create duoc';

    }
    function update()
    {
        $id = '8';
        $data = array();
        $data['username'] = 'hungtm33';
        $data['password'] = 'hungtm33';
        $data['name'] = 'hungtm33';
        if($this->admin_model->update($id,$data))
            echo 'Update thanh cong';
        else
            echo 'Khong update duoc';
    }
    function delete()
    {
        $id = '8';
        if($this->admin_model->delete($id))
            echo 'Delete thanh cong';
        else
            echo 'Khong delete duoc';
    }
    function get_info()
    {
        $id = '10';
        $info = $this->admin_model->get_info($id,'username');
        echo '<pre>';
        print_r($info);
    }
    function get_list()
    {
        $input = array();
//        $input['where'] = array('id'=> 10);
//        $input['order'] = array('id','desc');
//        $input['order'] = array('id','asc');
//        $input['limit'] = array(1,0);
            $input['like'] = array('name','hung');
        $list = $this->admin_model->get_list($input);
        echo '<pre>';
        print_r($list);
    }
    function index()
    {
        $input = array();
        $input['order'] = array('id','asc');
        $list = $this->admin_model->get_list($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/admin/index';
        $this->data['total'] = $this->admin_model->get_total();
        $this->load->view('admin/main', $this->data);
    }
    function check_username()
    {
        $username = $this->input->post('username');
        $where= array('username' => $username );
        if($this->admin_model->check_exists($where)){

            $this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        // neu co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules('username','Tài khoản','required|callback_check_username');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[6]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','required|matches[password]');

            if ($this->form_validation->run() == FALSE)
            {
                echo 'Validation false';
            }
            else
            {
                $name = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $data = array(
                    'name' => $name,
                    'username'=> $username,
                    'password' => md5($password),
                );
                if($this->admin_model->create($data))
                {
                    $this->session->set_flashdata('message','Thêm mới thành công');
                }
                else
                {
                    $this->session->set_flashdata('message','Không thêm được');
                }
                redirect(admin_url('admin'));
            }

        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }

}