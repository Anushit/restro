<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <section class="content">
      <div class="card card-default color-palette-bo ">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"><a href="<?php echo base_url('inquiry') ?>"> <i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp  <i class="fa fa-envelope-o"></i>
              Booking Inqiry Reply Mail &nbsp <span class="badge badge-primary"><?= $inquiry_data[0]['name']?></span> </h3>
          </div>
        </div>
      </div>
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
            <h4><i class="fa fa-info-circle"></i>

              Inquiry Details</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                 <b> Name </b>
                </div>
                <div class="col-sm-6">
                 :  <?= $inquiry_data[0]['username'];?>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                  <b>Email </b>
                </div>
                <div class="col-sm-6">
               : <?= $inquiry_data[0]['email'];?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                  <b> Phone </b>
                </div>
                <div class="col-sm-6">
               : <?= $inquiry_data[0]['mobile'];?>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                  <b> No of childs </b>
                </div>
                <div class="col-sm-6">
               : <?= $inquiry_data[0]['no_of_child'];?>
                </div>
              </div>
            </div>


            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                  <b> No of adults </b>
                </div>
                <div class="col-sm-6">
               : <?= $inquiry_data[0]['no_of_adult'];?>
                </div>
              </div>
            </div>
        
          </div>
         
    
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                  <b> Create Date </b>
                </div>
                <div class="col-sm-6">
                  : <?= date_time($inquiry_data[0]['created_at']);?>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-3">
                 <b>  IP Address </b>
                </div>
                <div class="col-sm-6">
               : <?= $inquiry_data[0]['ip_address'];?>
                </div>
              </div>
            </div>
          </div>
       
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-2" style="max-width: 12.50%;">
                 <b>  Message </b>
                </div>
                <div class="col-sm-10">
               : <?= $inquiry_data[0]['message'];?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex p-0">
              <h3 class="card-title p-3"><i class="fa fa-paper-plane"></i>
            Mail </h3>
             <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Compose Mail</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Sent Mail List</a></li> 
              </ul>
            </div>        
          
            <div class="card-body ">   
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <!-- For Messages -->
                  <div class="error"> </div>
                  <?php $this->load->view('includes/_messages.php') ?>
                  <?php echo form_open_multipart(base_url('inquiry/send_replymail_package/'.$inquiry_data[0]['id']), 'class="form-horizontal" id ="myform"');  ?> 

                  <div class="form-group row">                
                    <div class="col-sm-12">
                    <label for="subject" class="col-sm-12 control-label">Subject <span class="red">*</span></label>
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="" value="<?= set_value('subject'); ?>">
                    </div>
                  </div>  
                  <div class="form-group row">                
                    <div class="col-sm-12">
                    <label for="message" class="col-sm-12 control-label">Message <span class="red">*</span></label>
                    <textarea name="message" class="form-control" id="message" placeholder="" value=""><?= set_value('message'); ?></textarea> 
                    </div>
                  </div>  
                  <div class="form-group row">   
                    <div class="col-md-12">
                    <label for="attachment" class="col-sm-6 control-label">Attachment </label>                  
                    <input type="file"  class="form-control" name="attachment">
                    <span> <small class="text-success">Allowed Types: gif, jpg, png, jpeg, pdf</small></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit" value="Send Mail" class="btn btn-info pull-right">
                    </div>
                  </div>
                  <?php echo form_close( ); ?>
                  <!-- /.box-body --> 
                </div>
                <div class="tab-pane" id="tab_2">  
                  <div class="card">
                    <div class="card-body table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                    <tr>
                    <th>#ID</th> 
                    <th>Inquiry Email</th>
                    <th>Message</th>
                    <th>Attachment</th>
                    <th>subject</th>
                    <th>Followup date</th>
                    </tr>
                    </thead>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section> 
  </div>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script> 
  var table = $('#na_datatable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('inquiry/datatable_json_package_reply_mail/'.$inquiry_data[0]['id'])?>",
    "order": [[5,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':false, 'orderable':true}, 
    { "targets": 1, "name": "ci_tour_booking.email", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_tour_booking.message", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "attachment", 'searchable':false, 'orderable':true},
    { "targets": 4, "name": "ci_tour_booking_followup.subject", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "followup_date", 'searchable':false, 'orderable':true},
    ]
  });
</script> 

<script type="text/javascript">
  $(document).ready(function(){     
     $("#myform").validate({
        rules: {
            message:"required", 
            subject:"required", 
            attachment:{
                  extension:"jpg|png|gif|jpeg|pdf",
                  },
         },
        messages: {
            message:"Please Enter Message", 
            subject:"Please Enter Subject", 
            attachment:{
                extension:"Please upload file in these format only (jpg, jpeg, png, gif, pdf)",
                 },
        }
    });
    $("body").on("click", ".btn-submit", function(e){
      if ($("#myform").valid()){
          $("#myform").submit();
      }
    });

  });  
</script>