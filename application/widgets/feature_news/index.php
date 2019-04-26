<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature_news_widget   extends MY_Widget
{
    function index(){
        $data = null;
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'posts';
        $arr['order_by_desc'] = 'id';
        $arr['where'] = array('deleted' => NULL ,'feature' => 1,'status' => 1,'published <='=>time());
        $data['posts'] = $this->posts_model->get_all($arr,0,5);
        $this->load->view('views',$data);
    }
}