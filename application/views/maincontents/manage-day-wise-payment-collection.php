

<div class="content">

            <div class="container">

                <div class="row  page-titles">

                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0">Payemnt Collection</h3>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>

                            <li class="breadcrumb-item active">Payemnt Collection</li>

                        </ol>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0"><?php echo $action ?> Payemnt Collection</h3>
                            <?php
                                    if(isset($row))
                                        {   
                                            $paydate = $row->paydate;
                                            
                                        }
                                        else
                                        {
                                            $paydate = $this->input->post('paydate');
                                           
                                        }
                                    ?>    
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="" id="myform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Payment Date</label>
                                            <input type="date" class="form-control" placeholder="" name="paydate" value="<?php echo $paydate; ?>">
                                            <?php echo form_error('paydate', '<div class="error">', '</div>'); ?>
                                        </div>

                                       <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">To Date</label>
                                            <input type="date" class="form-control" placeholder="" name="to_date" value="<?php echo $to_date ?>">
                                            <?php echo form_error('to_date', '<div class="error">', '</div>'); ?>
                                        </div>-->
                                       
                                        <input type="hidden" class="form-control" placeholder="" name="slider1" value="1">
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action ?> Details</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-12">
                      <div class="card-box">
                        	  <div id="message">
								<?php echo $this->session->flashdata('success_message'); ?>
                             </div>
						<?php if($rows) { ?>
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                	<th>SL NO.</th>
                                    <th>Package Name</th>
                                    <th>Client Name</th>
                                    <th>Zone</th>
                                    <th>Area</th>
                                    <th>Amount</th>
                                    <th>Collected Amount</th>
                                    <th>Payment Date</th>
                                    <th>Payemt Status</th>
                                    <th>Collected By</th>
                                    <th>Action</th>                            
                                </tr>

                                </thead>

                                <tbody>

                                <?php $i =1; ?>

								<?php foreach($rows as $row) {	?>

                                <tr>

                                	<td><?php echo $i++; ?></td>
                                    <td><?php echo $row->pkg_name; ?></td>
                                    <td><?php echo $row->client_name; ?></td>
                                    <td><?php echo $row->zone_name; ?></td>
                                    <td><?php echo $row->area_name; ?></td>
                                    <td><?php echo $row->amount; ?></td>
                                    <td><?php echo $row->collected_amount; ?></td>
                                    <td><?php echo date_format(date_create($row->paydate), "d-m-Y"); ?></td>
                                    <td><?php echo $row->payment_done; ?></td>
                                    <td><?php echo $row->emp_name; ?></td>
                                    <td>
                                    <div class="col-sm-2"><a href="<?php echo base_url();?>payment_collection/view/<?php echo $row->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                                    </div>
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

   

  