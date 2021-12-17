  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Upload CSV Lead Info </h3>

          </div>

          <div class="d-inline-block float-right">
            <a href="<?= base_url() ?>assets/sample.csv" download class="btn btn-secondary"><i class="fa fa-download"></i> Download Sample</a>
            <a href="<?= base_url('lead_info'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Lead Info List</a>

          </div>

        </div>

        <div class="card-body col-lg-8">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open_multipart(base_url('lead_info/importdata'), 'class="form-horizontal" id="roleForm"');  ?> 
           
              <div class="form-group row">                
                <div class="col-sm-12">
                  <label for="category" class="col-sm-6 control-label">Category <span class="red">*</span></label>
                  <select name="category" id="category" class="form-control">
                    <option value="">Select Category </option>
                    <?php foreach ($category as $key => $value) {?>
                     <option value="<?= $value['id']?>" <?= set_value('category') ?>><?= $value['name']?>
                    </option>
                   <?php  } ?>
                  </select>
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
                  <select name="state" id="state"  class="form-control">
                    <option value="">Select State</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">   
               <div class="col-sm-12">
                  <label for="state" class="col-sm-12 control-label"> Upload CVC  <span class="red">*</span></label>
                   <input type="file" name="file" id="file" onChange="sendIt()" >
                </div>
              </div>
           

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Upload Lead Info" class="btn btn-info pull-right">
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
           
            category:"required",
            country:"required",
            state:"required",
            status: "required",
        },
        messages: {
            phone:"Please Enter Phone Number",
            country: "Please Select Country",
            state: "Please Select State",
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
            url: "<?php echo base_url(); ?>inquiry/get_state",
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