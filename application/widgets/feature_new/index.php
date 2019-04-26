<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature_new_widget   extends MY_Widget
{
    function index(){
        $data = null;
        $arr = array();
        $arr['select'] = 'id,title,alias,feature,status,published,deleted,thumb';
        $arr['table'] = 'posts';
        $arr['order_by_desc'] = 'id';
        $arr['where'] = array('deleted' => NULL ,'feature' => 1,'status' => 1,'published <='=>time());
        $data['posts'] = $this->posts_model->get_all($arr,0,4);
        if (isset( $data['posts']) && count( $data['posts']) > 0)
        {
            foreach ($data['posts'] as $key => $post)
            {

                $arr = array();
                $join['0'] = array('table'=>'relationships','join_condition'=>'category.id=relationships.foreign_key');
                $arr = array();
                $arr['select'] = 'category.id,category.name,category.alias';
                $arr['table'] = 'category';
                $arr['join'] = $join;
                $arr['order_by_desc'] = 'category.id';
                $arr['where'] = array('relationships.candidate_key' =>$post['id'],'relationships.candidate_table'=>'posts','relationships.foreign_table'=>'category');
                $category = $this->category_model->join($arr,500,00);
                $data['posts'][$key]['category'] = array_shift($category);
            }
        }
        $this->load->view('views',$data);
    }
}