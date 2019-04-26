<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller
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
        $data['settings'] = $this->setting;
        $post = $this->input->post();
        if (isset($post) && count($post) >0)
        {
            if (isset($post['id']) && $post['id'] !='')
            {
                $where = array('id'=>(int)$post['id']);
                $data['return'] = $this->settings_model->update($post,$where,'setting');
                $data['settings']= $post;
            }
        }
        $data['active'] = 'settings';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/settings/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
}

?>