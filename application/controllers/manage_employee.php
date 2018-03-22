<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_employee extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	
		
		if( $is_admin_logged_in != 1)
        {
           redirect(base_url());
        }
		$this->load->model(array('common_model'));
	}
	################################################################
	function index()
	{
		$table['name'] = 'user_login';
		$conditions = array('published'=>1,'username !='=>'admin');
		$data['rows'] = $this->common_model->find_data($table,'array','',$conditions);
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-employee-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function add()
	{
		
		$data['action'] = 'Add';
	
		
		/* for insert slider */
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
			
						$imge = $_FILES["slider_image"]["name"];
			
						if($imge == '')
						{
							$this->session->set_flashdata('message', 'Please upload an image');
							redirect(current_url());
						}
						$exp = explode('.',$imge);
						$imageFileType = $exp[1];
						
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
						{
							$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
							redirect(current_url());
						}
						$image = $exp[0].time().'.'.$exp[1];
						$temp = $_FILES["slider_image"]["tmp_name"];
			
			
						/*$imagedetails = getimagesize($_FILES['slider_image']['tmp_name']);
						$width = $imagedetails[0];
						$height = $imagedetails[1];
					
						if($width < 810 && $height < 365)
						{  
							$this->session->set_flashdata('message', 'Sorry file is big');
							redirect(current_url());
						}*/
			
						$fields = array(
						'user_type'=>'E',
						'emp_name' => $this->input->post('emp_name'),
						'empId' => $this->input->post('empId'),
						'address' => $this->input->post('address'),
						'blood_group' => $this->input->post('blood_group'),
						'contact' => $this->input->post('contact'),
						'area' => $this->input->post('area'),
						'salary' => $this->input->post('salary'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password'),
						'photo' => $image,
						'user_ip' => $this->input->ip_address(),
						'last_login_date'=>'',
						'published'	=>	1
						);
						//echo '<pre>';print_r($fields);die;
						$table['name'] = 'user_login';
						$data = $this->common_model->save_data($table,$fields);
						if($data)
						{
						$this->employee_file_upload($image,$temp);
						
						$this->session->set_flashdata('success_message','Employee Image successfully inserted');	
						redirect('manage_employee');
						}
					
					}
				
			
		}
		/* for insert slider */
		$max_id=$this->common_model->last_emp_id();
		$emp_id=$max_id[0]['id']+1;
		$data['employee_id']= 'EMP00'.$emp_id;
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$table['name'] = 'user_login';
		$conditions=array('id'=>$id);
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['row']);die;
		$data['slider_image'] = $data['row']->photo;
		$slider_image = $data['row']->photo;
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate_edit() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$published = $data['row']->published;
						$postdata['published'] = $published;
						//$postdata['date_modified'] = date('d-m-Y');
			
						$imge = $_FILES["slider_image"]["name"];
						if($imge != '')
						{
							$exp = explode('.',$imge);
							$imageFileType = $exp[1];
							
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
							{
								$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
								redirect(current_url());
							}
							$image = $exp[0].time().'.'.$exp[1];
							$temp = $_FILES["slider_image"]["tmp_name"];
							
							$imagedetails = getimagesize($_FILES['slider_image']['tmp_name']);
							$width = $imagedetails[0];
							$height = $imagedetails[1];
						
							/*if($width < 1920 && $height < 1080)
							{  
								$this->session->set_flashdata('message', 'Sorry file is big');
								redirect(current_url());
							}*/
							
							$postdata['photo'] = $image;	
							$this->employee_file_upload($image,$temp);
						}
						else
						{
							$postdata['photo'] = $slider_image;	
							
							$postdata['emp_name'] = $this->input->post('emp_name');
							$postdata['empId'] = $this->input->post('empId');
							$postdata['address'] = $this->input->post('address');
							$postdata['contact'] = $this->input->post('contact');
							$postdata['area'] = $this->input->post('area');
							$postdata['salary'] = $this->input->post('salary');
							$postdata['email'] = $this->input->post('email');
							$postdata['username'] = $this->input->post('username');
							$postdata['password'] = $this->input->post('password');
							$postdata['user_ip'] = $this->input->ip_address();
							$postdata['last_login_date'] = '';
							$postdata['published'] = 1;
							
						
						}
				
				
				//echo '<pre>';print_r($postdata);die;
				$table['name'] = 'user_login';
				$data = $this->common_model->save_data($table,$postdata,$id);
				
				if($data) {
				$this->session->set_flashdata('success_message','Employee details successfully updated');	
				redirect('manage_employee');
				}
				else
				{
					redirect('manage_employee');
				}
			}				
			
				
			}
		/* for insert city */
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function confirmDelete($id)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		$table['name'] = 'user_login';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$this->session->set_flashdata('success_message','Employee Image has been Deleted successfully.');
			redirect('manage_employee');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_employee');
		}
	}
	
	##############################################################################################
	
	/*function deactive($id)
	{
		
		
		$postdata = array(
							'published' => 0
						);
		$deactive = $this->slider_model->save_data($postdata,$id);
		
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee Image successfully deactivated');	
				redirect('manage_employee');
			}
		else
			{	
				//$this->session->set_flashdata('error_message','Please try again.');		
				redirect('manage_employee');					
			}
	}
	
	function active($id)
	{
		
		
		$postdata = array(
							'published' => 1
						);
		$deactive = $this->slider_model->save_data($postdata,$id);
		
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee Image successfully activated');	
				redirect('manage_employee');
			}
		else
			{	
				//$this->session->set_flashdata('error_message','Please try again.');		
				redirect('manage_employee');					
			}
	}*/
	
	##############################################################################################
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_name', 'Name', 'required');
		$this->form_validation->set_rules('empId', 'Employee Id', 'required|is_unique[user_login.empId]');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('blood_group', 'Blood Group', 'required|max_length[3]');
		$this->form_validation->set_rules('contact', 'Contact', 'required|numeric|max_length[10]|min_length[10]');
		$this->form_validation->set_rules('area', 'Area', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user_login.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	function form_validate_edit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_name', 'Name', 'required');
		$this->form_validation->set_rules('empId', 'Employee Id', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('blood_group', 'Blood Group', 'required|max_length[3]');
		$this->form_validation->set_rules('contact', 'Contact', 'required|numeric');
		$this->form_validation->set_rules('area', 'Area', 'required');
		$this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	##################################################################################################
	function employee_file_upload($img,$tmp)
	   {
		   $image_path = 'uploads/employee/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
}
