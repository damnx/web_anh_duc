<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('recaptcha');
    }
    public function index()
    {
        $data['use'] = $this->check_use;
        if (!isset( $data['use']) && count( $data['use']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('');
        }

        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'orders';
        $arr['where'] = array('use_name' => $data['use']['id']);
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
        $per_page = 10 ;
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
                $arr['select'] = 'id,name,thumb,link_dowload,password';
                $arr['table'] = 'product';
                $arr['where'] = array('id' => $post['id_sp']);
                $data['orders'][$key]['product'] = $this->product_model->get($arr);
            }
        }
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'card_loaded';
        $arr['order_by_desc'] = 'id';
        $arr['where'] = array('id_use'=>$data['use']['id'] );
        $data['carts'] = $this->card_model->get_all($arr,0,5);
        $data['setting'] = $this->setting;
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/account',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
    public function change_pass()
    {
        $data['check_login'] = $this->check_use;
        if (!isset( $data['check_login']) && count( $data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('');
        }
        $post = $this->input->post();
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);
        if ($response['success'])
        {
            if (isset($post) && count($post)>0)
            {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[8]');
                $this->form_validation->set_rules('passconf', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                if ($this->form_validation->run() == true)
                {
                    if ($post['email'] !=$data['check_login']['email'])
                    {
                        $data['return']  = array('title'=>'error','text'=>'Email sai');
                    }
                    unset($post['passconf']);
                    unset($post['email']);
                    unset($post['g-recaptcha-response']);
                    $post['updates'] = time();
                    $post['salt']=random_string('alnum',15);
                    $post['password']=md5(md5(md5(md5($data['check_login']['username']).md5($post['password']).md5($post['salt']))));
                    $where = array('id' => $data['check_login']['id']);
                    $this->use_model->update($post,$where,'use');
                    $data['return']  = array('title'=>'success','text'=>'Đổi mật khẩu thành công !');
                }
            }
        }
        else
        {
            $data['return'] = array('title'=>'error','text'=>'Bạn chọn captcha');
        }

        $data['use'] = $this->check_use;
        $data['setting'] = $this->setting;
        $data['setting']['title'] = 'Đổi mật khẩu';
        $data['setting']['description'] = '';
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/change_pass',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
