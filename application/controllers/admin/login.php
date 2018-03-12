<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/8/2018
 * Time: 2:06 PM
 */
Class login extends MY_Controller
{
    function index()
    {
        $this->load->view('admin/login/index');
    }
}