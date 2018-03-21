<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_addon extends CI_Controller {
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
		$table['name']='addons_channels';
		$order_by[0] = array('field'=>'id','type'=>'desc'); 
		$data['rows']=$this->common_model->find_data($table,'array','','','','','',$order_by);
		//echo '<pre>';print_r($data['rows']);die;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-addon-list-view',$data,true);
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
						$table['name']='service_tax';
						$conditions = array('id'=>1);
						$service_tax = $this->common_model->find_data($table,'row','',$conditions);
						$tax = $service_tax->tax;
						$price = $this->input->post('price');
						$tax_amt = ($price*$tax)/100;
						$total = $price + $tax_amt;
						
						$postdata = array(
											'channel_name'=> $this->input->post('channel_name'),
											'desc'=> $this->input->post('desc'),
											'price'=> $this->input->post('price'),
											'serv_tax'=> $tax,
											'tax_amt'=> $tax_amt,
											'total_amt'=> $total
											);
						//echo '<pre>';print_r($postdata);die;
											
					   	$table['name']='addons_channels';	
						$success = $this->common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Add ons successfully inserted');	
							redirect('manage_addon');
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
		$data['maincontent']=$this->load->view('maincontents/add-edit-addon-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$conditions = array('id'=>$id);
		$table['name']='addons_channels';
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
						$service_tax = $this->common_model->find_data($table,'row','',$conditions);
						$tax = $service_tax->tax;
						$price = $this->input->post('price');
						$tax_amt = ($price*$tax)/100;
						$total = $price + $tax_amt;
						
						$postdata = array(
											'channel_name'=> $this->input->post('channel_name'),
											'desc'=> $this->input->post('desc'),
											'price'=> $this->input->post('price'),
											'serv_tax'=> $tax,
											'tax_amt'=> $tax_amt,
											'total_amt'=> $total
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name']='addons_channels';		
						$success = $this->common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Add ons successfully updated');	
							redirect('manage_addon');
						}
						else
						{	
							redirect('manage_addon');			
						}	
					}			
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-addon-view',$data,true);
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
		
		$table['name']='addons_channels';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$this->session->set_flashdata('success_message','Add ons has been Deleted successfully.');
			redirect('manage_addon');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_addon');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('channel_name', 'Channel name', 'required');
		$this->form_validation->set_rules('desc', 'Description', 'required');
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

