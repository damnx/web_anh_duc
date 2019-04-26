<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends MY_Controller {
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
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);
        $post = $this->input->post();
        if (!empty($post))
        {
            if ($response['success']) {
                $this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|min_length[6]|max_length[36]|callback_username_check['.trim($this->input->post('password')).']');
                $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[8]');
                if ($this->form_validation->run() == true)
                {
                    $post = $this->input->post();
                    $arr = array();
                    $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                    $use_admin = trim($post['username']);
                    $arr['select'] = '*';
                    $arr['table'] = 'use';
                    $arr['where'] = array('username' =>$use_admin);
                    $data['use'] = $this->use_model->get($arr);
                    $post = array('http_user_agent' =>$http_user_agent,'last_login'=>time());
                    $where = array('id' => $data['use']['id']);
                    $this->use_model->update($post,$where,'use');
                    $data['use']['http_user_agent'] = $http_user_agent;
                    $_SESSION['use'] = json_encode($data['use']);
                    $this->my_libraies_redirect->php_redirect('');
                }
            }
            else
                {
                $data['return'] = array('title'=>'error','text'=>'Bạn chọn captcha');
            }

        }
        $data['setting'] = $this->setting;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/signin',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
    public function username_check($use_admin,$pass_admin)
    {
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'use';
        $arr['where'] = array('username' =>$use_admin);
        $check_use =  $this->use_model->get($arr);
        if (isset($check_use) && count($check_use))
        {
            $password = md5(md5(md5(md5($check_use['username']).md5($pass_admin).md5($check_use['salt']))));
            $arr['where'] = array('username' =>$use_admin,'password' =>$password,'deleted' => NULL);
            $check_pass = $this->use_model->get($arr);
            if (isset($check_pass) && count($check_pass)>0)
            {
                if (isset($check_pass['status']) && $check_pass['status'] == 0)
                {
                    $this->form_validation->set_message('username_check','Tài khoản của bạn bị khóa');
                    return false;
                }
                else
                {
                    $this->form_validation->set_message('username_check','Đang nhập thành công');
                    return true;
                }

            }
            else
            {
                $this->form_validation->set_message('username_check','Mật khẩu không đúng');
                return false;
            }
        }
        else
        {
            $this->form_validation->set_message('username_check','Tài khoản '.$use_admin.' không đúng');
            return false;
        }

    }
}
