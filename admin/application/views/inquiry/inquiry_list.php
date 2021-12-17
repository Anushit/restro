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
          <h3 class="card-title"><i class="fa fa-question-circle"></i>&nbsp; Inquiry List </h3>
        </div> 
        <div class="d-inline-block float-right">
          <div class="btn-group margin-bottom-20"> 
            <a href="<?= base_url() ?>inquiry/create_inquiry_pdf" class="btn btn-secondary">Export as PDF</a>
            <a href="<?= base_url() ?>inquiry/export_csv" class="btn btn-secondary">Export as CSV</a>&nbsp
             <?php  if(@$this->general_user_premissions['inquiry']['is_add']==1){ ?>
            <a href="<?= base_url('inquiry/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Inquiry</a>
              <?php } ?>
          </div> 
        </div>
      </div>
    </div>
    <div class="card">
    <div class="card-header">
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>

      <div id="location-filter" class="col-sm-12 row " data-url="<?php echo base_url(); ?>" token-name="<?php //echo $token_name; ?>" token-value="<?php //echo $token_value; ?>">
        <div class="col-sm-2 ">
            <label for="search_inquery_date">Inquiry Date</label>
            <input type="date" name="search_inquery_date" id="search_inquery_date" value="<?php //echo date("Y-m-d") ?>" class="form-control ">
        </div>
         <div class="col-sm-2">
            <label for="search_inqueryfollowup_date">followup Date</label>
            <input type="date" name="search_inqueryfollowup_date" id="search_inqueryfollowup_date" value="<?php //echo date("Y-m-d") ?>" class="form-control">
        </div>
         <div class="col-sm-2">
            <label for="search_country">Country</label>
            <select name="country" id="country" class="form-control custom-select form-control-border" onchange ="get_state(this)">
                <option value="0" >Select Country</option>
                <?php foreach ($country as $val) { ?>
                    <option value="<?php echo $val["id"]; ?>"><?php echo $val["name"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="state">State</label>
            <select name="state" id="state" class="form-control custom-select form-control-border">
                <option value="0">Select State</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label for="inquiry_type">Inquiry Type</label>
            <select name="inquiry_type" id="inquiry_type" class="form-control custom-select form-control-border">
                <option value="0">Select Type</option>
                <option value="1">Genral</option>
                <option value="2">product</option>
                <option value="3">service</option>
            </select>
        </div>
         <div class="col-sm-2">
            <label for="inquiry_mode">Inquiry Mode</label>
            <select name="inquiry_mode" id="inquiry_mode" class="form-control custom-select form-control-border">
                <option value="0">Select Mode</option>
                <option value="1">Website</option>
                <option value="2">Telephonic</option>
                <option value="3">Direct Inquiry</option>
                <option value="4">News paper</option>
            </select>
        </div>
        <div class="col-sm-9">&nbsp;</div>
        <div class="col-sm-1"><br />                
            <button title="Search" id="external-filter-reset" class="mr-2 btn btn-danger  float-right"><i aria-hidden="true" class="fa fa-times"></i> Reset</button>
        </div>
        &nbsp;&nbsp;
        <div class="col-sm-1"><br />
            <button title="Search" id="external-filter" class="btn btn-primary float-right"><i aria-hidden="true" class="fa fa-search"></i> Search</button>
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
              <th>Email</th>
              <th>Mobile</th>
              <th>Inquiry Type</th>
              <th>Assigned To</th>
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
    "ajax": "<?=base_url('inquiry/datatable_json')?>",
    "order": [[7,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "ci_inquiry.id", 'searchable':true, 'orderable':true}, 
    { "targets": 1, "name": "ci_inquiry.name", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ci_inquiry.mobile", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "ci_inquiry.email", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "ci_inquiry.inquiry_type", 'searchable':true, 'orderable':true},
    { "targets": 5, "name": "ci_admin.username", 'searchable':true, 'orderable':true},
    { "targets": 6, "name": "ip_address", 'searchable':true, 'orderable':true},
    { "targets": 7, "name": "ci_inquiry.created_at", 'searchable':false, 'orderable':false}, 
    { "targets": 8, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
  $("#external-filter").click(function(e) {
        table.on('preXhr.dt', function(e, settings, data) {
            var external_search = false;
            var location_search_added = false; 
            if ($("#search_inquery_date").val() != "") {              
                data.inquery_date = $("#search_inquery_date").val();
                external_search = true
            }
            if ($("#search_inqueryfollowup_date").val() != "") {              
                data.followup_date = $("#search_inqueryfollowup_date").val();
                external_search = true
            }
            
            if ($("#state").val() != 0 ) {
                data.state = $("#state").val();
                external_search = true
            }

            if ($("#country").val() != 0 ) {
                data.country = $("#country").val();
                external_search = true
            }
            if ($("#inquiry_type").val() != 0 ) {
                data.inquiry_type = $("#inquiry_type").val();
                external_search = true
            }
            if ($("#inquiry_mode").val() != 0 ) {
                data.inquiry_mode = $("#inquiry_mode").val();
                external_search = true
            }
            
            data.external_search = external_search;
        });

        table.draw();
    });

    $("#external-filter-reset").click(function(e) {       
        $("#search_inquery_date").val(""); 
        $("#search_inqueryfollowup_date").val("");
        $("#state").val("0");
        $("#country").val("0");
        $("#inquiry_type").val("0");
        $("#inquiry_mode").val("0");
        
        table.on('preXhr.dt', function(e, settings, data) {
            delete data.external_search;
            delete data.search_inquery_date; 
            delete data.search_inqueryfollowup_date; 
            delete data.state;
            delete data.inquiry_type;
            delete data.inquiry_mode;
            delete data.country;             
        });
        table.draw();
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