
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
            <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0">Manage Expense</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Manage Expense</li>
                </ol>
            </div>
        </div>
        <div class="row">
                    <div class="col-sm-12">
                    
                    <?php echo anchor('manage_expense/add', '<i class="mdi mdi-plus-circle"></i> Add Expense', 'title="Add Expense" class="btn btn-success" style="margin-top: 12px;"');?>
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
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                
                                <thead>
                                <tr>
                                    <th width="11">SL NO.</th>
                                    <th width="20">Expense</th>
                                    <th width="84">Amount</th>
                                    <?php if($this->session->userdata('username') =='admin') {?>
                                    <th width="43">Action</th>
                                    <?php } ?>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1; ?>
                                <?php foreach($rows as $row) {  ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row->expense_title; ?></td>
                                    <td><?php echo $row->expense_amount; ?></td>
                                    
                                <?php if($this->session->userdata('username') =='admin') {?>
                                <td>
                                    <div class="row">
                                    <div class="col-sm-2"><a href="<?php echo base_url();?>manage_expense/edit/<?php echo $row->id; ?>" title="Edit"><i class="fa fa-eye"></i></a></div>

                                    </div>
                                    </td>  
                                    <?php } ?> 
                                                                  
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                                            <p>No records found.</p>
                            <?php   }  ?>
                        </div>
                    </div>
                </div>
    </div>
</div>



