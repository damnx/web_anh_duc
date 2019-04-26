<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager.html');
        }
        $post = $this->input->post();

        if ($post)
        {
            if ($post['type'] == 'category')
            {
                $post['link'] = '' ;
            }
            if ($post['type'] == 'link')
            {
                $post['id_category'] = 0 ;
            }
            $data['check_type'] = $post['type'];
            $alias = trim($post['alias']);
            $alias = $this->my_libraies_string->alias($alias);
            $post['alias'] = $alias;

            $arr = array();
            $arr['select'] = '*';
            $arr['table'] = 'menu';
            $arr['where'] = array('alias' => $alias,'mid' =>$post['mid'] );
            $check_alias =  $this->menu_model->get($arr);

            if (isset($post['id']) && !empty($post['id']))
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['where'] = array('id' => (int)$post['id']);
                $check_id =  $this->menu_model->get($arr);
                if (isset($check_id) && $check_id['alias'] == $post['alias'] && $check_id['parent_id'] == $post['parent_id'])
                {
                    $where = array('id'=>(int)$post['id']);
                    unset($_POST['parent_id']);
                    $data['return'] = $this->menu_model->update($post,$where,'menu');
                }
                else
                {
                    if (!isset($check_alias) || empty($check_alias) && $check_id['parent_id'] != $post['parent_id'])
                    {
                        $where = array('id'=>(int)$post['id']);
                        $data['return'] = $this->menu_model->update($post,$where,'menu');
                    }
                    else if (isset($check_alias) && count($check_alias) > 0 && $check_id['alias'] == $post['alias'])
                    {
                        $where = array('id'=>(int)$post['id']);
                        $data['return'] = $this->menu_model->update($post,$where,'menu');
                    }
                    else if (isset($check_alias) && count($check_alias) > 0 && $check_id['alias'] != $post['alias'])
                    {
                        $data['return'] = array('title'=>'error','text'=>'Alias existing database');
                    }

                }
            }
            else
            {

                if (isset($check_alias) && count($check_alias) > 0)
                {
                    $data['return'] = array('title'=>'error','text'=>'Alias existing database');
                }
                else
                {
                    $data['return'] = $this->menu_model->insert($post,'menu');
                }

            }
        }
        $data['active'] = 'menu';
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'category';
        $arr['order_by_asc'] = 'left_ct';
        $data['select_nestedset']=$this->menu_model->get_all($arr,0 , 50000);
        $data['categorys'] = $this->my_libraies_nestedset->dropdown($data['select_nestedset']);

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'menu';
        $arr['order_by_asc'] = 'wednesday';
        $arr['where'] = array('mid' => 1 );
        $data['menus'] = $this->my_libraies_nestedset->recursive_basic(0,$this->menu_model->get_all($arr,0 , 50000),' ','dropdown');



        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'menu_item';
        $arr['order_by_asc'] = 'id';

        $data['menu_team']=$this->menu_model->get_all($arr,0 , 50000);


        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/menu/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
    public function ajax($action = null)
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
            $json = array('status'=>false, 'message'=>'Access denied');
        }
        $json = $echo = false;
        if ($action == 'get')
        {
            $id = (int)$this->input->post('id');
            if (isset($id) && $id > 0)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['where'] = array('id' => $id );
                $menu = $this->menu_model->get($arr);
                if (isset($menu) && count($menu) > 0)
                {
                    if ($menu['type'] == 'category')
                    {
                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'category';
                        $arr['where'] = array('id' => $menu['id'] );
                        $category = $this->menu_model->get($arr);
                        $data = $menu;
                        $data['name_category'] = $category['name'];
                        $json = $data;
                    }
                    else
                    {
                        $json = $menu;
                    }
                }
            }
        }
        if ($action == 'delete')
        {
            $id = (int)$this->input->post('id');
            if (isset($id) && $id > 0)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['where'] = array('parent_id' => $id);
                $arr['order_by_desc'] = 'id';
                $menu = $this->menu_model->get_all($arr,0,5000);
                if (isset($menu) && count($menu)>0)
                {
                    $json = $data = array('title' =>'error','text' =>'Delete submenu first!');
                }
                else
                {
                    $this->menu_model->delete('menu',array('id' => $id));
                    $json = $data = array('title' =>'success','text' =>' Data deletion is successful, can not be restored !');
                }
            }

        }
        if ($action == 'getParent')
        {
            $id = (int)$this->input->post('id');
            if (isset($id) && $id > 0)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['order_by_asc'] = 'wednesday';
                $arr['where'] = array('mid' => $id );
                $menus= $this->my_libraies_nestedset->recursive_basic(0,$this->menu_model->get_all($arr,0 , 50000),' ','dropdown');
                ?>
                    <select  name="parent_id" id="parent_id" class="form-control">
                        <option value="0">No Parent</option>
                        <?php
                        if (isset($menus) && is_array($menus))
                        {
                            foreach ($menus as $menu)
                            {
                                ?>
                                <option value="<?=$menu['id']?>"><?=$menu['name']?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                <?php
            }

        }
        if ($action =='getMenu')
        {
            $id = (int)$this->input->post('id');
            if (isset($id) && $id > 0)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'menu';
                $arr['where'] = array('mid' => $id);
                $arr['order_by_asc'] = 'wednesday';
                $menus = $this->my_libraies_nestedset->recursive_basic(0,$this->menu_model->get_all($arr,0 , 50000),' ','dropdown');
                ?>
                <ul id="menu-group-1" class="nav menu">
                    <?php
                    if (isset($menus) && is_array($menus))
                    {
                        foreach ($menus as $menu)
                        {
                            ?>
                            <li id="id-<?=$menu['id']?>" class="item-1 deeper parent active">
                                <a  href="javascript:;" onclick="renders(<?= $menu['id']?>)" class="lbl"><?=$menu['name']?></a>
                                <a href="javascript:;" onclick="remove(<?= $menu['id']?>)"  class="sign-cate sign-cate-trash  "><i  class="fa fa-trash" aria-hidden="true"></i></a>
                                <a href="javascript:;" onclick="renders(<?= $menu['id']?>)"  class="sign-cate sign-cate-square"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </li>
                            <?php

                        }
                    }
                    ?>

                </ul>
                <?php
            }
        }
        if($json) {
            echo json_encode($json);
        }
        else{
            echo $echo;
        }
        exit;
    }
}
?>