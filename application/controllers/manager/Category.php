<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
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
		{
			if ($post)
			{

				if (isset($post['id']) && !empty($post['id']))
				{
                    $id = (int)$post['id'];
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'category';
                    $arr['where'] = array('id' =>$id);
                    $check_id =  $this->category_model->get($arr);
				    if (isset($check_id) && $check_id['alias'] != trim($post['alias']) )
                    {
                        $alias = trim($this->input->post('alias'));
                        $alias = $this->my_libraies_string->alias($alias);
                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'category';
                        $arr['where'] = array('alias' => $alias);
                        $check_alias =  $this->category_model->get($arr);
                        if (isset($check_alias) && count ($check_alias) > 0)
                        {
                            $data['return'] = array('title'=>'error','text'=>''.URL.'/'.trim($post['alias']).'.html'.' Existing database');
                        }
                        else
                        {
                            $arr = array();
                            $arr['select'] = '*';
                            $arr['table'] = 'category';
                            $arr['order_by_asc'] = 'left_ct';
                            $arr['where'] = array('left_ct >=' => $check_id['left_ct'], 'right_ct <=' => $check_id['right_ct']);
                            $children = $this->my_libraies_nestedset->children($this ->category_model->get_all($arr));

                            if (in_array($post['parent_id'],$children))
                            {
                                $data['return'] = array('title'=>'error','text'=>'This location can not be changed');
                            }
                            else
                            {
                                $alias = trim($this->input->post('alias'));
                                $alias = $this->my_libraies_string->alias($alias);
                                $post['updates'] = time();
                                $post['alias'] = $alias;
                                $where = array('id'=>(int)$post['id']);
                                $data['return'] = $this->category_model->update($post,$where,'category');

                                $arr = array();
                                $arr['select'] = 'id,parent_id';
                                $arr['table'] = 'category';
                                $arr['order_by_asc'] = 'left_ct';
                                $this->my_libraies_nestedset->recursive(0,$this->my_libraies_nestedset->set($this->category_model->get_all($arr,0 , 50000)));
                                $this->category_model->nestedset($this->my_libraies_nestedset->level,$this->my_libraies_nestedset->lft,$this->my_libraies_nestedset->rgt);
                            }
                        }
                    }
                    else
                    {
                            $arr = array();
                            $arr['select'] = '*';
                            $arr['table'] = 'category';
                            $arr['order_by_asc'] = 'left_ct';
                            $arr['where'] = array('left_ct >=' => $check_id['left_ct'], 'right_ct <=' => $check_id['right_ct']);

                            $children = $this->my_libraies_nestedset->children($this ->category_model->get_all($arr));

                            if (in_array($post['parent_id'],$children))
                            {
                                $data['return'] = array('title'=>'error','text'=>'This location can not be changed');
                            }
                            else
                            {
                                $alias = trim($post['alias']);
                                $alias = $this->my_libraies_string->alias($alias);
                                $post['updates'] = time();
                                $post['alias'] = $alias;
                                $where = array('id'=>(int)$post['id']);
                                $data['return'] = $this->category_model->update($post,$where,'category');
                                $arr = array();
                                $arr['select'] = 'id,parent_id';
                                $arr['table'] = 'category';
                                $arr['order_by_asc'] = 'left_ct';
                                $this->my_libraies_nestedset->recursive(0,$this->my_libraies_nestedset->set($this->category_model->get_all($arr,0 , 50000)));
                                $this->category_model->nestedset($this->my_libraies_nestedset->level,$this->my_libraies_nestedset->lft,$this->my_libraies_nestedset->rgt);
                            }
                    }
				}
				else
				{
                    $alias = trim($this->input->post('alias'));
                    $alias = $this->my_libraies_string->alias($alias);
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'category';
                    $arr['where'] = array('alias' => $alias);
                    $check =  $this->category_model->get($arr);
					if (isset($check) && count ($check) > 0)
					{
						$data['return'] = array('title'=>'error','text'=>'Alias existing database');
					}
					else
					{
                        $alias = trim($this->input->post('alias'));
                        $alias = $this->my_libraies_string->alias($alias);
                        $post['created'] = time();
                        $post['alias'] = $alias;

						$data['return'] = $this->category_model->insert($post,'category');
                        $arr = array();
                        $arr['select'] = 'id,parent_id';
                        $arr['table'] = 'category';
                        $arr['order_by_asc'] = 'left_ct';
                        $this->my_libraies_nestedset->recursive(0,$this->my_libraies_nestedset->set($this->category_model->get_all($arr,0 , 50000)));
                        $this->category_model->nestedset($this->my_libraies_nestedset->level,$this->my_libraies_nestedset->lft,$this->my_libraies_nestedset->rgt);
					}
					
				}
			}
		}
        $data['active'] = 'category';
        $arr = array();
        $arr['select'] = 'id,name,level';
        $arr['table'] = 'category';
        $arr['order_by_asc'] = 'left_ct';
        $data['select_nestedset']=$this->category_model->get_all($arr,0 , 50000);
        $data['categorys'] = $this->my_libraies_nestedset->dropdown($data['select_nestedset']);

        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/category/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
	 public function ajax($action = null)
    {
        $json = $echo = false;
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
            $json = array('status'=>false, 'message'=>'Access denied');
        }
        else
        {
			 if ($action == 'alias')
			{
				$alias = trim($this->input->post('alias'));
				$alias = $this->my_libraies_string->alias($alias);
				$echo = $alias;
			}
			if ($action == 'get')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'category';
                    $arr['where'] = array('id' => $id);
                    $json = $this->category_model->get($arr);
                }
            }
            if ($action == 'delete')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'category';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->category_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $arr = array();
                        $arr['select'] = '*';
                        $arr['table'] = 'category';
                        $arr['order_by_asc'] = 'left_ct';
                        $arr['where'] = array('left_ct >' =>$check_id['left_ct'],'right_ct < ' => $check_id['right_ct']);
                        $children = $this->my_libraies_nestedset->children($this->category_model->get_all($arr));
                        if (!isset($children) && count($children) == 0 )
                        {
                            $this->category_model->delete('category',array('id' => $id));
                            $json = $data = array('title' =>'success','text' =>' Data deletion is successful, can not be restored !');
                        }
                        else
                        {
                            $json = $data = array('title' =>'error','text' =>' Delete subcategories first ');
                        }
                    }
                    else
                    {
                        $json = $data = array('title' =>'error','text' =>' Data does not exist ');
                    }

                }
                else
                {
                    $json = $data = array('title' =>'error','text' =>' Data does not exist ');
                }

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