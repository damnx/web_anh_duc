<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function index()
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (isset($data['check_login']) && count($data['check_login']) > 0)
        {
            $this->my_libraies_redirect->php_redirect('manager.html');
        }
        if ($this->input->post('login'))
        {
            $this->form_validation->set_rules('username', 'Tên tài khoản', 'trim|required|min_length[6]|max_length[36]|callback_username_check['.trim($this->input->post('password')).']');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[6]');
            if ($this->form_validation->run() == true)
            {
                $arr = array();
                $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                $use_admin = trim($this->input->post('username'));
                $arr['select'] = 'id,username,status,full_name,sex,http_user_agent,deleted';
                $arr['table'] = 'admin';
                $arr['where'] = array('username' =>$use_admin);
                $data['use_admin'] = $this->use_model->get($arr);

                $arr = array();
                $last_login = time();
                $post = array('http_user_agent' =>$http_user_agent,'last_login'=>$last_login);
                $where = array('id' => $data['use_admin']['id']);
                $data['return'] = $this->use_model->update($post,$where,'admin');

                $data['use_admin']['http_user_agent'] = $http_user_agent;
                $_SESSION['use_admin'] = json_encode($data['use_admin']);
                $this->my_libraies_redirect->php_redirect('manager.html');
            }
        }
        $this->load->view('backend/login',isset($data) ? $data : Null);
    }
    public function username_check($use_admin,$pass_admin)
    {
        $arr = array();
        $arr['select'] = 'id,username,status,full_name,sex,http_user_agent,salt';
        $arr['table'] = 'admin';
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
