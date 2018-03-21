<div class="content">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12"><h4 class="page-title">Manage Expiry List</h4>

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>

                            <li class="active">Manage Expiry List</li>

                        </ol>

                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <div class="card-box">

							<?php if($rows) { 

							//echo '<pre>';print_r($rows);die;

							?>

                            <table id="datatable" class="table table-striped table-bordered">

                            	

                                <thead>

                                <tr>

                                	<th width="51">SL NO.</th>

                                    <th width="21">ID</th>

                                    <th width="40">Name</th>

                                    <th width="33">Zone</th>

                                    <th width="33">Area</th>

                                    <th width="27">Box</th>

                                    <th width="57">Package</th>

                                    <th width="137">Mode</th>

                                    <th width="193">From</th>

                                    <th width="210">To</th>

                                    <th width="295">Status</th>                                 

                                </tr>

                                </thead>

                                <tbody>

                                <?php $i =1; ?>

								<?php foreach($rows as $row) {	?>

                                <tr>

                                	<td><?php echo $i++; ?></td>

                                    <td>

                                    <a href="<?php echo base_url(); ?>index.php/manage_list/client_details/<?php echo $row->client_id; ?>" target="_blank"><?php echo $row->client_id; ?></a>

                                    </td>

                                    <td><?php echo $row->client_name; ?></td>

                                    <td><?php echo $row->zone_name; ?></td>

                                    <td><?php echo $row->area_name; ?></td>

                                    <td><?php echo $row->box_no; ?></td>

                                    <td><?php echo $row->pkg_name; ?></td>

                                    <td><?php echo $row->pkg_mode; ?></td>

                                    <td><?php echo date_format(date_create($row->from_date), "d-m-Y"); ?></td>

                                    <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>

                                    <td>

									<?php 

									$cur_date = date("Y-m-d");

									$to_date = $row->to_date;

									if($row->to_date<$cur_date)

									{ ?>

									<span style="color:#FF0000;">

										<?php 												
										
										 $exp = strtotime($row->to_date);

										 $now = date('Y-m-d H:i:s', time());									 

										//echo timespan($exp, $now);
										
										 $f= $row->to_date;
										 $t = date("Y-m-d");
										 $from = explode('-', $f);
										 $till = explode('-', $t);
										 $from = gregoriantojd($from[1], $from[2], $from[0]);
										 $till = gregoriantojd($till[1], $till[2], $till[0]);
										 $days = ($from - $till);?>
										 <b><?php echo $days; ?></b>						

                                        days already expire

                                    </span>

									<?php } else { ?>

                                    <span style="color:#00CC33;">Within 

										<?php 												
										
                                     $exp = strtotime($row->to_date);

                                     $now = time();
									 
									 $f= $row->to_date;
									 $t = date("Y-m-d");
									 $from = explode('-', $f);
        							 $till = explode('-', $t);
									 $from = gregoriantojd($from[1], $from[2], $from[0]);
									 $till = gregoriantojd($till[1], $till[2], $till[0]);
									 $days = ($from - $till); ?>
									 <b><?php echo $days; ?></b>
									 days its expire

                                    </span>

                                    <?php } ?>

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



  