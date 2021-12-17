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
          <h3 class="card-title"><i class="fa fa-question-circle"></i>&nbsp;Booking Inquiry List </h3>
        </div>
        <div class="d-inline-block float-right">
          
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
              <th>Email</th>
              <th>Mobile</th>
              <th>Tour</th>
              <th>Package</th>
              <th>Adults</th>
              <th>Childs</th>
              <th>IP Address</th>
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
    "ajax": "<?=base_url('inquiry/datatable_json_packages')?>",
    "order": [[6,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "ci_tour_booking.id", 'searchable':false, 'orderable':true}, 
    { "targets": 1, "name": "ci_tour_booking.name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_tour_booking.mobile", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "ci_tour_booking.email", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "ci_tour_categories.name", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "ci_tour_package.title", 'searchable':true, 'orderable':false},
    { "targets": 6, "name": "ci_tour_booking.no_of_adult", 'searchable':false, 'orderable':true},
    { "targets": 7, "name": "ci_tour_booking.no_of_child", 'searchable':false, 'orderable':true},
    { "targets": 8, "name": "ci_tour_booking.ip_address", 'searchable':false, 'orderable':true},
    { "targets": 9, "name": "ci_tour_booking.created_at", 'searchable':false, 'orderable':false}, 
    { "targets": 10, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script> 