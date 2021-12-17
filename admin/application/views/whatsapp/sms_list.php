<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
     
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Whatsapp Message List </h3>
        </div>
        <?php if(@$this->general_user_premissions['whatsapp']['is_add']==1){ ?>
        <div class="d-inline-block float-right">
      
          <a href="<?= base_url('whatsapp/add'); ?>" class="btn btn-success"><i class="fa fa-send-o"></i> Send New Whatsapp Message</a>
        </div>
      <?php } ?>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Message</th>
              <th>Created by</th>
              <th>Created at</th>
              <th width="100">Member</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="sub"> Send To.. </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

          <div id="memberId" class="container">
            
          </div>
         
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('whatsapp/datatable_json')?>",
    "order": [[3,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "message", 'searchable':false, 'orderable':false},
    { "targets": 2, "name": "created_by", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "created_at", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>


<script type="text/javascript">

   function member(id)
    { 

      var vdata = {
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
          'id': id,
        };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Whatsapp/getmemberid",
            data: vdata,
            success: function (data) {
            data = JSON.parse(data);
            console.log(data);
                           
                  $('#memberId').html(data.data);
                  $('#sub').html(data.sub);

            },
        });
       
    }

</script>



