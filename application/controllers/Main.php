<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
    public function index()
    {
       

        $array = array();
        $array['select'] = '*';
        $array['table'] = 'category';
        $array['where'] = array('show_index'=>1,'status'=>1);
        $array['order_by_asc'] = 'order';
        $data['categorys'] = $this->posts_model->get_all($array, 0 , 5000 );
        $data['setting'] = $this->setting;
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/main',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
