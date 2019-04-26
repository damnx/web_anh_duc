<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single extends MY_Controller {
    public function index($parameter = NULL )
    {
        $arr = array();
        $arr['select'] = '*';
        $arr['table'] = 'product';
        $arr['where'] = array('alias' => trim($parameter));
        $data['product'] = $this->product_model->get($arr);
        if (isset($data['product']) && count($data['product']) > 0)
        {
            $data['categorys'] = $this->category_model->category($data['product']['id']);
            $data['attributes'] = $this->pratt_model->attribute($data['product']['id']);
            if (isset( $data['attributes']) && count( $data['attributes']) > 0)
            {
                foreach ($data['attributes'] as $key => $attributes)
                {
                    $data['attributes'][$key]['detail_attribute'] = $this->detail_attribute_model->detail_attribute($data['product']['id'],$attributes['id_att']);
                }
            }
        }
        else
            show_404();
        $data['setting'] = $this->setting;
        if (isset($data['product']) && count($data['product']) > 0)
        {
            $data['setting']['title'] =$data['product']['name'];
            $data['setting']['thumb'] = $data['product']['thumb'];
            $data['setting']['description'] = $data['product']['describe'];
            $data['setting']['url'] = base_url(uri_string());
        }
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/single',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
