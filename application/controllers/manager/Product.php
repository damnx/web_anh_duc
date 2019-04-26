<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('my_libraies_check_alias');
    }

    public function index($parameter = NULL)
    {

        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'product';
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
        if (isset($parameter) && $parameter == 'trash')
        {
            $arr['where'] = array('deleted !=' => null);
        }
        else
        {
            $arr['where'] = array('deleted' => null);
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
        $total_rows = $this->product_model->count_all($arr,'id', 0 , 50000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $arr['order_by_desc'] = 'id';
        $data['products'] =  $this->product_model->get_all($arr, $page * $per_page  , $per_page);
        if (isset($data['products']))
        {
            foreach ($data['products'] as $key => $post)
            {
                $arr = array();
                $arr['select'] = 'full_name';
                $arr['table'] = 'admin';
                $arr['where'] = array('id' => $post['id_use']);
                $data['products'][$key]['use_admin'] = $this->use_model->get($arr);
            }
        }
        $data['active_hone'] = 'product';
        $data['active'] = 'product';
        $data['iteam'] = 'iteam';
        if ($parameter == 'trash')
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/product/product/trash',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }
        else
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/product/product/iteam',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }

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
            $array['table'] = 'product';
            $array['where'] = array('id' =>(int)$parameter);
            $data['post'] =  $this->product_model->get($array);
            if (isset($data['post']) && count($data['post']) > 0)
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'relationships';
                $arr['order_by_asc'] = 'id';
                $arr['where'] = array('candidate_key' => $data['post']['id'],'candidate_table' => 'product','foreign_table'=>'category' );
                $data['post']['category_check'] = $this->relationships_model->get_all($arr,0,50000);
                foreach ($data['post']['category_check'] as $key => $value)
                {
                    $data['category_check'][$key] = $value['foreign_key'];
                }
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'relationships';
                $arr['order_by_asc'] = 'id';
                $arr['where'] = array('candidate_key' => $data['post']['id'],'candidate_table' => 'product','foreign_table'=>'tags' );
                $data['post']['tags'] = $this->relationships_model->get_all($arr,0,50000);
                foreach ($data['post']['tags'] as $key => $value)
                {
                    $array = array();
                    $array['select'] = '*';
                    $array['table'] = 'tags';
                    $array['where'] = array('id' => $value['foreign_key']);
                    $data['tags_product'][$key] = $this->tags_model->get($array);
                }
            }
            else
            {
                $this->my_libraies_redirect->php_redirect('manager/login.html');
            }
        }
        $post = $this->input->post();
        if (isset($post) && count($post)>0)
        {
            $alias = trim($post['alias']);
            $alias = $this->my_libraies_string->alias($alias);
            if (isset($post['feature']))
                $feature = (int)$post['feature'];
            else
                $feature = 0;
            if (isset($data['post']) && count($data['post']) > 0)
            {
                if ($data['post']['alias'] == $alias)
                {
                    $check_alias = $alias;
                }
                else
                {
                    $check_alias =  $this->my_libraies_check_alias->check_alias_product($alias);
                }
            }

            else
                {
                    $check_alias =  $this->my_libraies_check_alias->check_alias_product($alias);
                }

            $data['category_check'] = $this->input->post('category');

            if ($post['day'] !='')
            {
               $published = strtotime(date(''.(int)$post['hour'].':'.(int)$post['min'].':00 '.$post['day'].''));
            }
            else
            {
                $published = time();
            }
            if ($post['price'] !='')
            {
                $price = $result = str_replace(',', '', $post['price']);
            }
            if ($post['price'] !='')
            {
                $fake_price = $result = str_replace(',', '', $post['fake_price']);
            }
            $tags = explode(',',$post['tags']);
            foreach ($tags as  $key =>$value)
            {
                $data['tags_product'][$key] = array('name'=>$value);
            }
            if ($post['type'] == 'code')
                $quantity = 1;
            else
                $quantity = (int)$post['quantity'];
            if (isset($post['id']) && $post['id'] !='')
            {
                $arr =  array(
                    'id_use' =>$data['check_login']['id'],
                    'name' => trim($post['name']),
                    'alias' =>$check_alias,
                    'type' =>trim($post['type']),
                    'thumb' => trim($post['thumb']),
                    'price' => $price,
                    'fake_price' => $fake_price,
                    'quantity' => $quantity,
                    'link_dowload' => $post['link_dowload'],
                    'password' => $post['password'],
                    'content' => $post['content'],
                    'describe' => $post['describe'],
                    'practical_photo'=>$post['practical_photo'],
                    'status' => (int)$post['status'],
                    'feature'=>$feature,
                    'published' => $published,
                    'updates' => time()
                );
                $where = array('id'=>(int)$post['id']);
                $data['return'] = $this->product_model->update($arr,$where,'product');
                $post['category'] = $this->input->post('category');
                if (isset($post['category']) && count($post['category'])> 0 )
                {
                    $this->relationships_model->delete('relationships',array('candidate_table' => 'product','foreign_table'=>'category','candidate_key'=>(int)$post['id']));
                    foreach ($post['category'] as $value )
                    {
                        $relationships = array();
                        $relationships['candidate_table'] = 'product';
                        $relationships['candidate_key'] = $data['return']['id'];
                        $relationships['foreign_table'] = 'category';
                        $relationships['foreign_key'] = $value;
                        $this->relationships_model->insert($relationships,'relationships');
                    }
                }
                $this->relationships_model->delete('relationships',array('candidate_table' => 'product','foreign_table'=>'tags','candidate_key'=>(int)$post['id']));
                if (isset($tags) && count($tags) > 0)
                {
                    foreach ($tags as $tag)
                    {
                        $alias_tag = $this->my_libraies_string->alias($tag);
                        if ($alias_tag != null)
                        {
                            $array = array();
                            $array['select'] = '*';
                            $array['table'] = 'tags';
                            $array['where'] = array('alias' => $alias_tag);
                            $tag_check = $this->tags_model->get($array);
                            if (!isset($tag_check) || empty($tag_check))
                            {
                                $arr = array(
                                    'name'=>$tag,
                                    'alias' => $alias_tag
                                );
                                $data['return_tags'] = $this->tags_model->insert($arr,'tags');
                                $relationships = array();
                                $relationships['candidate_table'] = 'product';
                                $relationships['candidate_key'] = $data['return']['id'];
                                $relationships['foreign_table'] = 'tags';
                                $relationships['foreign_key'] = $data['return_tags']['id'];
                                $this->relationships_model->insert($relationships,'relationships');
                            }
                            else
                            {
                                $relationships = array();
                                $relationships['candidate_table'] = 'product';
                                $relationships['candidate_key'] = $data['return']['id'];
                                $relationships['foreign_table'] = 'tags';
                                $relationships['foreign_key'] = $tag_check['id'];
                                $this->relationships_model->insert($relationships,'relationships');
                            }
                        }
                    }
                }
            }
            else
            {
                $arr =  array(
                    'id_use' =>$data['check_login']['id'],
                    'name' => trim($post['name']),
                    'alias' =>$check_alias,
                    'type' =>trim($post['type']),
                    'thumb' => trim($post['thumb']),
                    'price' => $price,
                    'fake_price' => $fake_price,
                    'quantity' => $quantity,
                    'link_dowload' => $post['link_dowload'],
                    'password' => $post['password'],
                    'practical_photo'=>$post['practical_photo'],
                    'content' => $post['content'],
                    'describe' => $post['describe'],
                    'status' => (int)$post['status'],
                    'feature'=>$feature,
                    'published' => $published,
                    'created' => time()
                );
                 $data['return'] = $this->product_model->insert($arr,'product');
                if (isset($data['return']) && isset($data['return']['id']))
                {
                    $post['category'] = $this->input->post('category');
                    if (isset($post['category']) && count($post['category'])> 0 )
                    {
                        foreach ($post['category'] as $value )
                        {
                            $relationships = array();
                            $relationships['candidate_table'] = 'product';
                            $relationships['candidate_key'] = $data['return']['id'];
                            $relationships['foreign_table'] = 'category';
                            $relationships['foreign_key'] = $value;
                            $this->relationships_model->insert($relationships,'relationships');
                        }
                    }
                }
                if (isset($tags) && count($tags) > 0)
                {
                    foreach ($tags as $tag)
                    {
                        $alias_tag = $this->my_libraies_string->alias($tag);
                       if ($alias_tag != null)
                       {
                           $array = array();
                           $array['select'] = '*';
                           $array['table'] = 'tags';
                           $array['where'] = array('alias' => $alias_tag);
                           $tag_check = $this->tags_model->get($array);
                           if (!isset($tag_check) || empty($tag_check))
                           {
                               $arr = array(
                                   'name'=>$tag,
                                   'alias' => $alias_tag
                               );
                               $data['return_tags'] = $this->tags_model->insert($arr,'tags');
                               $relationships = array();
                               $relationships['candidate_table'] = 'product';
                               $relationships['candidate_key'] = $data['return']['id'];
                               $relationships['foreign_table'] = 'tags';
                               $relationships['foreign_key'] = $data['return_tags']['id'];
                               $this->relationships_model->insert($relationships,'relationships');
                           }
                           else
                           {
                               $relationships = array();
                               $relationships['candidate_table'] = 'product';
                               $relationships['candidate_key'] = $data['return']['id'];
                               $relationships['foreign_table'] = 'tags';
                               $relationships['foreign_key'] = $tag_check['id'];
                               $this->relationships_model->insert($relationships,'relationships');
                           }
                       }
                    }
                }
                $this->my_libraies_redirect->php_redirect('manager/product/pratt/'.$data['return']['id'].'.html');
            }
            $data['post'] = $post;
            $data['post']['fake_price'] = $fake_price;
            $data['post']['price'] = $price;
        }
        $data['active_hone'] = 'product';
        $data['active'] = 'product_iteam';
        $data['iteam'] = 'iteam';
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'category';
        $array['order_by_asc'] = 'id';
        $data['categorys'] = $this->product_model->get_all($array, 0 , 5000 );

        $array = array();
        $array['select'] = '*';
        $array['table'] = 'tags';
        $array['order_by_desc'] = 'id';
        $data['tags'] = $this->tags_model->get_all($array, 0 , 5000 );

        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/product/product/add',isset($data) ? $data : Null);
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
            if ($action=='delete')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'product';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->product_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $post['deleted'] = time();
                        $post['updates'] = time();
                        $where = array('id'=> $id);
                        $this->product_model->update($post,$where,'product');
                        $json = $data = array('title' =>'success','text' =>'Deleted success ! ');
                    }
                }
            }
            if ($action=='restore'){
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'product';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->product_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $post['deleted'] = NULL;
                        $post['updates'] = time();
                        $where = array('id'=> $id);
                        $this->product_model->update($post,$where,'product');
                        $json = $data = array('title' =>'success','text' =>'Data recovery successfu !');
                    }
                }
            }
            if ($action=='trash')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'product';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->product_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $this->product_model->delete('product',array('id' => $id));
                        $this->relationships_model->delete('relationships',array('candidate_key' => $id,'candidate_table'=>'product'));
                        $this->pratt_model->delete('product_detail_attribute',array('id_product' => $id));
                        $json = $data = array('title' =>'error','text' =>'Cant recover deleted data !');
                    }
                }
            }
            if ($action=='feature')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'product';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->product_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        if ($check_id['feature'] == 1)
                        {
                            $post['feature'] = 0;
                            $where = array('id'=> $id);
                            $this->product_model->update($post,$where,'product');
                            $json = $data = array('title' =>'success','text' =>'success !');
                        }
                        else
                        {
                            $post['feature'] = 1;
                            $where = array('id'=> $id);
                            $this->product_model->update($post,$where,'product');
                            $json = $data = array('title' =>'success','text' =>'success !');
                        }
                    }
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