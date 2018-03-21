<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Zone</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li><a href="<?php echo base_url();?>index.php/manage_zone">Manage Zone</a></li>
                            <li class="active"><?php echo $action; ?> Zone</li>
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
											$zone_name = $row->zone_name;
									 	}
									 	else
									 	{
											$zone_name = $this->input->post('zone_name');
									 	}
									?>                                       
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Zone Name</label>
										<?php  ?>
                                            <div class="col-md-7"><input type="text" class="form-control"
                                                                          placeholder="Enter zone name" name="zone_name" value="<?php if($action == 'Edit'){echo $zone_name;} else {echo set_value('zone_name');} ?>">
                                           
                                            <span style="color:red;"><?php echo form_error('zone_name'); ?></span>       
                                             </div>                              
                                        </div>
                                        
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Zone</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Zone</button>
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