<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_fee_structure extends CI_Controller {
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
		
		$table['name']='dumkal_fee_structure';
		$data['rows'] = $this->Common_model->find_data($table,'array');
		//echo '<pre>';print_r($data['rows']);die;	
		
		
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-fee-structure-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function add()
	{
		$data['action'] = 'Add';
		/* for sub-committee list */
		
		$sub = array(
					'' => 'Select Notice',
					'General Notice' => 'General Notice',
					'Tender Notice' => 'Tender Notice'
					);
		$data['categories']=$sub;
		/* for sub-committee list */
		
		/* for insert notice */	
		if($this->input->post('slider1') == 1)
		{	
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$nt = $_FILES["slider_image"]["name"];
			
						if($nt == '')
						{
							$this->session->set_flashdata('message', 'Please upload a document');
							redirect(current_url());
						}
						$exp = explode('.',$nt);
						$imageFileType = $exp[1];
						
						if($imageFileType != "pdf" )
						{
							$this->session->set_flashdata('message', 'Sorry, only PDF files are allowed');
							redirect(current_url());
						}
						$notice = $exp[0].time().'.'.$exp[1];
						$temp = $_FILES["slider_image"]["tmp_name"];
						
						$expiry_date = date_create($this->input->post('expiry_date'));
						$expiry_date1 = date_format($expiry_date,"d-m-Y");
						
						$postdata = array(
											'role'=>$this->input->post('role'),
											'title'=>$this->input->post('title'),
											'expiry_date'=>$expiry_date1,
											'filename'=> $notice,
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name'] = 'dumkal_notice_tender';		
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->student_file_upload($image,$temp);
							$this->session->set_flashdata('success_message','Notice successfully inserted');	
							redirect('admin/manage_notice_tender');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Error! Please try again.');		
							redirect(current_url());					
						}	
					}
		}
		/* for insert notice */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-notice-tender-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		/* for sub-committee list */
		
		$sub = array(
					'' => 'Select Notice',
					'General Notice' => 'General Notice',
					'Tender Notice' => 'Tender Notice'
					);
		$data['categories']=$sub;
		/* for sub-committee list */
		
		$table['name'] = 'dumkal_notice_tender';
		$conditions=array('dumkal_notice_tender.id'=>$id);
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions,'*');
		//echo '<pre>';print_r($data['row']);die;
		
		/* for insert notice */	
		if($this->input->post('slider1') == 1)
		{	
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$nt = $_FILES["slider_image"]["name"];
						
						if($nt == '')
						{
						$nt = $data['row']->filename;
						}
						else
						{
						$nt = $_FILES["slider_image"]["name"];
						}
			
						if($nt == '')
						{
							$this->session->set_flashdata('message', 'Please upload a document');
							redirect(current_url());
						}
						$exp = explode('.',$nt);
						$imageFileType = $exp[1];
						
						if($imageFileType != "pdf" )
						{
							$this->session->set_flashdata('message', 'Sorry, only PDF files are allowed');
							redirect(current_url());
						}
						$notice = $exp[0].time().'.'.$exp[1];
						$temp = $_FILES["slider_image"]["tmp_name"];
						
						$expiry_date = date_create($this->input->post('expiry_date'));
						$expiry_date1 = date_format($expiry_date,"d-m-Y");
						
						$postdata = array(
											'role'=>$this->input->post('role'),
											'title'=>$this->input->post('title'),
											'expiry_date'=>$expiry_date1,
											'filename'=> $notice,
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name'] = 'dumkal_notice_tender';		
						$success = $this->Common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							if($nt != '')
							{
							$this->student_file_upload($image,$temp);
							}
							$this->session->set_flashdata('success_message','Notice successfully updated');	
							redirect('admin/manage_notice_tender');
						}
						else
						{	
							$this->session->set_flashdata('success_message','Notice successfully updated');	
							redirect('admin/manage_notice_tender');					
						}	
					}
		}
		/* for insert notice */	
		
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-notice-tender-view',$data,true);
		
		
		
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
		$table['name'] = 'dumkal_notice_tender';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_notice_tender');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_notice_tender');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('role', 'Notice Role', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('expiry_date', 'Expiry Date', 'required');
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
	
	function student_file_upload($img,$tmp)
	   {
		   $image_path = 'uploads/notice/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
	
}

