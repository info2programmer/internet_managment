

<div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12"><h4 class="page-title"> Addons Duration Report</h4>

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>

                            <li class="active"> Addons Duration Report</li>

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

                                    <th>Addon Name</th>

                                    <th>From Date</th>

                                    <th>To Date</th>

                                    <th>Addon Amount</th>                             

                                </tr>

                                </thead>

                                <tbody>

                                <?php $i =1; ?>

								<?php foreach($rows as $row) {	?>

                                <tr>

                                	<td><?php echo $i++; ?></td>

                                    <td><?php echo $row->client_name; ?></td>

                                    <td><?php echo $row->client_id; ?></td>

                                    <td><?php echo $row->box_no; ?></td>

                                    <td><?php echo $row->channel_name; ?></td>

                                    <td><?php echo date_format(date_create($row->pay_date), "d-m-Y"); ?></td>

                                    <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>

                                    <td>

                                    <?php echo round($row->total_amount);

									 

									/*$query = $this->db->query("select package.price from package inner join pkg_assign on pkg_assign.pkg_name=package.pkg where pkg_assign.pkg_name='$row->pkg_name'");

									$sds = $query->result();

									$countt = $query->num_rows();								

									if($countt>0)

									{

										foreach($sds as $sd)

										{

											echo round($sd->price);

										}

									}

									else

									{

										echo "-";	

									}*/

									

									?>

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

   

  