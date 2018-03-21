<div class="content">
            <div class="container">
                <div class="row page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Monthly Renewal Report</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><?php echo $action; ?> Monthly Renewal</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-block"><h3 class="box-title m-b-0"><b></b></h3>                           

                            <div class="row">
                                <div class="col-md-12">
                                   <?php if($this->session->flashdata('error_message')) { ?>
                                          <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
                                    <?php } ?>
                                    <?php if($this->session->flashdata('success_message')) { ?>
                                          <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
                                    <?php } ?>
                                    <div class="row">
                                          <div class="col-sm-12 col-xs-12">
                                              <form method="post" action="" id="myform">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">From Date</label>
                                                      <input type="date" class="form-control" id="datepicker-autoclose1"
                                                                                    placeholder="Enter First day of the month" name="from_date" value="<?php echo set_value('from_date'); ?>">
                                                      <?php echo form_error('from_date', '<div class="error">', '</div>'); ?>
                                                  </div>


                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">To Date</label>
                                                      <input type="date" class="form-control" id="datepicker-autoclose"
                                                                                    placeholder="Enter Last day of the month" name="to_date" value="<?php echo set_value('registration_date'); ?>">
                                                      <?php echo form_error('to_date', '<div class="error">', '</div>'); ?>
                                                  </div>
                                                  <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                                                  <input type="hidden" name="slider1" value="1" />
                                                  
                                              </form>
                                          </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>