<div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title"><?php echo $action; ?> Sub Page</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li><a href="<?php echo base_url();?>index.php/admin/manage_menu/sub_page">Manage Sub Page</a></li>
                            <li class="active"><?php echo $action; ?> Sub Page</li>
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
											echo form_open('',$attributes); ?>
                                    <?php
									if(isset($row))
										{   
									   		$main_page_id = $row->main_page_id;
											$sub_page_name = $row->sub_page_name;
									 	}
									 	else
									 	{
										 	$main_page_id = $this->input->post('main_page_id'); 
											$sub_page_name = '';
									 	}
									?>
                                       <div class="form-group"><label class="col-sm-2 control-label">Main Page</label>

                                            <div class="col-sm-10">
                                            	<?php 
													$js = 'class="form-control"';
													echo form_dropdown('main_page_id',$categories,$main_page_id,$js);
													echo form_error('main_page_id'); 
												?>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                class="col-md-2 control-label">Sub Page</label>
										<?php  ?>
                                            <div class="col-md-10"><input type="text" class="form-control"
                                                                          placeholder="Enter Sub Page name" name="sub_page_name" value="<?php if($action == 'Edit'){echo $sub_page_name;} else {echo set_value('sub_page_name');} ?>">
                                                                   <?php echo form_error('sub_page_name'); ?>       
                                                                          </div>
                                        </div>
                                        <?php if($action == 'Add') 
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Add Sub Page</button>
										<?php }
											else if($action == 'Edit')
											{ ?>
												<button type="submit" class="btn btn-purple waves-effect waves-light">Edit Sub Page</button>
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