<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> GST</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_service_tax">Manage GST</a></li>
                            <li class="breadcrumb-item active"><?php echo $action; ?> GST</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box"><h4 class="m-t-0 header-title"><b></b></h4>                           

                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
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
											$tax = $row->tax;											
									 	}
									 	else
									 	{
											$tax = '';
									 	}
									?>
                                      	<div class="form-group"><label
                                                class="col-md-4 control-label">GST</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter tax" name="tax" value="<?php if($action == 'Edit'){echo $tax;} else {echo set_value('tax');} ?>">
                                                                   <?php echo form_error('tax'); ?>       
                                         
                                                                          </div>
                                                                          <br>
                                        <div class="col-md-12">
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Add GST</button>
                                                <input type="hidden" name="slider1" value="1" />
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Edit GST</button>
                                                <input type="hidden" name="slider1" value="1" />
										<?php }
										?>
                                        </div>
                                        </div>
                                        
                                        
                                        
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>