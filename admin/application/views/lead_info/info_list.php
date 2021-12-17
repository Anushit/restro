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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Lead info List </h3>

        </div>

        <div class="d-inline-block float-right">  
            <a href="<?= base_url() ?>lead_info/importdata" class="btn btn-secondary">Upload CSV </a>
            <a href="<?= base_url() ?>lead_info/create_lefdinfo_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>lead_info/export_csv" class="btn btn-secondary">Export as CSV</a>
         
         <?php if(@$this->general_user_premissions['lead_info']['is_add']==1){ ?>
          <a href="<?= base_url('Lead_info/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Lead info</a>
        <?php } ?>
            
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th>
              <th>name</th>
              <th>Category</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Created time</th>
              <th>Status</th>
              <th width="100" class="text-right">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('lead_info/datatable_json')?>",
    "order": [[0,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "ci_lead_info.id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "ci_lead_info.name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_lead_category.name", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "ci_lead_info.phone", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "ci_lead_info.email", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "ci_lead_info.created_at", 'searchable':false, 'orderable':false},
    { "targets": 6, "name": "ci_lead_info.is_active", 'searchable':true, 'orderable':true},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>


<script type="text/javascript">
  $("body").on("change",".tgl_checkbox",function(){
    console.log('checked');
    $.post('<?=base_url("lead_info/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
      id : $(this).data('id'),
      status : $(this).is(':checked') == true?1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
  function sendIt(){
    
    $( "#cvcupload" ).submit();
   
  }
</script>


