<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Assign Package(<?php echo $client_name; ?> / <?php echo $client_id; ?>)</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_client/box_details/<?php echo $id; ?>">Manage Assign Package</a></li>
                            <li class="breadcrumb-item active"><?php echo $action; ?> Assign Package</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-box"><h4 class="m-t-0 header-title"><b></b></h4>                           
                            <div class="row">
                                <div class="col-md-12">
                                   <?php if($this->session->flashdata('error_message')) { ?>
                                          <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
                                    <?php } ?>
                                    <?php if($this->session->flashdata('success_message')) { ?>
                                          <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
                                    <?php } ?>
                                   <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
											echo form_open_multipart('manage_client/payment_collection',$attributes); ?>
                                   
                                   <?php
									if(isset($row))
										{   
									   		$c_id = $row->c_id;
											$box_no = $row->box_no;
											$pkg = $row->pkg_name;
											$from_date = $row->from_date;
											$to_date = $row->to_date;
											$discount = $row->discount;
									 	}
									 	else
									 	{
										 	$c_id = '';
											$box_no = '';
											$pkg = '';
											$from_date = date("d/m/Y");
											$to_date = '';
											$discount = '';
									 	}
									?>
                                    
                                   		
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Package <?php echo $pkg; ?></label>
										<?php  ?>
                                            <div class="col-md-12">
                                          	<?php 
												$js = 'class="form-control" id="pkg"';
												echo form_dropdown('pkg',$pkg_list,$pkg,$js);
											?>
											<?php echo form_error('pkg'); ?>       
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Package Mode</label>
										<?php  ?>
                                            <div class="col-md-12">
                                            <select name="pkg_mode1" class="form-control">
                                                 <option value="" selected hidden>Choose Package Mode</option>
												 <option value="Monthly">Monthly</option>
                                            </select> 
                                        <?php echo form_error('pkg_mode'); ?>       
                                        </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-4 control-label">Form Date</label>
										<?php  ?>
                                            <div class="col-md-12">
                                           <input type="date" class="form-control" id="datepicker-autoclose1"
                                               placeholder="Enter Form Date" name="from_date" value="<?php echo date('m/d/Y',strtotime($from_date)); ?>">
                                           	
                                                                   <?php echo form_error('from_date'); ?>       
                                                                          </div>
                                        </div> 
										<div class="form-group">
											<label
                                                class="col-md-4 control-label">Total Amount</label>
											<div class="col-md-12">
											<input type="text" readonly id="txtTotalAmount" class="form-control"></div>
										</div>
										<div class="form-group">
											<label
                                                class="col-md-4 control-label">Pay Amount</label>
											<div class="col-md-12"><input type="number" id="txtpayamount" name="txtpayamount" class="form-control"></div>
                                            <input type="hidden" name="txtClientHidden" value="<?php echo $client_id; ?>">
										</div>
                                        <?php
										
										$query_box_count = $this->db->query("select * from box_details where client_foreign_id=$id")->num_rows();
										if($query_box_count>1) { 
										?>
                                        <div class="form-group">
                                        	<label class="col-md-4 control-label">Discount</label>
                                            <div class="col-md-12">
                                               <input type="text" class="form-control" id="datepicker-autoclose1"
    
                                                   placeholder="Enter Discount" name="discount" value="<?php if($action == 'Renew'){echo $discount;} else {echo set_value('discount');} ?>">                                               
                                                <?php echo form_error('discount'); ?>       
    
                                            </div>
                                        </div> 
										<?php } ?>
											<p align="center"><button name="submit" type="submit" class="btn btn-success waves-effect waves-light"><?php echo $action; ?> Assign Package</button></p>	
                                                <input type="hidden" name="slider1" value="1" />
										
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>
        
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
$(document).ready(function () {

	$('#pkg').change(function (e) { 
		var urls = "<?php echo base_url(); ?>manage_client/get_pacakge_amount/";
		$.ajax({
			type: "post",
			url: urls,
			data: {'pakage_name' : $('#pkg').val()},
			dataType: "json",
			success: function (response) {
				$('#txtTotalAmount').val(response[0].price);
				// console.log(response[0].price);
			}
		});
	});
});

	
</script>