<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_sub_committee extends CI_Controller {
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
		$this->load->model(array('Common_model'));
	}
	################################################################
	function index()
	{
		$table['name']='dumkal_sub_committee';
		$data['rows'] = $this->Common_model->find_data($table,'array');
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-sub-committee-list-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function add()
	{
		$data['action'] = 'Add';
		/* for sub-committee list */
		
		$sub = array(
					'' => 'Select Sub-committee',
					'Academic' => 'Academic Sub-committee',
					'Library' => 'Library Sub-committee',
					'Admission' => 'Admission Sub-committee',
					'Examination' => 'Examination Sub-committee',
					'Finance' => 'Finance Sub-committee',
					'Purches' => 'Purches Sub-committee',
					'Building' => 'Building Sub-committee',
					'Students' => 'Students welfare Sub-committee',
					'Sports' => 'Sports Sub-committee',
					'Cultural' => 'Cultural Sub-committee',
					'Canteen' => 'Canteen Sub-committee'
					);
		$data['categories']=$sub;
		/* for sub-committee list */
		
		/* for insert sub-committee */		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array(
											'sub_committee_id'=>$this->input->post('sub_committee_id'),
											'member_name'=>$this->input->post('member_name'),
											'designation'=>$this->input->post('designation'),
											'published'=> 1
											);
						$table['name'] = 'dumkal_sub_committee';		
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Sub committee successfully inserted');	
							redirect('admin/manage_sub_committee');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert sub-committee */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-sub-committee-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		/* for sub-committee list */
		
		$sub = array(
					'' => 'Select Sub-committee',
					'Academic Sub-committee' => 'Academic Sub-committee',
					'Library Sub-committee' => 'Library Sub-committee',
					'Admission Sub-committee' => 'Admission Sub-committee',
					'Examination Sub-committee' => 'Examination Sub-committee',
					'Finance Sub-committee' => 'Finance Sub-committee',
					'Purches Sub-committee' => 'Purches Sub-committee',
					'Building Sub-committee' => 'Building Sub-committee',
					'Students welfare Sub-committee' => 'Students welfare Sub-committee',
					'Sports Sub-committee' => 'Sports Sub-committee',
					'Cultural Sub-committee' => 'Cultural Sub-committee',
					'Canteen Sub-committee' => 'Canteen Sub-committee'
					);
		$data['categories']=$sub;
		/* for sub-committee list */
		
		$table['name'] = 'dumkal_sub_committee';
		$conditions=array('dumkal_sub_committee.id'=>$id);
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions,'*');
			
		
		/* for update sub_committee */		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array(
											'sub_committee_id'=>$this->input->post('sub_committee_id'),
											'member_name'=>$this->input->post('member_name'),
											'designation'=>$this->input->post('designation'),
											'published'=> 1
											);
						$table['name'] = 'dumkal_sub_committee';		
						$success = $this->Common_model->save_data($table,$postdata,$id);		
						if($success)
						{	
							$this->session->set_flashdata('success_message','Sub Committee successfully updated');	
							redirect('admin/manage_sub_committee');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert sub_committee */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-sub-committee-view',$data,true);
		
		
		
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
		$table['name'] = 'dumkal_sub_committee';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_sub_committee');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_sub_committee');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sub_committee_id', 'Sub Committee Name', 'required');
		$this->form_validation->set_rules('member_name', 'Member Name', 'required');
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

