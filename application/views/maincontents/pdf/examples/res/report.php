<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">



<html>

<style type="text/css">

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 0px;

	margin-bottom: 0px;

}

.school_name {

	font-size: 18px;

	font-weight: bold;

	color: #990000;

}

.school_add {

	font-size: 16px;

	font-weight: bold;

	color: #000000;

	padding-top: 15px;

}

.subheading {

	font-size: 11px;

	font-weight: lighter;

	color: #666666;

}

.transfer {

	font-size: 14px;

	font-weight: bold;

	color: #000000;

}

.table_border {

	font-size: 14px;

	color: #333;

	font-weight: bold;

	letter-spacing: 0.5px;

	border: solid #999 1px;

}

.grey {

	border-bottom: solid #999 1px;

	background: #EFEFEF;

	padding-left: 2px;

}

.white {

	background: #FFFFFF;

	padding-left: 2px;

}

.heading {

	font-size: 11px;

	font-weight: bold;

	color: #990000;

}

.result {

	font-size: 10px;

	font-weight: 700;

	color: #003333;

}

</style>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Client Report</title>

</head>



<body>

<table width="600" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <td width="221" rowspan="2" align="center" valign="bottom">
          <img src="<?php echo base_url(); ?>assets/img/STS.png" height="40" align="absmiddle">
          <br>Invoice No:&nbsp;<?php echo $row->invoice_no;?></td>
          <td width="166" align="center" valign="bottom">Customer Copy</td>
          <td width="277" align="right" valign="bottom">&nbsp;&nbsp;&nbsp;</td>

        </tr>

        <tr>

          <td align="center" valign="bottom" class="transfer">SATELLITE TV SYSTEMS</td>
		  <td width="277" align="center" valign="bottom"><br>Service Tax No: AFRPK4615BST001</td>
        </tr>

        <tr>

          <td height="25" colspan="3" align="center" valign="middle" style="border-top:solid #000 1px;"><b>Name:</b> <?php echo $row->client_name; ?> &nbsp;|&nbsp;<b>Address:</b><?php echo $row->address; ?></td>

        </tr>

        <tr>

          <td width="221" height="20" align="left" valign="middle">Client Id : <?php echo $row->client_id; ?></td>

          <td height="20" align="left" valign="middle">Contact No.: <?php echo $row->phone; ?></td>

          <td width="277" height="20" align="left" valign="middle">Email.: <?php echo $row->client_email; ?></td>

        </tr>

        <tr>

          <td height="15" colspan="3" align="left" valign="middle" class="transfer" style="border-top:solid #999 1px;"> Package Details </td>

        </tr>

        <tr>

          <td colspan="3" ><table width="600" align="center">

              <tr>
				<td width="65" height="15" align="center" valign="middle" class="grey heading">Box No.</td>
                <td width="65" height="15" align="center" valign="middle" class="grey heading">Package</td>

                <td width="55" height="15" align="center" valign="middle" class="grey heading">Cost(Rs/-)</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">From</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">To</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">Service Tax</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">Tax Amount(Rs/-)</td>

                <td width="26" height="15" align="center" valign="middle" class="grey heading">Service Charge(Rs/-)</td>
                <td width="27" align="center" valign="middle" class="grey heading">Discount <br>
