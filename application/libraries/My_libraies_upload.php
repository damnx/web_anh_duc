<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_upload{
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    public function uploading($arr=NULL)
    {
        //Khai bao bien cau hinh
        $config = array();
        //thuc mục chứa file
        $config['upload_path']      = $arr['upload_path'];
        //Định dạng file được phép tải
        $config['allowed_types']    = $arr['allowed_types'];
        //Dung lượng tối đa
        $config['max_size']         = $arr['max_size'];
        //Chiều rộng tối đa
        $config['max_width']        = '1800';
        //Chiều cao tối đa
        $config['max_height']       = '1028';
        $config['remove_spaces']    = $arr['remove_spaces'];
        $name_array = array();
        $file  = $_FILES['files'];
        $count = count($file['name']);//lấy tổng số file được upload
        $data = array();
        for($i=0; $i<=$count-1; $i++) {
            $_FILES['userfile']['name']     = $file['name'][$i];
            $_FILES['userfile']['type']     = $file['type'][$i];
            $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
            $_FILES['userfile']['error']    = $file['error'][$i];
            $_FILES['userfile']['size']     = $file['size'][$i];
            $this->CI->load->library('upload', $config);
            if(! $this->CI->upload->do_upload())
            {
                $data[$i] = array('title' => 'error' ,'text' => $this->CI->upload->display_errors());
            }
            else
            {
                $data[$i] = array('title' => 'success','text' => $this->CI->upload->data());
            }

        }
       return $data;
    }
}