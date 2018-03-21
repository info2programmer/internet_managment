<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Area</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li><a href="<?php echo base_url();?>index.php/manage_area">Manage Area</a></li>
                            <li class="active"><?php echo $action; ?> Area</li>
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
											$zone_id = $row->zone_id;
											$area_name = $row->area_name;
											$area_code = $row->area_code;
									 	}
									 	else
									 	{
											$zone_id = $this->input->post('zone_id');
											$area_name = $this->input->post('area_name');
											$area_code = $this->input->post('area_code');
									 	}
									?>                                       
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Zone</label>
										<?php  ?>
                                            <div class="col-md-7">
                                            <?php
                                           	$js = 'class="form-control" id="zone_id"';
											echo form_dropdown('zone_id',$zones,$zone_id,$js);
											?>		
                                            <span style="color:red;"><?php echo form_error('zone_id'); ?></span>       
                                             </div>                              
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Area</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Area name" name="area_name" value="<?php if($action == 'Edit'){echo $area_name;} else {echo set_value('area_name');} ?>">
                                           
                                            <span style="color:red;"><?php echo form_error('area_name'); ?></span>       
                                             </div>                              
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Area Code</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter Area name" name="area_code" value="<?php if($action == 'Edit'){echo $area_code;} else {echo set_value('area_code');} ?>">
                                           
                                            <span style="color:red;"><?php echo form_error('area_code'); ?></span>       
                                             </div>                              
                                        </div>
                                        
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Area</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit aArea</button>
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
        
<!-----------------------------selectbox with inputbox-------------------->	
  <script language="javascript" type="text/javascript">
     function DropDownTextToBox(objDropdown, strTextboxId) {
        document.getElementById(strTextboxId).value = objDropdown.options[objDropdown.selectedIndex].value;
        DropDownIndexClear(objDropdown.id);
        document.getElementById(strTextboxId).focus();
    }
    function DropDownIndexClear(strDropdownId) {
        if (document.getElementById(strDropdownId) != null) {
            document.getElementById(strDropdownId).selectedIndex = -1;
        }
    }
</script>


<!-----------------------------selectbox with inputbox-------------------->