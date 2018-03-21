<div class="content">
            <div class="container">
                 <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Package Report</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><?php echo $action; ?> Package Report</li>
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
											echo form_open_multipart('',$attributes); ?>
                                    <?php
                    									if(isset($row))
                    										{   									   		
                    											$tax = $row->tax;											
                    									 	}
                    									 	else
                    									 	{
                    											$tax = '';
                    									 	}
                    									?>
                                      	<div class="form-group"><label
                                                class="col-md-4 control-label">Package Mode</label>
										
                                            <div class="col-md-8">
                                                                                        
                                           <select name="pkg" class="form-control" id="pkg">
                                                <option value="" selected="selected">--Select Package--</option>
                                                <?php foreach($rows as $k=>$v) { ?>
                                                  <option value="<?php echo $v->pkg; ?>"><?php echo $v->pkg; ?></option>
                                                <?php } ?>
                                                
                                          </select>                            
                                             
                                              <?php echo form_error('pkg', '<div class="error">', '</div>'); ?>

                                              </div>
                                        </div>
                                        
												<button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                                <input type="hidden" name="slider1" value="1" />
										
                                        
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>