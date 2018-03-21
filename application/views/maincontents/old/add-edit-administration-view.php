<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Administration</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_administration">Manage Administration</a></li>
                            <li class="active"><?php echo $action; ?> Administration</li>
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
									   		$sub_committee_id = $row->administrative_role;
											$name = $row->name;
											$designation = $row->designation;
											$qualification = $row->qualification;
											$department = $row->department;
											$subject_id = $row->subject_id;
									 	}
									 	else
									 	{
										 	$sub_committee_id = $this->input->post('sub_committee_id'); 
											$name = $this->input->post('name');
											$designation = $this->input->post('designation');
											$qualification = $this->input->post('qualification');
											$department = $this->input->post('department'); 
											$subject_id = $this->input->post('subject_id'); 
									 	}
									?>
                                       <div class="form-group" id="role"><label class="col-sm-5 control-label">Administrative Role</label>

                                            <div class="col-sm-7">
                                            	<?php 
													$js = 'class="form-control" id="sub_committee_id"';
													echo form_dropdown('sub_committee_id',$categories,$sub_committee_id,$js);
												?>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-5 control-label">Member Name</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Member Name" name="name" value="<?php if($action == 'Edit'){echo $name;} else {echo set_value('name');} ?>">
                                        <?php echo form_error('name');?>      
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-5 control-label">Designation</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Designation" name="designation" value="<?php if($action == 'Edit'){echo $designation;} else {echo set_value('designation');} ?>">
                                        <h5 style="color:red;"><?php echo $this->session->flashdata('designation')."<br>";?></h5>       
                                                                          </div>
                                        </div>
                                        <div class="form-group" id="qualification"><label
                                                class="col-md-5 control-label">Qualification</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Qualification" name="qualification" value="<?php if($action == 'Edit'){echo $qualification;} else {echo set_value('qualification');} ?>">
                                       <h5 style="color:red;"><?php echo $this->session->flashdata('qualification')."<br>";?></h5>    
                                                                          </div>
                                        </div>
                                        <div class="form-group" id="department"><label class="col-sm-5 control-label">Department</label>

                                            <div class="col-sm-7">
                                            	<?php 
													$js = 'class="form-control"';
													echo form_dropdown('department',$departments,$department,$js);
												?>
                                                <h5 style="color:red;"><?php echo $this->session->flashdata('department')."<br>";?></h5>
                                            </div>
                                        </div>
                                        <div class="form-group" id="subject_id"><label class="col-sm-5 control-label">Subject</label>

                                            <div class="col-sm-7">
                                            	<?php 
													$js = 'class="form-control"';
													echo form_dropdown('subject_id',$subjects,$subject_id,$js);													
												?>
                                                <h5 style="color:red;"><?php echo $this->session->flashdata('subject_id')."<br>";?></h5>
                                            </div>
                                        </div>
                                        <div class="form-group" id="image"><label class="col-sm-5 control-label">Image</label>
											
                                            <div class="col-sm-7">
												<?php if($action == 'Edit'){ ?>
                                                    <img src="<?php echo base_url();?>uploads/stuff_image/<?php echo $row->image;?>" height="50" width="50"/>
                                                
                                            	<br /><br />
                                                <?php } ?>
                                            	<?php 	echo form_upload(
														array(
															'name' => 'image1'
														)
												);
												?>
                                                <h5 style="color:red;"><?php echo $this->session->flashdata('message1')."<br>";?></h5>
                                            </div>
                                        </div>
                                        <div class="form-group" id="resume"><label class="col-sm-5 control-label">Resume</label>
											
                                            <div class="col-sm-7">
                                            	<?php if($action == 'Edit'){ ?>
                                                <?php echo $row->resume;?>
                                            	<br /><br />
                                                <?php } ?>
                                            	<?php 	echo form_upload(
														array(
															'name' => 'resume'
														)
												);
												?>
                                                <h5 style="color:red;"><?php echo $this->session->flashdata('message2')."<br>";?></h5>
                                            </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Administration</button>
                                               	<input type="hidden" name="adid" value="1" />
                                                <input type="hidden" name="action" value="add" />
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Administration</button>
                                                <input type="hidden" name="adid" value="1" />
                                                <input type="hidden" name="action" value="edit" />
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
        
<script src="<?php echo base_url();?>/assets/admin/js/jquery-1.11.2.min.js"></script>
<script>
	$(document).ready(function(){
		$("#role").on('change', function(){
			role = $("#sub_committee_id").val();
			
			if(role == 'Teaching-Stuff' || role == 'Non-teaching-Stuff') 
			{
				$("#qualification").show();
				$("#department").show();
				$("#subject_id").show();
				$("#image").show();
				$("#resume").show();
			}
			else if(role == 'Governing-Body' || role == '')
			{
				$("#qualification").hide();
				$("#department").hide();
				$("#subject_id").hide();
				$("#image").hide();
				$("#resume").hide();
			}
			});
});
</script>