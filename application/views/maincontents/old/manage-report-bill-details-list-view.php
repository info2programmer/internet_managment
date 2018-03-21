

<div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12"><h4 class="page-title"> Bill Details Report</h4>

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>

                            <li class="active"> Bill Details Report</li>

                        </ol>

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

					

                      <div class="card-box">

                        	  <div id="message">

								<?php if($this->session->flashdata('error_message')) { ?>

                                        <span style="color: red;margin-left: 159px;;"><?php echo $this->session->flashdata('error_message'); ?></span>

                                <?php } ?>

                             </div>



						<?php if($rows) { ?>

                            <table id="datatable" class="table table-striped table-bordered">

                            	

                                <thead>

                                <tr>

                                	<th>SL NO.</th>

                                    <th>Client Name</th>

                                    <th>ClientId</th>

                                    <th>Box No.</th>

                                    <th>Package Name</th>

                                    <th>From Date</th>

                                    <th>To Date</th>

                                    <th>Payment Date</th>

                                    <th>Package Payment</th>  

                                    <th>Addon Payment</th> 

                                    <th>Total</th>  

                                    <th>Print</th>                          

                                </tr>

                                </thead>

                                <tbody>

                                <?php $i =1; ?>

								<?php foreach($rows as $row) {	

								$addon =$this->db->query("select sum(total_amount) as addon_total from addons_payment where c_id=$row->id and box_no='$row->box_no' and pay_date>'$from' and pay_date<'$to'")->result_array();

								?>

                                <tr>

                                	<td><?php echo $i++; ?></td>

                                    <td><?php echo $row->client_name; ?></td>

                                    <td><?php echo $row->client_id; ?></td>

                                    <td><?php echo $row->box_no; ?></td>

                                    <td><?php echo $row->pkg_name; ?></td>

                                    <td><?php echo date_format(date_create($row->from_date), "d-m-Y"); ?></td>

                                    <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>

                                    <td><?php echo $row->paydate; ?></td>

                                    <td>

                                    <?php echo round($row->amount); ?>

                                    </td> 

                                    <td><?php echo round($addon[0]['addon_total']); ?></td>

                                    <td><?php echo round($row->amount+$addon[0]['addon_total']); ?></td>                                    

                                    <td>

                                    <a target="_blank" href="<?php echo base_url(); ?>index.php/manage_list/payment_print/<?php echo $row->id; ?>" class="btn btn-default waves-effect waves-light">Print Bill</a>

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

   

  