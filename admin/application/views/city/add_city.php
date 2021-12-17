  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Add New City</h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('city'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  City List</a>

          </div>

        </div>

        <div class="card-body col-lg-6">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open(base_url('city/add'), 'class="form-horizontal" id="roleForm"');  ?> 
              <div class="form-group row">                
                <div class="col-sm-12">
                  <label for="name" class="col-sm-12 control-label">City Name <span class="red">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= set_value('name'); ?>">
                </div>
              </div>  
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="Country" class="col-sm-6 control-label">Country <span class="red">*</span></label>
                  <select name="country" id="country" onchange ="get_state(this)" class="form-control">
                    <option value="">Select Country </option>
                    <?php foreach ($country as $key => $value) {?>
                     <option value="<?= $value['id']?>" <?= set_value('country') ?>><?= $value['name']?>
                    </option>
                   <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-12">
                    <label for="state" class="col-sm-6 control-label"> State  <span class="red">*</span></label>
                    <select name="state" id="state"class="form-control">
                      <option value="">Select State</option>
                    </select>
                  </div>
              </div>
              <div class="form-group row">   
               <div class="col-md-12">
                  <label for="role" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status" id="status"class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= (set_value('status') == '1')?'selected': '' ?>>Active</option>
                    <option value="0" <?= (set_value('status') == '0')?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add City" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          <!-- /.box-body -->
        </div>
    </section> 
  </div>
  <script type="text/javascript">
  $(document).ready(function(){     
     $("#roleForm").validate({
        rules: {
            name:"required",
            country:"required",
            state:"required",
            status: "required",
        },
        messages: {
            name:"Please Enter Name",
            country:"Please select Country",
            state:"Please select State",
            status: "Please Select Status",
        },
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#roleForm").valid()){
            $("#roleForm").submit();
        }
    });
  });  
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

</script>