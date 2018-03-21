<div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Client</h4>

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>

                            <li><a href="<?php echo base_url();?>index.php/manage_client">Manage Client</a></li>

                            <li class="active"><?php echo $action; ?> Client</li>

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

									   		$client_name = $row->client_name;

											$client_email = $row->client_email;

											$registration_date = $row->registration_date;

											$zone_id = $row->zone_id;

											$area_id = $row->area_id;

											$address = $row->address;

											$dob = $row->dob;

											$phone = $row->phone;

									 	}

									 	else

									 	{

										 	$client_name = '';

											$client_email = '';

											$registration_date = '';

											$zone_id = $this->input->post('zone_id');

											$area_id = $this->input->post('area_id');

											$address = '';

											$dob = '';

											$phone = '';

									 	}
									?>

                                    

                                   		<div class="form-group"><label

                                                class="col-md-4 control-label">Name</label>

										<?php  ?>

                                            <div class="col-md-8"><input type="text" class="form-control"

                                                                          placeholder="Enter Name" name="client_name" value="<?php if($action == 'Edit'){echo $client_name;} else {echo set_value('client_name');} ?>">

                                         <span style="color:#FF0000;"><?php echo form_error('client_name'); ?> </span>      

                                                                          </div>

                                        </div>

                                        

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Email</label>

										<?php  ?>

                                            <div class="col-md-8"><input type="text" class="form-control"

                                                                          placeholder="Enter Email" name="client_email" value="<?php if($action == 'Edit'){echo $client_email;} else {echo set_value('client_email');} ?>">

                                                                   <span style="color:#FF0000;"><?php echo form_error('client_email'); ?></span>       

                                                                          </div>

                                        </div>

                                        

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Registered Date</label>

										<?php  ?>

                                            <div class="col-md-8">

                                            <input type="text" class="form-control" id="datepicker-autoclose1"

                                                                          placeholder="Enter Registered Date" name="registration_date" value="<?php if($action == 'Edit'){echo date_format(date_create($registration_date), "m/d/Y");} else {echo set_value('registration_date');} ?>">

                                           	

                                                                   <span style="color:#FF0000;"><?php echo form_error('registration_date'); ?> </span>      

                                                                          </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Zone</label>

										<?php  ?>

                                            <div class="col-md-8">

                                          	<?php 

												$js = 'class="form-control" id="zone"';

												echo form_dropdown('zone_id',$zone_list,$zone_id,$js);

											?>

											<span style="color:#FF0000;"><?php echo form_error('zone_id'); ?></span>       

                                            </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Area</label>

										<?php  ?>

                                            <div class="col-md-8">

                                            <select name="area_id1" id="area_id1" class="form-control">

                                                 <option value="">Choose Area</option>

                                            </select>

                                            <div id="city_id"></div>       

                                        <span style="color:#FF0000;"><?php echo form_error('area_id'); ?> </span>      

                                        </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Address</label>

										<?php  ?>

                                            <div class="col-md-8">

                                            <textarea class="form-control" placeholder="Enter Address" name="address">

                                            <?php if($action == 'Edit'){echo $address;} else {echo set_value('address');} ?>

                                            </textarea>
											<span style="color:#FF0000;"><?php echo form_error('address'); ?></span>       

                                                                          </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Date Of Birth</label>

										<?php  ?>

                                            <div class="col-md-8"><input type="text" class="form-control" id="datepicker-autoclose"

                                                                          placeholder="Enter Date Of Birth" name="dob" value="<?php if($action == 'Edit'){echo date_format(date_create($dob), "m/d/Y");} else {echo set_value('dob');} ?>">

                                         <span style="color:#FF0000;"><?php echo form_error('dob'); ?></span>       

                                                                          </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Contact No.</label>

										<?php  ?>

                                            <div class="col-md-8"><input type="text" class="form-control"

                                                                          placeholder="Enter Contact No" name="phone" value="<?php if($action == 'Edit'){echo $phone;} else {echo set_value('phone');} ?>">

                                         <span style="color:#FF0000;"><?php echo form_error('phone'); ?>  </span>     

                                                                          </div>

                                        </div>                                        

                                        <div class="form-group">

                                        	<label class="col-md-4 control-label">

                                            	Client Photo

                                        	</label>

                                           

                                            <div class="col-md-8">

                                            <?php if($action == 'Edit') { ?>

                                            <?php if($slider_image!='') { ?>

                                            <img src="<?php echo base_url();?>uploads/employee/<?php echo $slider_image;?>" height="80" width="80"/>

                                            <?php } else { ?>

                                            <img src="<?php echo base_url();?>assets/admin/images/default.png" height="80" width="80"/>

                                            <?php } ?>

                                            <?php }?>

                                           <br /><br />

                                            <input type="file" class="filestyle" data-buttonname="btn-white" name="slider_image">

                                           	<h5 style="color:red;"><?php echo $this->session->flashdata('message')."<br>";?></h5>

											</div>

                                            </div>

                                                <button name="submit" type="submit" class="btn btn-purple waves-effect waves-light"><?php echo $action; ?> Client</button>

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

				data: {zone:z, action:'<?php echo $action; ?>',selected_area_id:'<?php echo $area_id; ?>'},

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