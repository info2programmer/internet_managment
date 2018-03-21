<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_report extends CI_Controller {

	function __construct()

	{

		parent::__construct();

		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	

		

		if( $is_admin_logged_in != 1)

        {

           redirect(base_url());

        }

		$this->load->model(array('common_model'));

		//$this->load->library('Numbertowords');

		$this->load->helper('date');

		date_default_timezone_set('Asia/Calcutta');

	}

	################################################################

	function package_mode()
	{
		$data['action'] = 'View';
		
		//$pkg_mode = $this->input->get('pkg_mode');

		$pkg_mode = 'monthly';
		
		$table['name'] = 'pkg_assign';
		$select = 'pkg_assign.*,client.*,zone.zone_name,area.area_name';
		$conditions = array('pkg_assign.pkg_mode'=>$pkg_mode);
		$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_assign','field_table_master'=>'c_id','type'=>'inner');
		$join[1] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[2] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');			
		$data['rows'] = $this->common_model->find_data($table,'array','', $conditions,$select,$join);
		//echo '<pre>';print_r($data['rows']);die;	
		
		$data['input_mode'] = $pkg_mode;
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-report-package-mode-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
	}
	
	function payment_duration()
	{
		$data['action'] = 'View';
		
		if($this->input->post('slider1')==1)
		{
			if($this->form_validate_duration() == FALSE)
					{
						$data['error_message']=validation_errors();
						
						$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-package-duration-view',$data,true);
		$this->load->view('layout_after_login',$data);
					}
					else
					{
						$pkg_mode = $this->input->post('pkg_mode');
						$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
						$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
						
						
						$q = "select pkg_assign.*,client.* from pkg_assign inner join client on client.id=pkg_assign.c_id where pkg_assign.pkg_mode='$pkg_mode' and pkg_assign.to_date>'$from_date' and pkg_assign.to_date<'$to_date'";
						
									
						$data['rows'] = $this->db->query($q)->result();
						//echo '<pre>';print_r($data['rows']);die;
						$data['input_mode'] = $pkg_mode;
						if($data['rows'])
						{
							$data['head'] = $this->load->view('elements/head','',true);
							$data['header'] = $this->load->view('elements/header','',true);
							$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
							$data['footer'] = $this->load->view('elements/footer','',true);
							$data['maincontent']=$this->load->view('maincontents/manage-report-package-duration-list-view',$data,true);
							$this->load->view('layout_after_login',$data);
						}
						else
						{
							$this->session->set_flashdata('error_message','Sorry There is no data according to your input');		
							redirect(current_url());
						}
					}
		}
		else
		{
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-package-duration-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
		}
	}
	
	function addons_duration()
	{
		$data['action'] = 'View';
		
		if($this->input->post('slider1')==1)
		{
			if($this->form_validate_addon_duration() == FALSE)
					{
						$data['error_message']=validation_errors();
						
						$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-addon-duration-view',$data,true);
		$this->load->view('layout_after_login',$data);
					}
					else
					{
						
						$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
						$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
						
						
						$q = "select addons_payment.*,client.*,addons_channels.channel_name from addons_payment inner join client on client.id=addons_payment.c_id inner join addons_channels on addons_channels.id=addons_payment.addons_id where addons_payment.to_date>'$from_date' and addons_payment.to_date<'$to_date'";
						
									
						$data['rows'] = $this->db->query($q)->result();
						//echo '<pre>';print_r($data['rows']);die;
						
						if($data['rows'])
						{
							$data['head'] = $this->load->view('elements/head','',true);
							$data['header'] = $this->load->view('elements/header','',true);
							$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
							$data['footer'] = $this->load->view('elements/footer','',true);
							$data['maincontent']=$this->load->view('maincontents/manage-report-addon-duration-list-view',$data,true);
							$this->load->view('layout_after_login',$data);
						}
						else
						{
							$this->session->set_flashdata('error_message','Sorry There is no data according to your input');		
							redirect(current_url());
						}
					}
		}
		else
		{
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-addon-duration-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
		}
	}
	
	function monthly_renewal()
	{
		
		$data['action'] = 'View';
		
		if($this->input->post('slider1')==1)
		{
			if($this->form_validate_monthly_renewal() == FALSE)
					{
						$data['error_message']=validation_errors();
						
						$data['head'] = $this->load->view('elements/head','',true);
						$data['header'] = $this->load->view('elements/header','',true);
						$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
						$data['footer'] = $this->load->view('elements/footer','',true);
						$data['maincontent']=$this->load->view('maincontents/add-edit-report-monthly-renewal-view',$data,true);
						$this->load->view('layout_after_login',$data);
					}
					else
					{
						
						$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
						$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
						
						
						$q = "select pkg_assign.*,client.client_name,client.client_id from pkg_assign inner join client on client.id=pkg_assign.c_id where pkg_assign.to_date>='$from_date' and pkg_assign.to_date<='$to_date'";
						
						
									
						$data['rows'] = $this->db->query($q)->result();
						//echo '<pre>';print_r($data['rows']);die;
						
						if($data['rows'])
						{
							$data['head'] = $this->load->view('elements/head','',true);
							$data['header'] = $this->load->view('elements/header','',true);
							$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
							$data['footer'] = $this->load->view('elements/footer','',true);
							$data['maincontent']=$this->load->view('maincontents/manage-report-monthly-renewal-list-view',$data,true);
							$this->load->view('layout_after_login',$data);
						}
						else
						{
							$this->session->set_flashdata('error_message','Sorry There is no data according to your input');		
							redirect(current_url());
						}
					}
		}
		else
		{
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-monthly-renewal-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
		}
		
	}
	
	function bill_details()
	{
		$data['action'] = 'View';
		
		
		
		if($this->input->post('slider1')==1)
		{
			if($this->form_validate_addon_duration() == FALSE)
					{
						$data['error_message']=validation_errors();
						
						$data['head'] = $this->load->view('elements/head','',true);
						$data['header'] = $this->load->view('elements/header','',true);
						$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
						$data['footer'] = $this->load->view('elements/footer','',true);
						$data['maincontent']=$this->load->view('maincontents/add-edit-report-bill-details-view',$data,true);
						$this->load->view('layout_after_login',$data);
					}
					else
					{
						$c_id = $this->input->post('c_id');
						$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
						$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
						
						$data['from'] = $from_date;
						$data['to'] = $to_date;
						
						$q = "select pkg_payment.*,client.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.c_id='$c_id' and  pkg_payment.paydate>'$from_date' and pkg_payment.paydate<'$to_date'";
						
									
						$data['rows'] = $this->db->query($q)->result();
						//echo '<pre>';print_r($data['rows']);die;
						
						if($data['rows'])
						{
							$data['head'] = $this->load->view('elements/head','',true);
							$data['header'] = $this->load->view('elements/header','',true);
							$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
							$data['footer'] = $this->load->view('elements/footer','',true);
							$data['maincontent']=$this->load->view('maincontents/manage-report-bill-details-list-view',$data,true);
							$this->load->view('layout_after_login',$data);
						}
						else
						{
							$this->session->set_flashdata('error_message','Sorry There is no data according to your input');		
							redirect(current_url());
						}
					}
		}
		else
		{
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-report-bill-details-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
		}
	}
	
	function form_validate_mode()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pkg_mode', 'Package Mode', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}

	function form_validate_package()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pkg', 'Package', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function form_validate_duration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pkg_mode', 'Package Mode', 'required');
		$this->form_validation->set_rules('from_date', 'From Name', 'required');
		$this->form_validation->set_rules('to_date', 'To Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	function form_validate_addon_duration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('from_date', 'From Name', 'required');
		$this->form_validation->set_rules('to_date', 'To Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	function form_validate_monthly_renewal()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('from_date', 'From Name', 'required');
		$this->form_validation->set_rules('to_date', 'To Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}


	function package()
	{
		$data['action'] = 'View';
		
		if($this->input->post('slider1')==1)
		{
			if($this->form_validate_package() == FALSE)
			{
				$data['error_message']=validation_errors();

				$table['name'] = 'package';
				$select = 'package.*';		
				$data['rows'] = $this->common_model->find_data($table,'array','','',$select,'');

				$data['head'] = $this->load->view('elements/head','',true);
				$data['header'] = $this->load->view('elements/header','',true);
				$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
				$data['footer'] = $this->load->view('elements/footer','',true);
				$data['maincontent']=$this->load->view('maincontents/add-edit-report-package-view',$data,true);
				$this->load->view('layout_after_login',$data);
			}
			else
			{
				$pkg = $this->input->post('pkg');
				
				$table['name'] = 'pkg_assign';
				$select = 'pkg_assign.*,client.*,zone.zone_name,area.area_name';
				$conditions = array('pkg_assign.pkg_name'=>$pkg);
				$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_assign','field_table_master'=>'c_id','type'=>'inner');
				$join[1] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
				$join[2] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');			
				$data['rows'] = $this->common_model->find_data($table,'array','', $conditions,$select,$join);
				//echo '<pre>';print_r($data['rows']);die;	
			
			$data['input_mode'] = $pkg;
			if($data['rows'])
			{
				$data['head'] = $this->load->view('elements/head','',true);
				$data['header'] = $this->load->view('elements/header','',true);
				$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
				$data['footer'] = $this->load->view('elements/footer','',true);
				$data['maincontent']=$this->load->view('maincontents/manage-report-package-list-view',$data,true);
				$this->load->view('layout_after_login',$data);
			}
			else
			{
				$this->session->set_flashdata('error_message','Sorry There is no data according to your input');		
				redirect(current_url());
			}
		  }
		}
		else
		{

			$table['name'] = 'package';
			$select = 'package.*';		
			$data['rows'] = $this->common_model->find_data($table,'array','','',$select,'');
			$data['head'] = $this->load->view('elements/head','',true);
			$data['header'] = $this->load->view('elements/header','',true);
			$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
			$data['footer'] = $this->load->view('elements/footer','',true);
			$data['maincontent']=$this->load->view('maincontents/add-edit-report-package-view',$data,true);
			$this->load->view('layout_after_login',$data);
		}
	}
}



