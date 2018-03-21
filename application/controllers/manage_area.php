<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_area extends CI_Controller {
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
		$table['name']='area';
		$order_by[0] = array('field'=>'area.id','type'=>'asc');
		$select = 'area.id,area.zone_id,area.area_name,area.area_code,zone.zone_name';
		$join[0] = array('table'=>'zone','field'=>'id','table_master'=>'area','field_table_master'=>'zone_id','type'=>'inner'); 
		$data['rows']=$this->common_model->find_data($table,'array','','',$select,$join,'',$order_by);
		//echo '<pre>';print_r($data['rows']);die;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-area-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	
	function add()
	{
		$data['action'] = 'Add';
		
		$table['name'] = 'zone';
		$order_by[0] = array('field'=>'zone_name','type'=>'asc');
		$select = 'id,zone_name';
		$list = array('key'=>'id','value'=>'zone_name','empty_name'=>' Zone');
		$data['zones'] = $this->common_model->find_data($table,'list',$list,'',$select,'','',$order_by);
		//echo $this->db->last_query(); die;
		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='area';
						$postdata = array(
											'zone_id'=> $this->input->post('zone_id'),
											'area_name'=> $this->input->post('area_name'),
											'area_code'=> $this->input->post('area_code')
											);
					   		
						$success = $this->common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Area successfully inserted');	
							redirect('manage_area');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Please try again.');		
							redirect(current_url());					
						}	
					}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-area-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$conditions = array('id'=>$id);
		$table['name']='area';
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['row']);die;
		
		$table['name'] = 'zone';
		$order_by[0] = array('field'=>'zone_name','type'=>'asc');
		$conditions = array('id'=>$id);
		$select = 'id,zone_name';
		$list = array('key'=>'id','value'=>'zone_name','empty_name'=>' Zone');
		$data['zones'] = $this->common_model->find_data($table,'list',$list,'',$select,'','',$order_by);
		
		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='area';
						$postdata = array(
											'zone_id'=> $this->input->post('zone_id'),
											'area_name'=> $this->input->post('area_name'),
											'area_code'=> $this->input->post('area_code')
											);
								
						$success = $this->common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Area successfully updated');	
							redirect('manage_area');
						}
						else
						{	
							redirect('manage_area');			
						}	
					}			
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-area-view',$data,true);
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
		
		$table['name']='area';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$this->session->set_flashdata('success_message','Area has been Deleted successfully.');
			redirect('manage_area');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_area');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('zone_id', 'Zone Name', 'required');
		$this->form_validation->set_rules('area_name', 'Area Name', 'required');
		$this->form_validation->set_rules('area_code', 'Area Code', 'required|max_length[5]');
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
	
	
	
}

