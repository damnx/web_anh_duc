<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('recaptcha');
    }
    public function index()
    {
        $data['check_login'] = $this->check_use;
        if (isset($data['check_login']) && count( $data['check_login']) >0)
        {
            $this->my_libraies_redirect->php_redirect('');
        }
        $post = $this->input ->post();
        if (isset($post) && count($post)>0)
        {
            $captcha_answer = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($captcha_answer);
            if ($response['success'])
            {
                $this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|min_length[6]|max_length[36]|is_unique[use.username]');
                $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[8]');
                $this->form_validation->set_rules('passconf', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[use.email]');
                $this->form_validation->set_rules('phome', 'Phome', 'trim|min_length[10]|max_length[11]|is_natural');
                if ($this->form_validation->run() == true)
                {
                    unset($post['passconf']);
                    unset($post['g-recaptcha-response']);
                    $post['salt']=random_string('alnum',20);
                    $post['password']=md5(md5(md5(md5($post['username']).md5($post['password']).md5($post['salt']))));
                    $post['created'] = time();
                    $post['last_login'] = time();
                    $post['status'] = 1;
                    $post['type'] = 'register';
                    $use = $this->use_model->insert($post,'use');
                    if (isset($use) && $use['title'] == 'success')
                    {
                        $arr = array();
                        $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $use_admin = trim($post['username']);
                        $arr['select'] = '*';
                        $arr['table'] = 'use';
                        $arr['where'] = array('username' =>$use_admin);
                        $data['use'] = $this->use_model->get($arr);


                        $post = array('http_user_agent' =>$http_user_agent,'last_login'=>$post['last_login']);
                        $where = array('id' => $data['use']['id']);
                        $this->use_model->update($post,$where,'admin');

                        $data['use']['http_user_agent'] = $http_user_agent;
                        $_SESSION['use'] = json_encode($data['use']);
                        $this->my_libraies_redirect->php_redirect('');
                    }
                    else
                    {
                        show_404();
                    }
                }
            }
            else
                {
                    $data['return'] = array('title'=>'error','text'=>'Bạn chọn captcha');
            }

        }
        $data['setting'] = $this->setting;
        $data['setting']['title'] = 'Đăng ký';
        $data['setting']['url'] = base_url(uri_string());
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/register',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
