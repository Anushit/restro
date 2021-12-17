  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New Tour </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('tour_list'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Tour List</a>
          </div>
        </div>
        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open_multipart(base_url('tour_list/edit/'.$tour_list['id']), 'class="form-horizontal" id="tour_listForm"');  ?> 
                           
              <div class="form-group row"> 
                  <div class="col-sm-6">
                <label for="email" class="col-sm-6 control-label">Tour Category<span class="red">*</span></label>  
                  <select class="form-control select2" name="tour_cat_id" id="tour_cat_id">
                   <option value="">Select Category</option> 
                   <?php 
                   foreach ($parcat as $key => $pcat) { ?>
                    <option value="<?php echo $pcat['id']?>" <?php if(set_value('tour_cat_id',$tour_list['tour_cat_id'])==$pcat['id']){ echo "selected='selected'"; } ?> ><?php echo $pcat['name']?></option>
                   <?php } ?>                   
                  </select> 
                </div>
                <div class="col-sm-6">
                <label for="name" class="col-sm-6 control-label">Tour Name <span class="red">*</span></label>  
                  <input type="text" name="tour_name" class="form-control" id="tour_name" placeholder="" value="<?= set_value('tour_name',$tour_list['tour_name']); ?>">
                </div>
               
              </div>

               <div class="form-group row"> 
                <label for="description" class="col-sm-6 control-label">Description <span class="red">*</span></label>
                <div class="col-sm-12">
                  <textarea name="description" class="form-control textarea" id="description" placeholder=""><?= set_value('description',$tour_list['description']); ?></textarea> 
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="status" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status" id="status"class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= (set_value('status', $tour_list['is_active']) == 1)?'selected': '' ?>>Active</option>
                    <option value="0" <?= (set_value('status', $tour_list['is_active']) == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
                <div class="col-md-6">
                <label class="control-label">Image</label><br/>
                  <?php if(!empty($tour_list['image'])): ?>
                     <p><img src="<?= base_url($tour_list['image']); ?>" class="image logosmallimg"></p>
                 <?php endif; ?>
                 <input type="file" name="image" id="image">
                 <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                 <input type="hidden" name="old_image" value="<?php echo html_escape(@$tour_list['image']); ?>">
               </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Tour" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          <!-- /.box-body -->
        </div>
    </section> 
  </div> 
   <script type="text/javascript">
  $(document).ready(function(){     
     $("#tour_listForm").validate({
        rules: {
            name:"required",
            description: "required",
            sort_order: "required",
            slug: "required",
            status: "required",
            email: {required: true, email: true},
            mobile:{
                    required: true,
                    minlength:10,
                    maxlength:10,
                    number: true,
                },
            image:{
                  
                  extension:"jpg|png|gif|jpeg",
                  },
             
        },
        messages: {
            name:"Please Enter Name",
            description: "Please Enter Description",
            sort_order: "Please Enter sort_order",
            slug: "Please Enter SEO URL",
            status: "Please Enter Status",
            email: "Please Enter Valid Email Address",
            mobile: {
                    "required": "Please Enter Mobile No",
                    "number": "Please Enter Valid Mobile No",
                    "minlength": "Mobile Should Be 10 Digits",
                    "maxlength": "Mobile Should Be 10 Digits",
                },
          image:{
            
            extension:"Please upload file in these format only (jpg, jpeg, png, gif)",
            },
        
        }
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#tour_listForm").valid()){
            $("#tour_listForm").submit();
        }
    });
  });  
</script>