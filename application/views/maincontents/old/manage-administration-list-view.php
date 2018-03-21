
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
                <div class="row">
                    <div class="col-sm-12"><h4 class="page-title">Manage Administration</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li class="active">Manage Administration</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
					<?php echo anchor('admin/manage_administration/add', 'Add Administration', 'title="Add Administration" class="btn btn-default waves-effect waves-light"');?>
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
                            <table id="datatable" class="table table-striped table-bordered">
                            	
                                <thead>
                                <tr>
                                	<th>SL NO.</th>
                                    <th>Administration Role</th>
                                    <th>Member name</th>
                                    <th>Designation</th>
                                    <th>Action</th>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1; ?>
								<?php foreach($rows as $row) {	?>
                                <tr>
                                	<td><?php echo $i++; ?></td>
                                    <td><?php echo $row->administrative_role; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->designation; ?></td>
                                    <td>
                                    	<div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/admin/manage_administration/edit/<?php echo $row->id; ?>" title="Edit"><i class="md md-mode-edit"></i></a></p></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/admin/manage_administration/confirmDelete/<?php echo $row->id; ?>" title="Delete"><i class="md md-delete"></i></a></p></div>
                                    </td>                                    
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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
   
  