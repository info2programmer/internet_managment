<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Bill Details Report</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <!--<li><a href="<?php echo base_url();?>index.php/manage_service_tax">Manage Service Tax</a></li>-->
                            <li class="active"><?php echo $action; ?> Bill Details Report</li>
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
											$tax = $row->tax;											
									 	}
									 	else
									 	{
											$tax = '';
									 	}
									?>
                                      	<div class="form-group"><label
                                                class="col-md-4 control-label">Select Client</label>
										
                                            <div class="col-md-8">
                                                                                        
                                           <select name="c_id" class="form-control" id="pkg_mode">
                                                <option value="" selected="selected">select Client</option>
                                                <?php
												$rows = $this->db->query("select id,client_name,client_id from client")->result();
												?>
                                                <?php 
												foreach($rows as $row) { 
												?>
                                                <option value="<?php echo $row->id; ?>"><?php echo $row->client_name." ( ".$row->client_id." )"; ?></option>
                                                <?php } ?>
                                          </select>                            
                                                                   <?php echo form_error('c_id'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">From Date</label>
										<?php  ?>
                                            <div class="col-md-8">
                                            <input type="text" class="form-control" id="datepicker-autoclose1"
                                                                          placeholder="Enter From Date" name="from_date" value="<?php echo set_value('from_date'); ?>">
                                           	
                                                                   <?php echo form_error('from_date'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">To Date</label>
										<?php  ?>
                                            <div class="col-md-8">
                                            <input type="text" class="form-control" id="datepicker-autoclose"
                                                                          placeholder="Enter To Date" name="to_date" value="<?php echo set_value('registration_date'); ?>">
                                           	
                                                                   <?php echo form_error('to_date'); ?>       
                                                                          </div>
                                        </div>
                                        
												<button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                                <input type="hidden" name="slider1" value="1" />
										
                                        
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>