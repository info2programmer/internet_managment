<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_expense extends CI_Controller {
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
		$table['name']='expense';
		$order_by[0] = array('field'=>'id','type'=>'desc'); 
		$data['rows']=$this->common_model->find_data($table,'array','','','','','',$order_by);
		//echo '<pre>';print_r($data['rows']);die;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-expense-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	
	function add()
	{
		$data['action'] = 'Add';
		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='expense';
						$postdata = array('expense_title'=> $this->input->post('expense_title'),
										  'expense_amount'=> $this->input->post('expense_amount'),
										  'note'=> $this->input->post('note'),
											);
					   		
						$success = $this->common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Expense successfully inserted');	
							redirect('manage_expense');
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
		$data['maincontent']=$this->load->view('maincontents/add-edit-expense-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'View';
		
		$conditions = array('id'=>$id);
		$table['name']='expense';
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['row']);die;
		
		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='zone';
						$postdata = array(
											'zone_name'=> $this->input->post('zone_name')
											);
								
						$success = $this->common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Zone successfully updated');	
							redirect('manage_zone');
						}
						else
						{	
							redirect('manage_zone');			
						}	
					}			
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-expense-view',$data,true);
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
		
		$table['name']='zone';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$table['name'] = 'area';
			if($this->common_model->delete_data($table,$id,'zone_id'))
			{
				$table['name'] = 'client';
				$this->common_model->delete_data($table,$id,'zone_id');	
			}
			$this->session->set_flashdata('success_message','Zone has been Deleted successfully.');
			redirect('manage_zone');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_zone');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('expense_title', 'Expense Title', 'required');
		$this->form_validation->set_rules('expense_amount', 'Expense Amount', 'required');
		
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

