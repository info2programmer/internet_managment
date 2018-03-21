<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Package</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li><a href="<?php echo base_url();?>index.php/manage_package">Manage Package</a></li>
                            <li class="active"><?php echo $action; ?> Package</li>
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
											$pkg = $row->pkg;
											$pkg_mode = $row->pkg_mode;
											$desc = $row->desc;
											$all_ch = $row->all_ch;
											$tax_amount = $row->tax_amount;
											$service_chrg = $row->service_chrg;
											$price = $row->price;
									 	}
									 	else
									 	{
											$pkg = $this->input->post('pkg');
											$pkg_mode = $this->input->post('pkg_mode');
											$desc = $this->input->post('desc');
											$all_ch = $this->input->post('all_ch');
											$tax_amount = $this->input->post('tax_amount');
											$service_chrg = $this->input->post('service_chrg');
											$price = $this->input->post('price');
									 	}
									?>                                       
                                        
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Package Name</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Package Name" name="pkg" value="<?php if($action == 'Edit'){echo $pkg;} else {echo set_value('pkg');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('pkg'); ?></span>      
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Mode</label>
										<?php  ?>
                                            <div class="col-md-8"><!--<input type="text" class="form-control"
                                                                          placeholder="Enter Mode" name="pkg_mode" value="<?php if($action == 'Edit'){echo $pkg_mode;} else {echo set_value('pkg_mode');} ?>">-->
											<?php 
													$js = 'class="form-control" id="pkg_mode"';
													echo form_dropdown('pkg_mode',$pkg_mode_list,$pkg_mode,$js);
												?>
                                                                   <span style="color:red;"><?php echo form_error('pkg_mode'); ?></span>       
                                                                          </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Description</label>
										<?php  ?>
                                            <div class="col-md-8">
											<textarea class="form-control" placeholder="Enter Description" name="desc">
                                            <?php if($action == 'Edit'){echo $desc;} else {echo set_value('desc');} ?>
                                            </textarea>
                                                                   <span style="color:red;"><?php echo form_error('desc'); ?> </span>      
                                                                          </div>
                                        </div>
										<div class="form-group"><label
                                                class="col-md-4 control-label">Cost of All Channel</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Cost of All Channel" name="all_ch" id="all_ch" value="<?php if($action == 'Edit'){echo $all_ch;} else {echo set_value('all_ch');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('all_ch'); ?></span>       
                                                                          </div>
                                        </div>
										<div class="form-group"><label
                                                class="col-md-4 control-label"><span style="border: 1px solid black;padding-left: 2px;padding-right: 5px;"><?php echo $service_tax; ?></span> % Tax Amount</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Tax Amount" name="tax_amount" id="tax_amount" value="<?php if($action == 'Edit'){echo $tax_amount;} else {echo set_value('tax_amount');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('tax_amount'); ?></span>       
                                                                          </div>
                                        </div>
										<div class="form-group"><label
                                                class="col-md-4 control-label">Service Charge</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Service Charge" name="service_chrg" id="service_chrg" value="<?php if($action == 'Edit'){echo $service_chrg;} else {echo set_value('service_chrg');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('service_chrg'); ?></span>       
                                                                          </div>
                                        </div>
										<div class="form-group"><label
                                                class="col-md-4 control-label">Price</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Price" name="price" id="price" value="<?php if($action == 'Edit'){echo $price;} else {echo set_value('price');} ?>">
                                                                   <span style="color:red;"><?php echo form_error('price'); ?></span>       
                                                                          </div>
                                        </div>
                                        
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Package</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Package</button>
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
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script>
$(document).ready(function() {
tax = '<?php echo $service_tax; ?>';

$("#all_ch").keyup(function(){
        cost = $("#all_ch").val();
		tax_amt = (cost*tax)/100;
		/*alert(tax_amt);*/
		$("#tax_amount").val(tax_amt);
		subtotal = parseFloat(cost)+parseFloat(tax_amt);
		$("#price").val(subtotal);
    });
	$("#service_chrg").keyup(function(){
        cost = $("#all_ch").val();
		tax_amount = $("#tax_amount").val();
		service_charge = $("#service_chrg").val();
		total = parseFloat(cost)+parseFloat(tax_amount)+parseFloat(service_charge);
		$("#price").val(total);
    });
});
</script>