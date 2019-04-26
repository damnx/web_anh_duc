<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Widget
{
    public function __construct()
    {
        $this->load->model(array('use_model','slideshow_model','category_model','menu_model','posts_model','relationships_model','attribute_model','detail_attribute_model','product_model','tags_model','pratt_model','card_model','orders_model'));
        $this->load->helper(array('form', 'url','string','function_helper','thumb_helper'));
        $this->load->library(array('form_validation','my_libraies_redirect','my_libraies_use','session','my_libraies_pagination','my_libraies_upload','my_libraies_string','my_libraies_nestedset'));
    }
    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }

    function __set($key, $val)
    {
        $CI =& get_instance();
        if (isset($CI->$key))
            $CI->$key = $val;
        else
            $this->$key = $val;
    }
}
?>