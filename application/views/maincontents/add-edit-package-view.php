<div class="content">
  <div class="container">
    <div class="row  page-titles">
      <div class="col-sm-12">
        <h3 class="text-themecolor m-b-0 m-t-0"><?php echo $action; ?> Package</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>user/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>manage_zone">Manage Package</a></li>
          <li class="breadcrumb-item active"><?php echo $action ?> Package</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-block">
          <h3 class="box-title m-b-0"><?php echo $action ?> Package</h3>
          <?php
                                    if(isset($row))
                    {   
                      $pkg = $row->pkg;
                      $pkg_mode = $row->pkg_mode;
                      $desc = $row->desc;
                      $all_ch = $row->all_ch;
                      $tax_amount = $row->tax_amount;
                      $service_chrg = $row->service_chrg;
                      $price = $row->price;
                    }
                    else
                    {
                      $pkg = $this->input->post('pkg');
                      $pkg_mode = $this->input->post('pkg_mode');
                      $desc = $this->input->post('desc');
                      $all_ch = $this->input->post('all_ch');
                      $tax_amount = $this->input->post('tax_amount');
                      $service_chrg = $this->input->post('service_chrg');
                      $price = $this->input->post('price');
                    }
                                    ?>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <form method="post" action="" id="myform">
                <div class="form-group"><label
                                          
                  <label for="exampleInputEmail1">Package Name</label>
                  <input type="text" class="form-control" placeholder="Enter Package Name" name="pkg" value="<?php if($action == 'Edit'){echo $pkg;} else {echo set_value('pkg');} ?>">
                  <span style="color:red;"><?php echo form_error('pkg'); ?></span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Package Mode</label>
                  <?php 
                          $js = 'class="form-control" id="pkg_mode"';
                          echo form_dropdown('pkg_mode',$pkg_mode_list,$pkg_mode,$js);
                        ?>
                  <span style="color:red;"><?php echo form_error('pkg_mode'); ?></span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea class="form-control" placeholder="Enter Description" name="desc"><?php if($action == 'Edit'){echo $desc;} else {echo set_value('desc');} ?></textarea>
                  <span style="color:red;"><?php echo form_error('desc'); ?> </span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Cost of All Channel</label>
                 
                  <input type="text" class="form-control" placeholder="Enter Cost of All Channel" name="all_ch" id="all_ch" value="<?php if($action == 'Edit'){echo $all_ch;} else {echo set_value('all_ch');} ?>">
                  <span style="color:red;"><?php echo form_error('all_ch'); ?></span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><span style="border: 1px solid black;padding-left: 2px;padding-right: 5px;"><?php echo $service_tax; ?></span> % GST Amount</label>
                 
                  <input type="text" class="form-control" placeholder="Enter GST Amount" name="tax_amount" id="tax_amount" value="<?php if($action == 'Edit'){echo $tax_amount;} else {echo set_value('tax_amount');} ?>">
                  <span style="color:red;"><?php echo form_error('tax_amount'); ?></span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Service Charge</label>
                  
                  <input type="text" class="form-control"  placeholder="Enter Service Charge" name="service_chrg" id="service_chrg" value="<?php if($action == 'Edit'){echo $service_chrg;} else {echo set_value('service_chrg');} ?>">
                  <span style="color:red;"><?php echo form_error('service_chrg'); ?></span> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  
                  <input type="text" class="form-control" placeholder="Enter Price" name="price" id="price" value="<?php if($action == 'Edit'){echo $price;} else {echo set_value('price');} ?>">
                  <span style="color:red;"><?php echo form_error('price'); ?></span> </div>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $action ?> Package</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-----------------------------selectbox with inputbox-------------------->
<script language="javascript" type="text/javascript">
     function DropDownTextToBox(objDropdown, strTextboxId) {
        document.getElementById(strTextboxId).value = objDropdown.options[objDropdown.selectedIndex].value;
        DropDownIndexClear(objDropdown.id);
        document.getElementById(strTextboxId).focus();
    }
    function DropDownIndexClear(strDropdownId) {
        if (document.getElementById(strDropdownId) != null) {
            document.getElementById(strDropdownId).selectedIndex = -1;
        }
    }
</script>
<!-----------------------------selectbox with inputbox-------------------->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
<script>
$(document).ready(function() {
tax = '<?php echo $service_tax; ?>';

$("#all_ch").keyup(function(){
        cost = $("#all_ch").val();
    tax_amt = (cost*tax)/100;
    /*alert(tax_amt);*/
    $("#tax_amount").val(tax_amt);
    subtotal = parseFloat(cost)+parseFloat(tax_amt);
    $("#price").val(subtotal);
    });
  $("#service_chrg").keyup(function(){
        cost = $("#all_ch").val();
    tax_amount = $("#tax_amount").val();
    service_charge = $("#service_chrg").val();
    total = parseFloat(cost)+parseFloat(tax_amount)+parseFloat(service_charge);
    $("#price").val(total);
    });
});
</script>
