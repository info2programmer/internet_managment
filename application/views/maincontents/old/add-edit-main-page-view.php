<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Main Page</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_menu/main_page">Manage Main Page</a></li>
                            <li class="active"><?php echo $action; ?> Main Page</li>
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
											$main_page_name = $row->main_page_name;
									 	}
									 	else
									 	{
											$main_page_name = '';
									 	}
									?>                                       
                                        <div class="form-group"><label
                                                class="col-md-5 control-label">Main Page</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Main Page name" name="main_page_name" value="<?php if($action == 'Edit'){echo $main_page_name;} else {echo set_value('main_page_name');} ?>">
                                                                   <h5 style="color:red;"><?php echo form_error('main_page_name'); ?></h5>       
                                                                          </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Main Page</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Main Page</button>
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