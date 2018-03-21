<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_menu extends CI_Controller {
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
		$this->load->model(array('Common_model','sub_page_model'));
	}
	################################################################
	function index()
	{
		$conditions=array('thi_cities.published'=>1);
		//$order_by = array('field'=>'state_name','type'=>'ASC');
		$data['rows'] = $this->city_model->find_data('thi_cities.*,thi_states.state_name',$conditions);
		//echo '<pre>';print_r($data);die;	
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-city-list-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function main_page()
	{
		$table['name']='dumkal_main_page';
		$data['rows'] = $this->Common_model->find_data($table,'array');
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-main-page-list-view',$data,true);
		
		$this->load->view('admin/layout_after_login',$data);
	}
	#######################################################################################
	function main_page_add()
	{
		$data['action'] = 'Add';
		
		
		/* for insert main page */		
					if($this->main_page_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='dumkal_main_page';
						$postdata = array(
											'main_page_name'=>$this->input->post('main_page_name'),
											'published'=> 1
											);
									
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Main Page successfully inserted');	
							redirect('admin/manage_menu/main_page');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert city */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-main-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function main_page_edit($id)
	{
		$data['action'] = 'Edit';
		$conditions = array('id'=>$id);
		$table['name']='dumkal_main_page';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data);die;
		/* for update city */		
					if($this->main_page_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='dumkal_main_page';
						$postdata = array(
											'main_page_name'=>$this->input->post('main_page_name'),
											'published'=> 1
											);
									
						$success = $this->Common_model->save_data($table,$postdata,$id);					
						if($success)
						{	
							$this->session->set_flashdata('success_message','Main Page successfully updated');	
							redirect('admin/manage_menu/main_page');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert city */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-main-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function main_page_confirmDelete($id)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		
		$table['name']='dumkal_main_page';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_menu/main_page');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_menu/main_page');
		}
	}
	
	##############################################################################################
	
	
	function main_page_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('main_page_name', 'Main Page Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	#################################  MAIN PAGE END #####################################
	
	#################################  SUB PAGE START #####################################
	
	function sub_page()
	{		
		$select = 'dumkal_main_page.id,dumkal_main_page.main_page_name,dumkal_sub_pages.*';
		$conditions=array('dumkal_sub_pages.published'=>1);
		$order_by[0] = array('field'=>'dumkal_sub_pages.id','type'=>'ASC');
		$table['name']='dumkal_sub_pages';
		$join[0]=array('table'=>'dumkal_main_page','field'=>'id','table_master'=>'dumkal_sub_pages','field_table_master'=>'main_page_id','type'=>'INNER');
		$data['rows']=$this->Common_model->find_data($table,'array','',$conditions,$select,$join,'',$order_by);
		
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-sub-page-list-view',$data,true);
		
		$this->load->view('admin/layout_after_login',$data);
	}
	#######################################################################################
	function sub_page_add()
	{
	
		$data['action'] = 'Add';
		/* for main page list */
		
		$select = 'id,main_page_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'id','type'=>'ASC');
		$table['name']='dumkal_main_page';
		$list = array('empty_name'=>' Main Page Name','key'=>'id','value'=>'main_page_name');
		$data['categories']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		/* for main page list */
		
		/* for insert city */		
					if($this->sub_page_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array(
											'main_page_id'=>$this->input->post('main_page_id'),
											'sub_page_name'=>$this->input->post('sub_page_name'),
											'published'=> 1
											);
						
						$table['name']='dumkal_sub_pages';			
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Sub Page successfully inserted');	
							redirect('admin/manage_menu/sub_page');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert city */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-sub-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
		
	}
	######################################################################################
	
	function sub_page_edit($id)
	{
		
		$data['action'] = 'Edit';
		/* for main page list */
		
		$select = 'id,main_page_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'id','type'=>'ASC');
		$table['name']='dumkal_main_page';
		$list = array('empty_name'=>' Main Page Name','key'=>'id','value'=>'main_page_name');
		$data['categories']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		/* for main page list */
		
		$conditions=array('dumkal_sub_pages.id'=>$id);
		$data['row'] = $this->sub_page_model->find_data('dumkal_sub_pages.*,dumkal_main_page.main_page_name',$conditions,'row');
		
		/* for update sub page */		
					if($this->sub_page_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array(
											'main_page_id'=>$this->input->post('main_page_id'),
											'sub_page_name'=>$this->input->post('sub_page_name'),
											'published'=> 1
											);
						$table['name']='dumkal_sub_pages';			
						$success = $this->Common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Sub Page successfully updated');	
							redirect('admin/manage_menu/sub_page');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for update sub page */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-sub-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function sub_page_confirmDelete($id)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		
		$table['name']='dumkal_sub_pages';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_menu/sub_page');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_menu/sub_page');
		}
	}
	
	##############################################################################################
	
	
	function sub_page_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('main_page_id', 'Main Page Name', 'required');
		$this->form_validation->set_rules('sub_page_name', 'Sub Page Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	#################################  SUB PAGE END #####################################
	
}

