<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends MY_Controller
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
        $arr['table'] = 'posts';
        $data['search'] = $this->input->get('q');
        if (isset($data['search']) && $data['search'] !='')
        {
            $arr['like'] = array('title' => $data['search'] );
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
        $total_rows = $this->posts_model->count_all($arr,'id', 0 , 50000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $arr['order_by_desc'] = 'id';
        $data['posts'] =  $this->posts_model->get_all($arr, $page * $per_page  , $per_page);
        if (isset($data['posts']))
        {
            foreach ($data['posts'] as $key => $post)
            {
                $arr = array();
                $arr['select'] = 'full_name';
                $arr['table'] = 'admin';
                $arr['where'] = array('id' => $post['id_use']);
                $data['posts'][$key]['use_admin'] = $this->use_model->get($arr);
            }
        }
        $data['active'] = 'posts';
        if ($parameter == 'trash')
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/posts/trash',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }
        else
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/posts/iteam',isset($data) ? $data : Null);
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
            $array['table'] = 'posts';
            $array['where'] = array('id' =>(int)$parameter);
            $data['post'] =  $this->posts_model->get($array);

            if (isset( $data['post']) && count( $data['post']) > 0 )
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'relationships';
                $arr['order_by_asc'] = 'id';
                $arr['where'] = array('candidate_key' => $data['post']['id'],'candidate_table' => 'posts','foreign_table'=>'category' );
                $data['post']['category_check'] = $this->relationships_model->get_all($arr,0,50000);

                foreach ($data['post']['category_check'] as $key => $value)
                {
                    $data['category_check'][$key] = $value['foreign_key'];
                }
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'relationships';
                $arr['order_by_asc'] = 'id';
                $arr['where'] = array('candidate_key' => $data['post']['id'],'candidate_table' => 'posts','foreign_table'=>'tags' );
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
            if (isset($post['feature']))
            {
//                $data['post']['feature'] = 1;
                $feature = (int)$post['feature'];
            }
            else
            {
//                $data['post']['feature'] = 0;
                $feature = 0;
            }

            $tags = array_unique(explode(',',$post['tags']));
            foreach ($tags as  $key =>$value)
            {
                $data['tags_product'][$key] = array('name'=>$value);
            }
            if (isset($post['category']) && count($post['category']) > 0)
            {
                $category = $post['category'];
                $data['category_check'] = $post['category'];
            }
            else
            {
                $category = null;
                $data['category_check']= null;
            }
            $data['category'] = $category;
            $published = strtotime(date(''.(int)$post['hour'].':'.(int)$post['min'].':00 '.$post['day'].''));
            if ($post['alias'] =="")
            {
                $alias = trim($post['title']);
            }
            else
            {
                $alias = trim($post['alias']);
            }
            $alias = $this->my_libraies_string->alias($alias);
            if (isset($data['post']) && count($data['post']) > 0)
            {
                if ($data['post']['alias'] == $alias)
                {
                    $check_alias = $alias;
                }
                else
                {
                    $check_alias =  $this->my_libraies_check_alias->check_alias_post($alias);
                }
            }
            else
            {
                $check_alias =  $this->my_libraies_check_alias->check_alias_post($alias);
            }
            if (isset($post['id']) && $post['id'] !='')
            {
                $arr = array(
                    'id_use'=>$data['check_login']['id'],
                    'title' => trim($post['title']),
                    'feature'=>$feature,
                    'alias' =>$check_alias,
                    'description' => trim($post['description']),
                    'content' => $post['content'],
                    'meta_title'=>$post['meta_title'],
                    'meta_description'=>$post['meta_description'],
                    'status' => $post['status'],
                    'type' => $post['type'],
                    'published'=>$published,
                    'thumb'=>trim($post['thumb']),
                    'updates' => time()
                );
                $where = array('id'=>(int)$post['id']);
                $data['return'] = $this->posts_model->update($arr,$where,'posts');
                if (isset($data['return']) && $data['return']['title']=="success")
                {

                    if (isset($category) && count($category) > 0)
                    {
                        $this->relationships_model->delete('relationships',array('candidate_table' => 'posts','foreign_table'=>'category','candidate_key'=>(int)$post['id']));
                        foreach ($post['category'] as $value )
                        {
                            $relationships = array();
                            $relationships['candidate_table'] = 'posts';
                            $relationships['candidate_key'] = $data['return']['id'];
                            $relationships['foreign_table'] = 'category';
                            $relationships['foreign_key'] = $value;
                            $this->relationships_model->insert($relationships,'relationships');
                        }
                    }
                    $this->relationships_model->delete('relationships',array('candidate_table' => 'posts','foreign_table'=>'tags','candidate_key'=>(int)$post['id']));
                    if (isset($tags) && count($tags) > 0)
                    {
                        foreach ($tags as $tag)
                        {
                            $alias_tag = $this->my_libraies_string->alias($tag);
                            if ($alias_tag !=null)
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
                                    $return_tags = $this->tags_model->insert($arr,'tags');
                                    if (isset($return_tags) && $return_tags['title'] == 'success')
                                    {
                                        $relationships = array();
                                        $relationships['candidate_table'] = 'posts';
                                        $relationships['candidate_key'] = $data['return']['id'];
                                        $relationships['foreign_table'] = 'tags';
                                        $relationships['foreign_key'] = $return_tags['id'];
                                        $this->relationships_model->insert($relationships,'relationships');
                                    }
                                }
                                else
                                {
                                    $relationships = array();
                                    $relationships['candidate_table'] = 'posts';
                                    $relationships['candidate_key'] = $data['return']['id'];
                                    $relationships['foreign_table'] = 'tags';
                                    $relationships['foreign_key'] = $tag_check['id'];
                                    $this->relationships_model->insert($relationships,'relationships');
                                }
                            }
                        }

                    }
                }
                $data['feature'] = $feature;
                $data['status'] = $post['status'];
            }
            else
            {
                $arr = array(
                    'id_use'=>$data['check_login']['id'],
                    'title' => trim($post['title']),
                    'alias' =>$check_alias,
                    'feature'=>$feature,
                    'description' => trim($post['description']),
                    'content' => $post['content'],
                    'meta_title'=>$post['meta_title'],
                    'meta_description'=>$post['meta_description'],
                    'status' => $post['status'],
                    'type' => $post['type'],
                    'published'=>$published,
                    'thumb'=>trim($post['thumb']),
                    'created' => time()
                );
                $data['return'] = $this->posts_model->insert($arr,'posts');
                if (isset($data['return']) && $data['return']['title']=="success")
                {

                    if (isset($category) && count($category) > 0)
                    {
                        foreach ($post['category'] as $value )
                        {
                            $relationships = array();
                            $relationships['candidate_table'] = 'posts';
                            $relationships['candidate_key'] = $data['return']['id'];
                            $relationships['foreign_table'] = 'category';
                            $relationships['foreign_key'] = $value;
                            $this->relationships_model->insert($relationships,'relationships');
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
                                    $return_tags = $this->tags_model->insert($arr,'tags');
                                    if (isset($return_tags) && $return_tags['title'] == 'success')
                                    {
                                        $relationships = array();
                                        $relationships['candidate_table'] = 'posts';
                                        $relationships['candidate_key'] = $data['return']['id'];
                                        $relationships['foreign_table'] = 'tags';
                                        $relationships['foreign_key'] = $return_tags['id'];
                                        $this->relationships_model->insert($relationships,'relationships');
                                    }
                                }
                                else
                                {
                                    $relationships = array();
                                    $relationships['candidate_table'] = 'posts';
                                    $relationships['candidate_key'] = $data['return']['id'];
                                    $relationships['foreign_table'] = 'tags';
                                    $relationships['foreign_key'] = $tag_check['id'];
                                    $this->relationships_model->insert($relationships,'relationships');
                                }
                            }
                        }
                    }
                }
                $data['feature'] = $feature;
                $data['status'] = $post['status'];
            }

        }
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'tags';
        $array['order_by_desc'] = 'id';
        $data['tags'] = $this->tags_model->get_all($array, 0 , 5000 );

        $array = array();
        $array['select'] = '*';
        $array['table'] = 'category';
        $array['order_by_asc'] = 'id';
        $data['categorys'] = $this->posts_model->get_all($array, 0 , 5000 );

        $data['active_children'] = 'add-posts';
        $data['active'] = 'posts';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/posts/add',isset($data) ? $data : Null);
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
            if ($action == 'description')
            {
                $description = trim($this->input->post('description'));
                $echo = strip_tags($description);
            }

            if ($action == 'meta_title')
            {
                $description = trim($this->input->post('title'));
                $echo = strip_tags($description);
            }
            if ($action=='delete')
            {
                $id = (int)$this->input->post('id');
                if (isset($id) && $id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'posts';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->posts_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $post['deleted'] = time();
                        $post['updates'] = time();
                        $where = array('id'=> $id);
                        $this->posts_model->update($post,$where,'posts');
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
                    $arr['table'] = 'posts';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->posts_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $post['deleted'] = NULL;
                        $post['updates'] = time();
                        $where = array('id'=> $id);
                        $this->posts_model->update($post,$where,'posts');
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
                    $arr['table'] = 'posts';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->posts_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        $this->posts_model->delete('posts',array('id' => $id));
                        $this->relationships_model->delete('relationships',array('candidate_key' => $id,'candidate_table'=>'posts'));
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
                    $arr['table'] = 'posts';
                    $arr['where'] = array('id' => $id);
                    $check_id = $this->posts_model->get($arr);
                    if (isset($check_id) && count($check_id) > 0)
                    {
                        if ($check_id['feature'] == 1)
                        {
                            $post['feature'] = 0;
                            $where = array('id'=> $id);
                            $this->product_model->update($post,$where,'posts');
                            $json = $data = array('title' =>'success','text' =>'success !');
                        }
                        else
                        {
                            $post['feature'] = 1;
                            $where = array('id'=> $id);
                            $this->product_model->update($post,$where,'posts');
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