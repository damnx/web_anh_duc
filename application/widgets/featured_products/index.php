<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_products_widget   extends MY_Widget
{
    function index(){
        $data = null;
        $arr = array();
        $arr['select'] = 'id,name,alias,type,thumb,price,fake_price,rating';
        $arr['table'] = 'product';
        $arr['order_by_desc'] = 'id';
        $arr['where'] = array('deleted' => NULL ,'feature' => 1,'status' => 1,'published <='=>time(),'quantity >= '=>1);
        $data['posts'] = $this->product_model->get_all($arr,0,8);
        $this->load->view('views',$data);
    }
}