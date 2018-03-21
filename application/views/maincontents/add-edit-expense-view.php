<div class="content">
            <div class="container">
                <div class="row  page-titles">
                    <div class="col-sm-12"><h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Expense</h3>  
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_expense">Manage Expense</a></li>
                        <li class="breadcrumb-item active"><?php echo $action ?> Expense</li>
                    </ol>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-block">
                            <h3 class="box-title m-b-0"><?php echo $action ?> Expense</h3>
                            <?php
                                    if(isset($row))
                                        {   
                                            $expense_title = $row->expense_title;
                                            $expense_amount = $row->expense_amount;
                                            $note = $row->note;
                                        }
                                        else
                                        {
                                            $expense_title = $this->input->post('expense_title');
                                            $expense_amount = $this->input->post('expense_amount');
                                            $note = $this->input->post('note');
                                        }
                                    ?>    
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form method="post" action="" id="myform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Expense Title</label>
                                            <input type="text" class="form-control" placeholder="" name="expense_title" value="<?php echo $expense_title ?>">
                                            <?php echo form_error('expense_title', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="expense_amount" value="<?php echo $expense_amount ?>">
                                            <?php echo form_error('expense_amount', '<div class="error">', '</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note</label>
                                            <textarea class="form-control" placeholder="" name="note" value="<?php echo $note ?>"><?php echo $note; ?></textarea>
                                           
                                        </div>
                                       
                                        <?php if($action=='Add'){?> 
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action ?> Expense</button>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
        </div>