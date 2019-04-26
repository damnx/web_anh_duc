<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Use_use extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($parameter = NULL)
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }

        if (isset($parameter) && $parameter == 'trash' )
        {
            $data['active'] = 'users_trash';
        }
        else
        {
            $data['active'] = 'users';
        }
		$post = $this->input->post();
        if ($post)
        {
            if (isset($post['username']) && !empty($post['username']))
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'admin';
                $arr['where'] = array('username' =>$post['username']);
                $count =  count($this->use_model->get($arr));
            }
            $post['birthday'] = strtotime($this->input->post('birthday'));
            if ($post['id'])
            {
                $arr = array();
                $arr['select'] = '*';
                $arr['table'] = 'use';
                $arr['where'] = array('id' =>(int)$post['id']);
                $use =  $this->use_model->get($arr);
                if (isset($post['password'])&& $post['password'] !='')
                {
                    unset($post['username']);
                    $post['salt']=random_string('alnum',15);
                    $post['password']=md5(md5(md5(md5($use['username']).md5($post['password']).md5($post['salt']))));
                }
                else
                {
                    unset($post['username']);
                    unset($post['password']);
                }
                if (isset($post['money'])&& $post['money'] !='')
                {
                    $post['money'] = (int)$post['money'] + (int)$use['money'];
                }
                else
                {
                    unset($post['money']);
                }

                $post['updates'] = time();
                $where = array('id'=>(int)$post['id']);
                $data['return'] = $this->use_model->update($post,$where,'use');
            }
            else
            {
                if (isset($count) && $count >0)
                {
                    $data['return'] = array('title' => 'error' , 'text' => 'User name '.$post['username'].' tồn tại');
                }
                else
                {
                    $post['salt']=random_string('alnum',15);
                    $post['password']=md5(md5(md5(md5($post['username']).md5($post['password']).md5($post['salt']))));
                    $post['created'] = time();
                    $data['return'] = $this->use_model->insert($post,'use');
                }

            }
        }
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'use';
        $data['search'] = $this->input->get('q');
        if (isset($data['search']) && $data['search'] !='')
        {
            $arr['like'] = array('username' => $data['search'] );
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
        $total_rows = $this->use_model->count_all($arr,'id', 0 , 50000000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $arr['order_by_desc'] = 'id';
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $data['user_admin'] =  $this->use_model->get_all($arr, $page * $per_page  , $per_page);

        if ($parameter == 'trash')
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/use/trash_use',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }
        else
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/use/iteam_use',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }

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
            if($action == "get") {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $arr = array();
                    $arr['select'] = '*';
                    $arr['table'] = 'use';
                    $arr['where'] = array('id' =>$id);
                    $data =  $this->use_model->get($arr);
                    $json = $data;
                    $echo = 'get';
                }
            }
            else if($action == 'delete')
            {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $post['deleted'] = time();
                    $post['updates'] = time();
                    $where = array('id'=> $id);
                    $this->use_model->update($post,$where,'use');
					$json = $data = array('title' =>'error','text' =>'Deleted success ! ');
                    $echo = 'Deleted';
                }
            }
            if ($action == 'trash')
            {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $data = $this->use_model->delete('use',array('id' => $id));
					$json = $data = array('title' =>'error','text' =>'Cant recover deleted data !');
					
                }
            }
            if ($action == 'restore')
            {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $post['deleted'] = NULL;
                    $post['updates'] = time();
                    $where = array('id'=> $id);
                    $this->use_model->update($post,$where,'use');
					$json = $data = array('title' =>'success','text' =>'Data recovery successfu ! ');
                    $echo = 'Deleted';
                }
            }
        }
        if($json) echo json_encode($json);
        else echo $echo;
        exit;
    }
}
?>