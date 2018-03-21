<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Zone</h3>  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_zone">Manage Zone</a></li>
                        <li class="breadcrumb-item active"><?php echo $action ?> Zone</li>
                    </ol>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0"><?php echo $action ?> Zone</h3>
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
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="" id="myform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Zone Name</label>
                                            <input type="text" class="form-control" placeholder="" name="zone_name" value="<?php echo $zone_name ?>">
                                            <?php echo form_error('zone_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                       
                                        
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action ?> Zone</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>