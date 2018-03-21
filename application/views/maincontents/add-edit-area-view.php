<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Area</h3>  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_zone">Manage Area</a></li>
                        <li class="breadcrumb-item active"><?php echo $action ?> Area</li>
                    </ol>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0"><?php echo $action ?> Area</h3>
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
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="" id="myform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Zone</label>
                                             <?php
                                            $js = 'class="form-control" id="zone_id"';
                                            echo form_dropdown('zone_id',$zones,$zone_id,$js);
                                            ?>      
                                            <span style="color:red;"><?php echo form_error('zone_id'); ?></span>
                                            <?php echo form_error('zone_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group"><label
                                               <label for="exampleInputEmail1">Area</label>
                                         <input type="text" class="form-control"
                                                                          placeholder="Enter Area name" name="area_name" value="<?php if($action == 'Edit'){echo $area_name;} else {echo set_value('area_name');} ?>">
                                           
                                            <span style="color:red;"><?php echo form_error('area_name'); ?></span>       
                                                                     
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Area Code</label>
                                      
                                            <input type="text" class="form-control"
                                                                          placeholder="Enter Area Code" name="area_code" value="<?php if($action == 'Edit'){echo $area_code;} else {echo set_value('area_code');} ?>">
                                           
                                            <span style="color:red;"><?php echo form_error('area_code'); ?></span>       
                                                                          
                                        </div>
                                       
                                        
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action ?> Area</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>