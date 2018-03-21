<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Administration_model extends CI_Model
{
	var $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'dumkal_administration';
	}
	
	function save_data($postData = array(),$id=0)
	{
		if($id == 0)
		{
			$this->db->insert($this->table,$postData);
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('id', $id);
			$query = $this->db->update($this->table,$postData);
			return $this->db->affected_rows();
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
	
	function stuff_image_upload($img,$tmp)
	   {
		   $image_path = 'uploads/stuff_image/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
	   
	function stuff_resume_upload($img,$tmp)
	   {
		   $image_path = 'uploads/stuff_resume/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
}