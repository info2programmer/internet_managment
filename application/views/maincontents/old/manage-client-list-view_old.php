
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
                    <div class="col-sm-12"><h4 class="page-title">Manage Client</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li class="active">Manage Client</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
					<?php echo anchor('manage_client/add', 'Add Client', 'title="Add Client" class="btn btn-default waves-effect waves-light"');?>
                    <?php echo br(2);?>
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
                                	<th width="11">SL NO.</th>
                                    <th width="20">Client Id</th>
                                    <th width="84">Client Name</th>
                                    <th width="33">Zone</th>
                                    <th width="33">Area</th>
                                    <th width="25">Contact No</th>
                                    <th width="25">Box Number</th>
                                    <th width="25">Box Manage</th>
                                    <th width="43">Action</th>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1; ?>
								<?php foreach($rows as $row) {	?>
                                <tr>
                                	<td><?php echo $i++; ?></td>
                                    <td><?php echo $row->client_id; ?></td>
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->zone_name; ?></td>
                                    <td><?php echo $row->area_name; ?></td>
                                    <td><?php echo $row->phone; ?></td>
                                    <td>
                                    <!--<img src="<?php echo base_url();?>uploads/employee/<?php echo $row->image;?>" height="50" width="50"/>-->
                                    <?php 
									$q_boxs = $this->db->query("select box_no from box_details where client_foreign_id=$row->id")->result();
									foreach($q_boxs as $q_box)
									{
										echo $q_box->box_no."<br>";	
									}
									?>
                                    </td>
                                    <td>
                                    <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/add_box/<?php echo $row->id; ?>"> Add Box</a>
                                    <br /><br />
                                    <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/box_details/<?php echo $row->id; ?>">Box details</a>
                                    
                                    </td>
                                    <!--<td>
                                    <?php if($row->pkg_name == "")
									{ ?>
									<div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/manage_client/new_assign/<?php echo $row->id; ?>" title="New Assign">New</a></p></div>	
									<?php }
									else
									{ ?>
										<div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/manage_client/renew_assign/<?php echo $row->id; ?>" title="Renew Assign">Renew</a></p></div>
									<?php }
									?>
                                    <br />
                                    <?php 
									
									if($row->pkg_name == "")
									{
										echo "No Package Assigned";
									}
									else
									{
									$a = explode("**",$row->pkg_name);
									echo $a[0]; 
                                    }?>
                                    </td>
                                    <td><?php echo $row->from_date; ?></td>
                                    <td><?php echo $row->to_date; ?></td>
                                    <td>
                                    <?php 
									$cur_date = date("Y-m-d"); 
									if($cur_date>$row->to_date)
									{ echo "Deactive"; }
									else
									{ echo "Active"; }	  
									?>
                                    </td>-->
                                    <td>
                                    	<div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/manage_client/edit/<?php echo $row->id; ?>" title="Edit"><i class="md md-mode-edit"></i></a></p></div>
                                        <div class="col-sm-6 col-md-4 col-lg-3"><p><a onclick="return confirm('Are you sure?')"  href="<?php echo base_url();?>index.php/manage_client/confirmDelete/<?php echo $row->id; ?>" title="Delete"><i class="md md-delete"></i></a></p></div>
                                       
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
   
  