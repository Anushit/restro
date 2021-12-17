  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Edit City </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('city'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  City List</a>

          </div>

        </div>

        <div class="card-body col-lg-6">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open(base_url('city/edit/'.$city['id']), 'class="form-horizontal" id="roleForm"');  ?> 
              <div class="form-group row">                
                <div class="col-sm-12">
                  <label for="name" class="col-sm-12 control-label"> Name <span class="red">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= set_value('name',$city['name']); ?>">
                </div>
              </div>  
              <div class="form-group row">  
               <div class="col-sm-12">
                  <label for="Country" class="col-sm-6 control-label">Country <span class="red">*</span></label>
                  <select name="country" id="country" onchange ="get_state(this)" class="form-control">
                    <option value="">Select Country </option>
                    <?php foreach ($country as $key => $value) {?>
                     <option value="<?= $value['id']?>"<?= ($city['country_id']==$value['id']) ? 'selected':''; ?>><?= $value['name']?>
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
                     <?php foreach ($state as $key => $value) {?>
                     <option value="<?= $value['id']?>"<?= ($city['state_id']==$value['id']) ? 'selected':''; ?>><?= $value['name']?>
                    </option>
                   <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">   
               <div class="col-md-12">
                  <label for="role" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status" id="status"class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($city['is_active'] == '1')?'selected': '' ?>>Active</option>
                    <option value="0" <?= ($city['is_active'] == '0')?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update City" class="btn btn-info pull-right">
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
            status: "required",
        },
        messages: {
            name:"Please Enter Name",
            status: "Please Select Status",
        },
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#roleForm").valid()){
            $("#roleForm").submit();
        }
    });
  });  
</script>