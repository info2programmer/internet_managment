<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Employee</h3>  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard/">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_employee/">Manage Employee</a></li>
                        <li class="breadcrumb-item active"><?php $action ?> Employee</li>
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
									   		$emp_name = $row->emp_name;
											$empId = $row->empId;
											$address = $row->address;
											$blood_group = $row->blood_group;
											$contact = $row->contact;
											$area = $row->area;
											$salary = $row->salary;
											$email = $row->email;
											$username = $row->username;
											$password = $row->password;
									 	}
									 	else
									 	{
										 	$emp_name = '';
											$empId = $employee_id;
											$address = '';
											$blood_group = '';
											$contact = '';
											$area = '';
											$salary = '';
											$email = '';
											$username = '';
											$password = '';
									 	}
									?>
                                    
                                   		<div class="form-group"><label
                                                class="col-md-4 control-label">Name</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter name" name="emp_name" value="<?php if($action == 'Edit'){echo $emp_name;} else {echo set_value('emp_name');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('emp_name'); ?></span>       
                                                                          </div>
                                        </div>
                                        
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Employee Id</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Employee Id" name="empId" value="<?php if($action == 'Edit'){echo $empId;} else {echo $empId;} ?>">
                                                                   <span style="color:red;"><?php echo form_error('empId'); ?></span>       
                                                                          </div>
                                        </div>
                                        
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Address</label>
										<?php  ?>
                                            <div class="col-md-12">
                                           	<textarea class="form-control" placeholder="Enter Address" name="address"><?php if($action == 'Edit'){echo $address;} ?></textarea>
                                                                   <span style="color:red;"><?php echo form_error('address'); ?> </span>      
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Blood Group</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Blood Group" name="blood_group" value="<?php if($action == 'Edit'){echo $blood_group;} else {echo set_value('blood_group');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('blood_group'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Phone</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Phone" name="contact" value="<?php if($action == 'Edit'){echo $contact;} else {echo set_value('contact');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('contact'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Area</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Area" name="area" value="<?php if($action == 'Edit'){echo $area;} else {echo set_value('area');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('area'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Salary</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Salary" name="salary" value="<?php if($action == 'Edit'){echo $salary;} else {echo set_value('salary');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('salary'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Email</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Email" name="email" value="<?php if($action == 'Edit'){echo $email;} else {echo set_value('email');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('email'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Username</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="text" class="form-control"
                                                                          placeholder="Enter Username" name="username" value="<?php if($action == 'Edit'){echo $username;} else {echo set_value('username');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('username'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Password</label>
										<?php  ?>
                                            <div class="col-md-12"><input type="password" class="form-control"
                                                                          placeholder="Enter Password" name="password" value="<?php if($action == 'Edit'){echo $password;} else {echo set_value('password');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('password'); ?> </span>      
                                                                          </div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-md-4 control-label">
                                            	Employee Image
                                        	</label>
                                            <div class="col-md-8">
                                            <?php if($action == 'Edit') { ?>
                                            <img src="<?php echo base_url();?>uploads/employee/<?php echo $slider_image;?>" height="80" width="80"/>
                                            <br /><br />
                                            <?php }?>                                           
                                            <input type="file" class="filestyle" data-buttonname="btn-white" name="slider_image">
                                           	<h6 style="color:red;"><?php echo $this->session->flashdata('message')."<br>";?></h5>
											</div>
                                            </div>  
                                                <div class="col-md-12 text-center">
                                                <button name="submit" type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action; ?> Employee</button><br>
                                                </div>
                                                <input type="hidden" name="slider1" value="1" />
										
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>