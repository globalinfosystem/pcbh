<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Pollution_model extends SB_Model 
{
    function __construct() 
	{
        parent::__construct();
		
    }
     public function insertdata($tablename,$data)
	{
		$this->db->insert($tablename,$data);
		$lastId = $this->db->insert_id();
		return $lastId;
	}
	public function updatedata($tablename,$condition,$updatefield)
	{
		
		//$data=array('last_login'=>current_login,'current_login'=>date('Y-m-d H:i:s'));
      $this->db->where($condition);
      $this->db->update($tablename,$updatefield);
		
	}
	public function join_with_condition($select_data,$table_one,$table_two,$join_condition,$join_type,$where_condition)
	{
		$this->db->select($select_data); 
        $this->db->from($table_one); 
        $this->db->join($table_two,$join_condition,$join_type); 
        $this->db->where($where_condition); 
        $res = $this->db->get();
		return $res->result();
	}
	public function delete_data($tablename,$condition)
	{
		$this->db->delete($tablename, $condition); 
	}
	public function query($query)
	{
		$this->db->query($query);
	}
	public function custom_query($query)
	{
		$data=$this->db->query($query)->result_array();
		return $data; 
	}
	public function get_data($tablename,$fieldname,$condition)
	{
		
		$data=$this->db->select($fieldname)->get_where($tablename,$condition)->result_array();
		return $data;
		
	}
	public function get_data_with_like($tablename,$fieldname,$condition,$likecondition)
	{
		$data=$this->db->select($fieldname)->where($likecondition)->get_where($tablename,$condition)->result_array();
       
		return $data;
		
	}
	public function get_data_with_condition_order_limit($tablename,$fieldname,$condition,$orderfieldname,$ordertype,$limit,$offset)
	{
		$data=$this->db->select($fieldname)->order_by($orderfieldname, $ordertype)->get_where($tablename,$condition,$limit,$offset)->result_array();
        return $data;
	   
	}
	public function get_data_with_order_limit($tablename,$fieldname,$orderfieldname,$ordertype,$limit,$offset)
	{
		$this->db->select($fieldname);
        $this->db->from($tablename);
        $this->db->order_by($orderfieldname, $ordertype);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
	public function delete_data_with_like_condition($tablename,$condition,$fieldname,$field_data)
	{
		$this->db->where($condition);
		$this->db->like($fieldname,$field_data);
        $this->db->delete($tablename); 
	}
	public function getdate_select($tablename,$fieldname)
	{
		$this->db->select($fieldname);
        $result = $this->db->get($tablename)->result_array();
	   return $result;
	}
	
	
	
}
?>