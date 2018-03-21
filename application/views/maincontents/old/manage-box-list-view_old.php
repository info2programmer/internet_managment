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

      <div class="col-sm-12">

        <h4 class="page-title">Manage Box(<?php echo $client_details->client_name; ?> - <?php echo $client_details->client_id; ?>)</h4>

        <ol class="breadcrumb">

          <li><a href="<?php echo base_url();?>index.php/user/dashboard">Satellite TV Systems</a></li>

          <li><a href="<?php echo base_url();?>index.php/manage_client">Manage Client</a></li>

          <li class="active">Manage Box</li>

        </ol>

      </div>

    </div>

    <div class="row">

      <div class="col-sm-12"> <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/add_box/<?php echo $id; ?>"> Add Box</a> 

	  

     <?php

	 	$firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));

		$lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));

		

		$firstDay = date("Y-m-d", $firstDayUTS);

		//echo '<br>';
		
		$lastDay = date("Y-m-d", $lastDayUTS);

		//$curr_dt = date("Y-m-d");

		//echo "select * from pkg_assign where c_id=$id and payment_status=1 and from_date BETWEEN  '$firstDay' and '$lastDay' or to_date BETWEEN  '$firstDay' and '$lastDay'";

		$data['row_count'] = $this->db->query("select * from pkg_assign where c_id=$id and payment_status=1 and from_date BETWEEN  '$firstDay' and '$lastDay' and to_date BETWEEN  '$firstDay' and '$lastDay'")->num_rows();

		if($data['row_count']>0) { 		

	 ?> 

	 <a target="_blank" class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_list/whole_challan_print/<?php echo $id; ?>"> Print Bill</a>

     <?php } ?>

      

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

                <th width="28">SL NO.</th>

                <th width="65">Box Number</th>

                <th width="133">Current Package</th>

                <th width="111">Package</th>

                <th width="139">From</th>

                <th width="127">To</th>

                <th width="129">Package Status</th>

                <th width="111">ADDOns</th>

                <th width="118">Payment/Bill</th>

                <th width="43">Action</th>

              </tr>

            </thead>

            <tbody>

              <?php $i =1; ?>

              <?php foreach($rows as $row) {?>

              <tr>

                <td><?php echo $i++; ?></td>

                <td><?php echo $row->box_no; ?></td>

                <?php 







									$client_primary_id = $row->client_foreign_id;







									$client_box_no = $row->box_no;







									$table['name'] = 'pkg_assign';



									$conditions = array('c_id'=>$client_primary_id,'box_no'=>$client_box_no);



									$assign_details = $this->common_model->find_data($table,'array','',$conditions);







									if($assign_details) {







										foreach($assign_details as $assign_detail) { 

										

			$query_payment=$this->db->query("select id as pid from pkg_payment where c_id='".$row->client_foreign_id."' and box_no='$client_box_no' order by id desc limit 1");

			$count_payment=$query_payment->num_rows();

			$fetch_payment=$query_payment->result_array();

			 //print_r($fetch_payment);die;

										?>

                <td><?php echo $assign_detail->pkg_name; ?></td>

                <td><?php 

											$c_date = date("Y-m-d");

											$a_date=$assign_detail->to_date;

											if($c_date>$a_date) {

											 ?>

                  <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/renew_assign/<?php echo $id; ?>/<?php echo $row->box_no; ?>"> Renew</a>

                  <?php } else { ?>

                  <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/renew_assign/<?php echo $id; ?>/<?php echo $row->box_no; ?>"> Change Plan</a>

                  <?php } ?></td>

                <td><?php echo date_format(date_create($assign_detail->from_date), "d-m-Y"); ?></td>

                <td><?php echo date_format(date_create($assign_detail->to_date), "d-m-Y"); ?></td>

                <td><?php







										 $current_date = date("Y-m-d"); 







										 if($assign_detail->to_date < $current_date)







										 { ?>

                  <span style="color:#F00;">Expire</span>

                  <?php }







										 else







										 {







											echo "Active"; 







										 }







										 ?></td>

                <td>

                <?php 

				$assign_frm_dt = strtotime(date_format(date_create($assign_detail->from_date), "d-m-Y"));

				$cur_dt = strtotime(date("d-m-Y"));

				if($cur_dt>=$assign_frm_dt)

				{ ?>

					<a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/addons/<?php echo $id; ?>/<?php echo $row->box_no; ?>"> Add Addons</a>

				<?php }

				else

				{ echo "Please waiting till ".date_format(date_create($assign_detail->from_date), "d-m-Y"); }

				?>

                

                

                </td>

                

                

                <td><?php if($assign_detail->payment_status==0) { ?>

                  <a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/payment/<?php echo $id; ?>/<?php echo $row->box_no; ?>" onclick="return confirm('Are you sure?')"> Payment</a>

                  <?php } else { ?>

                  <span>Payment Clear</span>

                  <!--<a target="_blank" class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_list/payment_print/<?php echo $fetch_payment[0]['pid']; ?>"> Print Bill</a>-->

                  <?php } ?></td>

                <?php }







									} 







									else 







									{







									?>

                <td width="43"><?php //echo $row->pkg_name; ?></td>

                <td width="33"><a class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>index.php/manage_client/new_assign/<?php echo $id; ?>/<?php echo $row->box_no; ?>"> New</a></td>

                <td width="0"></td>

                <td width="0"></td>

                <td width="0"></td>

                <td width="0"></td>

                <td width="75"></td>

                <?php } ?>

                

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

                

                <td width="17"><?php /*?>                                    	<div class="col-sm-6 col-md-4 col-lg-3"><p><a href="<?php echo base_url();?>index.php/manage_client/edit/<?php echo $row->id; ?>" title="Edit"><i class="md md-mode-edit"></i></a></p></div><?php */?>

                  <div class="col-sm-6 col-md-4 col-lg-3">

                    <p><a href="<?php echo base_url();?>index.php/manage_client/box_delete/<?php echo $row->id; ?>/<?php echo $client_primary_id; ?>/<?php echo $client_box_no; ?>" title="Delete" onClick="return confirm('Are you Sure to Delete?');"><i class="md md-delete"></i></a></p>

                  </div></td>

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

<script>







function myFunction() {







    var x;







    if (confirm("Press a button!") == true) {







        x = "You pressed OK!";







    } else {







        x = "You pressed Cancel!";







    }







    document.getElementById("demo").innerHTML = x;







}







</script> 