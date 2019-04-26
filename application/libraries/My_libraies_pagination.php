<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_pagination {
    private $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
        $this->CI->load->library('pagination');
    }
    function pagination($current_url = '',$total_rows = 0 , $per_page = 0 )
    {
        $config['full_tag_open'] = '<ul class="pagination pagination-sm pagination-sm-gb">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = ' <li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = ' <li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 2;
        $config['page_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';

        $config['base_url'] = ''.$current_url.'';

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $per_page;
        $this->CI->pagination->initialize($config);
        $pagination = $this->CI->pagination->create_links();
        return $pagination ;

    }
}