<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller {
    public function index()
    {

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'posts';
        $current_url = base_url(uri_string());
        $arr['where'] = array('deleted' => null);
        if (!isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = $_GET['page'];
        }
        $per_page = 6 ;
        $total_rows = $this->posts_model->count_all($arr,'id', 0 ,50000);

        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $arr['order_by_desc'] = 'id';
        $data['posts'] =  $this->posts_model->get_all($arr, $page * $per_page  , $per_page);
        $data['setting'] = $this->setting;
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/posts',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
