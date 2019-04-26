<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_libraies_nestedset {
    public $checked= NULL ;
    public $count= 0 ;
    public $count_level= 0;
    public $lft= NULL ;
    public $rgt= NULL ;
    public $level= NULL ;
    public function __construct()
    {
        $this->checked= NULL ;
        $this->count= 0 ;
        $this->count_level= 0;
        $this->lft= NULL ;
        $this->fgh= NULL ;
        $this->level= NULL ;
    }
    public function set($data =NULL)
    {
        if(isset($data) && is_array($data))
        {
            $arr=NULL;
            foreach ($data as $key => $val)
            {
                $arr[$val['id']][$val['parent_id']]=1;
                $arr[$val['parent_id']][$val['id']]=1;
            }
            return $arr;
        }
    }
    public function recursive($start= 0,$arr= NULL)
    {
        $this->lft[$start]= ++$this->count;
        $this->level[$start] = $this->count_level;
        if (isset($arr) && is_array($arr))
        {
            foreach ($arr as $key => $val)
            {
                if ((isset($arr[$start][$key]) || isset($arr[$key][$start]))&&(!isset($this->checked[$start][$key]) && !isset($this->checked[$key][$start])))
                {
                    $this->count_level++;
                    $this->checked[$start][$key]=1;
                    $this->checked[$key][$start]=1;
                    $this->recursive($key,$arr);
                    $this->count_level--;
                }
            }
        }
        $this->rgt[$start]=++$this->count;
    }
    /// lấy ra những thằng con cua cha
    public function children($data)
    {
        if (isset($data) && is_array($data))
        {
            $temp=NULL;
            foreach ($data as $key =>$val)
            {
                $temp[]=$val['id'];
            }
            return $temp;
        }
    }
    public function dropdown($data=NULL)
    {
        if (isset($data) && is_array($data))
        {
            $temp[0]='No Parent';
            foreach ($data as $key=>$val)
            {
                $temp[$val['id']]=str_repeat('|--- ',$val['level']-1).$val['name'];
            }
            return $temp;
        }
    }
    public function recursive_basic($id = 0, $data = NULL , $strep = ' ',$type = 'dropdown')
    {
        if (isset($data) && count($data) > 0){
            foreach ($data as $key => $val)
            {
                if ($val['parent_id'] == $id){
                    if ($type=='view')
                    {
                        $this->test[$val['parent_id']]=$strep.$val['name'];
                    }
                    elseif ($type =='dropdown')
                    {
                        $val['name']=$strep.''.$val['name'];
                        $this->test[$val['id']]= $val;
                    }
                    $this->recursive_basic($val['id'], $data, $strep.'|-- ',$type);
                }
            }
            if (isset($this->test))
            {
                return $this->test;
            }

        }
    }
}