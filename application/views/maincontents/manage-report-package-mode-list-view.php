

<div class="content">

            <div class="container">

                <div class="row  page-titles">

                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo ucfirst($input_mode); ?> Package Mode Report</h3>

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>

                            <li class="breadcrumb-item active"><?php echo ucfirst($input_mode); ?> Package Mode Report</li>

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

                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">

                            	

                                <thead>

                                <tr>

                                	<th>SL NO.</th>

                                    <th>Client Name</th>

                                    <th>ClientId</th>

                                   

                                    <th>Zone</th>

                                    <th>Area</th>

                                    <th>Package Name</th>

                                    <th>From Date</th>

                                    <th>To Date</th>

                                    <th>Registration Date</th> 

                                   

                                    <th>Payment Status</th>                               

                                </tr>

                                </thead>

                                <tbody>

                                <?php $i =1; ?>

								<?php foreach($rows as $row) {	?>

                                <tr>

                                	<td><?php echo $i++; ?></td>

                                    <td><?php echo $row->client_name; ?></td>

                                    <td><?php echo $row->client_id; ?></td>

                                   

                                    <td><?php echo $row->zone_name; ?></td>

                                    <td><?php echo $row->area_name; ?></td>

                                    <td><?php echo $row->pkg_name; ?></td>

                                    <td><?php echo date_format(date_create($row->from_date), "d-m-Y"); ?></td>

                                    <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>

                                    <td><?php echo $row->registration_date; ?></td>

                                    

                                    <td><?php if($row->payment_status)

									{

									echo "Clear";	

									}

									else

									{ ?>

									<span style="color:#F00;"><?php echo "Pending"; ?></span>	

									<?php }

									 ?></td>                                                                       

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

   

  