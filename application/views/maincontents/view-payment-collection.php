<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Payemtn Collection</h3>  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>payment_collection">Payemtn Collection</a></li>
                        <li class="breadcrumb-item active"><?php echo $action ?> Payemtn Collection</li>
                    </ol>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0"><?php echo $action ?> Payemtn Collection</h3>
                            
                            <form method="post" action="" id="myform">   
                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Package Name</label>
                                            <input type="text" class="form-control" placeholder="" name="pkg_name" value="<?php echo $rows[0]->pkg_name; ?>">
                                            <?php echo form_error('pkg_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Client Name</label>
                                            <input type="text" class="form-control" placeholder="" name="client_name" value="<?php echo $rows[0]->client_name ?>">
                                            <?php echo form_error('client_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Zone</label>
                                            <input type="text" class="form-control" placeholder="" name="zone_name" value="<?php echo $rows[0]->zone_name ?>">
                                            <?php echo form_error('zone_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Area</label>
                                            <input type="text" class="form-control" placeholder="" name="area_name" value="<?php echo $rows[0]->area_name ?>">
                                            <?php echo form_error('area_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cost</label>
                                            <input type="text" class="form-control" placeholder="" name="cost" value="<?php echo $rows[0]->cost ?>">
                                            <?php echo form_error('cost', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tax</label>
                                            <input type="text" class="form-control" placeholder="" name="tax" value="<?php echo $rows[0]->tax ?>">
                                            <?php echo form_error('tax', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tax Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="tax_amount" value="<?php echo $rows[0]->tax_amount ?>">
                                            <?php echo form_error('tax_amount', '<div class="error">', '</div>'); ?>
                                        </div>
                                       
                                    
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Service Charge</label>
                                            <input type="text" class="form-control" placeholder="" name="service_charge" value="<?php echo $rows[0]->service_charge ?>">
                                            <?php echo form_error('service_charge', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount</label>
                                            <input type="text" class="form-control" placeholder="" name="discount" value="<?php echo $rows[0]->discount ?>">
                                            <?php echo form_error('discount', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="amount" value="<?php echo $rows[0]->amount ?>">
                                            <?php echo form_error('amount', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Collected Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="collected_amount" value="<?php echo $rows[0]->collected_amount ?>">
                                            <?php echo form_error('collected_amount', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Payment Date</label>
                                            <input type="text" class="form-control" placeholder="" name="paydate" value="<?php echo date_format(date_create($rows[0]->paydate), "d-m-Y"); ?>">
                                            <?php echo form_error('paydatepaydate', '<div class="error">', '</div>'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Payemt Status</label>
                                            <input type="text" class="form-control" placeholder="" name="payment_done" value="<?php echo $rows[0]->payment_done ?>">
                                            <?php echo form_error('payment_done', '<div class="error">', '</div>'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Collected By</label>
                                            <input type="text" class="form-control" placeholder="" name="emp_name" value="<?php echo $rows[0]->emp_name ?>">
                                            <?php echo form_error('emp_name', '<div class="error">', '</div>'); ?>
                                        </div>
                                </div>
                            </div>
                            <a onclick="return confirm('Are you sure?')" href="<?php echo base_url();?>payment_collection/payment_done/<?php echo $rows[0]->id; ?>" title="Delete" class="btn btn-success waves-effect waves-light m-r-10">Payment Done</a>
                            
                            </form>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>