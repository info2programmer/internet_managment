
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
                    <div class="col-sm-12"><h4 class="page-title">Manage Payment List</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>
                            <li class="active">Manage Payment List</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
					<?php //echo anchor('manage_zone/add', 'Add Zone', 'title="Add Zone" class="btn btn-default waves-effect waves-light"');?>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Box</th>
                                    <th>Package</th>
                                    <th>Mode</th>
                                    <th>Amount</th>
                                    <th>Paydate</th>
                                    <th>Invoice</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Print</th>
                                    <!--<th>Status</th>
                                    <th>Action</th>-->                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1; ?>
								<?php foreach($rows as $row) {	?>
                                <tr>
                                	<td><?php echo $i++; ?></td>
                                    <td><?php echo $row->client_id; ?></td>
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->box_no; ?></td>
                                    <td><?php echo $row->pkg_name; ?></td>
                                    <td><?php echo $row->pkg_duration; ?></td>
                                    <td><?php echo $row->amount; ?></td>
                                    <td><?php echo $row->paydate; ?></td>
                                    <td><?php echo $row->invoice_no; ?></td>
                                    <td><?php echo date_format(date_create($row->from_date), "d-m-Y"); ?></td>
                                    <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>
                                    <td><a target="_blank" href="<?php echo base_url(); ?>index.php/manage_list/payment_print/<?php echo $row->id; ?>" class="btn btn-default waves-effect waves-light">Print Bill</a></td>                                  
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
   
  