<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller
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
        if (isset($_SESSION['use_admin']))
        {
            unset($_SESSION['use_admin']);
        }
        $this->session->unset_userdata('use_admin');
        $this->my_libraies_redirect->php_redirect('manager/login.html');
    }
}

?>