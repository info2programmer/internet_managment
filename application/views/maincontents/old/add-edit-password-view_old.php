<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title">Change Password</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li class="active">Change Password</li>
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
									   		//$state_id = $row->state_id;
											//$city_name = $row->city_name;
									 	}
									 	else
									 	{
										 	$state_id = $this->input->post('state_id'); 
											$city_name = '';
									 	}
									?>
                                       
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Old Password</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="password" class="form-control"
                                                                          placeholder="Enter Old Password" name="old_password" value="<?php echo set_value('old_password'); ?>">
                                                                   <?php echo form_error('old_password'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">New Password</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="password" class="form-control"
                                                                          placeholder="Enter New Password" name="new_password" value="<?php echo set_value('new_password'); ?>">
                                                                   <?php echo form_error('new_password'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Confirm Password</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="password" class="form-control"
                                                                          placeholder="Enter Confirm Password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>">
                                                                   <?php echo form_error('confirm_password'); ?>       
                                                                          </div>
                                        </div>                                        
												<button type="submit" class="btn btn-purple waves-effect waves-light">Update Password</button>										
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>