<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_post extends MY_Controller {
    public function index($parameter = NULL)
    {

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'posts';
        $arr['where'] = array('alias' => trim($parameter));
        $data['post'] = $this->posts_model->get($arr);
        if (isset($data['post']) && count($data['post']) > 0)
        {
            $data['categorys'] = $this->posts_model->category_posts($data['post']['id']);
        }
        else
        {
            show_404();
        }
        $data['setting'] = $this->setting;
        $data['setting']['title'] =$data['post']['meta_title'];
        $data['setting']['thumb'] = $data['post']['thumb'];
        $data['setting']['description'] = $data['post']['meta_description'];
        $data['setting']['url'] = base_url(uri_string());
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/single_post',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
