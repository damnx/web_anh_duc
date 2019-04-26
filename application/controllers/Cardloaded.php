<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cardloaded extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('recaptcha');
    }
    public function index()
    {
		$data['setting'] = $this->setting;
        $data['setting']['title'] = 'Nạp thẻ';
        $data['check_login'] = $this->check_use;
        $post = $this->input->post();
        $captcha_answer = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($captcha_answer);
		if (isset($data['setting']) && count($data['setting']) > 0)
		{
			if ($data['setting']['type'] =='gamebank')
            {
                require('GB_API.php');
                if (!empty($post))
                {
                    if ($response['success'])
                    {
                        if (isset( $data['check_login']) && count( $data['check_login']) > 0)
                        {
                            $arr = array();
                            $arr['select'] = '*';
                            $arr['table'] = 'use';
                            $arr['where'] = array('id' => $data['check_login']['id']);
                            $check_use = $this->use_model->get($arr);

                            $merchant_id = 20463; // interger
                            $api_user = "56c1d4101793f"; // string
                            $api_password = "2dbb2434076aaa8a75f0810d4778f5b5"; // string

                            // truyen du lieu the
                            $pin = $post['code']; // string
                            $seri = $post['seri']; // string
                            $card_type = $post['type']; // interger

                            $gb_api = new GB_API();

                            $gb_api->setMerchantId($merchant_id);
                            $gb_api->setApiUser($api_user);
                            $gb_api->setApiPassword($api_password);
                            $gb_api->setPin($pin);
                            $gb_api->setSeri($seri);
                            $gb_api->setCardType(intval($card_type));
                            $gb_api->setNote("username accname"); // ghi chu giao dich ben ban tu sinh

                            $gb_api->cardCharging();
                            $code = intval($gb_api->getCode());
                            $info_card = intval($gb_api->getInfoCard());

                            if ($code === 0 && $info_card >= 10000)
                            {
                                $arr = array(
                                    'id_use' =>$check_use['id'],
                                    'code' =>$post['code'],
                                    'seri' => $post['seri'],
                                    'denominations' => $info_card,
                                    'type' => $post['type'],
                                    'before' => $check_use['money'],
                                    'after' => (int)$check_use['money'] + $info_card,
                                    'published' =>time()
                                );
                                $this->card_model->insert($arr,'card_loaded');

                                $arr = array(
                                    'money' => (int)$check_use['money'] + $info_card
                                );
                                $where = array('id' => $check_use['id']);
                                $this->use_model->update($arr,$where,'use');
                                $data['return']  = array('title'=>'success','text'=>'Success ! Nạp thẻ thành công '.number_format($info_card).' !');
                            }
                            else
                            {
                                $error = $gb_api->getMsg();
                                $data['return']  = array('title'=>'error','text'=>'error ! '.$error.' !');
                            }
                        }
                        else
                        {
                            $data['return'] = array('title'=>'error','text'=>'Bạn cần đăng nhập <a href="/dang-nhap.html" type="Đăng nhập">Đăng Nhập</a>');
                        }
                    } else {
                        $data['return'] = array('title'=>'error','text'=>'Bạn chọn captcha');
                    }

                }
                $this->load->view('frontend/header',isset($data) ? $data : Null);
                $this->load->view('frontend/cardloaded',isset($data) ? $data : Null);
                $this->load->view('frontend/footer',isset($data) ? $data : Null);

			}
			else
            {
                if (!empty($post))
                {
                    $this->form_validation->set_rules('code', 'Mã thẻ', 'trim|required');
                    $this->form_validation->set_rules('seri', 'Seri', 'trim|required');
                    {
                        if ($this->form_validation->run() == true)
                        {
                            if ($post['type'] == '0')
                            {
                                $data['return'] = array('title'=>'error','text'=>'Chọn thẻ nạp');
                            }
                            else
                            {
                                if (isset( $data['check_login']) && count( $data['check_login']) > 0)
                                {
                                    $config = array(
                                        'URLPAYMENT' => 'http://megapay.com.vn:8080/megapay_server?',
                                        'PROCESSING_CODE' => '10002',
                                        'PROJECT_ID' => '82672',
                                        'USER_NAME' => 'muaxuan.290391@gmail.com',
                                        'ACCOUNT' => 'phuongvd',
                                        'PAYMENT_CHANNEL' => '1'
                                    );
                                    $project_id = $config['PROJECT_ID'];
                                    $trans_id = $project_id . date("YmdHis") . rand(1, 99999);
                                    $payment_data = array(
                                        'serial' => $post['seri'],
                                        'mpin' => $post['code'],
                                        'transid' => $trans_id,
                                        'telcocode' => $post['type'],
                                        'username' => $config['USER_NAME'],
                                        'account' => $config['ACCOUNT'],
                                        'payment_channel' => $config['PAYMENT_CHANNEL']
                                    );
                                    $send_payment_info = array(
                                        'processing_code' => $config['PROCESSING_CODE'],
                                        'project_id' =>$config['PROJECT_ID'],
                                        'data' => json_encode($payment_data)
                                    );
                                    $url = $config['URLPAYMENT'];
                                    $url = $url . urlencode('request=' . json_encode($send_payment_info));
                                    $response = $this->my_libraies_string->get_curl($url);
                                    if($response)
                                    {
                                        $input = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($response));
                                        $json = json_decode($input, true);
                                        $status = $json['status'];
                                        if($status)
                                        {
                                            print_r($json);
                                        }
                                        else
                                            {
                                            echo 'Tham số truyền về không đúng định dạng. Mời bạn liên hệ với nhà cung cấp dịch vụ để biết thêm chi tiết'; die;
                                        }
                                    }
                                    else{
                                        echo 'Gạch thẻ không thành công. Mời bạn kiểm tra lại đường truyền và bật các extendsion cần thiết.'; die;
                                    }
                                }
                                else
                                {
                                    $data['return'] = array('title'=>'error','text'=>'Bạn cần đăng nhập <a href="/dang-nhap.html" type="Đăng nhập">Đăng Nhập</a>');
                                }
                            }
                        }
                    }

                }
                $this->load->view('frontend/header',isset($data) ? $data : Null);
                $this->load->view('frontend/megapay',isset($data) ? $data : Null);
                $this->load->view('frontend/footer',isset($data) ? $data : Null);
            }

		}
       
    }
}
