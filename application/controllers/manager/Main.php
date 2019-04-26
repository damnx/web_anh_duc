<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
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
        $data['active'] = 'main_admin';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/main',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
}

?>