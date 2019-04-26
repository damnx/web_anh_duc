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
        $data['check_login'] = $this->check_use;
        if (!isset( $data['check_login']) && count( $data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('');
        }
        if (isset($_SESSION['use']))
        {
            unset($_SESSION['use']);
        }
        $this->session->unset_userdata('use');
        $this->my_libraies_redirect->php_redirect('');
    }
}

?>