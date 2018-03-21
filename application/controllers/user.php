<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {



	######################################################################################
	public function index()
	{

		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	
		
		if( $is_admin_logged_in != 1)
        {
           //redirect(base_url());
        }
		
		$this->load->model('user_model');
		$this->load->model('common_model');
			if($this->session->flashdata('error_message'))
			{
				$data['error_message'] =  $this->session->flashdata('error_message');
			}
			
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
					    //echo $this->input->post('username'); die;
						$conditions = array(
											'username'=>$this->input->post('username'),
											'password'=>$this->input->post('password'),
											'user_type'=>$this->input->post('user_type')
											);
						$table['name'] = 'user_login';					
						$record = $this->common_model->find_data($table,'row','',$conditions);
						//echo $this->db->last_query(); die;
						//SELECT * FROM (`user_login`) WHERE `username` = 'admin' AND `password` = 'admin' AND `user_type` = 'A'
						if($record)
						{
							$sessiondata = array(
												'user_id' => $record->id,
												'username' => $record->username,
												'is_admin_logged_in' => true,
												'email' => $record->email,
												'photo' => $record->photo,
												'emp_name' => $record->emp_name
												);
												
							$this->session->set_userdata($sessiondata);
							if($this->session->userdata('is_admin_logged_in') == 1)
							{
								redirect('user/dashboard/');
							}						
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}					
				//}
			
			$this->load->view('login', $data);
		//}
		
	}	
	###############################################################################
	
	function dashboard()
	{
		/*$this->load->model('common_model');
		$table['name'] = 'dumkal_sliders';
		$conditions = array('published'=>1);
		$data['portfolio']=$this->common_model->find_data($table,'count','',$conditions);
		
		$table['name'] = 'dumkal_image_galleries';
		$conditions = array('published'=>1,'category_id'=>'Flats for Resale');
		$data['resale']=$this->common_model->find_data($table,'count','',$conditions);
		
		$table['name'] = 'dumkal_image_galleries';
		$conditions = array('published'=>1,'category_id'=>'Flats for Rent');
		$data['rent']=$this->common_model->find_data($table,'count','',$conditions);*/
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	
		
		if( $is_admin_logged_in != 1)
        {
           redirect(base_url());
        }
		
		$this->load->model('common_model');
		$table['name'] = 'zone';
		$data['count_zone']=$this->common_model->find_data($table,'count','');
		
		
		$table['name'] = 'area';
		$data['count_area']=$this->common_model->find_data($table,'count','');
		
		$table['name'] = 'user_login';
		$data['count_employee']=$this->common_model->find_data($table,'count','');
		
		$table['name'] = 'package';
		$data['count_package']=$this->common_model->find_data($table,'count','');
		
		$table['name'] = 'addons_channels';
		$data['count_addon']=$this->common_model->find_data($table,'count','');
		
		$table['name'] = 'client';
		$data['count_client']=$this->common_model->find_data($table,'count','');
		
		
		$cur_date = date("Y-m-d");		
		$q = $this->db->query("select * from `pkg_assign` where `to_date`<'$cur_date'")->num_rows();
		$data['count_expire']=$q;
		
		$data['count_payment'] = $this->db->query("select * from box_details")->num_rows();
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/home',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	
	
	function change_password()
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	
		
		if( $is_admin_logged_in != 1)
        {
           redirect(base_url());
        }
		
		$this->load->model('user_model');
		
		if($this->password_validate() == FALSE)
			{
				//echo "wrong"; die;
				$data['error_message']=validation_errors();
			}
			else
			{

				
						$postdata = array(
											'password'=>$this->input->post('new_password')
											);
						$user_id = $this->session->userdata('user_id');					
						$success = $this->user_model->save_data($postdata,$user_id);
						//echo $this->db->last_query(); die;
						
						if($success)
						{	
							//echo "ok";
							$this->session->set_flashdata('success_message','Password changed successfully');	
							redirect('user/logout');
						}
						else
						{	
							//echo "not ok";
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}
						//die;					
			}	
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-password-view',$data,true);
		//print_r($data); die;
		$this->load->view('layout_after_login',$data);
	}
	###############################################################################
	function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('is_user_logged_in');
		redirect(base_url());
	}
	###############################################################################
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('user_type', 'User Type', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function password_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_existing_password');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function existing_password($str)
	{
		$old_password =  $str;
		$data['row'] = $this->user_model->find_data('','','row');

		//echo '<pre>';print_r($data['row']);
		$existing_password = $data['row']->password;
		//echo $old_password; die;
		//echo $this->db->last_query(); die;
		
		if ($existing_password != $old_password)
		{
			
			$this->form_validation->set_message('existing_password', 'Old Password is incorrect!');
			return FALSE;
		}
		else
		{
			
			return TRUE;
		}

		die;
		
	}
}

