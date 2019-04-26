<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    public $check_use_admin_login ;
    public $check_use ;
    public $setting ;
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('use_model','settings_model','slideshow_model','category_model','menu_model','posts_model','relationships_model','attribute_model','detail_attribute_model','product_model','tags_model','pratt_model','card_model','orders_model'));
        $this->load->helper(array('form', 'url','string','function_helper','thumb_helper'));
        $this->load->library(array('form_validation','my_libraies_redirect','my_libraies_use','session','my_libraies_pagination','my_libraies_upload','my_libraies_string','my_libraies_nestedset','my_libraies_setting'));
        $this->check_use_admin_login = $this->my_libraies_use->check_admin_login();
        $check[] = $this->check_use_admin_login;
        $this->check_use = $this->my_libraies_use ->check_use_login();

        if (isset($check['status']) && $check['status']  == 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        if (isset($check['deleted']) && $check['deleted']  != NULL)
        {
            $this->my_libraies_redirect->php_redirect('manager/logout.html');
        }
        $this->setting = $this->my_libraies_setting->setting();
    }
}
