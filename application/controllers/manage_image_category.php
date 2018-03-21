<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_image_category extends CI_Controller {
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
		$this->load->model(array('Common_model','Gallery_model'));
	}
	################################################################
	function index()
	{
		$conditions=array('thi_cities.published'=>1);
		//$order_by = array('field'=>'state_name','type'=>'ASC');
		$data['rows'] = $this->city_model->find_data('thi_cities.*,thi_states.state_name',$conditions);
		//echo '<pre>';print_r($data);die;	
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-city-list-view',$data,true);
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function category_list()
	{
		$table['name']='dumkal_category';
		$data['rows'] = $this->Common_model->find_data($table,'array');
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-category-list-view',$data,true);
		
		$this->load->view('admin/layout_after_login',$data);
	}
	#######################################################################################
	/*function category_add()
	{
		$data['action'] = 'Add';
		
		
		 		
					if($this->category_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='dumkal_category';
						$postdata = array(
											'category_name'=>$this->input->post('category_name'),
											'published'=> 1
											);
						echo '<pre>';print_r($postdata);die;			
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->session->set_flashdata('success_message','Category successfully inserted');	
							redirect('admin/manage_image_category/category_list');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-category-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}*/
	######################################################################################
	
	/*function category_edit($id)
	{
		$data['action'] = 'Edit';
		$conditions = array('id'=>$id);
		$table['name']='dumkal_category';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		echo '<pre>';print_r($data);die;
		  		
					if($this->category_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$table['name']='dumkal_category';
						$postdata = array(
											'category_name'=>$this->input->post('category_name'),
											'published'=> 1
											);
									
						$success = $this->Common_model->save_data($table,$postdata,$id);					
						if($success)
						{	
							$this->session->set_flashdata('success_message','Category successfully updated');	
							redirect('admin/manage_image_category/category_list');
						}
						else
						{	
							redirect('admin/manage_image_category/category_list');					
						}	
					}
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-category-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}*/
	######################################################################################
	
	/*function category_confirmDelete($id)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		
		$table['name']='dumkal_category';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_image_category/category_list');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_image_category/category_list');
		}
	}*/
	
	##############################################################################################
	
	
	/*function category_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}*/
	
	#################################  Category END #####################################
	
	#################################  Photo gallery START #####################################
	
	function image_list()
	{		
		$table['name'] = 'dumkal_image_galleries';
		$data['rows']=$this->Common_model->find_data($table,'array');
		//echo '<pre>';print_r($data['rows']);die;
		
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-image-gallery-list-view',$data,true);
		
		$this->load->view('admin/layout_after_login',$data);
	}
	#######################################################################################
	function image_add()
	{
	
		$data['action'] = 'Add';
		/* for category list */
		
		$categories = array(
							'' => 'Choose Image For the page',
							'Flats for Resale' => 'Flats for Resale',
							'Flats for Rent' => 'Flats for Rent'
							);
		$data['categories']=$categories;
		/* for category list */
		
		/* for insert image */	
		if($this->input->post('slider1') == 1)
		{	
					if($this->image_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$nt = $_FILES["slider_image"]["name"];
			
						if($nt == '')
						{
							$this->session->set_flashdata('message', 'Please upload a image');
							redirect(current_url());
						}
						$exp = explode('.',$nt);
						$imageFileType = $exp[1];
						
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
						{
							$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
							redirect(current_url());
						}
						$notice = $exp[0].time().'.'.$exp[1];
						$temp = $_FILES["slider_image"]["tmp_name"];
						
						$postdata = array(
											'category_id'=>$this->input->post('category_id'),
											'image_title'=>$this->input->post('image_title'),
											'images'=>$notice,
											'project_title'=>$this->input->post('project_title'),
											'feature1'=>$this->input->post('feature1'),
											'feature2'=>$this->input->post('feature2'),
											'dimension'=>$this->input->post('dimension'),
											'description'=>$this->input->post('description'),
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name']='dumkal_image_galleries';			
						$success = $this->Common_model->save_data($table,$postdata);						
						if($success)
						{	
							$this->gallery_image_upload($notice,$temp);
							$this->session->set_flashdata('success_message','Reality Management Details successfully inserted');	
							redirect('admin/manage_image_category/image_list');
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		
							redirect(current_url());					
						}	
					}
		}
		/* for insert image */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-image-gallery-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
		
	}
	######################################################################################
	
	function image_edit($id)
	{
		
		$data['action'] = 'Edit';
		
		$categories = array(
							'' => 'Choose Image For the page',
							'Flats for Resale' => 'Flats for Resale',
							'Flats for Rent' => 'Flats for Rent'
							);
		$data['categories']=$categories;
		
		$conditions=array('id'=>$id);
		$table['name'] = 'dumkal_image_galleries';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		
		
		//echo '<pre>';print_r($data['row']);die;
		
		/* for update gallery image */		
					
		if($this->input->post('slider1') == 1)
		{	
					if($this->image_form_validate() == FALSE)
					{
						$data['error_message']=validation_errors();
					}
					else
					{
						$nt = $_FILES["slider_image"]["name"];
						
						if($nt == '')
						{
						$nt = $data['row']->images;
						}
						else
						{
						$nt = $_FILES["slider_image"]["name"];
						}
			
						if($nt == '')
						{
							$this->session->set_flashdata('message', 'Please upload a image');
							redirect(current_url());
						}
						$exp = explode('.',$nt);
						$imageFileType = $exp[1];
						
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
						{
							$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
							redirect(current_url());
						}
						if($nt != $data['row']->images)
						{
						$notice = $exp[0].time().'.'.$exp[1];
						}
						else
						{
						$notice = $data['row']->images;	
						}
						$temp = $_FILES["slider_image"]["tmp_name"];
						
						$postdata = array(
											'category_id'=>$this->input->post('category_id'),
											'image_title'=>$this->input->post('image_title'),
											'images'=>$notice,
											'project_title'=>$this->input->post('project_title'),
											'feature1'=>$this->input->post('feature1'),
											'feature2'=>$this->input->post('feature2'),
											'dimension'=>$this->input->post('dimension'),
											'description'=>$this->input->post('description'),
											'published'=> 1
											);
						//echo '<pre>';print_r($postdata);die;
						$table['name']='dumkal_image_galleries';			
						$success = $this->Common_model->save_data($table,$postdata,$id);						
						if($success)
						{	
							if($nt != '')
							{
								$this->gallery_image_upload($notice,$temp);	
							}
							
							$this->session->set_flashdata('success_message','Reality Management Details successfully updated');	
							redirect('admin/manage_image_category/image_list');
						}
						else
						{	
							redirect('admin/manage_image_category/image_list');					
						}	
					}
		}
		/* for update gallery image */
		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-image-gallery-view',$data,true);
		
		
		
		$this->load->view('admin/layout_after_login',$data);
	}
	######################################################################################
	
	function image_confirmDelete($id)
	{
		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		
		$table['name']='dumkal_image_galleries';
		if($this->Common_model->delete_data($table,$id))
		{
			$this->session->set_flashdata('success_message','Record has been Deleted successfully.');
			redirect('admin/manage_image_category/image_list');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_image_category/image_list');
		}
	}
	
	##############################################################################################
	
	
	function image_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('image_title', 'Image Title', 'required');
		$this->form_validation->set_rules('project_title', 'Project Title', 'required');
		$this->form_validation->set_rules('feature1', 'Feature1', 'required');
		$this->form_validation->set_rules('feature2', 'Feature2', 'required');
		$this->form_validation->set_rules('dimension', 'Dimension', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function gallery_image_upload($img,$tmp)
	   {
		   $image_path = 'uploads/gallery_image/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	   }
	
	#################################  Photo gallery END #####################################
	
}

