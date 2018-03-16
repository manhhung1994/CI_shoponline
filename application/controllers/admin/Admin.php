<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/9/2018
 * Time: 2:36 PM
 */
Class Admin extends  MY_Controller
{
    private $_username = 'username';
    private $_pass = 'password';
    private $_message = 'message';
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

//    function create()
//    {
//        $data = array();
//        $data[$this->_username] = 'hungtm1';
//        $data[$this->_pass] = 'hungtm2';
//        $data['name'] = 'hung4tm';
//        if ($this->admin_model->create($data))
//        {
//            echo 'Create thanh cong';
//
//        }
//        else
//        {
//            echo 'Khong create duoc';
//
//        }
//
//    }
//    function update()
//    {
//        $id = '8';
//        $data = array();
//        $data[$this->_username] = 'hungtm3';
//        $data[$this->_pass] = 'hungtm34';
//        $data['name'] = 'hungtm35';
//        if ($this->admin_model->update($id,$data))
//        {
//            echo 'Update thanh cong';
//        }
//        else
//        {
//            echo 'Khong update duoc';
//        }
//    }
//    function delete()
//    {
//        $id = '8';
//        if ($this->admin_model->delete($id))
//        {
//            echo 'Delete thanh cong';
//
//        }
//        else
//        {
//            echo 'Khong delete duoc';
//
//        }
//    }
//    function get_info()
//    {
//        $id = '10';
//        $info = $this->admin_model->get_info($id,$this->_username);
//        echo '<pre>';
//        print_r($info);
//    }
//    function get_list()
//    {
//        $input = array();
//        $input['where'] = array('id'=> 10);
////        $input['order'] = array('id','desc');
////        $input['order'] = array('id','asc');
////        $input['limit'] = array(1,0);
//            $input['like'] = array('name','hung');
//        $list = $this->admin_model->get_list($input);
//        echo '<pre>';
//        print_r($list);
//    }
    function index()
    {
        $input = array();
        $input['order'] = array('id','asc');
        $list = $this->admin_model->get_list($input);
        $this->data['list'] = $list;
        $this->data['total'] = $this->admin_model->get_total();

        $message = $this->session->flashdata($this->_message);
        $this->data[$this->_message] = $message;
        $this->data['temp'] = 'admin/admin/index';

        $this->load->view('admin/main', $this->data);
        // lay noi dung message
    }
    function check_username()
    {
        $username = $this->input->post($this->_username);
        $where= array($this->_username => $username );
        if($this->admin_model->check_exists($where)){

            $this->form_validation->set_message(__FUNCTION__,'User name đã tồn tại');
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
            $this->form_validation->set_rules($this->_username,'Tài khoản','required|callback_check_username');
            $this->form_validation->set_rules($this->_pass,'Mật khẩu','required|min_length[6]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','required|matches[password]');

            if (!($this->form_validation->run()))
            {
//                echo 'Validation false';
            }
            else
            {
                $name = $this->input->post('name');
                $username = $this->input->post($this->_username);
                $password = $this->input->post($this->_pass);
                $data = array(
                    'name' => $name,
                    $this->_username=> $username,
                );
                if ($password)
                {
                    $data[$this->_pass] = md5($password);
                }
                if($this->admin_model->create($data))
                {
                    $this->session->set_flashdata($this->_message,'Thêm mới thành công');
                }
                else
                {
                    $this->session->set_flashdata($this->_message,'Không thêm được');
                }
                redirect(admin_url('admin'));
            }

        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/main', $this->data);
    }
    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        //lay id
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //lay du lieu
        $info = $this->admin_model->get_info($id);
        if (!($info))
        {
            $this->session->set_flashdata($this->_message,'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        $this->data['info'] = $info;

        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required|min_length[8]');
            $this->form_validation->set_rules($this->_username,'Tài khoản','required|callback_check_username');
            $password = $this->input->post('passowrd');
            if ($password)
            {
                $this->form_validation->set_rules($this->_pass,'Mật khẩu','required|min_length[6]');
                $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','required|matches[password]');
            }

            if (!($this->form_validation->run()))
            {
//                echo 'Validation false';
            }
            else
            {
                $name = $this->input->post('name');
                $username = $this->input->post($this->_username);
                $password = $this->input->post($this->_pass);
                $data = array(
                    'name' => $name,
                    $this->_username=> $username,
                    $this->_pass => md5($password),
                );
                if($this->admin_model->update($id,$data))
                {
                    $this->session->set_flashdata($this->_message,'Update thành công');
                }
                else
                {
                    $this->session->set_flashdata($this->_message,'Không update được');
                }
                redirect(admin_url('admin'));
            }
        }
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/main', $this->data);
    }
    function delete()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        //lay id
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //lay du lieu
        $info = $this->admin_model->get_info($id);
        if (!($info))
        {
            $this->session->set_flashdata($this->_message,'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }

        $this->admin_model->delete($id);
        $this->session->set_flashdata($this->_message,'Xóa thành công');
        redirect(admin_url('admin'));
    }
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
}