(Rs/-)</td>

                <td width="55" height="15" align="center" valign="middle" class="grey heading">Total</td>

              </tr>
			  <?php
			  if($rows) {
				  foreach($rows as $row1) { 
				  
				  $grand9[] = $row1->amount; 
			  ?>
              <tr>
				<td width="74" height="15" align="left" valign="middle" class="white result"><?php echo $row1->box_no;  ?></td>
                <td width="74" height="15" align="left" valign="middle" class="white result"><?php echo $row1->pkg_name; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row1->cost; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo date_format(date_create($row1->from_date), "d-m-Y"); ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo date_format(date_create($row1->to_date), "d-m-Y"); ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row1->tax; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row1->tax_amount; ?></td>

                <td width="45" height="15" align="center" valign="middle" class="white result"><?php echo $row1->service_charge; ?></td>
                <td width="27" height="15" align="center" valign="middle" class="white result"><?php echo $row1->discount; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result">Rs <?php echo $row1->amount; ?>/-</td>

              </tr>
              
			  <?php } ?>
			  <tr>

                  <td height="15" colspan="10" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Net Total: Rs <?php echo round(array_sum($grand9)); ?>/-</td>
        
              </tr> 
			  <?php }
			  else { ?>
              <tr>
              	<td colspan="10">No records found.</td>
              </tr>
              <?php } ?>	
            </table></td>

        </tr>

         <?php if($addons) { ?>

        <tr>

          <td height="15" colspan="3" align="left" valign="middle" class="transfer"> Addon Details </td>

        </tr>

        <tr>

          <td colspan="3"><table width="664" border="0" cellspacing="0" cellpadding="0" align="center">

         

              <tr>
                <td width="68" align="left" valign="middle" class="grey heading">Box No.</td>

                <td width="68" height="15" align="left" valign="middle" class="grey heading">Addon Chnl</td>

                <td width="66" height="15" align="left" valign="middle" class="grey heading">From Date</td>

                <td width="66" height="15" align="left" valign="middle" class="grey heading">To Date</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Price(Rs/-)</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Service Tax</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Tax Amount(Rs/-)</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Amount/Month</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Days</td>

                <td width="66" align="center" valign="middle" class="grey heading">Total Charges</td>

              </tr>

              <?php
				foreach($addons as $addon) { 

				$grand[] = $addon->total_amount;

				?>

              <tr>
                <td width="68" align="left" valign="middle" class="white result"><?php echo $addon->box_no; ?></td>

                <td width="68" height="15" align="left" valign="middle" class="white result"><?php echo $addon->channel_name; ?></td>

                <td width="66" height="15" align="left" valign="middle" class="white result"><?php echo date_format(date_create($addon->pay_date), "d-m-Y"); ?></td>

                <td width="66" height="15" align="left" valign="middle" class="white result"><?php echo date_format(date_create($addon->to_date), "d-m-Y"); ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->price; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->service_tax; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->tax_amount; ?></td>

                <!--<td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->total_amount; ?></td>-->

				<td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->price+$addon->tax_amount; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon->duartion; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"> Rs <?php echo $addon->total_amount; ?>/-</td>

              </tr>

              <?php 

							}







						 ?>

              

              

            </table></td>

        </tr>
        
        <tr>

          <td height="15" colspan="3" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Net Total: Rs <?php echo round(array_sum($grand)); ?>/-</td>

        </tr>

        <?php } ?>

        <?php if($addons) {?>

        

        <?php }?>

        <tr>

          <td height="15" colspan="2" align="left" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">The sum of Rupees:
            <?php  echo $rupees; ?>
&nbsp;rupees only</td>
          <td height="15" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Grand Total: Rs <?php echo $grand_toatl ?>/-</td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left">
    Please pay your bill within 10 days from the date of billing to avoid disconnection.
    <br>
    --------------------------------------------------------------------------------------------------------------------------------------------------------------------------- </td>

  </tr>

  <tr>

    <td><table align="center" width="600" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="227" height="18">No.: <?php echo $row->invoice_no; ?></td>

          <td width="212" height="18" align="left"><u>MONEY RECEIPT</u></td>

          <td width="161" height="18" align="center">Date : <?php echo date_format(date_create($row->paydate), "d-m-Y"); ?></td>

        </tr>

        <tr>

          <td height="20" colspan="3" align="center">SATELLITE TV SYSTEMS</td>

        </tr>

        <tr>

          <td height="15" colspan="3" align="center" style="font-size:12px;">A-12/2, Purbasha, 160, Maniktala Main Road, Kolkata - 700 054  Phone : 2321 7713</td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td height="20">Received with thanks from Mr./Mrs. : <?php echo $row->client_name; ?></td>

        </tr>

        <tr>

          <td height="20" colspan="3">The sum of Rupees:

            <?php  echo $rupees; ?> rupees only</td>

        </tr>

        <tr>

          <td height="55" colspan="3">For CATV, Broad Band Service / Monthly Subscription / Installation charge etc.</td>

        </tr>

        <tr>

          <td height="20" align="left"><div style="border:#000000 1px; width:100px;">Rs: <?php echo $grand_toatl ?><?php //echo $row->amount + round(array_sum($grand)); ?>/-</div></td>

          <td height="20">&nbsp;</td>

          <td height="20" align="center">for <b>SATELLITE TV SYSTEMS</b></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left"><!--<img src="">-->--------------------------------------------------------------------------------------------------------------------------------------------------------------------------- </td>

  </tr>

  <tr>

    <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <td height="15" colspan="4" align="center" valign="middle">Office Copy</td>

        </tr>

        <tr>

          <td width="163" height="15" align="left" valign="middle">Invoice No:&nbsp;<?php echo $row->invoice_no;?></td>

          <td height="15" colspan="2" align="center" valign="middle" class="transfer">SATELLITE TV SYSTEMS</td>

          <td width="173" height="15" align="center" valign="bottom">Service Tax No: AFRPK4615BST001</td>

        </tr>

        <tr>

          <td height="25" colspan="4" align="center" valign="middle" style="border-top:solid #000 1px;"><b>Name:</b> <?php echo $row->client_name; ?> &nbsp;|&nbsp;<b>Address:</b><?php echo $row->address; ?></td>

        </tr>

        <tr>

          <td width="163" height="20" align="left" valign="middle">ClientId: <?php echo $row->client_id; ?></td>

          <td width="240" height="20" align="left" valign="middle">Contact No.: <?php echo $row->phone; ?></td>

          <td height="20" colspan="2" align="left" valign="middle">Email: <?php echo $row->client_email; ?></td>

        </tr>

        <tr>

          <td height="15" colspan="4" align="left" valign="middle" class="transfer" style="border-top:solid #999 1px;"> Package Details </td>

        </tr>

        <tr>

          <td colspan="4" ><table width="600" align="center">

              <tr>
				<td width="65" height="15" align="center" valign="middle" class="grey heading">Box No.</td>
                <td width="65" height="15" align="center" valign="middle" class="grey heading">Package</td>

                <td width="55" height="15" align="center" valign="middle" class="grey heading">Cost(Rs/-)</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">From</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">To</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">Service Tax</td>

                <td width="75" height="15" align="center" valign="middle" class="grey heading">Tax Amount(Rs/-)</td>

                <td width="26" height="15" align="center" valign="middle" class="grey heading">Service Charge</td>
                <td width="27" align="center" valign="middle" class="grey heading">Discount <br>
