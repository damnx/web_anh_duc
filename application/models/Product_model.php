<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends CI_Model {
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
            $query = $this->db->get()->row_array();
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
    public function filter($arr = NULL,$count=0,$cid=0,$limit=9,$start=0)
    {
        $sql = "SELECT * from product INNER JOIN relationships on product.id = relationships.candidate_key where product.id in (select id_product from product_detail_attribute where id_da in ("."'".implode("','",array_map('intval', $arr))."'".") group by id_product having count(id_product) ='".$count."') AND product.deleted is null and product.status ='1' and product.quantity >='1' AND relationships.foreign_key = '$cid' AND relationships.foreign_table='category' AND relationships.candidate_table ='product'  order BY product.id DESC LIMIT $limit,$start";
        $query=$this->db->query($sql);
        return $query->result_array();
    }
    public function count_filter($arr = NULL,$count=0, $cid= 0 , $limit= 50000,$start = 0)
    {
        $sql = "SELECT * from product INNER JOIN relationships on product.id = relationships.candidate_key where product.id in (select id_product from product_detail_attribute where id_da in ("."'".implode("','",array_map('intval', $arr))."'".") group by id_product having count(id_product) ='".$count."') AND product.deleted is null and product.status ='1' and product.quantity >='1' AND relationships.foreign_key = '$cid' AND relationships.foreign_table='category' AND relationships.candidate_table ='product'  order BY product.id DESC LIMIT $start,$limit";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    public function product($array = array(),$start = 0 ,$limit = 50000)
    {
        $this->db->select('product.id,product.id_use,product.name,product.alias,product.type,product.thumb,product.price,product.fake_price,product.quantity,product.link_dowload,product.password,product.describe,product.content,product.practical_photo,product.status,product.feature,product.rating,product.published,product.created,product.updates,product.deleted,relationships.candidate_table,relationships.candidate_key,relationships.foreign_table,relationships.foreign_key');
        $this->db->from('product');
        $this->db->join('relationships', 'product.id = relationships.candidate_key');
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
        if (isset($array['order_by_asc']) && $array['order_by_asc'] !='')
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
    public function count_product($array = array())
    {
        $this->db->select('product.id,product.id_use,product.name,product.alias,product.type,product.thumb,product.price,product.fake_price,product.quantity,product.link_dowload,product.password,product.describe,product.content,product.practical_photo,product.status,product.feature,product.rating,product.published,product.created,product.updates,product.deleted,relationships.candidate_table,relationships.candidate_key,relationships.foreign_table,relationships.foreign_key');
        $this->db->from('product');
        $this->db->join('relationships', 'product.id = relationships.candidate_key');
        if (isset($array['where']) && count($array['where'])>0)
        {
            $this->db->where($array['where']);
        }
        if (isset($array['like']) && count($array['like']) >0)
        {
            $this->db->like($array['like']);
        }
        $this->db->limit(50000,0);
        $query = $this->db->get()->num_rows();
        return $query;
    }
    public function join($array = null,$limit = 50000,$start = 0)
    {
        if (isset($array['select']) && $array['select'] !='' )
            $this->db->select($array['select']);
        else
            $this->db->select('*');
        if (isset($array['table']))
        {

            $this->db->from($array['table']);
        }
        if (isset($array['join']))
        {
            foreach ($array['join'] as $join)
            {
                $this->db->join($join['table'], $join['join_condition']);
            }
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
        $this->db->limit($limit,$start);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
?>