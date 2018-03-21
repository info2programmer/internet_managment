<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> About Page</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Antara Nandy Official Website</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_pages">Manage Page</a></li>
                            <li class="active"><?php echo $action; ?> Page</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box"><h4 class="m-t-0 header-title"><b></b></h4>                           

                            <div class="row">
                                <div class="col-md-12">
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
											$page_content = $row->page_content;
									 	}
									 	else
									 	{
											$page_content = '';
									 	}
									?>
                                       <div class="col-sm-6">
                                       
                                        
                                        
                                       </div>
                                        <!--<div class="form-group"><label
                                                class="col-md-4 control-label">Page Content</label>
										<?php  ?>
                                            <div class="col-md-8">
                                            <textarea name="" rows="15" cols="45"><?php if($action == 'Edit'){echo $page_content;} else {echo set_value('page_content');} ?></textarea>
                                                                   <?php echo form_error('page_content'); ?>       
                                                                          </div>
                                        </div>-->
                                         <div class="row">
                                            <div class="col-sm-12">
                                            
                                                <div class="card-box"><h4 class="m-b-30 m-t-0 header-title"><b>Page content</b></h4>
                                                    <textarea class="summernote" name="page_content">
														<?php if($action == 'Edit'){echo $page_content;} else {echo set_value('page_content');} ?>
                                                    </textarea>
                                                    <?php echo form_error('page_content'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Content</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Content</button>
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
<?php if($action == 'Edit'){ ?>
<script>
	$(document).ready(function(){
		currurl = window.location.href;
		newurl = currurl.split('edit')[0];
		stateID = <?php echo $state_id; ?>;
		ID = <?php echo $id; ?>;
		/*alert(stateID);*/
		$.ajax({
				type: "POST",
				url: newurl+"ajax_call",
				async: false,
				data: {state:stateID, action:'<?php echo $action; ?>', id:ID,sayantan:'ready'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
		$("#state_id").on('change', function(){
		
			stateID = $(this).val();
			if(stateID == "")
			{
			$("#city_dropdown").hide();	
			}
			$.ajax({
				type: "POST",
				url: newurl+"ajax_call",
				async: false,
				data: {state:stateID, action:'<?php echo $action; ?>',sayantan:'change'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
		});
	});
</script>
<?php }else if($action == 'Add'){ ?>
<script>
	$(document).ready(function(){
		
		stateID = $(this).val();
			/*if(stateID == "")
			{
			$("#city_dropdown").hide();	
			}*/
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {state:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    $("#state_id").on('change', function(){
			/*$("#city_dropdown").show();*/
			
			stateID = $(this).val();
			/*if(stateID == "")
			{
			$("#city_dropdown").hide();	
			}*/
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {state:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    });
});
</script>
<?php } ?>