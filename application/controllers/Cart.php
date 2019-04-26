<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {
    public function index()
    {
        $this->load->library('cart');
        $data['check_login'] = $this->check_use;
        $post = $this->input->post();
        if (isset($post) && count($post)>0)
        {
            if (isset($data['check_login']) && count($data['check_login']) > 0)
            {
                if ((int)$data['check_login']['money'] >= (int)$this->cart->total())
                {
                    $carts = $this->cart->contents();
                    if (isset($carts) && count($carts) > 0)
                    {
                        foreach ($carts as $cart)
                        {
                            $arr = array(
                                'use_name'=> $data['check_login']['id'],
                                'id_sp' =>$cart['id'],
                                'status' =>1,
                                'price' =>$cart['price'],
                                'quantity'=>$cart['qty'],
                                'published' =>time()
                            );
                            $this->card_model->insert($arr,'orders');

                            if ($cart['options']['type'] != 'code')
                            {
                                $arr = array();
                                $arr['select'] = '*';
                                $arr['table'] = 'product';
                                $arr['where'] = array('id' => $cart['id']);
                                $check = $this->product_model->get($arr);
                                if (isset($check) && count($check) > 0)
                                {
                                    $quantity = $check['quantity'] - $cart['qty'];
                                    $arr =  array(
                                        'quantity' =>$quantity
                                    );
                                    $where = array('id'=> $check['id']);
                                    $this->product_model->update($arr,$where,'product');
                                }

                            }

                        }
                        $money = (int)$data['check_login']['money'] - (int)$this->cart->total();
                        $arr =  array(
                            'money' =>$money
                        );
                        $where = array('id'=> $data['check_login']['id']);
                        $this->card_model->update($arr,$where,'use');
                        $data['return']  = array('title'=>'success','text'=>'Success ! Thanh toán thành công , Cảm ơn bạn !');
                        $this->cart->destroy();
                    }

                }
                else
                {
                    $data['return']  = array('title'=>'error','text'=>'Số dư trong tài khoản không đủ thanh toán <a href="/nap-the.html">Nạp thẻ</a>');
                }
            }
            else
            {
                $data['return']  = array('title'=>'error','text'=>'Bạn cần đăng nhập trước <a href="/dang-nhap.html">Đăng nhập</a> / <a href="/dang-ky.html">Đăng ký</a>.');
            }
        }
        $data['setting'] = $this->setting;
        $data['check_login'] = $this->check_use;
        $this->load->view('frontend/header',isset($data) ? $data : Null);
        $this->load->view('frontend/cart',isset($data) ? $data : Null);
        $this->load->view('frontend/footer',isset($data) ? $data : Null);
    }
}
