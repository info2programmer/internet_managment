<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_list extends CI_Controller {

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

	function expiry_list()
	{		
		$table['name'] = 'pkg_assign';
		$select = 'pkg_assign.*,client.*,zone.zone_name,area.area_name';
		$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_assign','field_table_master'=>'c_id','type'=>'inner');
		$join[1] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[2] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$data['rows'] = $this->common_model->find_data($table,'array','','',$select,$join);
		//echo '<pre>';print_r($data['rows']);die;

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-expiry-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	function payment_list()
	{		
		$table['name'] = 'pkg_payment';
		$select = 'pkg_payment.*,client.*,zone.zone_name,area.area_name,pkg_payment.id';
		$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_payment','field_table_master'=>'c_id','type'=>'inner');
		$join[1] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[2] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$order_by[0] = array('field'=>'pkg_payment.id','type'=>'desc');
		$data['rows'] = $this->common_model->find_data($table,'array','','',$select,$join,'',$order_by);
		//echo '<pre>';print_r($data['rows']);die;

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-payment-list-view',$data,true);
		$this->load->view('layout_after_login',$data);

	}
	public function payment_print($id){
		$table['name'] = 'pkg_payment';
		$select = 'client.*,pkg_payment.*,pkg_payment.id';
		$conditions = array('pkg_payment.id'=>$id);
		$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_payment','field_table_master'=>'c_id','type'=>'inner');
        //$join[1] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		//$join[2] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');

		$data['row'] = $this->common_model->find_data($table,'row','',$conditions,$select,$join);

		//echo '<pre>';print_r($data['row']);die;

		$c_id = $data['row']->c_id;



		$box_no = $data['row']->box_no;
		$from_date = $data['row']->from_date;
		$to_date = $data['row']->to_date;
		
		$data['rows'] = $this->db->query("select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.id=$id")->result();
		
		$pkg_count = $this->db->query("select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.id=$id")->num_rows();
		
		//echo '<pre>';print_r($data['rows']);die;
		
		//echo $qq ="select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `box_no`='$box_no' and `pay_date`>='$from_date' and `pay_date`<='$to_date'";die;
		

		$data['addons'] = $this->db->query("select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `box_no`='$box_no' and `pay_date`>='$from_date' and `pay_date`<='$to_date'")->result();
		
		$addon_fetch = $this->db->query("select sum(addons_payment.total_amount) as total from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `box_no`='$box_no' and `pay_date`>='$from_date' and `pay_date`<='$to_date'")->result_array();
		$addon_count = $this->db->query("select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `box_no`='$box_no' and `pay_date`>='$from_date' and `pay_date`<='$to_date'")->num_rows();

		//$aprint_r($addon_fetch);die;
		
		/*$package_total = $data['row']->amount;
		if($addon_count!=0){$addon_total=$addon_fetch[0]['total'];}else{$addon_total=0;}
		$grand_toatl=round($package_total+$addon_total);
		$data['rupees']= $this->convert_number($grand_toatl);
		$data['grand_toatl']=$grand_toatl;
		
		$data['addon_count']=$addon_count;*/
		
		foreach($data['rows'] as $amt) { 
				  
				  $grand9[] = $amt->amount;
		}
		
		if($pkg_count!=0){$package_total = round(array_sum($grand9));}else{$package_total=0;}
		
		if($addon_count!=0){$addon_total=$addon_fetch[0]['total'];}else{$addon_total=0;}
		
		$grand_toatl=round($package_total+$addon_total);
		$data['rupees']= $this->convert_number($grand_toatl);
		$data['grand_toatl']=$grand_toatl;
		
		$data['addon_count']=$addon_count;
		

		//echo '<pre>';print_r($data['grand_toatl']);die;
		$this->load->view('maincontents/pdf/examples/report',$data);
	}
	
	public function whole_challan_print($id){
		
		//$assign_details = $this->db->query("select * from pkg_assign where ");
		$firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
		$lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));
		
		$firstDay = date("Y-m-d", $firstDayUTS);
		$lastDay = date("Y-m-d", $lastDayUTS);
		
		/*$table['name'] = 'pkg_payment';
		$select = 'client.*,pkg_payment.*,pkg_payment.id';
		$conditions = array('pkg_payment.c_id'=>$id);
		$join[0] = array('table'=>'client','field'=>'id','table_master'=>'pkg_payment','field_table_master'=>'c_id','type'=>'inner');*/
		/*echo "select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.c_id=$id and pkg_payment.from_date BETWEEN  '$firstDay' and '$lastDay'";
		die;*/       

		$data['rows'] = $this->db->query("select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.c_id=$id and pkg_payment.from_date BETWEEN  '$firstDay' and '$lastDay'")->result();
		//echo '<pre>';print_r($data['rows']);
		
		$pkg_count = $this->db->query("select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.c_id=$id and pkg_payment.from_date BETWEEN  '$firstDay' and '$lastDay'")->num_rows();
		//echo $pkg_count;die;
		
		$data['row'] = $this->db->query("select client.*,pkg_payment.*,pkg_payment.id from pkg_payment inner join client on client.id=pkg_payment.c_id where pkg_payment.c_id=$id and pkg_payment.from_date BETWEEN  '$firstDay' and '$lastDay'")->row();
		//echo '<pre>';print_r($data['rows']);die;
		

		$c_id = $data['row']->c_id;



		$box_no = $data['row']->box_no;
		$from_date = $data['row']->from_date;
		$to_date = $data['row']->to_date;
		
		
		

		//$data['addons'] = $this->db->query("select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `box_no`='$box_no' and `pay_date`>='$from_date' and `pay_date`<='$to_date'")->result();
		$data['addons'] = $this->db->query("select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `pay_date` BETWEEN  '$firstDay' and '$lastDay'")->result();
		//echo '<pre>';print_r($data['addons']);die;
		
		$addon_fetch = $this->db->query("select sum(addons_payment.total_amount) as total from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `pay_date` BETWEEN  '$firstDay' and '$lastDay'")->result_array();
		
		$addon_count = $this->db->query("select addons_payment.*,addons_channels.channel_name from `addons_payment` inner join addons_channels on addons_channels.id=addons_payment.addons_id where `c_id`=$c_id and `pay_date` BETWEEN  '$firstDay' and '$lastDay'")->num_rows();

		
		
		//$package_total = $data['row']->amount;
		
		foreach($data['rows'] as $amt) { 
				  
				  $grand9[] = $amt->amount;
		}
		
		if($pkg_count!=0){$package_total = round(array_sum($grand9));}else{$package_total=0;}
		
		if($addon_count!=0){$addon_total=$addon_fetch[0]['total'];}else{$addon_total=0;}
		
		$grand_toatl=round($package_total+$addon_total);
		$data['rupees']= $this->convert_number($grand_toatl);
		$data['grand_toatl']=$grand_toatl;
		
		$data['addon_count']=$addon_count;

		
		$this->load->view('maincontents/pdf/examples/report',$data);
	}
	
		function convert_number($number) {

					if (($number < 0) || ($number > 999999999)) {
			
						throw new Exception("Number is out of range");
			
					}
			
					$Gn = floor($number / 1000000);
			
					/* Millions (giga) */
			
					$number -= $Gn * 1000000;
			
					$kn = floor($number / 1000);
			
					/* Thousands (kilo) */
			
					$number -= $kn * 1000;
			
					$Hn = floor($number / 100);
			
					/* Hundreds (hecto) */
			
					$number -= $Hn * 100;
			
					$Dn = floor($number / 10);
			
					/* Tens (deca) */
			
					$n = $number % 10;
			
					/* Ones */
			
					$res = "";
					if ($Gn) {
			
						$res .= $this->convert_number($Gn) .  "Million";
					}
			
					if ($kn) {
			
						$res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
					}
			
					if ($Hn) {
			
						$res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
					}
			
					$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Ninteen");
			
					$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninty");
					if ($Dn || $n) {
						if (!empty($res)) {
			
							$res .= " and ";
						}
			
						if ($Dn < 2) {
			
							$res .= $ones[$Dn * 10 + $n];
			
						} else {
			
							$res .= $tens[$Dn];
			
							if ($n) {
			
								$res .= "-" . $ones[$n];
							}
			
						}
			
					}
			
					if (empty($res)) {
			
						$res = "zero";
					}
			
					return $res;
	}
	#################################  MAIN PAGE END #####################################

function client_details($c_id)
	{
		$table['name'] = 'client';
		$conditions = array('client_id'=>$c_id);
		$select = 'client.*,zone.zone_name,area.area_name';
		$join[0] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[1] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions,$select,$join);
		//echo '<pre>';print_r($data['row']);die;

		$this->load->view('maincontents/client-details-view',$data);
	}
}







