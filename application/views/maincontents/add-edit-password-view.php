<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Change Password</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                    
                </div>
<div class="row">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0">Change Password</h3>
                            
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="" id="myform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Old Password</label>
                                            <input type="password" class="form-control" placeholder="Old Password" name="old_password" value="<?php echo set_value('old_password'); ?>">
                                            <?php echo form_error('old_password', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">New Password</label>
                                            <input type="password" class="form-control" id="exampleInputEmail1" name="new_password" value="<?php echo set_value('new_password'); ?>" placeholder="New Password">
                                            <?php echo form_error('new_password', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Confirm Password</label>
                                            <input type="password" class="form-control"
                                                                          placeholder="Confirm Password" name="confirm_password" value="<?php echo set_value('confirm_password'); ?>">
                                                                   
                                            <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>