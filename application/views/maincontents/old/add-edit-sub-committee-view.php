<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Sub Committee</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_sub_committee">Manage Sub Committee</a></li>
                            <li class="active"><?php echo $action; ?> Sub Committee</li>
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
									   		$sub_committee_id = $row->sub_committee_id;
											$member_name = $row->member_name;
											$designation = $row->designation;
									 	}
									 	else
									 	{
										 	$sub_committee_id = $this->input->post('sub_committee_id'); 
											$member_name = '';
											$designation = '';
									 	}
									?>
                                       <div class="form-group"><label class="col-sm-2 control-label">Sub Committee</label>

                                            <div class="col-sm-10">
                                            	<?php 
													$js = 'class="form-control"';
													echo form_dropdown('sub_committee_id',$categories,$sub_committee_id,$js);
													echo form_error('sub_committee_id'); 
												?>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-2 control-label">Member Name</label>
										<?php  ?>
                                            <div class="col-md-10"><input type="text" class="form-control"
                                                                          placeholder="Enter Member Name" name="member_name" value="<?php if($action == 'Edit'){echo $member_name;} else {echo set_value('member_name');} ?>">
                                                                   <?php echo form_error('member_name'); ?>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-2 control-label">Designation</label>
										<?php  ?>
                                            <div class="col-md-10"><input type="text" class="form-control"
                                                                          placeholder="Enter Designation" name="designation" value="<?php if($action == 'Edit'){echo $designation;} else {echo set_value('designation');} ?>">
                                                                   <?php echo form_error('designation'); ?>       
                                                                          </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Sub Committee</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Sub Committee</button>
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