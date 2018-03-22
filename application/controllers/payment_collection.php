<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_collection extends CI_Controller {


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




	######################################################################################
	function index()
	{
		if($this->input->post('slider1')==1){


			if($this->form_validate_duration() == FALSE)
					{
						$data['error_message']=validation_errors();
						
						$data['head'] = $this->load->view('elements/head','',true);
						$data['header'] = $this->load->view('elements/header','',true);
						$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
						$data['footer'] = $this->load->view('elements/footer','',true);
						$data['maincontent']=$this->load->view('maincontents/manage-day-wise-payment-collection',$data,true);
						$this->load->view('layout_after_login',$data);
					}


		}

		$data['action'] = 'View';
		$table['name'] = 'pkg_payment';
		$select = 'pkg_payment.*,user_login.emp_name,client.client_name,zone.zone_name,area.area_name';
		$order_by[0] = array('field'=>'pkg_payment.id','type'=>'desc');
		$join[0] = array('table'=>'user_login','field'=>'id','table_master'=>'pkg_payment','field_table_master'=>'collected_by','type'=>'inner');
		$join[1] = array('table'=>'client','field'=>'id','table_master'=>'pkg_payment','field_table_master'=>'c_id','type'=>'inner');
		$join[2] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[3] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$conditions = array('pkg_payment.paydate'=>date('Y-m-d'));
		$data['rows'] = $this->common_model->find_data($table,'array','',$conditions,$select,$join,'',$order_by);
		
		//echo $this->db->last_query(); die;
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-day-wise-payment-collection',$data,true);
		$this->load->view('layout_after_login',$data);
		
	}	
	
}

