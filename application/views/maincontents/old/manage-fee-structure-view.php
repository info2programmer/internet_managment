
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
                    <div class="col-sm-12"><h4 class="page-title">Manage Fee Structure</h4>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php/admin">Dumkal College</a></li>
                            <li class="active">Manage Fee Structure</li>
                        </ol>
                    </div>
                </div>
               	<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">

                            
                            <!--<div class="table-responsive">-->
                            <span id="status" style="color:#0C9;font-size: 16px;"></span>
                            <div>
                                <table id="tblx" border="2">
                                <!--<table id="mainTable" class="table table-striped m-b-0" border="2">-->
                                    <thead>
                                    <tr>
                                    	<th colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF"></th>
                                        <th colspan="7" align="center" bgcolor="#000000" style="color:#FFFFFF">B.A</th>
                                        <th colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF">B.COM</th>
                                        <th colspan="7" align="center" bgcolor="#000000" style="color:#FFFFFF">B.Sc</th>
                                    </tr>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Fees</th>
                                        <th>General Without Geo</th>
                                        <th>General Pass With Geo</th>
                                        <th>General Pass With Phe.Edu</th>
                                        <th>General Pass With Sanskrit</th>
                                        <th>Beng, & Eng (H)</th>
                                        <th>Hist & Pol.SC (H)</th>
                                        <th>Phil (Hons)</th>
                                        <th>B.Com (G)</th>
                                        <th>B.Com (H)</th>
                                        <th>Pass With out Comp .Sc</th>
                                        <th>Pass With Comp .Sc</th>
                                        <th>Geo.(H)</th>
                                        <th>Chem.(H)</th>
                                        <th>Phys.(H)</th>
                                        <th>Math.(H)</th>
                                        <th>Comp. Sc(H)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tuition fees (Per Month)</td>
                                        <?php if($rows) { 						
										
										?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="tuition_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->tuition_fees; ?></td>
                                        <?php } }?>
                                        
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Admission fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="admission_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->admission_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Development Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="development_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->development_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Building Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="building_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->building_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>College Exam Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="college_exam_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->college_exam_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    
                                    <tr>
                                        <td>6</td>
                                        <td>Journals Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="journals_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->journals_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Session Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="session_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->session_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Student Union Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="student_union_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->student_union_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Miscellaneous Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="miscellaneous_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->miscellaneous_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Electric Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="electric_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->electric_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Environment Project Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="environment_project_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->environment_project_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Computer Litaracy Prog.</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="computer_litaracy_prog:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->computer_litaracy_prog; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Enhance Course Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="enhance_course_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->enhance_course_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Registration Fees & Sports Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="registration_sports_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->registration_sports_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Student Health Home</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="student_health_home:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->student_health_home; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>Student Aid Fund</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="student_aid_fund:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->student_aid_fund; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Library Development Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="library_development_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->library_development_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>18</td>
                                        <td>Library Caution</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="library_caution:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->library_caution; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Laboratory Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="laboratory_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->laboratory_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>Laboratory Caution</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="laboratory_caution:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->laboratory_caution; ?></td>
                                        <?php } }?>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Computer Instal Fees</td>
                                        <?php if($rows) { ?>
                                        <?php $i =0; ?>
                                        <?php foreach($rows as $row) { ?>
                                        <td id="computer_instal_fees:<?php echo $row->id; ?>" contenteditable="true"><?php echo $row->computer_instal_fees; ?></td>
                                        <?php } }?>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th><strong>TOTAL</strong></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  $(function(){
	//acknowledgement message
    var message_status = $("#status");
	for(i=3;i<=18;i++){
		var vall = 0;
		$('#tblx tr > td:nth-child('+i+')').each(function() {
			vall += parseInt($(this).text());
			});
		$('#tblx tfoot tr:last-child > th:nth-child('+i+')').text(vall);
		}
		
    $("td[contenteditable=true]").blur(function(){
		
		var field_userid = $(this).attr("id") ;
        var value = $(this).text() ;
		var column = $(this).parent().children().index(this) + 1;
		var vall = 0;
		$('#tblx tr > td:nth-child('+column+')').each(function() {
			vall += parseInt($(this).text());
			});
		$('#tblx tfoot tr:last-child > th:nth-child('+column+')').text(vall);
		//alert(value);
        $.post('<?php echo base_url('index.php/admin/inline_edit_table/edit');?>' , field_userid + "=" + value, function(data){
            if(data != '')
			{
				message_status.show();
				message_status.text(data);
				//hide the message
				setTimeout(function(){message_status.hide()},5000);
			}
        });
    });
});
</script>