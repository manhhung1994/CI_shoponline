<?php
/**
 * Created by PhpStorm.
 * User: manhh
 * Date: 3/14/2018
 * Time: 10:13 AM
 */
class Catalog extends MY_Controller
{

    private $_message = 'message';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }
    public function index()
    {
        $list = $this->catalog_model->get_list();
        $this->data['list'] = $list;
        $message = $this->session->flashdata($this->_message);
        $this->data[$this->_message] = $message;

        $this->data['temp'] = 'admin/catalog/index';
        $this->load->view('admin/main', $this->data);
    }
    public function add()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        // neu co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required');

            if (!($this->form_validation->run()))
            {
//                echo 'Validation false';
            }
            else
            {
                $name = $this->input->post('name');
                $parent_id = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order),
                );
                if($this->catalog_model->create($data))
                {
                    $this->session->set_flashdata($this->_message,'Thêm mới thành công');
                }
                else
                {
                    $this->session->set_flashdata($this->_message,'Không thêm được');
                }
                redirect(admin_url('catalog'));
            }

        }
        //lay ra danh sach danh muc cha
        $input['where'] = array('parent_id' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/main', $this->data);
    }
    public function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));

        $id = $this->uri->rsegment(3);
        $info = $this->catalog_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata($this->_message,'Không tồn tại danh mục');
            redirect(admin_url('catalog'));
        }
        $this->data['info'] = $info;

        // neu co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name','Tên','required');

            if (!($this->form_validation->run()))
            {
//                echo 'Validation false';
            }
            else
            {
                $name = $this->input->post('name');
                $parent_id = $this->input->post('parent_id');
                $sort_order = $this->input->post('sort_order');
                $data = array(
                    'name' => $name,
                    'parent_id' => $parent_id,
                    'sort_order' => intval($sort_order),
                );
                if($this->catalog_model->update($id,$data))
                {
                    $this->session->set_flashdata($this->_message,'Cập nhật thành công');
                }
                else
                {
                    $this->session->set_flashdata($this->_message,'Không cập nhật được');
                }
                redirect(admin_url('catalog'));
            }

        }
        //lay ra danh sach danh muc cha
        $input['where'] = array('parent_id' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'admin/catalog/edit';
        $this->load->view('admin/main', $this->data);
    }
    public function delete()
    {
        //lay id
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //lay du lieu
        $info = $this->catalog_model->get_info($id);
        if (!($info))
        {
            $this->session->set_flashdata($this->_message,'Không tồn tại danh mục này');
            redirect(admin_url('admin'));
        }

        $this->catalog_model->delete($id);
        $this->session->set_flashdata($this->_message,'Xóa thành công');
        redirect(admin_url('catalog'));
    }
}