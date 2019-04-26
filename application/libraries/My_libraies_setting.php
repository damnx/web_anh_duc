<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_setting {
    private $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->model('tags_model');
    }
    public function setting()
    {
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'setting';
        $setting = $this->CI->tags_model->get($array);
        return $setting ;
    }
}