<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_model extends CI_Model
{
	var $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'user_login';
	}
	
	function save_data($postData = array(),$id=0)
	{
		if($id == 0)
		{
			$this->db->insert($this->table,$postData);
			//echo $this->db->last_query();die;
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('id', $id);
			$query = $this->db->update($this->table,$postData);
			//echo $this->db->last_query();die;
			return $this->db->affected_rows();
			//return $query->row();
		} 
	}
	function find_data($select='*',$conditions='',$return_type='array',$group_by=NULL,$order_by=NULL,$limit=0,$offset=0)
	{
		$result = array();
		
		$this->db->select($select);
		
		if($conditions != '')
		{
			$this->db->where($conditions);
		}
		
		if($limit != 0)
		{
			$this->db->limit($limit, $offset);
		}
		
		$query = $this->db->get($this->table);
		
		switch($return_type)
		{
			case 'array':
			case '':
				if($query->num_rows()> 0) {$result = $query->result();} 
				break;
			case 'row':
				if($query->num_rows()> 0) {$result = $query->row();} 
				break;
			case 'count':
				$result = $query->num_rows();
				break;
		}
		//echo $this->db->last_query();die;
		return $result;
	}
	
	##########################################################################
	
	function existing_password($conditions='')
	{
		if($conditions != '')
		{
			$this->db->where($conditions);
		}
		$query = $this->db->get($this->table);
		//echo $this->db->last_query();die;
		return $query->result();
		
	}
}