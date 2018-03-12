<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/8/2018
 * Time: 2:05 PM
 */
Class MY_Controller extends CI_Controller
{
    public $data = array();
    public function __construct()
    {
        parent::__construct();
        $controller = $this->uri->segment(1);
        switch ($controller)
        {
            case 'admin' :
                {
                    // xu ly tai admin
                    $this->load->helper('admin');
                    $this->_check_login();
                    break;
                }
            default:
                {
                    //xu ly trang ngoai
                }

        }
    }
    /*
     * kiem tra trang thai dang nhap
     */
    public function _check_login()
    {

    }
}