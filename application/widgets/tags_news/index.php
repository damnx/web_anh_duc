<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_news_widget   extends MY_Widget
{
    function index($id_post = 0){
        $data = null;
        $join[0] = array('table' =>'relationships','join_condition' =>'tags.id =  relationships.foreign_key');
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'tags';
        $arr['join'] = $join;
        $arr['where'] = array('relationships.foreign_table' => 'tags' ,'relationships.candidate_table' => 'posts','relationships.candidate_key' => ''.$id_post.'');
        $data['tags'] = $this->tags_model->join($arr,5,0);

        if (isset($data['tags'])  && count($data['tags']) > 0)
        {
            $data['tags'] = array_pop($data['tags']);
            $join[0] = array('table' =>'relationships','join_condition' =>'posts.id = relationships.candidate_key');
            $arr = array();
            $arr['select'] = '*';
            $arr['table'] = 'posts';
            $arr['join'] = $join;
            $arr['where'] = array('relationships.foreign_table' => 'tags' ,'relationships.candidate_table' => 'posts','relationships.foreign_key' => ''.$data['tags']['foreign_key'].'');
            $data['tags']['posts'] = $this->tags_model->join($arr,5,0);
        }
          else
          {
              $data['tags'] = null;
          }
        $this->load->view('views',$data);
    }
}