<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/8/2018
 * Time: 2:06 PM
 */
Class Login extends MY_Controller
{
    function index()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        if($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if ($this->form_validation->run())
            {
                $this->session->set_userdata('login',true);
//                var_dump($this->session->userdata('login'));die();

                redirect(admin_url('home'));
            }
        }
        $this->load->view('admin/login/index');
    }
    function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);

        $this->load->model('admin_model');
        $where = array('username' => $username, 'password' => $password);

        if($this->admin_model->check_exists($where))
        {
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập thất bại');
        return false;
    }
}