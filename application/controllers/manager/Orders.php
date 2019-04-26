<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller
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
        $arr['table'] = 'orders';
        $data['search'] = $this->input->get('q');
        if (isset($data['search']) && $data['search'] !='')
        {
            $arr['like'] = array('use_name' => $data['search'] );
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
        $total_rows = $this->orders_model->count_all($arr,'id', 0 , 50000);
        $total_page= ceil($total_rows / $per_page);
        $page = ($page > $total_page)?$total_page:$page;
        $page =($page < 1)? 1 : $page;
        $page = $page - 1;
        $data['pagination'] = $this->my_libraies_pagination->pagination($current_url,$total_rows,$per_page);
        $arr['order_by_desc'] = 'id';
        $data['orders'] =  $this->orders_model->get_all($arr, $page * $per_page  , $per_page);
        if (isset($data['orders']))
        {
            foreach ($data['orders'] as $key => $post)
            {

                $arr = array();
                $arr['select'] = 'id,name,thumb';
                $arr['table'] = 'product';
                $arr['where'] = array('id' => $post['id_sp']);
                $data['orders'][$key]['product'] = $this->product_model->get($arr);
            }
        }

        $data['title'] = 'Orders';
        $data['active'] = 'orders';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/orders/iteam',isset($data) ? $data : Null);
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
                $id = intval($this->input->post('id'));
                if ($id > 0)
                {
                    $array = array();
                    $array['select'] = '*';
                    $array['table'] = 'orders';
                    $array['where'] = array('id' =>$id);
                    $check = $this->card_model->get($array);
                    if (isset($check) && count($check))
                    {
                        $this->card_model->delete('orders',array('id' => $id));
                        $json = $data = array('title' =>'error','text' =>'Deleted success ! ');
                    }
                }
            }
        }
        if($json) echo json_encode($json);
        else echo $echo;
        exit;
    }
}

?>