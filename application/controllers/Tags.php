<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends MY_Controller {
    public function index($parameter = NULL)
    {

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'tags';
        $arr['where'] = array('alias' => trim($parameter));
        $current_url = base_url(uri_string());
        $data['tags'] = $this->tags_model->get($arr);
        if (isset( $data['tags']) && count( $data['tags']) > 0)
        {
            $arr = array();
            $join[0] = array('table' =>'relationships','join_condition' =>'posts.id = relationships.candidate_key');
            $arr['select'] = '*';
            $arr['table'] = 'posts';
            $arr['join'] = $join;
            $arr['where'] = array('relationships.foreign_table' => 'tags' ,'relationships.candidate_table' => 'posts','relationships.foreign_key' => ''.$data['tags']['id'].'');
            $arr['order_by_desc'] = 'posts.id';

            if (!isset($_GET['page']))
            {
                $page = 1;
            }
            else
            {
                $page = $_GET['page'];
            }

            $per_page =6 ;
            $total_rows = $this->tags_model->join_num_rows($arr);

            $total_page= ceil($total_rows / $per_page);
            $page = ($page > $total_page)?$total_page:$page;
            $page =($page < 1)? 1 : $page;
            $page = $page - 1;
            $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);


            $data['posts'] = $this->tags_model->join($arr, $per_page,$page * $per_page );
        }
        else
        {
            show_404();
        }
        $data['setting'] = $this->setting;
        $data['setting']['title'] =$data['tags']['name'];
        $data['setting']['url'] = base_url(uri_string());
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/tags',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
