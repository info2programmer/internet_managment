<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Digital Media</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Antara Nandy Official Website</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_notice_tender">Manage Digital Media</a></li>
                            <li class="active"><?php echo $action; ?> Digital Media</li>
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
											$title = $row->title;
											$expiry_date = $row->expiry_date;
									 	}
									 	else
									 	{ 
											$title = '';
											$expiry_date = '';
									 	}
									?>
                                       
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Video ID</label>
										<?php  ?>
                                            <div class="col-md-9"><input type="text" class="form-control"
                                                                          placeholder="Enter Video ID" name="title" value="<?php if($action == 'Edit'){echo $title;} else {echo set_value('title');} ?>">
                                                                   <?php echo form_error('title'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-3 control-label">Upload Date</label>
										<?php  ?>
                                            <div class="col-md-9">
                                             <input type="text" class="form-control" placeholder="Enter Upload Date" id="datepicker-autoclose1" name="expiry_date" value="<?php if($action == 'Edit'){echo $expiry_date;} else {echo set_value('expiry_date');} ?>">                             
                                                                   <?php echo form_error('expiry_date'); ?>       
                                                                          </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Digital Media Code</button>
                                                <input type="hidden" name="slider1" value="1" />
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Digital Media Code</button>
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