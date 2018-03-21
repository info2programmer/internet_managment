<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Upload_model extends CI_Model
{
	var $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'dumkal_sliders';
	}
	
	
	function student_file_upload($img,$tmp)
	   {
		   $image_path = 'uploads/notice/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
	
	
	
	
}