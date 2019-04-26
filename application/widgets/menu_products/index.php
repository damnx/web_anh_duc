<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_products_widget   extends MY_Widget
{
    function index(){
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'menu';
        $arr['order_by_asc'] = 'wednesday';
        $arr['where'] = array('status' => 1,'parent_id'=>0,'mid'=>2);
        $data['menus_products'] = $this->menu_model->get_all($arr,0,10);
        if (isset( $data['menus_products']) && count( $data['menus_products']) > 0)
        {
            foreach ($data['menus_products'] as $key => $menu)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['order_by_asc'] = 'wednesday';
                $arr['where'] = array('status' => 1,'parent_id'=>$menu['id'],'mid'=>2);
                $data['menus_products'][$key]['mni'] = $this->menu_model->get_all($arr,0,10);
                if (isset( $data['menus_products'][$key]['mni']) && count($data['menus_products'][$key]['mni']) > 0)
                {
                    foreach ($data['menus_products'][$key]['mni'] as $mni => $menui)
                    {
                        if ($menui['type'] == 'category')
                        {
                            $arr = array();
                            $arr['select'] = 'name,alias';
                            $arr['table'] = 'category';
                            $arr['where'] = array('id'=> $menui['id_category']);
                            $data['menus_products'][$key]['mni'][$mni]['category'] = $this->category_model->get($arr);
                        }
                    }
                }
                if ($menu['type'] == 'category')
                {
                    $arr = array();
                    $arr['select'] = 'name,alias';
                    $arr['table'] = 'category';
                    $arr['where'] = array('id'=> $menu['id_category']);
                    $data['menus_products'][$key]['category'] = $this->category_model->get($arr);
                }
            }
        }
        $this->load->view('views',$data);
    }
}