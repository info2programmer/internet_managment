		<!--	<br>
			<div class="login">
				<?php echo form_open(); ?>
				<?php echo form_input(array('name'=>'username','id'=>'username','placeholder'=>'user name','class' => 'input'));?><br><br>
				<?php echo form_password(array('name'=>'password','id'=>'password','placeholder'=>'password','class' => 'input'));?><br><br>
				<?php echo form_submit(array('value'=>'login','name'=>'submit','class' => 'input'));?>
				<?php echo form_close(); ?>
				<a href="" class="input">Forgot Password</a>
			</div>-->
            
<div class="card-box">
        <div class="panel-heading"><h3 class="text-center"><strong class="text-custom">Satellite TV Systems</strong><br /> Admin Panel</h3>
        </div>
        <div class="panel-body">
            <!--<form class="form-horizontal m-t-20" action="http://localhost/the_hotels_of_india/index.php/admin/user/login" method="post">-->
            <?php if($this->session->flashdata('error_message')) { ?>
            <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
    <?php } ?>
            <?php 
				$attributes = array('class' => 'form-horizontal m-t-20', 'id' => 'myform');
				echo form_open('',$attributes); 
			?>
                <div class="form-group">
                    <div class="col-xs-12"><input class="form-control" type="text" placeholder="Username" name="username">
                    <?php echo form_error('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12"><input class="form-control" type="password" placeholder="Password" name="password">
                     <?php echo form_error('password'); ?>
                     </div>
                </div>
				<div class="form-group">
                    <div class="col-xs-12">
					<input type="radio" name="user_type" value="A"> Admin
  					<input type="radio" name="user_type" value="E"> Employee
                     <?php echo form_error('user_type'); ?>
                     </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log
                            In
                        </button>
                        <?php //echo form_submit(array('value'=>'login','name'=>'submit','class' =>'btn btn-pink btn-block text-uppercase waves-effect waves-light'));?>
                        
                    </div>
                </div>
                <!--<div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12"><a href="page-recoverpw.html" class="text-dark"><i
                            class="fa fa-lock m-r-5"></i> Forgot your password?</a></div>
                </div>-->
            <!--</form>-->
            <?php echo form_close();?>
        </div>
    </div>
    