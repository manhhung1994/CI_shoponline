<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/8/2018
 * Time: 2:55 PM
 */
class Home extends MY_Controller
{
    function index()
    {
        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/main',$this->data);
    }
}