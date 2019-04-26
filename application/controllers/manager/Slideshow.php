<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slideshow extends MY_Controller
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
		$data['title'] = 'Slideshow';
        if (isset($parameter) && $parameter == 'trash' )
        {
            $data['active'] = 'trash';
        }
        else
        {
            $data['active'] = 'slideshow';
        }
		$post = $this->input->post();
        if ($post)
        {
            if ($post['id'])
            {
                $post['updates'] = time();
                $where = array('id'=>(int)$post['id']);
                $data['return'] = $this->slideshow_model->update($post,$where,'slideshow');
            }
            else
            {
                $post['created'] = time();
                $data['return'] = $this->slideshow_model->insert($post,'slideshow');
            }
        }
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'slideshow';
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
        $arr['order_by_desc'] = 'id';
        $per_page = 20 ;
        $total_rows = $this->slideshow_model->count_all($arr,'id', 0 , 50000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $data['posts'] =  $this->slideshow_model->get_all($arr, $page * $per_page  , $per_page);
        if ($parameter == 'trash')
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/slideshow/trash',isset($data) ? $data : Null);
            $this->load->view('backend/footer',isset($data) ? $data : Null);
        }
        else
        {
            $this->load->view('backend/header',isset($data) ? $data : Null);
            $this->load->view('backend/slideshow/iteam',isset($data) ? $data : Null);
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
                    $arr['table'] = 'slideshow';
                    $arr['where'] = array('id' =>$id);
                    $data =  $this->slideshow_model->get($arr);
                    $json = $data;
                    $echo = 'get';
                }
            }
            if ($action == 'delete')
            {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $post['deleted'] = time();
                    $post['updates'] = time();
                    $where = array('id'=> $id);
                    $this->slideshow_model->update($post,$where,'slideshow');
					$json = $data = array('title' =>'error','text' =>'Deleted success ! ');
                    $echo = 'Deleted';
                }
            }
            if ($action == 'trash')
            {
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
					$this->slideshow_model->delete('slideshow',array('id' => $id));
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
                    $this->slideshow_model->update($post,$where,'slideshow');
					$json = $data = array('title' =>'success','text' =>'Data recovery successfu ! ');
                    $echo = 'restore';
                }
            }
        }
        if($json) echo json_encode($json);
        else echo $echo;
        exit;
    }
}

?>