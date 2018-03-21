<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Category</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_menu/main_page">Manage Category</a></li>
                            <li class="active"><?php echo $action; ?> Category</li>
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
											echo form_open('',$attributes); ?>
                                    <?php
									if(isset($row))
										{   
											$category_name = $row->category_name;
									 	}
									 	else
									 	{
											$category_name = '';
									 	}
									?>                                       
                                        <div class="form-group"><label
                                                class="col-md-5 control-label">Category</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Category name" name="category_name" value="<?php if($action == 'Edit'){echo $category_name;} else {echo set_value('category_name');} ?>">
                                                                   <h5 style="color:red;"><?php echo form_error('category_name'); ?></h5>       
                                                                          </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Category</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Category</button>
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