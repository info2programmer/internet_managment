<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_administration extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('admin_init_elements');
		if($this->uri->segment('3')=='login')
		{
			//echo "login";
		}
		else
		{
			$this->admin_init_elements->init_elements();
		}
		$this->load->model(array('Common_model','administration_model'));
	}
	################################################################
	function index()
	{
		$table['name']='dumkal_administration';
		$data['rows'] = $this->Common_model->find_data($table,'array');
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-administration-list-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function add()
	{
		$data['action'] = 'Add';
		/* for Administrative Rolet */
		$postdata = array();
		
		$sub = array(
					'' => 'Select Administrative Role',
					'Governing-Body' => 'Governing Body',
					'Teaching-Stuff' => 'Teaching Stuff',
					'Non-teaching-Stuff' => 'Non-teaching Stuff'
					);
		$data['categories']=$sub;
		/* for Administrative Role */
		
		$departments = array(
					'' => 'Select Department',
					'Science' => 'Science',
					'Arts' => 'Arts',
					'Commerce' => 'Commerce'
					);
		$data['departments']=$departments;
		
		/* for subject list */
		
		$select = 'id,subject_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'id','type'=>'ASC');
		$table['name']='dumkal_subjects';
		$list = array('empty_name'=>' subject Name','key'=>'id','value'=>'subject_name');
		$data['subjects']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		/* for subject list */
		
		
		
		if($this->input->post('adid') == 1)
			{	
							if($this->input->post('sub_committee_id') != 'Governing Body') {
							
							$imge = $_FILES["image1"]["name"];
							$action = $this->input->post('action');
							
							/*if($imge == '')
							{
								$this->session->set_flashdata('message1', 'Please upload an image');
							}*/
							$exp = explode('.',$imge);
							$imageFileType = $exp[1];
							
							
							/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "")
							{
								$this->session->set_flashdata('message1', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
							}*/
							$image = $exp[0].'.'.$exp[1];
							$temp = $_FILES["image1"]["tmp_name"];
							
							
							$imagedetails = getimagesize($_FILES['image1']['tmp_name']);
							$width = $imagedetails[0];
							$height = $imagedetails[1];
							
							
								
							$rme = $_FILES["resume"]["name"];
							$action = $this->input->post('action');
							
							/*if($rme == '')
							{
								$this->session->set_flashdata('message2', 'Please upload a document');
							}*/
							$exp1 = explode('.',$rme);
							$rmeFileType = $exp1[1];
							
							
							/*if($rmeFileType != "doc" && $rmeFileType != "pdf")
							{
								$this->session->set_flashdata('message2', 'Sorry, only DOC,PDF files are allowed');
							}*/
							$resume = $exp1[0].'.'.$exp1[1];
							$temp1 = $_FILES["resume"]["tmp_name"];
							}
							$postdata = array(
												'administrative_role' => $this->input->post('sub_committee_id'),
												'name' => $this->input->post('name'),
												'designation' => $this->input->post('designation'),
												'published' => 1,
												'qualification' => $this->input->post('qualification'),
												'department' => $this->input->post('department'),
												'subject_id' => $this->input->post('subject_id')
												);
							if($this->input->post('sub_committee_id') != 'Governing Body') {
							$postdata['image'] = $image;
							$postdata['resume'] = $resume;
							}
							//echo '<pre>';print_r($postdata);die;
												
							$table['name'] = 'dumkal_administration';		
							$success = $this->Common_model->save_data($table,$postdata);						
							if($success)
							{	
								$this->administration_model->stuff_image_upload($image,$temp);
								$this->administration_model->stuff_resume_upload($resume,$temp1);
								
								$this->session->set_flashdata('success_message','Administrative details successfully inserted');	
								redirect('admin/manage_administration');
							}
							else
							{	
								$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
								redirect(current_url());					
							}
				
			}		
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-administration-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		/* for Administrative Rolet */
		$action = $this->input->post('action');
		$postdata = array();
		
		$sub = array(
					'' => 'Select Administrative Role',
					'Governing-Body' => 'Governing Body',
					'Teaching-Stuff' => 'Teaching Stuff',
					'Non-teaching-Stuff' => 'Non-teaching Stuff'
					);
		$data['categories']=$sub;
		/* for Administrative Role */
		
		$departments = array(
					'' => 'Select Department',
					'Science' => 'Science',
					'Arts' => 'Arts',
					'Commerce' => 'Commerce'
					);
		$data['departments']=$departments;
		
		/* for subject list */
		
		$select = 'id,subject_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'id','type'=>'ASC');
		$table['name']='dumkal_subjects';
		$list = array('empty_name'=>' subject Name','key'=>'id','value'=>'subject_name');
		$data['subjects']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		/* for subject list */
		
		$table['name'] = 'dumkal_administration';
		$conditions=array('dumkal_administration.id'=>$id);
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions,'*');
		
		//echo '<pre>';print_r($data);die;
			
		if($this->input->post('adid') == 1)
			{	
					//echo "ok";die;
							if($this->input->post('sub_committee_id') != 'Governing Body') {
							
							$imge = $_FILES["image1"]["name"];
							
							if($imge == '' && $action == 'edit') {
							$imge = $data['row']->image;
							}
							else
							{
							$imge = $_FILES["image1"]["name"];	
							}
							/*if($imge == '')
							{
								$this->session->set_flashdata('message1', 'Please upload an image');
							}*/
							$exp = explode('.',$imge);
							$imageFileType = $exp[1];
							
							
							/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "")
							{
								$this->session->set_flashdata('message1', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
							}*/
							$image = $exp[0].'.'.$exp[1];
							$temp = $_FILES["image1"]["tmp_name"];
							
							
							/*$imagedetails = getimagesize($_FILES['image1']['tmp_name']);
							$width = $imagedetails[0];
							$height = $imagedetails[1];*/
							
							
								
							$rme = $_FILES["resume"]["name"];
							
							if($rme == '' && $action == 'edit') {
							$rme = $data['row']->resume;
							}
							else
							{
							$rme = $_FILES["resume"]["name"];	
							}
							
							
							
							/*if($rme == '')
							{
								$this->session->set_flashdata('message2', 'Please upload a document');
							}*/
							$exp1 = explode('.',$rme);
							$rmeFileType = $exp1[1];
							
							
							/*if($rmeFileType != "doc" && $rmeFileType != "pdf")
							{
								$this->session->set_flashdata('message2', 'Sorry, only DOC,PDF files are allowed');
							}*/
							$resume = $exp1[0].'.'.$exp1[1];
							$temp1 = $_FILES["resume"]["tmp_name"];
							}
							$postdata = array(
												'administrative_role' => $this->input->post('sub_committee_id'),
												'name' => $this->input->post('name'),
												'designation' => $this->input->post('designation'),
												'published' => 1,
												'qualification' => $this->input->post('qualification'),
												'department' => $this->input->post('department'),
												'subject_id' => $this->input->post('subject_id')
												);
							if($this->input->post('sub_committee_id') != 'Governing Body') {
								
								
								$postdata['image'] = $image;								
								$postdata['resume'] = $resume;
								
							}
							//echo '<pre>';print_r($postdata);die;
												
							$table['name'] = 'dumkal_administration';		
							$success = $this->Common_model->save_data($table,$postdata,$id);						
							if($success)
							{	
								if($imge != '')
								{
									$this->administration_model->stuff_image_upload($image,$temp);									
								}
								if($rme != '')
								{
									$this->administration_model->stuff_resume_upload($resume,$temp1);
								}
								$this->session->set_flashdata('success_message','Administrative details successfully updated');	
								redirect('admin/manage_administration');
							}
							else
							{	
								$this->session->set_flashdata('success_message','Administrative details successfully updated');	
								redirect('admin/manage_administration');					
							}
				
			}		
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-administration-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
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
		$table['name'] = 'dumkal_administration';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_administration');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_administration');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sub_committee_id', 'Administrative Role', 'required');
		$this->form_validation->set_rules('name', 'Member Name', 'required');
		$this->form_validation->set_rules('designation', 'Designation', 'required');
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
	
}

