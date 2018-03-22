<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_client extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');	
		
		if( $is_admin_logged_in != 1)
        {
           redirect(base_url());
        }
		$this->load->model(array('common_model'));
		date_default_timezone_set('Asia/Calcutta');
	}
	################################################################
	function index()
	{
		$table['name'] = 'client';
		$select = 'client.*,zone.zone_name,area.area_name';
		$order_by[0] = array('field'=>'client.id','type'=>'desc');
		$join[0] = array('table'=>'zone','field'=>'id','table_master'=>'client','field_table_master'=>'zone_id','type'=>'inner');
		$join[1] = array('table'=>'area','field'=>'id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$conditions = array('client.published'=>1);
		//$join[2] = array('table'=>'box_details','field'=>'client_foreign_id','table_master'=>'client','field_table_master'=>'area_id','type'=>'inner');
		$data['rows'] = $this->common_model->find_data($table,'array','',$conditions,$select,$join,'',$order_by);
		//echo '<pre>';print_r($data['rows']);die;
		// $data['package_name'] = 
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-client-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function add()
	{
		
		$data['action'] = 'Add';
		
		/*$x = 4; 
		$min = pow(10,$x);
		$max = pow(10,$x+1)-1;
		$value = rand($min,$max);*/
		$data['area_id']= $this->input->post('area_id');
		
		$table['name']= 'zone';
		$select = 'id,zone_name';
		 
		$list = array('key'=>'id','value'=>'zone_name','empty_name'=>' Zone');
		$data['zone_list'] = $this->common_model->find_data($table,'list',$list,'',$select);
		//echo '<pre>';print_r($data['zone_list']);die;
		
		/* for insert slider */
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
			
						$imge = $_FILES["slider_image"]["name"];
			
						if($imge != '')
						{
							//$this->session->set_flashdata('message', 'Please upload an image');
							//redirect(current_url());
							
							$exp = explode('.',$imge);
							$imageFileType = $exp[1];
							
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
							{
								$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
								redirect(current_url());
							}
							$image = $exp[0].time().'.'.$exp[1];
							$temp = $_FILES["slider_image"]["tmp_name"];
						}
						else
						{
							$image = '';
						}
						
			
			
						/*$imagedetails = getimagesize($_FILES['slider_image']['tmp_name']);
						$width = $imagedetails[0];
						$height = $imagedetails[1];
					
						if($width < 810 && $height < 365)
						{  
							$this->session->set_flashdata('message', 'Sorry file is big');
							redirect(current_url());
						}*/
						
						date_default_timezone_set('Asia/Kolkata');
						$table['name'] = 'area';
						$conditions = array('id'=>$this->input->post('area_id'));
						$area_code_result = $this->common_model->find_data($table,'row','',$conditions);
						$area_code = $area_code_result->area_code;
						
						
						
						$last_id = $this->db->query("select id from client order by id desc limit 1")->result_array();

						if(!isset($last_id[0]['id'])){
							$last=0;
						}
						else{
							$last=$last_id[0]['id'];
						}
						$last = $last+1;
						// echo  $this->db->last_query();
						// die;
						
						$client_id = explode(" ",$this->input->post('client_name'));
						$client_id = $client_id[0];
						$client_id = substr($client_id,0,3).$area_code.$last;
						
						$registration_date = date_format(date_create($this->input->post('registration_date')), "Y-m-d");
						//$registration_date = date_format(date_format($registration_date,"Y-m-d");
						
						$dob = date_format(date_create($this->input->post('dob')),"Y-m-d");
						//$dob = date_format($dob,"Y-m-d");
						
						$fields = array(
						'client_name' => $this->input->post('client_name'),
						'client_id' => $client_id,
						'client_email' => $this->input->post('client_email'),
						'registration_date' => $registration_date,
						'zone_id' => $this->input->post('zone_id'),
						'area_id' => $this->input->post('area_id'),
						'address' => $this->input->post('address'),
						'dob' => $dob,
						'phone' => $this->input->post('phone'),
						'image' => $image,
						'username' => $client_id,
						'password' => $client_id,
						'user_ip' => $this->input->ip_address(),
						'published'	=>	1
						);
						
						//echo '<pre>';print_r($fields);die;
						$table['name'] = 'client';
						$data = $this->common_model->save_data($table,$fields);

						// this section for package assign
						$client_id=$this->db->insert_id();
						$validity=29;
						$package_fromdate= $this->input->post('txtFromDate');
						$to_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($package_fromdate)) . " + " . $validity . " day"));
						$fields1= array(
							'c_id' => $client_id,
							'pkg_name' => $this->input->post('ddlPackage'),
							'active_status' => 1,
							'payment_status' => 1,
							'from_date' => $package_fromdate,
							'to_date' => $to_date,
							'pkg_mode' => $this->input->post('ddlPackageMode'),
							'discount' => '0.00'
						);
						$table1['name'] = 'pkg_assign';
						$data = $this->common_model->save_data($table1,$fields1);

						$this->db->last_query();
						
						
						$this->payment($client_id,'');
						

						if($data)
						{
						if($imge != '')
						{	
							$this->employee_file_upload($image,$temp);
						}
						$this->session->set_flashdata('success_message','Client details successfully inserted');	
						redirect(base_url().'index.php/manage_client');
						}
					
					}
				
			
		}
		/* for insert slider */
		$package_table['name']='package';
		$order_by[0] = array('field'=>'id','type'=>'desc'); 
		$data['all_package'] = $this->common_model->find_data($package_table,'array','','','','','',$order_by);
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-client-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}

	######################################################################################
	
	function edit($id)
	{
		$data['action'] = 'Edit';
		
		/*$x = 4; 
		$min = pow(10,$x);
		$max = pow(10,$x+1)-1;
		$value = rand($min,$max);*/
		
		
		$table['name']= 'zone';
		$select = 'id,zone_name';
		 
		$list = array('key'=>'id','value'=>'zone_name','empty_name'=>' Zone');
		$data['zone_list'] = $this->common_model->find_data($table,'list',$list,'',$select);
		
		
		
		$table['name'] = 'client';
		$conditions=array('id'=>$id);
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		$data['id_edit'] = $data['row']->id;
		$data['slider_image'] = $data['row']->image;
		$slider_image = $data['row']->image;
		
		
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$published = $data['row']->published;
						$postdata['published'] = $published;
						
			
						$imge = $_FILES["slider_image"]["name"];
						if($imge != '')
						{
							$exp = explode('.',$imge);
							$imageFileType = $exp[1];
							
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
							{
								$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
								redirect(current_url());
							}
							$image = $exp[0].time().'.'.$exp[1];
							$temp = $_FILES["slider_image"]["tmp_name"];
							
							$imagedetails = getimagesize($_FILES['slider_image']['tmp_name']);
							$width = $imagedetails[0];
							$height = $imagedetails[1];
						
							/*if($width < 1920 && $height < 1080)
							{  
								$this->session->set_flashdata('message', 'Sorry file is big');
								redirect(current_url());
							}*/
							
							$postdata['image'] = $image;	
							$this->employee_file_upload($image,$temp);
						}
						else
						{
							$postdata['image'] = $slider_image;
							$postdata['client_name'] = $this->input->post('client_name');
							$postdata['client_email'] = $this->input->post('client_email');
							$postdata['zone_id'] = $this->input->post('zone_id');
							$postdata['area_id'] = $this->input->post('area_id');
							$postdata['address'] = $this->input->post('address');
							$postdata['registration_date'] = date_format(date_create($this->input->post('registration_date')),"Y-m-d");
							$postdata['dob'] = date_format(date_create($this->input->post('dob')),"Y-m-d");
							$postdata['phone'] = $this->input->post('phone');
							$postdata['published'] = 1;
							
						
						}
				
				
				//echo '<pre>';print_r($postdata);die;
				$table['name'] = 'client';
				$data = $this->common_model->save_data($table,$postdata,$id);
				
				if($data) {
				$this->session->set_flashdata('success_message','Client details successfully updated');	
				redirect('manage_client');
				}
				else
				{
					redirect(base_url().'index.php/manage_client');
				}
			}				
			
				
			}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-client-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	######################################################################################
	
	function add_box($id)
	{
		$data['action'] = 'Add';
		
		$table['name'] = 'client';
		$conditions = array('id'=>$id);
		$data['client_details'] = $this->common_model->find_data($table,'row','',$conditions);
		$data['client_name'] = $data['client_details']->client_name;
		$data['client_id']= $data['client_details']->client_id;
		$data['id'] = $data['client_details']->id;
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate_box_add() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$fields = array(
						'client_foreign_id' => $id,
						'box_no' => $this->input->post('box_no')
						);
						
						//echo '<pre>';print_r($fields);die;
						
						$table['name'] = 'box_details';
						$data = $this->common_model->save_data($table,$fields);
						if($data)
						{						
						$this->session->set_flashdata('success_message','Box details successfully inserted');
						$r = base_url().'index.php/manage_client/box_details/'.$id;	
						redirect($r);
						}
					
					}
				
			
		}
		
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-box-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	
	function box_details($id)
	{
		$data['action'] = 'Edit';
		$table['name'] = 'pkg_payment';
		// $select = 'box_details.*';
		
		$conditions = array('c_id'=>$id);
		$order_by[0] = array('field'=>'id','type'=>'desc');
		$data['rows'] = $this->common_model->find_data($table,'array','',$conditions,'','','',$order_by);
		// $data['rows'] = $this->common_model->find_data($table,'array','',$conditions,'','','',$order_by[0]);
		
		$table['name'] = 'client';
		$conditions = array('id'=>$id);
		$data['client_details'] = $this->common_model->find_data($table,'row','',$conditions);
		$data['client_name'] = $data['client_details']->client_name;
		$data['client_id']= $data['client_details']->client_id;
		$data['id'] = $data['client_details']->id;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-box-list-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	
	function box_delete($id,$c_id,$box_no)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		$table['name'] = 'box_details';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$table['name'] = 'pkg_assign';
			$conditions = array('c_id'=>$c_id,'box_no'=>$box_no);
			$pfg_assign_data = $this->common_model->find_data($table,'row','',$conditions);
			
			if($pfg_assign_data) {
				$asign_id = $pfg_assign_data->id;
				$table['name'] = 'pkg_assign';
				$this->common_model->delete_data($table,$asign_id,'id');				
				$this->session->set_flashdata('success_message','Box details has been Deleted successfully.');
				$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
				redirect($r);	
			}
			else
			{
				$this->session->set_flashdata('success_message','Box details has been Deleted successfully.');				
				$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
				redirect($r);
				//redirect('manage_client');
			}
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
			redirect($r);
		}
	}
	########################################################################################
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
		$table['name'] = 'client';
		if($this->common_model->delete_data($table,$id,'id'))
		{
			$this->session->set_flashdata('success_message','Client details has been Deleted successfully.');
			redirect(base_url().'index.php/manage_client');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect(base_url().'index.php/manage_client');
		}
	}
	
	##############################################################################################
	
	/*function deactive($id)
	{
		
		
		$postdata = array(
							'published' => 0
						);
		$deactive = $this->slider_model->save_data($postdata,$id);
		
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee Image successfully deactivated');	
				redirect('manage_employee');
			}
		else
			{	
				//$this->session->set_flashdata('error_message','Please try again.');		
				redirect('manage_employee');					
			}
	}
	
	function active($id)
	{
		
		
		$postdata = array(
							'published' => 1
						);
		$deactive = $this->slider_model->save_data($postdata,$id);
		
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee Image successfully activated');	
				redirect('manage_employee');
			}
		else
			{	
				//$this->session->set_flashdata('error_message','Please try again.');		
				redirect('manage_employee');					
			}
	}*/
	
	##############################################################################################
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('client_name', 'Name', 'required');
		//$this->form_validation->set_rules('client_email', 'Client Email', 'required|valid_email');
		$this->form_validation->set_rules('registration_date', 'Registration Date', 'required');
		$this->form_validation->set_rules('zone_id', 'Zone', 'required');
		$this->form_validation->set_rules('area_id', 'Area', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		//$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
		$this->form_validation->set_rules('phone', 'Contact Number', 'required|numeric|max_length[10]|min_length[10]');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	function form_validate_box_add()
	{
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('box_no', 'Set Top Box Number', 'required|is_unique[box_details.box_no]');
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
	function employee_file_upload($img,$tmp)
	   {
		   $image_path = 'uploads/employee/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
	
	####################################################################################################
	
	public function new_assign($c_id,$box)
	{
$data['action'] = 'New';
		$table['name'] = 'client';
		$select = 'client.id,client.client_name,client.client_id,box_details.box_no';
		$conditions = array('box_details.client_foreign_id'=>$c_id,'box_details.box_no'=>$box);
		$join[0] = array('table'=>'box_details','field'=>'client_foreign_id','table_master'=>'client','field_table_master'=>'id','type'=>'inner');
		$data['bread_crumbs'] = $this->common_model->find_data($table,'row','',$conditions,$select,$join);
		$data['id'] = $data['bread_crumbs']->id;
		$data['client_name'] = $data['bread_crumbs']->client_name;
		$data['client_id'] = $data['bread_crumbs']->client_id;
		$data['box_no'] = $data['bread_crumbs']->box_no;
		
		$table['name']= 'package';
		$select = 'pkg';
		 
		$list = array('key'=>'pkg','value'=>'pkg','empty_name'=>' Package');
		$data['pkg_list'] = $this->common_model->find_data($table,'list',$list,'',$select);
		
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate_assign() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{		
						$from_date = date_create($this->input->post('from_date'));
						$from_date = date_format($from_date,"Y-m-d");
						
						if($this->input->post('pkg_mode') == 'Monthly')
						{ $validity = 29; }
						else if($this->input->post('pkg_mode') == 'Quarterly')
						{ $validity = 89; }
						else if($this->input->post('pkg_mode') == 'Half Yearly')
						{ $validity = 179; }
						else if($this->input->post('pkg_mode') == 'Annually')
						{ $validity = 364; }
						
						
						$to_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($from_date)) . " + " . $validity . " day"));
						
						
						$fields = array(
						'c_id' => $data['id'],
						'box_no' => $box,
						'pkg_name' => $this->input->post('pkg'),
						'active_status' => 1,
						'payment_status' => 0,
						'from_date' => $from_date,
						'to_date' => $to_date,
						'pkg_mode' => $this->input->post('pkg_mode'),
						'discount' => $this->input->post('discount')
						);
						//echo '<pre>';print_r($fields);die;
						$table['name'] = 'pkg_assign';
						$data = $this->common_model->save_data($table,$fields);
						if($data)
						{
						
						$this->session->set_flashdata('success_message','Package successfully assigned to client');
						$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
						redirect($r);
						}
					
					}
				
			
		}
		
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-newassign-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	
	public function renew_assign($c_id)
	{
		$data['action'] = 'Renew';
		$table['name'] = 'client';
		$conditions=array('id' => $c_id);
		$data['bread_crumbs'] = $this->common_model->find_data($table,'row','',$conditions);
		$data['id'] = $data['bread_crumbs']->id;
		$data['client_name'] = $data['bread_crumbs']->client_name;
		$data['client_id'] = $data['bread_crumbs']->client_id;
		// $data['box_no'] = $data['bread_crumbs']->box_no;
		
		$data['c_id_edit'] = $data['bread_crumbs']->id;
		
		
		
		$table['name']= 'package';
		$select = 'pkg';
		 
		$list = array('key'=>'pkg','value'=>'pkg','empty_name'=>' Package');
		$data['pkg_list'] = $this->common_model->find_data($table,'list',$list,'',$select);
		
		
		$table['name'] = 'pkg_assign';
		$conditions = array('c_id'=>$c_id);
		$data['row'] = $this->common_model->find_data($table,'row','',$conditions);
		$assign_id = $data['row']->id;
		//echo '<pre>';print_r($data['row']);die;
		
		/*if($this->input->post('slider1') == 1)
		{
			if($this->form_validate_assign() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				
						$table['name'] = 'pkg_assign';
						$conditions = array('c_id'=>$this->input->post('c_id'));
						$data['pkg_assign_result'] = $this->common_model->find_data($table,'row','',$conditions);
						
						
						
						$pkg_assign_id = $data['pkg_assign_result']->id;
						$from_date = date_create($this->input->post('from_date'));
						$from_date = date_format($from_date,"Y-m-d");
						$to_date = date_create($this->input->post('to_date'));
						$to_date = date_format($to_date,"Y-m-d");
						
						$code = $data['pkg_assign_result']->track_code;
						
						$fields = array(
						'c_id' => $this->input->post('c_id'),
						'box_no' => $this->input->post('box_no'),
						'pkg_name' => $this->input->post('pkg')."**".$this->input->post('pkg_mode'),
						'activ_status' => 1,
						'renew_status' => 1,
						'from_date' => $from_date,
						'to_date' => $to_date,
						'track_code' => $code,
						'pkg_duration' => $this->input->post('pkg_mode'),
						'status' => 1
						);
						
						$table['name'] = 'pkg_assign';
						$data = $this->common_model->save_data($table,$fields,$pkg_assign_id);
						if($data)
						{
						
						$this->session->set_flashdata('success_message','Client package Image successfully updated');	
						redirect('manage_client');
						}
					
					}
				
			
		}*/
		
		if($this->input->post('slider1') == 1)
		{
			if($this->form_validate_assign() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{		
						$from_date = date_create($this->input->post('from_date'));
						$from_date = date_format($from_date,"Y-m-d");
						
						if($this->input->post('pkg_mode') == 'Monthly')
						{ $validity = 29; }
						else if($this->input->post('pkg_mode') == 'Quarterly')
						{ $validity = 89; }
						else if($this->input->post('pkg_mode') == 'Half Yearly')
						{ $validity = 179; }
						else if($this->input->post('pkg_mode') == 'Annually')
						{ $validity = 364; }
						
						
						$to_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($from_date)) . " + " . $validity . " day"));
						
						
						$fields = array(
						'c_id' => $data['id'],
						'box_no' => '',
						'pkg_name' => $this->input->post('pkg'),
						'active_status' => 1,
						'payment_status' => 1,
						'from_date' => $from_date,
						'to_date' => $to_date,
						'pkg_mode' => $this->input->post('pkg_mode'),
						'discount' => $this->input->post('discount')
						);
						//echo '<pre>';print_r($fields);die;
						$table['name'] = 'pkg_assign';
						$data = $this->common_model->save_data($table,$fields,$assign_id);

						$this->payment_collection($c_id,$this->input->post('txtpayamount'));

						if($data)
						{
						
						$this->session->set_flashdata('success_message','Package successfully re-assigned to client');
						$r = base_url().'manage_client/box_details/'.$c_id;	
						redirect($r);
						}
					
					}
				
			
		}
		$data['client_id'] = $c_id;
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-newassign-view',$data,true);
		$this->load->view('layout_after_login',$data);
	}
	
	
	function form_validate_assign()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pkg', 'Package Name', 'required');
		$this->form_validation->set_rules('pkg_mode', 'Package Mode', 'required');
		$this->form_validation->set_rules('from_date', 'From Date', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	
	function payment($c_id,$box)
	{
		//echo $c_id;
		$table['name'] = 'pkg_assign';
		$conditions = array('c_id'=>$c_id);
		$data['assign_data_for_payment'] = $this->common_model->find_data($table,'row','',$conditions);	
		//echo '<pre>';print_r($data['assign_data_for_payment']);die;
		$assign_id = $data['assign_data_for_payment']->id;
		$assign_from_date = $data['assign_data_for_payment']->from_date;
		$date1=date_create($assign_from_date);
		$inv_month = date_format($date1,"M");
		$inv_year = date_format($date1,"Y");

		// var_dump($data['assign_data_for_payment']);
		// die;
		
		
		//$last_id = $this->db->query("select id from pkg_payment order by id desc limit 1")->result_array();
		//$insert_id = $last_id[0]['id'] + 1;
		$invoice_number = $inv_month."/".$inv_year."/".$c_id;
		
		
		
		$table['name'] = 'package';
		$conditions = array('pkg'=>$data['assign_data_for_payment']->pkg_name);
		$package_result = $this->common_model->find_data($table,'row','',$conditions);
		$package_amount = round($package_result->price);
		// $table['name'] = 'pkg_assign';
		// $conditions = array('c_id'=>$c_id);
		// $postdata_payment_status = array('payment_status'=>1);
		// $success_payment_status = $this->common_model->save_data($table,$postdata_payment_status,$assign_id);
		// echo $this->db->last_query();
		// die;
		
		$table['name'] = 'package';
		$conditions = array('pkg'=>$data['assign_data_for_payment']->pkg_name);
		$package_details = $this->common_model->find_data($table,'row','',$conditions);
		if(1)
		{
		$post_data_payment = array(
									'c_id'=>$data['assign_data_for_payment']->c_id,
									'box_no'=>$data['assign_data_for_payment']->box_no,
									'pkg_name'=>$data['assign_data_for_payment']->pkg_name,
									'from_date'=>$data['assign_data_for_payment']->from_date,
									'to_date'=>$data['assign_data_for_payment']->to_date,
									'cost'=>$package_details->all_ch,
									'tax'=>$package_details->service_tax,
									'tax_amount'=>$package_details->tax_amount,
									'service_charge'=>$package_details->service_chrg,
									'discount'=>$data['assign_data_for_payment']->discount,
									'amount'=>$package_amount-$data['assign_data_for_payment']->discount,
									'collected_amount' => $package_amount-$data['assign_data_for_payment']->discount,
									'approval'=>1,
									'paydate'=>date("Y-m-d"),
									'pkg_duration'=>$data['assign_data_for_payment']->pkg_mode,
									'invoice_no'=>$invoice_number,
									'collected_by' => $this->session->userdata('user_id'),
									'payment_done' => 1
								);
		// echo '<pre>';print_r($post_data_payment);die;	
		
		// var_dump($post_data_payment); die; exit;
		
		$table['name'] = 'pkg_payment';
		$payment_success = $this->common_model->save_data($table,$post_data_payment);
			if($payment_success)
			{
			$this->session->set_flashdata('success_message','Payment successfully paid');
			$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
			redirect($r);
			}
		}
	}
	
	function addons($c_id,$box)
	{
		$data['action'] = 'Add';
		
		$table['name'] = 'client';
		$select = 'client.id,client.client_name,client.client_id,box_details.box_no';
		$conditions = array('box_details.client_foreign_id'=>$c_id,'box_details.box_no'=>$box);
		$join[0] = array('table'=>'box_details','field'=>'client_foreign_id','table_master'=>'client','field_table_master'=>'id','type'=>'left');
		$data['bread_crumbs'] = $this->common_model->find_data($table,'row','',$conditions,$select,$join);
		$data['id'] = $data['bread_crumbs']->id;
		$data['client_name'] = $data['bread_crumbs']->client_name;
		$data['client_id'] = $data['bread_crumbs']->client_id;
		$data['box_no'] = $data['bread_crumbs']->box_no;
		
		$table['name'] = 'addons_channels';
		$data['addons_channels'] = $this->common_model->find_data($table,'array');
		//echo '<pre>';print_r($data['addons_channels']);die;
		
		
		if($this->input->post('slider1') == 1)
		{
			
					$pay_date = date("Y-m-d");
					$x = $this->input->post('duartion');
					$y = $this->input->post('addons_id');
					$z = $this->input->post('amount');
					
					for($i=0,$j=0,$k=0;$i<=count($x),$i<=count($y),$i<=count($z);$i++,$j++,$k++)
					{
					
							if(!empty($x[$i]))
							{	
										$duartion = ($x[$i])*30;
										$addons_id = $y[$j];
										$amount = $z[$k];
										
										$validity = $duartion-1;		
													
										$to_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($pay_date)) . " + " . $validity . " day"));
										$total_amount = $amount*$x[$i];
										
										$table['name'] = 'addons_channels';
										$conditions = array('id'=>$addons_id);
										$addons_details = $this->common_model->find_data($table,'row','',$conditions);	
													
										$post_arry_addons = array(
																	'addons_id'=>$addons_id,
																	'amount'=>$amount,
																	'duartion'=>$duartion,
																	'price'=>$addons_details->price,
																	'service_tax'=>$addons_details->serv_tax,
																	'tax_amount'=>$addons_details->tax_amt,
																	'total_amount'=>$total_amount,
																	'pay_date'=>$pay_date,
																	'to_date'=>$to_date,
																	'c_id'=>$c_id,
																	'box_no'=>$box
																	);	
																
										$table['name'] = 'addons_payment';	
										$payment_success = $this->common_model->save_data($table,$post_arry_addons);
							}
					}
				
			
			
		   if($payment_success)
		   {
			   //echo "succ";die;
			   $this->session->set_flashdata('success_message','Addons successfully paid');
				$r = base_url().'index.php/manage_client/box_details/'.$c_id;	
				redirect($r);
		   }
		   
		}
			
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-addons-view',$data,true);
		$this->load->view('layout_after_login',$data);
		
	}
	
	
	
	   
	####################################################################################################
	
	public function mode_view()
	{
		$pkg =  $this->input->post('pkg');
		$action = $this->input->post('action');
		
		$table['name'] = 'package';
		$list = array('key'=>'pkg_mode','value'=>'pkg_mode','empty_name'=>' Package Mode');
		$select = 'pkg_mode';
		 
		$conditions = array('pkg'=>$pkg);
		
		$arrMode = $this->common_model->find_data($table,'list',$list,$conditions,$select);
		
		$state = $this->input->post('state');
		
		$js = 'class="form-control" id="pkg_mode"';
			if($action == 'New')
			 {
				
            	echo form_dropdown('pkg_mode',$arrMode,'',$js);
			 }
			 else if($action == 'Renew' && $state=='ready')
			 {				 
					 $c_id = $this->input->post('c_id');
					 $table['name'] = 'pkg_assign';
					 $conditions = array('pkg_assign.c_id'=>$c_id);
					 $select = 'package.pkg_mode';
					 $join[0] = array('table'=>'package','field'=>'pkg','table_master'=>'pkg_assign','field_table_master'=>'pkg_name','type'=>'inner');
					 $result_pkg_mode = $this->common_model->find_data($table,'row','',$conditions,$select,$join);
					
					 $pkg_mode_name = $result_pkg_mode->pkg_mode;
					 echo form_dropdown('pkg_mode',$arrMode,$pkg_mode_name,$js);				
			 }
			 else if($action == 'Renew' && $state == 'change')
			 {
				 
				 echo form_dropdown('pkg_mode',$arrMode,'',$js);
			 }
		
		
	}
	
	public function area_view()
	{
		$zone =  $this->input->post('zone');
		$action = $this->input->post('action');
		$selected_area_id = $this->input->post('selected_area_id');
		
		$table['name'] = 'area';
		$list = array('key'=>'id','value'=>'area_name','empty_name'=>' Area');
		$select = 'id,area_name';
		$conditions = array('zone_id'=>$zone);
		$order_by[0] = array('field'=>'area_name','type'=>'asc');
		$arrArea = $this->common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		$state = $this->input->post('state');
		
		$js = 'class="form-control" id="area"';
			if($action == 'Add')
			 {
				
            	echo form_dropdown('area_id',$arrArea,$selected_area_id,$js);
			 }
			 else if($action == 'Edit' && $state=='ready')
			 {				 
					 $id = $this->input->post('id');
					 $table['name'] = 'client';
					 $conditions = array('id'=>$id);
					 $select = 'id,area_id';
					 $result_area = $this->common_model->find_data($table,'row','',$conditions,$select);
					 $area_id = $result_area->area_id;
					 echo form_dropdown('area_id',$arrArea,$area_id,$js);				
			 }
			 else if($action == 'Edit' && $state == 'change')
			 {
				
				 echo form_dropdown('area_id',$arrArea,'',$js);
			 }
		
		
	}

	public function get_pacakge_amount()
	{
		$pkg = $this->input->post('pakage_name');
		$table['name'] = 'package';
		$select = 'id,price';
		$conditions = array('pkg'=>$pkg);
		$arrArea = $this->common_model->find_data($table,'','',$conditions,$select,'','','');
		echo json_encode($arrArea);
	}

	function payment_collection($client_id,$pay_amount){

		//  Get All Data In Variable
		$package_name=$this->input->post('pkg');
		$package_mode=$this->input->post('pkg_mode1');
		$form_date=$this->input->post('from_date');
		$pay_amount=$this->input->post('txtpayamount');
		$client_id=$this->input->post('txtClientHidden');

		// Create To Date Here
		$validity=29;
		// $package_fromdate= $form_date;
		$to_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($form_date)) . " + " . $validity . " day"));

		// Update Package Assign Table
		$object_package_assign=array(
			'pkg_name' => $package_name,
			'from_date' => $form_date,
			'to_date' => $to_date,
			'pkg_mode' => $package_mode
		);

		$this->common_model->update_package($client_id,$object_package_assign);
		
		// Get All Package Data
		$package_data = $this->common_model->get_package_data($package_name);

		$date1=date_create($form_date);
		$inv_month = date_format($date1,"M");
		$inv_year = date_format($date1,"Y");

		// var_dump($data['assign_data_for_payment']);
		// die;
		
		
		//$last_id = $this->db->query("select id from pkg_payment order by id desc limit 1")->result_array();
		//$insert_id = $last_id[0]['id'] + 1;
		$invoice_number = $inv_month."/".$inv_year."/".$client_id;

		// Update Payment Table Data
		$object_package_payment=array(
			'c_id' => $client_id,
			'box_no' => '',
			'pkg_name' => $package_name,
			'from_date' => $form_date,
			'to_date' => $to_date,
			'cost' => $package_data[0]['all_ch'],
			'tax' => $package_data[0]['service_tax'],
			'tax_amount' => $package_data[0]['tax_amount'],
			'service_charge' => $package_data[0]['service_chrg'],
			'discount' => '0.00',
			'amount' => $package_data[0]['price'],
			'collected_amount' => $pay_amount,
			'approval' => 1,
			'paydate' => date('Y-m-d'),
			'pkg_duration' => $package_mode,
			'invoice_no' => $invoice_number,
			'collected_by' => $this->session->userdata('user_id')
		);
		 
		$this->common_model->insert_package($object_package_payment);

		$this->session->set_flashdata('success_message','Package successfully re-assigned to client');
		$r = base_url().'manage_client/box_details/'.$client_id;	
		redirect($r);
		
	}

	// This Function For Due Clear
	public function due_clear($payment_id,$client_id)
	{
		$payment_data=$this->common_model->get_payment_data($payment_id);
		
		$clear_data=array(
			'collected_amount' => (float)$payment_data[0]['amount']
		);

		$this->common_model->clear_due_amount($payment_id,$clear_data);
		// echo $this->db->last_query();
		// die;

		$this->session->set_flashdata('success_message','Due clear successfully');
		$r = base_url().'manage_client/box_details/'.$client_id;	
		redirect($r);
		
	}



}
