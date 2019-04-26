<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_check_alias {
    public function check_alias_product($alias = 'NULL')
    {
        $CI = get_instance();
        $CI->load->model('product_model');
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'product';
        $array['where'] = array('alias' => $alias);
        $array['order_by_asc'] = 'id';
        $check = $CI->product_model->get($array);
        if (isset($check) && count($check) > 0)
        {
            $alias = $alias.'-1';
            return $this -> check_alias_product($alias);
        }
        else
        {
            return $alias;
        }
    }
    public function check_alias_post($alias = 'NULL')
    {
        $CI = get_instance();
        $CI->load->model('posts_model');
        $array = array();
        $array['select'] = 'id,alias';
        $array['table'] = 'posts';
        $array['where'] = array('alias' => $alias);
        $array['order_by_asc'] = 'id';
        $check = $CI->posts_model->get($array);
        if (isset($check) && count($check) > 0)
        {
            $alias = $alias.'-1';
            return $this -> check_alias_post($alias);
        }
        else
        {
            return $alias;
        }
    }
}