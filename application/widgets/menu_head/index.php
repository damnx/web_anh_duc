<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_head_widget   extends MY_Widget
{
    function index()
    {
        $data = null;
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'menu';
        $arr['order_by_asc'] = 'wednesday';
        $arr['where'] = array('status' => 1,'parent_id'=>0,'mid'=>1);
        $data['menus'] = $this->menu_model->get_all($arr,0,500);
        if (isset($data['menus']) && count($data['menus']))
        {
            foreach ($data['menus'] as $key => $menu)
            {
                $arr = array();
                $arr['select'] = 'alias,name';
                $arr['table'] = 'category';
                $arr['where'] = array('id' =>$menu['id_category'],'status' =>1);
                $data['menus'][$key]['cid'] = $this->menu_model->get($arr);

                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['order_by_asc'] = 'wednesday';
                $arr['where'] = array('status' => 1,'parent_id'=>$menu['id'],'mid'=>1);
                $data['menus'][$key]['mci'] = $this->menu_model->get_all($arr,0,500);

                if (isset( $data['menus'][$key]['mci']) && count( $data['menus'][$key]['mci']))
                {
                    foreach ( $data['menus'][$key]['mci'] as $mii => $mci )
                    {
                        $arr = array();
                        $arr['select'] = 'alias,name';
                        $arr['table'] = 'category';
                        $arr['where'] = array('id' =>$mci['id_category'],'status' =>1);
                        $data['menus'][$key]['mci'][$mii]['cid'] = $this->menu_model->get($arr);


                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'menu';
                        $arr['order_by_asc'] = 'wednesday';
                        $arr['where'] = array('status' => 1,'parent_id'=>$mci['id'],'mid'=>1);
                        $data['menus'][$key]['mci'][$mii]['mciii'] = $this->menu_model->get_all($arr,0,500);
                        if ($data['menus'][$key]['mci'][$mii]['mciii'] && count($data['menus'][$key]['mci'][$mii]['mciii']))
                        {
                            foreach ($data['menus'][$key]['mci'][$mii]['mciii'] as $miii => $mciii)
                            {

                                $arr = array();
                                $arr['select'] = 'alias,name';
                                $arr['table'] = 'category';
                                $arr['where'] = array('id' =>$mciii['id_category'],'status' =>1);
                                $data['menus'][$key]['mci'][$mii]['mciii'][$miii]['cid'] = $this->menu_model->get($arr);
                            }
                        }
                    }
                }
                if ($menu['type'] =='category')
                {
                    if ($menu['product_posts'] == 'product')
                    {
                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'relationships';
                        $arr['order_by_desc'] = 'id';
                        $arr['where'] = array('foreign_key' =>$menu['id_category'] ,'foreign_table'=>'category','candidate_table'=>'product');
                        $pro_ids = $this->relationships_model->get_all($arr,0,6);
                        if (isset($pro_ids) && count($pro_ids))
                        {
                            foreach ($pro_ids as $pr => $pro_id)
                            {
                                $arr = array();
                                $arr['select'] = 'id,name,alias,type,thumb,price,fake_price,rating';
                                $arr['table'] = 'product';
                                $arr['order_by_desc'] = 'id';
                                $arr['where'] = array('id'=>$pro_id['candidate_key'],'deleted' => NULL ,'status' => 1,'published <='=>time());
                                $data['menus'][$key]['product'][$pr] = $this->product_model->get($arr);
                            }
                        }
                    }
                    else if ($menu['product_posts'] == 'posts')
                    {
                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'relationships';
                        $arr['order_by_desc'] = 'id';
                        $arr['where'] = array('foreign_key' =>$menu['id_category'] ,'foreign_table'=>'category','candidate_table'=>'posts');
                        $pro_ids = $this->relationships_model->get_all($arr,0,6);
                        if (isset($pro_ids) && count($pro_ids))
                        {
                            foreach ($pro_ids as $pr => $pro_id)
                            {
                                $arr = array();
                                $arr['select'] = '*';
                                $arr['table'] = 'posts';
                                $arr['order_by_desc'] = 'id';
                                $arr['where'] = array('id'=>$pro_id['candidate_key'],'deleted' => NULL ,'status' => 1,'published <='=>time());
                                $data['menus'][$key]['product'][$pr] = $this->product_model->get($arr);
                            }
                        }
                    }
                }


            }
        }
        $this->load->view('views',$data);
    }
}