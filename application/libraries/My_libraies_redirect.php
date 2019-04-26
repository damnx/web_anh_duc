<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_redirect {
    private $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->model('use_model');
    }
    public function php_redirect($url)
    {
        header('Location: '.base_url().$url);
        die();
    }
    public function js_redirect($alert,$url)
    {
        die('<script type="text/javascript">
                 alert(\''.$alert.' \');location.href=\''.$url.'\';
            </script>');
    }
}