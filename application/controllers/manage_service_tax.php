<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_service_tax extends CI_Controller {
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
		$table['name'] = 'service_tax';
		$data['rows']=$this->common_model->find_data($table,'array');
		//echo '<pre>';print_r($data['rows']);die;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-servicetax-list-view',$data,true);
		
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	
	
	
	#################################  Photo gallery START #####################################
	
	
	function add()
	{
	
		$data['action'] = 'Add';
		
		
		/* for insert image */	
		if($this->input->post('slider1') == 1)
		{	
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array(											
											'tax'=>$this->input->post('tax')
											);
						
						$table['name']='service_tax';			
						$success = $this->common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Service Tax successfully inserted');	
							redirect('manage_service_tax');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}
					}
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-servicetax-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
	}
	######################################################################################
	
	function edit($id)
	{
		
		$data['action'] = 'Edit';
		
		$conditions=array('id'=>$id);
		$table['name'] = 'service_tax';
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		
	
					
		if($this->input->post('slider1') == 1)
		{	
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$postdata = array('tax'=>$this->input->post('tax'));
						
						$table['name']='service_tax';			
						$success = $this->common_model->save_data($table,$postdata, $id);						
						if($success)
						{	
							
							/********************Update package amount as per GST**********************/
							$query = $this->db->query("Select * FROM `package`");
							$result = $query->result();

							foreach ($result as $key => $value) {

								//`all_ch`, `service_tax`, `tax_amount`, `service_chrg`, `price`

								$all_ch = $value->all_ch;
						
								$percentage = $this->input->post('tax');
								$totalWidth = $all_ch;
								$new_width = ($percentage / 100) * $totalWidth;


								$tax_amount = $value->tax_amount;
								$service_chrg = $value->service_chrg;
								
								$price = ($all_ch+$new_width+$service_chrg);
								

								$arrayPackage = array('service_tax' => $percentage,
													   'tax_amount' => $new_width,
													   'price'  => $price

												 );
								$table = 'package';
								$this->db->where('id', $value->id);
                                $this->db->update('package', $arrayPackage);

							}
							//die;
							$this->session->set_flashdata('success_message','Service Tax successfully updated');	
							redirect('manage_service_tax');
						}
						else
						{		
							redirect('manage_service_tax');				
						}
					}
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-servicetax-view',$data,true);
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
		
		$table['name']='thi_sliders';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('manage_service_tax');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_service_tax');
		}
	}
	
	##############################################################################################
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tax', 'Service Tax', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
}

