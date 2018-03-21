<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_package extends CI_Controller {
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
		$table['name']='package';
		$order_by[0] = array('field'=>'id','type'=>'desc'); 
		$data['rows']=$this->common_model->find_data($table,'array','','','','','',$order_by);
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-package-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	
	function add()
	{
		$data['action'] = 'Add';
		
		$data['pkg_mode_list'] = array(
									''=>'select mode',
									'Monthly'=>'Monthly',
									'Quarterly'=>'Quarterly',
									'Half Yearly'=>'Half Yearly',
									'Annually'=>'Annually'
									);
		$table['name'] = 'service_tax';
		$data['service_tax_result'] = $this->common_model->find_data($table,'row','');
		$data['service_tax'] = $data['service_tax_result']->tax;
		
			if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='service_tax';
						$conditions = array('id'=>1);
						$data['service_tax'] = $this->common_model->find_data($table,'row','',$conditions);
						$tax = $data['service_tax']->tax;
						
						$postdata = array(
											'pkg'=> $this->input->post('pkg'),
											'pkg_mode'=> $this->input->post('pkg_mode'),
											'pkg_name'=> $this->input->post('pkg')."**".$this->input->post('pkg_mode'),
											'desc'=> $this->input->post('desc'),
											'all_ch'=> $this->input->post('all_ch'),
											'service_tax'=> $tax,
											'tax_amount'=> $this->input->post('tax_amount'),
											'service_chrg'=> $this->input->post('service_chrg'),
											'price'=> $this->input->post('price')
											);
						//echo '<pre>';print_r($postdata);die;
											
					   	$table['name']='package';	
						$success = $this->common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Package successfully inserted');	
							redirect('manage_package');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert result */
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-package-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$data['pkg_mode_list'] = array(
									''=>'select mode',
									'Monthly'=>'Monthly',
									'Quarterly'=>'Quarterly',
									'Half Yearly'=>'Half Yearly',
									'Annually'=>'Annually'
								);
		$table['name'] = 'service_tax';
		$data['service_tax_result'] = $this->common_model->find_data($table,'row','');
		$data['service_tax'] = $data['service_tax_result']->tax;
		
		$conditions = array('id'=>$id);
		$table['name']='package';
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['row']);die;
		
		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='service_tax';
						$conditions = array('id'=>1);
						$data['service_tax'] = $this->common_model->find_data($table,'row','',$conditions);
						$tax = $data['service_tax']->tax;
						
						$postdata = array(
											'pkg'=> $this->input->post('pkg'),
											'pkg_mode'=> $this->input->post('pkg_mode'),
											'pkg_name'=> $this->input->post('pkg')."**".$this->input->post('pkg_mode'),
											'desc'=> $this->input->post('desc'),
											'all_ch'=> $this->input->post('all_ch'),
											'service_tax'=> $tax,
											'tax_amount'=> $this->input->post('tax_amount'),
											'service_chrg'=> $this->input->post('service_chrg'),
											'price'=> $this->input->post('price')
											);
						//echo '<pre>';print_r($postdata);die;
											
					   	$table['name']='package';		
						$success = $this->common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Package successfully updated');	
							redirect('manage_package');
						}
						else
						{	
							redirect('manage_package');			
						}	
					}			
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-package-view',$data,true);
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
		
		$table['name']='package';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$this->session->set_flashdata('success_message','Package has been Deleted successfully.');
			redirect('manage_package');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_package');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pkg', 'Package name', 'required');
		$this->form_validation->set_rules('pkg_mode', 'Package mode', 'required');
		$this->form_validation->set_rules('desc', 'Package description', 'required');
		$this->form_validation->set_rules('all_ch', 'Package Price', 'required');
		$this->form_validation->set_rules('tax_amount', 'Price', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		
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

