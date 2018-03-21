<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inline_edit_table extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function edit()
	{
		if(!empty($_POST))
		{
			foreach($_POST as $field_name => $val)
			{
				//clean post values
				$field_userid = strip_tags(trim($field_name));
				$val = strip_tags(trim(mysql_real_escape_string($val)));
		
				//from the fieldname:user_id we need to get user_id	
				$split_data = explode(':', $field_userid);
				$user_id = $split_data[1];
				$field_name = $split_data[0];
				$this->load->model('Common_model');
				$table['name']='dumkal_fee_structure';
				$conditions = array('id'=> $user_id);
				$select = 'course';
				$data['row'] = $this->Common_model->find_data($table,'row','',$conditions,$select);
				$course = $data['row']->course;
				
				if(!empty($user_id) && !empty($field_name) && !empty($val))
				{
					//update the values
					//echo $sql = "UPDATE dumkal_fee_structure SET $field_name = '$val' WHERE id = $user_id and course = '$course'";die;
					mysql_query("UPDATE dumkal_fee_structure SET $field_name = '$val' WHERE id = $user_id and course = '$course'") or mysql_error();
					echo "The records successfully updated";
				} else {
					echo "Invalid Requests";
				}
			}
		} 
		else 
		{
			echo "Invalid Requests";
		}	
	}
	
}

