<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Reality Management</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">ADS Furniture</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_image_category/image_list">Manage Reality Management</a></li>
                            <li class="active"><?php echo $action; ?> Reality Management</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box"><h4 class="m-t-0 header-title"><b></b></h4>                           

                            <div class="row">
                                <div class="col-md-6">
                                   <?php if($this->session->flashdata('error_message')) { ?>
                                          <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
                                    <?php } ?>
                                    <?php if($this->session->flashdata('success_message')) { ?>
                                          <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
                                    <?php } ?>
                                    <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
											echo form_open_multipart('',$attributes); ?>
                                    <?php
									if(isset($row))
										{   
									   		$category_id = $row->category_id;
											$image_title = $row->image_title;
											$project_title = $row->project_title;
											$feature1 = $row->feature1;
											$feature2 = $row->feature2;
											$dimension = $row->dimension;
											$description = $row->description;
									 	}
									 	else
									 	{
										 	$category_id = $this->input->post('category_id'); 
											$image_title = '';
											$project_title = '';
											$feature1 = '';
											$feature2 = '';
											$dimension = '';
											$description = '';
									 	}
									?>
                                       <div class="form-group"><label class="col-sm-3 control-label">Category</label>

                                            <div class="col-sm-9">
                                            	<?php 
													$js = 'class="form-control"';
													echo form_dropdown('category_id',$categories,$category_id,$js);
													echo form_error('category_id'); 
												?>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Image Title</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Image Title" name="image_title" value="<?php if($action == 'Edit'){echo $image_title;} else {echo set_value('image_title');} ?>">
                                                                   <?php echo form_error('image_title'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Project Title</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Project Title" name="project_title" value="<?php if($action == 'Edit'){echo $project_title;} else {echo set_value('project_title');} ?>">
                                                                   <?php echo form_error('project_title'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Feature 1</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Feature 1" name="feature1" value="<?php if($action == 'Edit'){echo $feature1;} else {echo set_value('feature1');} ?>">
                                                                   <?php echo form_error('feature1'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Feature 2</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Feature 2" name="feature2" value="<?php if($action == 'Edit'){echo $feature2;} else {echo set_value('feature2');} ?>">
                                                                   <?php echo form_error('feature2'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Dimension</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Dimension" name="dimension" value="<?php if($action == 'Edit'){echo $dimension;} else {echo set_value('dimension');} ?>">
                                                                   <?php echo form_error('dimension'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Description</label>
										<?php  ?>
                                            <div class="col-md-9">
                                            <textarea class="form-control" placeholder="Enter Description" name="description">
                                            <?php if($action == 'Edit'){echo $description;} else {echo set_value('description');} ?>
                                            </textarea>
                                                                   <?php echo form_error('description'); ?>       
                                                                          </div>
                                        </div>
                                        
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Project Images</label>
										<?php  ?>
                                            <div class="col-md-9">
                                            	<?php if($action == 'Edit') { ?>
											<img src="<?php echo base_url();?>uploads/gallery_image/<?php echo $row->images;?>" height="75" width="75" /><br /><br />
												<?php } ?>
                                                <input type="file" class="filestyle" data-buttonname="btn-white" name="slider_image" />             
                                                <h6 style="color:red;"><?php echo $this->session->flashdata('message')."<br>";?></h5>  
                                             </div>
                                        </div>
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Reality Management</button>
                                                <input type="hidden" name="slider1" value="1" />
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Reality Management</button>
                                                <input type="hidden" name="slider1" value="1" />
										<?php }
										?>
                                        
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>