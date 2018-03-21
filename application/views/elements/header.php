
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>user/dashboard">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url() ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url() ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <img src="<?php echo base_url() ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

    <?php if($this->session->userdata('photo')!='') { ?>
            <img height="30px" width="30px" class="img-circle" src="<?php echo base_url() ?>uploads/employee/<?php echo $this->session->userdata('photo'); ?>" alt="user">
    <?php } else {?> 
            <img height="30px" width="30px" class="img-circle" src="<?php echo base_url() ?>uploads/employee/download.jpg" alt="user">
    <?php } ?>

    </a>
    <div class="dropdown-menu dropdown-menu-right animated flipInY">
        <ul class="dropdown-user">
            <li>
                <div class="dw-user-box">
                    <div class="u-img">

                    <?php if($this->session->userdata('photo')!='') { ?>
                            <img src="<?php echo base_url() ?>uploads/employee/<?php echo $this->session->userdata('photo'); ?>" alt="user">
                    <?php } else {?> 
                            <img src="<?php echo base_url() ?>uploads/employee/download.jpg" alt="user">
                    <?php } ?>
                        </div>
                    <?php if($this->session->userdata('username') == 'admin'){?> 
                        <div class="u-text">
                            <h4>admin</h4>
                            <!--<p class="text-muted">varun@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>-->
                        </div>
                    <?php } else { ?>

                        <div class="u-text">
                            <h4><?php echo $this->session->userdata('username'); ?></h4>
                            <p class="text-muted"><?php echo $this->session->userdata('email'); ?></p>
                        </div>

                     <?php  } ?>
                </div>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url() ?>user/change_password"><i class="ti-user"></i> Change Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>user/logout"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
    </div>
</li>
                        
                    </ul>
                </div>
            </nav>