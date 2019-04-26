<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs_widget   extends MY_Widget
{
    function index($left = 0, $right = 0){
        $data = null;
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'category';
        $arr['order_by_asc'] = 'left_ct';
        $arr['where'] = array('left_ct <=' => $left ,'right_ct >='=> $right);
        $data['breadcrumbs'] = $this->category_model->get_all($arr,0,500);
        $this->load->view('views',$data);
    }
}