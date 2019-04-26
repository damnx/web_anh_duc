<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_widget   extends MY_Widget
{
    function index(){
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'slideshow';
        $arr['order_by_asc'] = 'wednesday';
        $arr['where'] = array('deleted' => NULL ,'status'=> 1);
        $data['posts'] = $this->slideshow_model->get_all($arr,0,3);
        $this->load->view('views',$data);
    }
}