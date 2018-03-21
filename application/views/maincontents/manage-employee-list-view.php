
<script>
$(document).ready(function() {
setInterval(function()
	{
		 $('#message').hide();
	}, 3000);
});
</script>

<div class="content">
    <div class="container">
        <div class="row  page-titles">
            <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0">Manage Employee</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard/">Home</a></li>
                    <li class="breadcrumb-item active">Manage Employee</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <?php echo anchor('manage_employee/add', '<i class="mdi mdi-plus-circle"></i> Add Employee', 'title="Add Employee" class="btn btn-success" style="margin-top: 12px;"');?>
                <div class="card-box">
                    <div id="message">
                        <?php if($this->session->flashdata('success_message')) { ?>
                                <h5 style="color: green;font-size: 20px;font-weight: 600;margin-left: 279px;margin-top: -5px;"><?php echo $this->session->flashdata('success_message'); ?></h5>
                        <?php } ?>
                        
                        <?php if($this->session->flashdata('error_message')) { ?>
                                <h5 style="color: red;font-size: 20px;font-weight: 600;margin-left: 279px;margin-top: -5px;"><?php echo $this->session->flashdata('error_message'); ?></h5>
                        <?php } ?>
                        </div>   

                    <?php if($rows) { ?>
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Employee Name</th>
                                <th>Employee Id</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>                                    
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i =1; ?>
                            <?php foreach($rows as $row) {	?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><!--<img src="<?php echo base_url();?>uploads/slider/<?php echo $row->slider_image;?>" height="50" width="50"/>-->
                                <?php echo $row->emp_name; ?>
                                </td>
                                <td><?php echo $row->empId; ?></td>
                                <td><?php echo $row->username; ?></td>
                                <td><?php echo $row->password; ?></td>
                                <td>
                                <?php if($row->username !='admin') {?>
                                    <a href="<?php echo base_url();?>manage_employee/edit/<?php echo $row->id; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a onclick="return confirm('Are you sure?')" href="<?php echo base_url();?>manage_employee/confirmDelete/<?php echo $row->id; ?>" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    <?php } ?> 
                                </td>                                    
                            </tr>
                            <?php } ?>
                            </tbody>    
                        </table>
                    </div>
                    
                    <?php }
                            else
                            { ?>
                            <p>No records found.</p>
                    <?php 	}  ?>
                </div>
            </div>
        </div>
    </div>
</div>


