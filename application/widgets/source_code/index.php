<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Source_code_widget   extends MY_Widget
{
    function index($cid = null,$title = null,$color = null)
	{
        $data = null;
        $join['0'] = array('table'=>'relationships','join_condition'=>'product.id = relationships.candidate_key');
        $arr = array();
        $arr['select'] = 'product.id,product.name,product.alias,product.thumb,product.type,product.type, product.price,product.fake_price,product.quantity';
        $arr['table'] = 'product';
        $arr['join'] = $join;
        $arr['order_by_desc'] = 'product.id';
        $arr['where'] = array('relationships.candidate_table' =>'product','relationships.foreign_key'=>$cid,'relationships.foreign_table'=>'category','product.quantity >= '=>'1' ,'deleted' => NULL ,'status' => '1','published <='=>time());
        $data['posts'] = $this->product_model->join($arr,8,0);
        

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'category';
        $arr['where'] = array('id' =>(int)$cid );
        $data['category'] = $this->product_model->get($arr);

        $data['title'] = $title;
        $data['cid'] =$cid;
        $data['color'] =$color;
        $this->load->view('views',$data);
    }
}