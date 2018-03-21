<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Add Ons</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li><a href="<?php echo base_url();?>index.php/manage_addon">Manage Add Ons</a></li>
                            <li class="active"><?php echo $action; ?> Add Ons</li>
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
											$channel_name = $row->channel_name;
											$desc = $row->desc;
											$price = $row->price;
									 	}
									 	else
									 	{
											$channel_name = $this->input->post('channel_name');
											$desc = $this->input->post('desc');
											$price = $this->input->post('price');
									 	}
									?>                                       
                                        
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Channel Name</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Channel Name" name="channel_name" value="<?php if($action == 'Edit'){echo $channel_name;} else {echo set_value('channel_name');} ?>">
                                                                   <span style="color:#FF0000;"><?php echo form_error('channel_name'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Description</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Description" name="desc" value="<?php if($action == 'Edit'){echo $desc;} else {echo set_value('desc');} ?>">
                                                                   <span style="color:#FF0000;"><?php echo form_error('desc'); ?> </span>      
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Price</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Price" name="price" value="<?php if($action == 'Edit'){echo $price;} else {echo set_value('price');} ?>">
                                                                   <span style="color:#FF0000;"><?php echo form_error('price'); ?> </span>      
                                                                          </div>
                                        </div>
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Addons</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Addons</button>
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