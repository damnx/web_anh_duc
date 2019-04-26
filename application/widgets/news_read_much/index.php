<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_read_much_widget   extends MY_Widget
{
    function index(){
        $lastmonth  = mktime(0, 0, 0, date("m")-2 , date("d"), date("Y"));
        $nextmonth  = mktime(0, 0, 0, date("m")+2 , date("d"), date("Y"));
        $data = null;
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'posts';
        $arr['order_by_desc'] = 'views';
        $arr['where'] = array('deleted' => NULL ,'status' => 1,'published <='=>$nextmonth,'published >='=>$lastmonth);
        $data['posts'] = $this->posts_model->get_all($arr,0,5);
        $this->load->view('views',$data);
    }
}