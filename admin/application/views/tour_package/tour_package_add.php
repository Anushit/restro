  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New Tour Package </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('tour_package'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Tour Package</a>
          </div>
        </div>
        <div class="card-body">   

           <!-- For Messages -->

            <?php $this->load->view('includes/_messages.php') ?>
            <?php echo form_open_multipart(base_url('tour_package/add'), 'class="form-horizontal" id="tour_packageForm"');  ?> 
                           
              <div class="form-group row"> 
                
                <div class="col-sm-6">
                <label for="email" class="col-sm-6 control-label">Tour Category<span class="red">*</span></label>  
                  <select class="form-control select2" name="tour_cat_id" id="tour_cat_id">
                   <option value="">Select Category</option> 
                   <?php 
                   foreach ($parcat as $key => $pcat) { ?>
                    <option value="<?php echo $pcat['id']?>" ><?php echo $pcat['name']?></option>
                   <?php } ?>                   
                  </select> 
                </div>
               <div class="col-sm-6">
                <label for="title" class="col-sm-6 control-label"> Title <span class="red">*</span></label>  
                  <input type="text" name="title" class="form-control" id="title" placeholder=""value="<?= set_value('title'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="price" class="col-sm-6 control-label"> Price <span class="red">*</span></label>  
                  <input type="text" name="price" class="form-control" id="price" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^\d\.]/g, '')" value="<?= set_value('price'); ?>">
                </div>
                <div class="col-sm-6">
                <label for="offer_price" class="col-sm-6 control-label">Offer Price </label>  
                  <input type="text" name="offer_price" class="form-control" id="offer_price" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/[^\d\.]/g, '')" value="<?= set_value('offer_price'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                <label for="duration" class="col-sm-6 control-label">Duration </label>  
                  <input type="text" name="duration" class="form-control" id="duration" placeholder="" value="<?= set_value('duration'); ?>">
                </div>
                   <div class="col-md-6">
                  <label for="status" class="col-sm-6 control-label">Select Status <span class="red">*</span></label>                  
                  <select name="status" id="status"class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= (set_value('status') == '1')?'selected': '' ?>>Active</option>
                    <option value="0" <?= (set_value('status') == '0')?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
                

              <div class="form-group row">               
                <div class="col-sm-12">
                   <label for="description" class="col-sm-6 control-label">Description <span class="red">*</span></label>
                   <textarea name="description" class="form-control" id="description" placeholder="" ><?= set_value('description'); ?></textarea> 
                </div>  
              </div>

              <div class="form-group row"> 

             
                <div class="col-md-6">
                <label class="control-label">Image</label><br/>
                  <?php if(!empty($tour_package['image'])): ?>
                     <p><img src="<?= base_url($tour_package['image']); ?>" class="image logosmallimg"></p>
                 <?php endif; ?>
                 <input type="file" name="image" id="image">
                 <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                 <input type="hidden" name="old_image" value="<?php echo html_escape(@$tour_package['image']); ?>">
               </div>
              </div> 
               
              <div class="form-group row"> 
                
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Tour Package" class="btn btn-info pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
          <!-- /.box-body -->
        </div>
    </section> 
  </div> 
  <script type="text/javascript">
  $(document).ready(function(){     
     $("#tour_packageForm").validate({
        rules: {
            name:"required",
            description: "required",
            status: "required",
            email: {required: true, email: true},
            mobile:{
                    required: true,
                    minlength:10,
                    maxlength:10,
                    number: true,
                },
            image:{
                  required: true,
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
            required:"Please insert Image",
            extension:"Please upload file in these format only (jpg, jpeg, png, gif)",
            },
        
        }
    });
    $("body").on("click", ".btn-submit", function(e){
        if ($("#tour_packageForm").valid()){
            $("#tour_packageForm").submit();
        }
    });
  });  
</script>