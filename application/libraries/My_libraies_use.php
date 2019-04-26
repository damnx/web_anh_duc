<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_use {
    private $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->model('use_model');
    }
    public function check_admin_login()
    {
        $flag=0;
        if (isset($_SESSION['use_admin'])&& !empty($_SESSION['use_admin']))
        {
            $use_admin = json_decode($_SESSION['use_admin'] ,true);
            $arr = array();
            $arr['select'] = 'id,username,status,full_name,sex,http_user_agent,deleted';
            $arr['table'] = 'admin';
            $arr['where'] = array('id' =>$use_admin['id']);
            $data = $this->CI->use_model->get($arr);
            if ($data['deleted'] != NULL)
            {
                unset($_SESSION['use_admin']);
                $use_admin = $this->CI->session->userdata('use_admin');
            }
            else
            {
                $_SESSION['use_admin'] = json_encode($data);
                $use_admin =$_SESSION['use_admin'];
            }


        }
        else
        {
            $flag=1;
            $use_admin = $this->CI->session->userdata('use_admin');
        }
        if (!isset($use_admin)|| empty($use_admin))
        {
		
            return NULL;
        }
		$use_admin = json_decode($use_admin,true);
		
        $arr = array();
        $http_user_agent = $use_admin['http_user_agent'];
        $arr['select'] = 'id,username,status,full_name,sex,http_user_agent,deleted';
        $arr['table'] = 'admin';
        $arr['where'] = array('http_user_agent' =>$http_user_agent,'username' =>$use_admin['username']);
        $data = $this->CI->use_model->get($arr);
        if (!isset($data) || count($data) == 0)
        {
            if ($flag == 0)
            {
                unset($_SESSION['use_admin']);
            }
            elseif ($flag == 1)
            {
                $this->CI->session->unset_userdata('use_admin');
            }
            return NULL;
        }
        return $use_admin;
    }

    public function check_use_login()
    {
        $flag=0;
        if (isset($_SESSION['use'])&& !empty($_SESSION['use']))
        {
            $use = json_decode($_SESSION['use'] ,true);
            $arr = array();
            $arr['select'] = '*';
            $arr['table'] = 'use';
            $arr['where'] = array('id' =>$use['id']);
            $data = $this->CI->use_model->get($arr);
            if ($data['deleted'] != NULL)
            {
                unset($_SESSION['use']);
                $use = $this->CI->session->userdata('use');
            }
            else
            {
                $_SESSION['use'] = json_encode($data);
                $use =$_SESSION['use'];
            }


        }
        else
        {
            $flag=1;
            $use = $this->CI->session->userdata('use');
        }
        if (!isset($use)|| empty($use))
        {
            return NULL;
        }
        $use = json_decode($use,true);

        $arr = array();
        $http_user_agent = $use['http_user_agent'];
        $arr['select'] = '*';
        $arr['table'] = 'use';
        $arr['where'] = array('http_user_agent' =>$http_user_agent,'username' =>$use['username']);
        $data = $this->CI->use_model->get($arr);
        if (!isset($data) || count($data) == 0)
        {
            if ($flag == 0)
            {
                unset($_SESSION['use']);
            }
            elseif ($flag == 1)
            {
                $this->CI->session->unset_userdata('use');
            }
            return NULL;
        }
        return $use;
    }
}