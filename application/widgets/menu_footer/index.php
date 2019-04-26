<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_footer_widget   extends MY_Widget
{
    function index(){
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'menu';
        $arr['order_by_asc'] = 'wednesday';
        $arr['where'] = array('status' => 1,'parent_id'=>0,'mid'=>3);
        $data['menus_footer'] = $this->menu_model->get_all($arr,0,5);
        if (isset( $data['menus_footer']) && count( $data['menus_footer']) > 0)
        {
            foreach ($data['menus_footer'] as $key => $menu)
            {
                if ($menu['id_category'] != 0)
                {
                    $arr = array();
                    $arr['select'] = 'name,alias';
                    $arr['table'] = 'category';
                    $arr['where'] = array('id'=> $menu['id_category']);
                    $data['menus_footer'][$key]['category'] = $this->category_model->get($arr);
                }
            }
        }
        $this->load->view('views',$data);
    }
}