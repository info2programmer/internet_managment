<?php 

	/*
	common helper function for uploading image(single or multiple)
	
	// $field_name = upload form field name
	
	// $upload_image_path = path of the image file
	
	// $existing_image_name = required in case of image edit.the previous image file name should be passed
	
	// $action = defines the action eg. add, edit etc..
	
	// $thumbnail_dimensions = required in case of uploading more than one thumbnail of different dimensions. This parameter should be passed in a two-dimensional array form, eg. $thumbnail_dimensions[0]['width']=80; $thumbnail_dimensions[0]['height']=80; and the numeric index will increase by 1
	
	*/
	
	function upload_image($field_name,$upload_image_path,$thumbnail_dimensions=NULL,$existing_image_name=NULL,$adjusted_thumbnail=NULL,$action=NULL,$file_name=NULL)
	{
		$ci =& get_instance();
		
		for($i=0;$i<count($_FILES[$field_name]['name']);$i++)	
		{
			$files = $_FILES;
			if($files[$field_name]['name'][$i]!="")
			{              
				$_FILES['userfile']['name']= $files[$field_name]['name'][$i]; 
				$_FILES['userfile']['type']= $files[$field_name]['type'][$i];
				$_FILES['userfile']['tmp_name']= $files[$field_name]['tmp_name'][$i];
				$_FILES['userfile']['error']= $files[$field_name]['error'][$i];
				$_FILES['userfile']['size']= $files[$field_name]['size'][$i];
				if($file_name!=NULL)
				{
					$config['file_name']=$file_name;
					$config['encrypt_name']=false;
				}else
				{
					$config['encrypt_name'] = true;
				}	
				
				$config['upload_path'] = $upload_image_path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png|JPEG|JPG|PNG';
				$config['overwrite'] = false;
				$config['quality'] = "98%"; 
				/*$config['master_dim'] = 'width';*/
						
				$ci->load->library('upload', $config);
				
				if(!$ci->upload->do_upload())
				{
						$msg[0]="error-upload";
						$msg[1]=$ci->upload->display_errors();
						return $msg;
						exit();
				}
				else
				{	
					$data = array('upload_data' => $ci->upload->data());
			
					// IMAGE RESIZE (thumbnail)
					
					if($thumbnail_dimensions)$thumbnail_to_be_created = $thumbnail_dimensions;
					if($adjusted_thumbnail)$thumbnail_to_be_created = $adjusted_thumbnail[$i];
					
					if(!empty($thumbnail_to_be_created))
					{
						if(count($thumbnail_to_be_created)>0)
						{ 
							foreach($thumbnail_to_be_created as $thumb_index => $thumb_value)
							{ 
								if(count($thumbnail_to_be_created) > 1)
								{
									$thumbnail_folder = "thumbnail".($thumb_index+1);
								}
								else
								{ 
									$thumbnail_folder = "thumbnail";
								}
								if(!is_dir($upload_image_path.$thumbnail_folder))
								{
									mkdir($upload_image_path.$thumbnail_folder);
									chmod($upload_image_path.$thumbnail_folder,0777);
								}
									
								//if existing image found in case of edit, first delete that image from the folder then proceed
								
								if($existing_image_name != NULL)
								{ 
									$files_array=array_filter($_FILES[$field_name]['name']); 
									$existing_images=array_intersect_key(array_filter($existing_image_name),$files_array); 
									
									foreach($existing_images as $existing_image)
									{
										@unlink($upload_image_path.$existing_image);
										@unlink($upload_image_path.$thumbnail_folder.'/'.$existing_image);
									}
								}
								$ci->load->library('image_lib');
								$config['image_library'] = 'gd2';
								$config['source_image'] = $data['upload_data']['full_path'];
								$config['new_image'] = $upload_image_path.$thumbnail_folder;
								$config['maintain_ratio'] = true;
								$config['width'] = $thumb_value['width'];
								$config['height'] = $thumb_value['height'];
								$config['quality'] = "98%";
									
								$ci->image_lib->initialize($config);
								$ci->image_lib->resize();
									
								if(!$ci->image_lib->resize())
								{
									$msg[0]="error-image-resize";
									$msg[1]=$this->image_lib->display_errors();
									return $msg;
									break;
									exit();
								}
								else
								{
									continue;
								}	
								
							}
						}
						//after successful uploading, delete the actual image from the folder to reduce space
						@unlink($upload_image_path.$data['upload_data']['file_name']);
					}
					else
					{ 
					
						if(!empty($existing_image_name))
						{
							$files_array=array_filter($_FILES[$field_name]['name']); 
							$existing_images=array_intersect_key(array_filter($existing_image_name),$files_array); 
								
							foreach($existing_images as $existing_image)
							{
								@unlink($upload_image_path.$existing_image);
							}
						}
					}
					
					$filename[$i]=$data['upload_data']['file_name'];
					
					$msg[0]="success-upload";
				}
			}
		}
		$msg[1]=$filename;
		//print_r($msg); die();
		return $msg;
	}

?>