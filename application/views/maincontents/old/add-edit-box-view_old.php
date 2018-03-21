<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Box(<?php echo $client_details->client_name; ?> - <?php echo $client_details->client_id; ?>)</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li><a href="<?php echo base_url();?>index.php/manage_client/box_details/<?php echo $id; ?>">Manage Box</a></li>
                            <li class="active"><?php echo $action; ?> Box</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box"><h4 class="m-t-0 header-title"><b></b></h4>                           

                            <div class="row">
                                <div class="col-md-8">
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
									   		$box_no = $row->box_no;
									 	}
									 	else
									 	{
										 	$box_no = '';
									 	}
									?>
                                    
                                   		<div class="form-group"><label
                                                class="col-md-4 control-label">Box Number</label>
										<?php  ?>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                                          placeholder="Enter Box Number" name="box_no" value="<?php if($action == 'Edit'){echo $box_no;} else {echo set_value('box_no');} ?>">
                                       <span style="color:#FF0000;"><?php echo form_error('box_no'); ?>   </span>    
                                                                          </div>
                                        </div>
                                        
                                                <button name="submit" type="submit" class="btn btn-purple waves-effect waves-light"><?php echo $action; ?> Box</button>
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
<?php if($action == 'Add') { ?>
<script>
$(document).ready(function() {
	
	currurl = window.location.href;
	newurl = currurl.split('manage_client')[0];
	
		
	$('#zone').on('change',function() {
		z = $('#zone').val();
		$.ajax({
				type: "POST",
				url: newurl+"manage_client/area_view",
				async: false,
				data: {zone:z, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$('#area_id1').hide();
                        $('#city_id').html(data);
				}
			})	
	});
	
});
</script>     
<?php } else if($action == 'Edit') { ?>
<script>
$(document).ready(function() {
	
	currurl = window.location.href;
	newurl = currurl.split('manage_client')[0];
	
	z = $('#zone').val();
	
	$.ajax({
				type: "POST",
				url: newurl+"manage_client/area_view",
				async: false,
				data: {zone:z, action:'<?php echo $action; ?>', id:'<?php echo $id_edit; ?>', state:'ready'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$('#area_id1').hide();
                        $('#city_id').html(data);
				}
			})
			
		
	$('#zone').on('change',function() {
		z1 = $('#zone').val();
		
		$.ajax({
				type: "POST",
				url: newurl+"manage_client/area_view",
				async: false,
				data: {zone:z1, action:'<?php echo $action; ?>', state:'change'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$('#area_id1').hide();
                        $('#city_id').html(data);
				}
			})	
	});
	
});
</script>
<?php } ?>   