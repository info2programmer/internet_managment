<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> 


                        <?php if($this->session->userdata('photo')!='') { ?>
            <img  src="<?php echo base_url() ?>uploads/employee/<?php echo $this->session->userdata('photo'); ?>" alt="user">
    <?php } else {?> 
            <img  src="<?php echo base_url() ?>uploads/employee/download.jpg" alt="user">
    <?php } ?>

                     </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <?php if($this->session->userdata('username') == 'admin'){ echo 'admin';} else { 
                        echo ucwords($this->session->userdata('emp_name'));  }  ?> 
                        
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a class="" href="<?php echo base_url() ?>user/dashboard/" aria-expanded="false"><span class="hide-menu">Dashboard </span></a>
                        </li>


                        <?php if($this->session->userdata('username') =='admin'){?>

                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_employee/" aria-expanded="false"><span class="hide-menu">Manage Employee </span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_service_tax/" aria-expanded="false"><span class="hide-menu">Manage GST </span></a>                            
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_package/" aria-expanded="false"><span class="hide-menu">Manage Package </span></a>                            
                        </li>

                        <?php } ?>



                        
                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_zone/" aria-expanded="false"><span class="hide-menu">Manage Zone </span></a>
                        </li>
                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_area/" aria-expanded="false"><span class="hide-menu">Manage Area </span></a>
                        </li>
                        

                         

                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_client/" aria-expanded="false"><span class="hide-menu">Manage Client </span></a>                            
                        </li>
                        <?php if($this->session->userdata('username') =='admin'){?>
                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_expense/" aria-expanded="false"><span class="hide-menu">Manage Expense </span></a>                            
                        </li>

                        <li class="active">
                            <a class="has-arrow " href="#" aria-expanded="true"><span class="hide-menu">Manage Reports</span></a>
                            <ul aria-expanded="true" class="collapse in" style="">
                                <li><a href="<?php echo base_url() ?>manage_report/package">Package</a></li>
                                <li><a href="<?php echo base_url() ?>manage_report/package_mode">Package Mode</a></li>
                                <li><a href="<?php echo base_url() ?>manage_report/monthly_renewal">Monthly Renewal </a></li>
                            </ul>
                        </li>


                        <li>
                            <a class="" href="<?php echo base_url() ?>manage_payment_collection/" aria-expanded="false"><span class="hide-menu">Payment Collection </span></a>                            
                        </li>



                        <?php } ?>
                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            
            <!-- End Bottom points-->
        </aside>