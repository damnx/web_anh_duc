<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends MY_Controller
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
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'attribute';
        $data['search'] = $this->input->get('q');
        if (isset($data['search']) && $data['search'] !='')
        {
            $arr['like'] = array('name' => $data['search'] );
            $current_url = base_url(uri_string()).'?q='.$data['search'];
        }
        else
        {
            $current_url = base_url(uri_string());
        }
        if (!isset($_GET['page']))
        {
            $page = 1;
        }
        else
        {
            $page = $_GET['page'];
        }
        $per_page = 20 ;
        $total_rows = $this->attribute_model->count_all($arr,'id', 0 , 50000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $arr['order_by_desc'] = 'id';
        $data['posts'] =  $this->attribute_model->get_all($arr, $page * $per_page  , $per_page);
        if (isset($data['posts']))
        {
            foreach ($data['posts'] as $key => $post)
            {

                $data['posts'][$key]['category'] = $this->attribute_model->get_join_attribute($post['id']);
            }
        }
        $data['active'] = 'product';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/product/attribute/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
    public function iteam($parameter = NULL)
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        if (isset($parameter) && !empty($parameter))
        {
            $array = array();
            $array['select'] = '*';
            $array['table'] = 'attribute';
            $array['where'] = array('id' =>(int)$parameter);
            $data['attribute'] =  $this->attribute_model->get($array);

            $array = array();
            $array['select'] = 'foreign_key';
            $array['table'] = 'relationships';
            $array['where'] = array('foreign_table' =>'category','candidate_table'=>'attribute','candidate_key'=>(int)$parameter);
            $category =  $this->attribute_model->get_all($array);

            if (isset($category))
            {
                foreach ($category as $key => $value)
                {
                    $data['attribute']['category'][$key] = $value['foreign_key'];

                }
            }
            $array = array();
            $array['select'] = '*';
            $array['table'] = 'detail_attribute';
            $array['where'] = array('id_attribute' => (int)$parameter);
            $array['order_by_asc'] = 'id';
            $data['attribute']['detail_attribute'] = $this->attribute_model->get_all($array);


        }
        $post = $this->input->post();
        if ($post)
        {
            if (!isset($post['category']) || empty($post['category']))
            {
                $data['return'] = array('title'=>'error','text'=>'Category not null ! ');
            }
            else
            {
                if (isset($post['id']) && $post['id'] !='')
                {
                    $alias = trim($this->input->post('name'));
                    $alias = $this->my_libraies_string->alias($alias);
                    $type = array(
                        'name' => trim($post['name']),
                        'alias' => $alias,
                    );
                    $where = array('id'=>(int)$post['id']);
                    $this->attribute_model->update($type,$where,'attribute');
                    $data['type']['name'] = trim($post['name']);
                    $this->relationships_model->delete('relationships',array('candidate_table' => 'attribute','candidate_key' =>(int)$post['id'],'foreign_table' =>'category'));
                    if (isset($post['category']) && count($post['category']) >0)
                    {
                        $data['type']['category'] = $post['category'];
                        foreach ($post['category'] as $key => $value )
                        {
                            $relationships = array();
                            $relationships['candidate_table'] = 'attribute';
                            $relationships['candidate_key'] = (int)$post['id'];
                            $relationships['foreign_table'] = 'category';
                            $relationships['foreign_key'] = $value;
                            $this->relationships_model->insert($relationships,'relationships');
                        }
                    }
                    if (isset($post['details']) && is_array($post['details']))
                    {
                        foreach ($post['details'] as $key => $detail)
                        {
                            if (isset($detail['id_details']) && $detail['id_details'] !='' )
                            {
                                $alias = trim($detail['name']);
                                $alias = $this->my_libraies_string->alias($alias);

                                $array = array();
                                $array['select'] = '*';
                                $array['table'] = 'detail_attribute';
                                $array['where'] = array('id' => (int)$detail['id_details'],'id_attribute' => (int)$post['id']);
                                $check = $this->detail_attribute_model->get($array);
                                if ($check['alias'] == $alias )
                                {
                                    $attribute = array(
                                        'name' => trim($detail['name']),
                                        'alias' => $alias
                                    );
                                    $where = array('id'=>(int)$detail['id_details']);
                                    $this->detail_attribute_model->update($attribute,$where,'detail_attribute');
                                }
                                else
                                {
                                    $array = array();
                                    $array['select'] = '*';
                                    $array['table'] = 'detail_attribute';
                                    $array['where'] = array('alias' => $alias,'id_attribute' => (int)$post['id']);
                                    $check = $this->detail_attribute_model->get($array);
                                    if (!isset($check) || empty($check))
                                    {
                                        $attribute = array(
                                            'name' => trim($detail['name']),
                                            'alias' => $alias
                                        );
                                        $where = array('id'=>(int)$detail['id_details']);
                                        $this->detail_attribute_model->update($attribute,$where,'detail_attribute');
                                    }
                                }


                            }
                            else
                            {
                                $alias = trim($detail['name']);
                                $alias = $this->my_libraies_string->alias($alias);
                                $detail = array(
                                    'name' =>$detail['name'],
                                    'alias' => $alias,
                                    'id_attribute' => $post['id']
                                );
                                $this->detail_attribute_model->insert($detail,'detail_attribute');
                                $data['type']['detail_attribute'] = $post['details'];
                                $data['type']['detail_attribute'][$key+1] = $post['details'];
                            }
                        }
                    }
                    $this->my_libraies_redirect->php_redirect('manager/product/attribute-iteam/'.$post['id'].'.html');
                }
                else
                {
                    $alias = trim($post['name']);
                    $alias = $this->my_libraies_string->alias($alias);
                    $attribute = array(
                        'name' => trim($post['name']),
                        'alias' => $alias
                    );
                    $data['return'] = $this->attribute_model->insert($attribute,'attribute');
                    if (isset($post['category']) && count($post['category']) >0)
                    {
                        foreach ($post['category'] as $value )
                        {
                            $relationships = array();
                            $relationships['candidate_table'] = 'attribute';
                            $relationships['candidate_key'] = $data['return']['id'];
                            $relationships['foreign_table'] = 'category';
                            $relationships['foreign_key'] = $value;
                            $this->relationships_model->insert($relationships,'relationships');
                        }
                    }
                    if (isset($post['details']) && count($post['details']) > 0)
                    {

                        foreach ($post['details'] as $details )
                        {
                            $alias = trim($details['name']);
                            $alias = $this->my_libraies_string->alias($alias);

                            $array = array();
                            $array['select'] = '*';
                            $array['table'] = 'detail_attribute';
                            $array['where'] = array('alias' => $alias,'id_attribute' => $data['return']['id']);
                            $check = $this->detail_attribute_model->get($array);
                            if (!isset($check) || empty($check))
                            {
                                $detail = array(
                                    'name' =>$details['name'],
                                    'alias' => $alias,
                                    'id_attribute' => $data['return']['id']
                                );
                                $this->detail_attribute_model->insert($detail,'detail_attribute');
                            }
                        }

                    }
                    $this->my_libraies_redirect->php_redirect('manager/product/attribute-iteam/'.$data['return']['id'].'.html');
                }
            }

        }
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'category';
        $array['order_by_asc'] = 'id';
        $data['categorys'] = $this->category_model->get_all($array, 0 , 5000 );
        $data['active_hone'] = 'product';
        $data['active'] = 'attribute';
        $data['iteam'] = 'iteam';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/product/attribute/add',isset($data) ? $data : Null);
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
            if ($action == 'delete')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'attribute';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->attribute_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $this->attribute_model->delete('attribute',array('id' => $id));
                        $this->relationships_model->delete('relationships',array('candidate_key' => $id ,'foreign_table' => 'category','candidate_table' =>'attribute'));
                        $this->detail_attribute_model->delete('detail_attribute',array('id_attribute' => $id));
                        $json = $data = array('title' =>'success','text' =>' Data deletion is successful, can not be restored !');
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
            if ($action == 'deleteDetails')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'detail_attribute';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->attribute_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $this->detail_attribute_model->delete('detail_attribute',array('id' => $id));
                        $json = $data = array('title' =>'success','text' =>' Data deletion is successful, can not be restored !');
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