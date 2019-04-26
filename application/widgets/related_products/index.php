<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Related_products_widget   extends MY_Widget
{
    function index($cid = 0,$id_pr = 0 ){
        $data = null;
        $join['0'] = array('table'=>'relationships','join_condition'=>'product.id = relationships.candidate_key');
        $arr = array();
        $arr['select'] = 'product.id,product.name,product.thumb,product.alias,product.type,product.price,product.fake_price,product.quantity,product.describe';
        $arr['table'] = 'product';
        $arr['join'] = $join;
        $arr['order_by_desc'] = 'product.id';
        $arr['where'] = array('relationships.candidate_table' =>'product','relationships.foreign_key'=>(int)$cid,'relationships.foreign_table'=>'category','product.id !='=>(int)$id_pr,'product.quantity >= '=>1 ,'deleted' => NULL ,'status' => 1,'published <='=>time());
        $data['posts'] = $this->product_model->join($arr,6,0);
        $this->load->view('views',$data);
    }
}