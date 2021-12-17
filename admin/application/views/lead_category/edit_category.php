  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default color-palette-bo">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-plus"></i>

              Edit Lead Category </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('lead_category'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Lead Category List</a>

          </div>

        </div>

        <div class="card-body col-lg-6">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open(base_url('lead_category/edit/'.$lead_category['id']), 'class="form-horizontal" id="roleForm"');  ?> 
              <div class="form-group row">                
                <div class="col-sm-12">
                  <label for="name" class="col-sm-12 control-label">Category Name <span class="red">*</span></label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="" value="<?= set_value('name',$lead_category['name']); ?>">
                </div>
              </div>  
              <div class="form-group row">   
               <div class="col-md-12">
                  <label for="role" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status" id="status"class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($lead_category['is_active'] == '1')?'selected': '' ?>>Active</option>
                    <option value="0" <?= ($lead_category['is_active'] == '0')?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Lead Category" class="btn btn-info pull-right">
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