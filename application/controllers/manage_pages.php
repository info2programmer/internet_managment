<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_pages extends CI_Controller {
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
		$this->load->model(array('Common_model'));
	}
	################################################################
	function index()
	{
		
		$conditions=array('dumkal_pages.published'=>1);
		$table['name']='dumkal_pages';
		
		$data['rows']=$this->Common_model->find_data($table,'array','',$conditions);
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-page-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	
	
	
	#######################################################################################
	function add()
	{
	
		$data['action'] = 'Add';
		
		
		
		/* for insert page */		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						
						$postdata = array(
											'page_title'=> 'About Me',
											'page_content'=>$this->input->post('page_content'),
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name']='dumkal_pages';			
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Page Content successfully inserted');	
							redirect('admin/manage_pages');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		/* for insert page */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
		
	}
	######################################################################################
	
	function edit($id)
	{
		
		$data['action'] = 'Edit';	
		
		
		$conditions=array('published'=>1,'id'=>$id);
		$table['name']='dumkal_pages';		
		$data['row']=$this->Common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['rows']);die;
		
		
		/* for update page */		
					if($this->form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						
						$postdata = array(
											'page_title'=> 'About Me',
											'page_content'=>$this->input->post('page_content'),
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name']='dumkal_pages';			
						$success = $this->Common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Page Content successfully updated');	
							redirect('admin/manage_pages');
						}
						else
						{	
							redirect('admin/manage_pages');					
						}	
					}
		/* for update page */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-page-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
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
		
		$table['name']='dumkal_pages';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_pages');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_pages');
		}
	}
	
	##############################################################################################
	
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('page_content', 'Page Content', 'required');
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
	
	
	function ajax_call() 
	{
        //Checking so that people cannot go to the page directly.
        if (isset($_POST) && isset($_POST['state'])) 
		{
            $state = $_POST['state'];
			$action = $_POST['action'];
			
			if($action == 'Edit') {
			$sayantan = $_POST['sayantan']; 
			}
			if($action == 'Edit' && $sayantan == 'ready') {
			$id = $_POST['id']; }
			
			//$conditions=array('thi_cities.state_id'=>$state);
			//$arrCities = $this->city_model->find_data('thi_cities.*,thi_states.state_name',$conditions,'list');
			
			
			$select = 'id,sub_page_name';
			$conditions=array('published'=>1,'main_page_id'=>$state);
			$order_by[0] = array('field'=>'id','type'=>'ASC');
			$table['name']='dumkal_sub_pages';
			$list = array('empty_name'=>' Sub Page Name','key'=>'id','value'=>'sub_page_name');
			$arrCities=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
			
			if($action == 'Edit' && $sayantan == 'ready')
			{
				
				
				
				$select = 'dumkal_main_page.id,dumkal_main_page.main_page_name,dumkal_sub_pages.id,dumkal_sub_pages.sub_page_name,dumkal_pages.*';
				$conditions=array('dumkal_pages.published'=>1,'dumkal_pages.id'=>$id);
				$table['name']='dumkal_pages';
				$join[0]=array('table'=>'dumkal_main_page','field'=>'id','table_master'=>'dumkal_pages','field_table_master'=>'main_page_id','type'=>'INNER');
				$join[1]=array('table'=>'dumkal_sub_pages','field'=>'id','table_master'=>'dumkal_pages','field_table_master'=>'sub_page_id','type'=>'INNER');
				$data['row']=$this->Common_model->find_data($table,'row','',$conditions,$select,$join);
				//$data['row'] = $this->Common_model->find_data('thi_hotels.id,thi_hotels.city_id,thi_hotels.hotel_name,thi_cities.id,thi_cities.city_name',$conditions,'row');
				
				$city_name = $data['row']->sub_page_id; 
			}
          
             
           
            //Using the form_dropdown helper function to get the new dropdown.
			$js = 'class="form-control" id="sub_page_id"';
			if($action == 'Add')
			 {
				 //echo 'add city drop';
            	echo form_dropdown('sub_page_id',$arrCities,'',$js);
			 }
			 else if($action == 'Edit' && $sayantan == 'ready')
			 {
				 //echo 'edit city drop';
				 echo form_dropdown('sub_page_id',$arrCities,$city_name,$js);
			 }
			 else if($action == 'Edit' && $sayantan == 'change')
			 {
				 //echo 'edit city drop';
				 echo form_dropdown('sub_page_id',$arrCities,'',$js);
			 }
			//echo "succ";
        } 
		else
		{
            redirect('site'); //Else redire to the site home page.
        }
    }
	
}

