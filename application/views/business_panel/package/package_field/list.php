<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Package Fields <small> Saglus Package Fields manager </small> </h3>
		<br/>
      </div>
      
    </div>
    <div class="clearfix"></div>
	
	<div class="row top_tiles">
	        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i>
                </div>
                <div class="count"><?=$total?></div>

                <h3>Total Package Fields</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check"></i>
                </div>
                <div class="count"><?=$active?></div>

                <h3>Active</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-ban"></i>
                </div>
                <div class="count"><?=$inactive?></div>

                <h3>Inactive</h3>
              </div>
            </div>
          </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Package Fields's list </h2>
             <?php if($add_per=='yes') { ?>
            <ul class="nav navbar-right panel_toolbox">
                    <li><a href="<?=$this->config->item('spanel_url').'create-package-field'?>" class="btn btn-success btn-xs" title="Add New Package Field" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a></li>
                  </ul>
				  <?php } ?>
				  
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Field Name</th>
                  <th>App</th>
                  <th>Overages</th>
                  <th>Input Type</th>
				  <th>Input Value</th>
				  <th>Field Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($list as $val) { ?>
                <tr>
                  <td><?=$val->field_name?></td>
                  <td><?=$val->app_name?></td>
                  <td><?=$val->overages?></td>
                  <td><?=$val->input_type?></td>
				  <td><?=$val->input_val?></td>
				  <td><?=$val->field_type?></td>
                  <td><button type="button" class="btn btn-success btn-xs"><?=$val->status?></button></td>
                  <td>
				  <?php if($status_per=='yes') { ?>
				    <?php if($val->status=='inactive'){ ?>
				       <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Active" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-package-field-status/active/'.$val->id?>"><i class="fa fa-check"></i> </a>
					<?php } else { ?>   
					   <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Inactive" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-package-field-status/inactive/'.$val->id?>"><i class="fa fa-ban"></i> </a>
					<?php } } ?>
					
					   <?php if($edit_per=='yes') { ?>
                      <a href="<?=$this->config->item('spanel_url').'edit-package-field/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
					  <?php } ?>
					  
					   <?php if($delete_per=='yes') { ?>
                      <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-package-field/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
					  <?php } ?>
				  </td>
                </tr>
			<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade bs-example-modal-lg modaldiv" tabindex="-1" role="dialog" aria-hidden="true"></div>
<script src="<?=$this->config->item('adminAssetsPath')?>js/bootbox.js"></script>

<script>
$(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        "order": [[ 1, "asc" ]]
    } );
} );
$('body').delegate(".deletelink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to delete this package field?", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
	  }
	}); 
});
$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this package field?", function(result) {
	  if(result) {
	     window.location.href = statusurl;
	  }
	}); 
});
<?php if($this->session->userdata('success_msg')) { ?>
new PNotify({
	  title: 'Success',
	  text: '<?=$this->session->userdata('success_msg')?>',
	  type: 'success'
	});
<?php $this->session->unset_userdata('success_msg'); } ?>
</script>