(Rs/-)</td>

                <td width="50" height="15" align="center" valign="middle" class="grey heading">Total</td>

              </tr>
			   <?php
			  if($rows) {
				  foreach($rows as $row11) { 
				  
				  $grand11[] = $row11->amount; 
			  ?>	
              <tr>
				<td width="74" height="15" align="left" valign="middle" class="white result"><?php echo $row11->box_no;   ?></td>
                <td width="74" height="15" align="left" valign="middle" class="white result"><?php echo $row11->pkg_name; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row11->cost; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo date_format(date_create($row11->from_date),  "d-m-Y"); ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo date_format(date_create($row11->to_date), "d-m-Y"); ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row11->tax; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result"><?php echo $row11->tax_amount; ?></td>

                <td width="45" height="15" align="center" valign="middle" class="white result"><?php echo $row11->service_charge; ?></td>
                <td width="27" height="15" align="center" valign="middle" class="white result"><?php echo $row11->discount; ?></td>

                <td width="74" height="15" align="center" valign="middle" class="white result">Rs <?php echo $row11->amount; ?>/-</td>

              </tr>
			  <?php } ?>
			  <tr>

                  <td height="15" colspan="10" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Net Total: Rs <?php echo round(array_sum($grand11)); ?>/-</td>
        
              </tr> 
			  <?php }
			  else { ?>
              <tr>
              	<td colspan="10">No records found.</td>
              </tr>
              <?php } ?>	
            </table></td>

        </tr>

        <?php if($addons) { ?>

        <tr>

          <td height="15" colspan="4" align="left" valign="middle" class="transfer"> Addon Details </td>

        </tr>

        <tr>

          <td colspan="4"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center">

              <tr>
              
				<td width="68" align="left" valign="middle" class="grey heading">Box No.</td>
                
                <td width="68" height="15" align="left" valign="middle" class="grey heading">Addon Chnl</td>

                <td width="66" height="15" align="left" valign="middle" class="grey heading">From Date</td>

                <td width="66" height="15" align="left" valign="middle" class="grey heading">To Date</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Price(Rs/-)</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Service Tax</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Tax Amount(Rs/-)</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Amount/day</td>

                <td width="66" height="15" align="center" valign="middle" class="grey heading">Days</td>

                <td width="66" align="center" valign="middle" class="grey heading">Total Charges</td>

              </tr>

              <?php

							foreach($addons as $addon_office) { 







							$grand_office[] = $addon_office->total_amount;







						?>

              <tr>
              
              	<td width="68" height="15" align="left" valign="middle" class="white result"><?php echo $addon_office->box_no; ?></td>

                <td width="68" height="15" align="left" valign="middle" class="white result"><?php echo $addon_office->channel_name; ?></td>

                <td width="66" height="15" align="left" valign="middle" class="white result"><?php echo date_format(date_create($addon_office->pay_date), "d-m-Y"); ?></td>

                <td width="66" height="15" align="left" valign="middle" class="white result"><?php echo date_format(date_create($addon_office->to_date), "d-m-Y"); ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->price; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->service_tax; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->tax_amount; ?></td>

               	<!--<td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->total_amount; ?></td>-->

				<td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->price+$addon_office->tax_amount; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result"><?php echo $addon_office->duartion; ?></td>

                <td width="66" height="15" align="center" valign="middle" class="white result">Rs <?php echo $addon_office->total_amount; ?>/-</td>

              </tr>

              <?php 







					







							}



			 ?>

             

              

            </table></td>

            

        </tr>

        <?php } ?>

        <?php if($addons) {?>

        <tr>

          <td height="15" colspan="4" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Net Total: Rs <?php echo round(array_sum($grand_office)); ?>/-</td>

        </tr>

        <?php }?>

        <tr>

          <td height="15" colspan="3" align="left" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">The sum of Rupees:
            <?php  echo $rupees; ?>
&nbsp;rupees only</td>
          <td height="15" align="right" style="padding-right:25px; font-size:14px; border-top:#999 1px; border-bottom:solid #000 1px;">Grand Total:
            
          Rs <?php echo $grand_toatl ?>/-</td>

        </tr>

      </table></td>

  </tr>

</table>

</body>

</html>

