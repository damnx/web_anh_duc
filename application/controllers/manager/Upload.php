<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        $data['active'] = 'upload';
        if ($this->input->post('upload'))
        {
           $arr =array();
           $arr['upload_path'] = 'statics/upload/';
           $arr['allowed_types'] = 'gif|jpg|png';
           $arr['max_size'] = '1024';
           $arr['remove_spaces'] = 'TRUE';
           $data['upload'] = $this->my_libraies_upload->uploading($arr);
        }
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/upload/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
    public function listFiles()
    {

        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        $this->load->helper('directory');

        $data['posts'] = directory_map('./statics/upload/', FALSE, TRUE);

        $data['active'] = 'listFiles';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/upload/listFiles',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
}

?>