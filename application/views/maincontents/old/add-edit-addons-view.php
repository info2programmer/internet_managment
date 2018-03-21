<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h4 class="page-title"><?php echo $action; ?> Addons(<?php echo $client_name; ?> (<?php echo $client_id; ?>)/<?php echo $box_no; ?>)</h4>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
          <li><a href="<?php echo base_url();?>index.php/manage_client/box_details/<?php echo $id; ?>">Manage Addons</a></li>
          <li class="active"><?php echo $action; ?> Addons</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <h4 class="m-t-0 header-title"><b></b></h4>
          <div class="row">
            <?php if($this->session->flashdata('error_message')) { ?>
            <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
            <?php } ?>
            <?php if($this->session->flashdata('success_message')) { ?>
            <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
            <?php } ?>
            <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');echo form_open_multipart('',$attributes); ?>
            <div style="width:100%">
              <?php
									if(isset($row))
										{   
									   		$duartion = $row->c_id;
											$box_no = $row->box_no;
											$pkg = $row->pkg_name;
											$from_date = $row->from_date;
											$to_date = $row->to_date;
									 	}
									 	else
									 	{
										 	$duartion = '';
											$box_no = '';
											$pkg = '';
											$from_date = '';
											$to_date = '';
									 	}
									?>
                                  <?php
									if($addons_channels) { 
										foreach($addons_channels as $addons_channel) { 
									?>
              <div style="width:19%; padding:1px 0 1px 0; float:left;">
                
                <label class="col-md-9 control-label"><?php echo $addons_channel->channel_name; ?> </label>
                <div class="col-md-3">
                  <?php

											$idd = $this->uri->segment(3);

											$box_noo = $this->uri->segment(4);

											$curr_date = date("Y-m-d");

											$add_onns_exist_count = $this->db->query("select * from addons_payment where addons_id=$addons_channel->id and c_id=$idd and box_no='$box_noo' and to_date>'$curr_date'")->num_rows();

											

											//echo "select * from addons_payment where addons_id=$addons_channel->id and c_id=$idd and box_no='$box_noo' and to_date<'$curr_date'";//die;

											

											if(!$add_onns_exist_count) {

												 

											?>
                  <input type="text" class="form-control"  name="duartion[]" value="<?php echo $duartion; ?>" style="padding:0px; text-align:center;" >
                  <input type="hidden" name="addons_id[]" value="<?php echo $addons_channel->id; ?>" />
                  <input type="hidden" name="amount[]" value="<?php echo $addons_channel->total_amt; ?>" />
                  <?php 

											

											 } else { 

											 $table['name'] = 'addons_payment';

											 $conditions = array('addons_id'=>$addons_channel->id,'c_id'=>$idd,'box_no'=>$box_noo);

											 $add_onns_expire_result = $this->common_model->find_data($table,'row','',$conditions);

											 ?>
                  <label class="col-md-3 control-label"><span style="color:green;">Added<?php //echo  date_format(date_create($add_onns_expire_result->to_date), "d-m-Y"); ?></span></label>
                  <?php } ?>
                  <?php echo form_error('duartion'); ?> </div>
                  
                  
              </div>
              <?php } }?>
            </div>
            <br>
            <button name="submit" type="submit" class="button_new btn btn-purple waves-effect waves-light button_new" style="clear:both;"><?php echo $action; ?> Addons</button>
            <input type="hidden" name="slider1" value="1" />
            <?php echo form_close(); ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<?php if($action == 'New') { ?>
<script>
$(document).ready(function() {
	currurl = window.location.href;
	newurl = currurl.split('manage_client')[0];
	$('#pkg').on('change',function() {
		p = $('#pkg').val();
		$.ajax({
				type: "POST",
				url: newurl+"manage_client/mode_view",
				async: false,
				data: {pkg:p, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$('#pkg_mode1').hide();
                        $('#city_id').html(data);
				}
			})	
	});
});
</script>
<?php } else if($action == 'Renew') { ?>
<script>
$(document).ready(function() {
	currurl = window.location.href;
	newurl = currurl.split('manage_client')[0];
	p = $('#pkg').val();
	$.ajax({
				type: "POST",
				url: newurl+"manage_client/mode_view",
				async: false,

				data: {pkg:p, action:'<?php echo $action; ?>', c_id:'<?php echo $c_id_edit; ?>', state:'ready'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

						$('#pkg_mode1').hide();

                        $('#city_id').html(data);

				}

			})

			

		

	$('#pkg').on('change',function() {

		p1 = $('#pkg').val();

		

		$.ajax({

				type: "POST",

				url: newurl+"manage_client/mode_view",

				async: false,

				data: {pkg:p1, action:'<?php echo $action; ?>', state:'change'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

						$('#pkg_mode1').hide();

                        $('#city_id').html(data);

				}

			})	

	});

	

});

</script>
<?php } ?>
