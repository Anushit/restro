  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New Referral </h3>
          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('inquiry'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Referral List</a>

          </div>

        </div>

        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open(base_url('referral/add'), 'class="form-horizontal" id="inquiryForm"');  ?> 
              <div class="form-group row">                
                <div class="col-sm-6">
                  <label for="name" class="col-sm-6 control-label"> Name <span class="red">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= set_value('name'); ?>">
                </div>
                <div class="col-sm-6">
                  <label for="firmname" class="col-sm-6 control-label"> Firmname <span class="red">*</span></label>
                  <input type="text" name="firmname" class="form-control" id="firmname" placeholder="Enter Firmname" value="<?= set_value('firmname'); ?>">
                </div>
              </div>            
              <div class="form-group row">
               <div class="col-sm-6">
                  <label for="address" class="col-sm-6 control-label">Address <span class="red">*</span></label>
                  <input type="text" name="address" class="form-control" id="address" placeholder="" value="<?= set_value('address'); ?>">
                </div>
                <div class="col-sm-6">
                   <label for="phone" class="col-sm-6 control-label">Mobile No <span class="red">*</span></label>
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Your 10 Digits Mobilbe Number" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g, '')" value="<?= set_value('phone'); ?>">
                </div> 
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="Country" class="col-sm-6 control-label">Country <span class="red">*</span></label>
                  <select name="country" id="country" onchange ="get_state(this)" class="form-control">
                    <option value="">Select Country </option>
                    <?php foreach ($country as $key => $value) {?>
                     <option value="<?= $value['id']?>" <?= set_value('country') ?>><?= $value['name']?>
                    </option>
                   <?php  } ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label for="state" class="col-sm-6 control-label"> State  <span class="red">*</span></label>
                  <select name="state" id="state" onchange="get_city(this)"class="form-control">
                    <option value="">Select State</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">               
                <div class="col-sm-6">
                 <label for="city" class="col-sm-6 control-label">City <span class="red">*</span></label>  
                   <select name="city_id" id="city_id" class="form-control">
                    <option value="">Select City</option>
                  </select>
                </div>               
              </div>
      
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Referral" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
          <!-- /.box-body -->
        </div>
    </section> 
  </div>

  <script type="text/javascript">

    function get_state(id)
    { 
       
      var type =id.value;
     
      var vdata = {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
          'type': type,
        };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>city/get_state",
            data: vdata,
            success: function (data) {
             data = JSON.parse(data);
             console.log(data);

                if (data.status==true) {
                  $('#state').html(data.data);
                } 
            },
        });
        return true;
    }
     function get_city(id)
      { 
      
      var type =id.value;
     
      var vdata = {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
          'type': type,
        };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>city/get_city",
            data: vdata,
            success: function (data) {
             data = JSON.parse(data);
             console.log(data);

                if (data.status==true) {
                  $('#city_id').html(data.data);
                } 
            },
        });
        return true;
    }

  </script>
  <script type="text/javascript">
  $(document).ready(function(){     
     $("#inquiryForm").validate({
        rules: {
            name:"required",
            firmname:"required",
            country: "required",
            city_id: "required",
            state: "required",
            address: {required: true},
            phone:{
                    required: true,
                    minlength:10,
                    maxlength:10,
                    number: true,
                },
             
        },
        messages: {
            name:"Please Enter Name",
            firmname:"Please Enter Name",
            country: "Please Select Country",
            city_id: "Please Select City ",
            state: "Please Select State",
            address: "Please Address",
            phone: {
                    "required": "Please Enter Mobile No",
                    "number": "Please Enter Valid Mobile No",
                    "minlength": "Mobile Should Be 10 Digits",
                    "maxlength": "Mobile Should Be 10 Digits",
                },
  
        
        }
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#inquiryForm").valid()){
            $("#inquiryForm").submit();
        }
    });
  });  
</script>