<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slideshow_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    public function get($array = NULL )
    {
        if (isset($array) && count($array)>0)
        {
            if (isset($array['select']) && $array['select'] !="")
            {
                $this->db->select($array['select']);
            }
            if (isset($array['table']) && $array['table'] !="")
            {
                $this->db->from($array['table']);
            }
            if (isset($array['where']) && count($array['where'])>0)
            {
                $this->db->where($array['where']);
            }
            $query=$this->db->get()->row_array();
            return $query;
        }
    }
    public function get_all($array = NULL,$start = 0 ,$limit = 0 )
    {
        if (isset($array) && count($array)>0)
        {
            if (isset($array['select']) && $array['select'] !="")
            {
                $this->db->select($array['select']);
            }
            if (isset($array['table']) && $array['table'] !="")
            {
                $this->db->from($array['table']);
            }
            if (isset($array['where']) && count($array['where'])>0)
            {
                $this->db->where($array['where']);
            }
            if (isset($array['order_by_asc']) && $array['order_by_asc'] !='')
            {
                $this->db->order_by($array['order_by_asc'], 'ASC');
            }
            if (isset($array['order_by_desc']) && $array['order_by_desc'] !='')
            {
                $this->db->order_by($array['order_by_desc'], 'DESC');
            }
            if (isset($array['like']) && count($array['like']) >0)
            {
                $this->db->like($array['like']);
            }
            $this->db->limit($limit,$start);
            $query = $this->db->get()->result_array();
            return $query;

        }
    }
    public function count_all ($array = NULL,$order_by = '',$start = 0 ,$limit = 0)
    {
        if (isset($array) && count($array)>0)
        {
            if (isset($array['select']) && $array['select'] !="")
            {
                $this->db->select($array['select']);
            }
            if (isset($array['table']) && $array['table'] !="")
            {
                $this->db->from($array['table']);
            }
            if (isset($array['where']) && count($array['where'])>0)
            {
                $this->db->where($array['where']);
            }
            if (isset($order_by) && $order_by != '')
            {
                $this->db->order_by($order_by, 'DESC');
            }
            else
            {
                $this->db->order_by('id', 'DESC');
            }
            if (isset($array['like']) && count($array['like']) >0)
            {
                $this->db->like($array['like']);
            }
            $this->db->limit($limit,$start);
            $query = $this->db->get();
            return $query->num_rows();
        }

    }
    public function insert($array = NULL,$table='')
    {
        if (isset($array) && count($array)>0)
        {
            $this->db->set($array);
            $this->db->insert($table);
            $last_id   = $this->db->insert_id();
            if (isset($last_id) && !empty($last_id))
            {
                return $notification = array('title'=>'success','text'=>'Insert success','id'=>$last_id);
            }
            else
            {
                return $notification = array('title'=>'error','text'=>'Insert error ! ');
            }

        }
    }
    public function update($array = null ,$where ='', $table ='')
    {
        $this->db->set($array);
        $this->db->where($where);
        $this->db->update($table);
        $updated = $this->db->affected_rows();
        if (isset($updated) && $updated !=0)
        {
            return  array('title' =>'success','text' =>'Update success','id'=>$where['id']);
        }
        else{
            return  array('title' =>'error','text' =>'Update error ! ');
        }
    }
    public function delete( $table = '',$array = NULL)
    {
        if (isset($array) && count($array) >0 )
        {
           $this->db->delete($table, $array);
            return $notification = array('title'=>'success','text'=>'delete success ! ');
        }


    }
}
?>