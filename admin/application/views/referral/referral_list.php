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
          <h3 class="card-title"><i class="fa fa-question-circle"></i>&nbsp; Referral List </h3>
        </div> 
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>referral/create_referral_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>referral/export_csv" class="btn btn-secondary">Export as CSV</a>&nbsp
           <?php  if(@$this->general_user_premissions['referral']['is_add']==1){ ?>
            <a href="<?= base_url('referral/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Referral</a>
           <?php } ?>
          </div> 
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th> 
              <th>Name</th>
              <th>Address</th>
              <th>Mobile</th>
              <th>Created Date</th> 
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
    "ajax": "<?=base_url('referral/datatable_json')?>",
    "order": [[4,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "ci_referral.id", 'searchable':true, 'orderable':true}, 
    { "targets": 1, "name": "ci_referral.name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_referral.phone", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "ci_referral.address", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "ci_referral.created_at", 'searchable':false, 'orderable':false}, 
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });

</script> 