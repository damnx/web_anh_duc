<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pratt extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($parameter = NULL)
    {
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
        }
        if (isset($parameter))
        {
            $array = array();
            $array['select'] = '*';
            $array['table'] = 'product';
            $array['where'] = array('id' =>(int)$parameter);
            $check = $this->product_model->get($array);
            if (!isset($check) || empty($check))
            {
                $this->my_libraies_redirect->php_redirect('manager.html');
            }
            $data['pr_id'] = (int)$parameter;
        }
        $array = array();
        $array['select'] = '*';
        $array['table'] = 'attribute';
        $array['order_by_desc'] = 'id';
        $data['attributes'] = $this->pratt_model->get_all($array, 0 , 5000 );
        if (isset( $data['attributes']) && count( $data['attributes']))
        {
            foreach ( $data['attributes'] as $key => $attribute )
            {
                $array = array();
                $array['select'] = '*';
                $array['table'] = 'detail_attribute';
                $array['where'] = array('id_attribute' =>$attribute['id'] );
                $array['order_by_asc'] = 'id';
                $data['attributes'][$key]['detail_attribute'] = $this->pratt_model->get_all($array, 0 , 5000 );
            }
        }

        $array = array();
        $array['select'] = '*';
        $array['table'] = 'product_detail_attribute';
        $array['where'] = array('id_product'=>(int)$parameter);
        $array['order_by_desc'] = 'id';
        $product_detail_attribute = $this->pratt_model->get_all($array, 0 , 5000 );

        if (isset($product_detail_attribute) && count($product_detail_attribute))
        {
            foreach ($product_detail_attribute as $key => $value)
            {
                $data['product_detail_attribute'][$key] =  $value['id_da'];
            }
        }
        else
        {
            $data['product_detail_attribute'] =  NULL;
        }
        $data['title'] = 'Product attribute';
        $data['active_hone'] = 'product';
        $data['active'] = 'product_iteam';
        $data['iteam'] = 'iteam';
        $this->load->view('backend/header',isset($data) ? $data : Null);
        $this->load->view('backend/pratt/iteam',isset($data) ? $data : Null);
        $this->load->view('backend/footer',isset($data) ? $data : Null);
    }
    public function ajax($action = null)
    {
        $json = $echo = false;
        $data['check_login'] = $this->check_use_admin_login;
        if (!isset($data['check_login']) && count($data['check_login']) <= 0)
        {
            $this->my_libraies_redirect->php_redirect('manager/login.html');
            $json = array('status'=>false, 'message'=>'Access denied');
        }
        else
        {
            if ($action == 'checkbox')
            {
                $id = intval($this->input->post('id'));
                $pr_id = intval($this->input->post('pr_id'));
                $id_att = intval($this->input->post('id_att'));
                if ($id > 0)
                {
                    $array = array();
                    $array['select'] = '*';
                    $array['table'] = 'product_detail_attribute';
                    $array['where'] = array('id_da' =>$id,'id_product'=>$pr_id);
                    $check = $this->pratt_model->get($array);
                    if (isset($check) && count($check))
                    {
                        $this->pratt_model->delete('product_detail_attribute',array('id_da' => $id));
                        $json = $data = array('title' =>'error','text' =>'Deleted success ! ');
                    }
                    else
                    {
                        $arr = array(
                            'id_product' =>$pr_id,
                            'id_da' =>$id,
                            'id_att'=>$id_att
                        );
                        $data['return'] = $this->pratt_model->insert($arr,'product_detail_attribute');
                        $json = $data = array('title' =>'success','text' =>'Insert success ');
                    }

                }
            }
        }
        if($json) echo json_encode($json);
        else echo $echo;
        exit;
    }
}

?>