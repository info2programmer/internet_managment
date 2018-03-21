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
      <div class="col-sm-12">
        <h3 class="page-title">Manage Package(<?php echo $client_details->client_name; ?> - <?php echo $client_details->client_id; ?>)</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_client">Manage Client</a></li>
          <li class="breadcrumb-item active">Manage Package</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12"> <a class="btn btn-success waves-effect waves-light" href="<?php echo base_url(); ?>manage_client/renew_assign/<?php echo $id; ?>"> Renew Package</a> 
	  
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
	 <a target="_blank" class="btn btn-default waves-effect waves-light" href="<?php echo base_url(); ?>manage_list/whole_challan_print/<?php echo $id; ?>"> Print Bill</a>
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
                <th>SL NO.</th>
                <th>Package</th>
                <th>From</th>
                <th>To</th>
                <th>Cost</th>
                <th>GST</th>
                <th>GST Amount</th>
                <th>Service Charge</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php $i =1; ?>
              <?php foreach($rows as $row) {?>
                 <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row->pkg_name ?></td>
                  <td><?php echo $row->from_date ?></td>
                  <td> <?php echo $row->to_date ?> </td>
                  <td> <?php echo $row->cost ?> </td>
                  <td><?php echo $row->tax ?></td>
                  <td><?php echo $row->tax_amount ?></td>
                  <td><?php echo $row->service_charge ?></td>
                  <td><?php echo $row->amount ?></td>
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