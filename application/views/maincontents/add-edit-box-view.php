<div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Assign Package(<?php echo $client_name; ?>)</h4>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard/">Home</a></li>

                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_client/box_details/<?php echo $id; ?>">Manage Assign Package</a></li>

                            <li class="breadcrumb-item active"><?php echo $action; ?> Assign Package</li>

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

                                   <?php    $attributes = array('class' => 'form-horizontal', 'id' => 'myform','action'=>'');

                                            echo form_open_multipart('',$attributes); ?>

                                   

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

                                            <div class="col-md-8">

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

                                            <div class="col-md-8">

                                            <select name="pkg_mode1" id="pkg_mode1" class="form-control">

                                                 <option value="">Choose Package Mode</option>

                                            </select>

                                            <div id="city_id"></div>       

                                        <?php echo form_error('pkg_mode'); ?>       

                                        </div>

                                        </div>

                                        <div class="form-group"><label

                                                class="col-md-4 control-label">Form Date</label>

                                        <?php  ?>

                                            <div class="col-md-8">

                                           <input type="date" class="form-control" id="datepicker-autoclose1"

                                               placeholder="Enter Form Date" name="from_date" value="<?php echo date('m/d/Y',strtotime($from_date)); ?>">

                                            

                                                                   <?php echo form_error('from_date'); ?>       

                                                                          </div>

                                        </div> 
                                        <?php
                                        
                                        $query_box_count = $this->db->query("select * from box_details where client_foreign_id=$id")->num_rows();
                                        if($query_box_count>1) { 
                                        ?>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Discount</label>
                                            <div class="col-md-8">
                                               <input type="text" class="form-control" id="datepicker-autoclose1"
    
                                                   placeholder="Enter Discount" name="discount" value="<?php if($action == 'Renew'){echo $discount;} else {echo set_value('discount');} ?>">                                               
                                                <?php echo form_error('discount'); ?>       
    
                                            </div>
                                        </div> 
                                        <?php } ?>
                                                <button name="submit" type="submit" class="btn btn-success waves-effect waves-light"><?php echo $action; ?> Assign Package</button>

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