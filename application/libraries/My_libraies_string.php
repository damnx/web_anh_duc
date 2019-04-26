<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_string {
    private $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->model('use_model');
    }
    public function isCurl(){
        return function_exists('curl_version');
    }
    function utf8convert($st) {
        if(!$st) return false;
        $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($utf8 as $ascii=>$uni) $st = preg_replace("/($uni)/i",$ascii,$st);
        return $st;
    }
    public function alias($st)
    {
        $st=str_replace(' ','-',strtolower($this->utf8convert($st)));
        $temp=NULL;
        for ($i=10;$i>=1;$i--)
        {
            $temp[]=str_repeat('-',$i);
            $st=str_replace($temp,'-',$st);
            $st = preg_replace("/[^_a-zA-Z0-9 -]/", "",$st);
            if (substr($st,-1)=='-')
            {
                $st=substr($st, 0, -1); ;
            }
        }
        return $st;
    }
    public function signature_hash($transId, $config, $data)
    {
        return md5($config['partnerId'].'&'.$data['cardSerial'].'&'.$data['cardPin'].'&'.$transId.'&'.$data['telcoCode'].'&'.md5($config['password']));
    }
    public function parseArray($response)
    {
        $return = array();
        $response = explode('&', $response);
        if(!empty($response)){
            foreach($response as $key => $value){
                $data = explode('=', $value);
                if(!empty($data[1])){
                    $return[$data[0]] = $data[1];
                }
            }
            return $return;
        }else{
            return array();
        }
    }
    public function get_transid($config)
    {
        return $config['partnerId'].'_'.date('YmdHis').'_'.rand(0, 999999);
    }
    public function get_curl($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        $str = curl_exec($curl);
        if(empty($str)) $str = $this->curl_exec_follow($curl);
        curl_close($curl);
        return $str;
    }
    public function curl_exec_follow($ch, &$maxredirect = null)
    {
        $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
            " Gecko/20041107 Firefox/1.0";
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );

        $mr = $maxredirect === null ? 5 : intval($maxredirect);

        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
            curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        } else {

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

            if ($mr > 0)
            {
                $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                $newurl = $original_url;

                $rch = curl_copy_handle($ch);

                curl_setopt($rch, CURLOPT_HEADER, true);
                curl_setopt($rch, CURLOPT_NOBODY, true);
                curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
                do
                {
                    curl_setopt($rch, CURLOPT_URL, $newurl);
                    $header = curl_exec($rch);
                    if (curl_errno($rch)) {
                        $code = 0;
                    } else {
                        $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                        if ($code == 301 || $code == 302) {
                            preg_match('/Location:(.*?)\n/', $header, $matches);
                            $newurl = trim(array_pop($matches));

                            if(!preg_match("/^https?:/i", $newurl)){
                                $newurl = $original_url . $newurl;
                            }
                        } else {
                            $code = 0;
                        }
                    }
                } while ($code && --$mr);

                curl_close($rch);

                if (!$mr)
                {
                    if ($maxredirect === null)
                        trigger_error('Too many redirects.', E_USER_WARNING);
                    else
                        $maxredirect = 0;

                    return false;
                }
                curl_setopt($ch, CURLOPT_URL, $newurl);
            }
        }
        return curl_exec($ch);
    }
}
