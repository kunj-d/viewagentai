<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3> Users <small> Saglus user manager </small> </h3>
      <br/>
    </div>
    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <form action="" method="Get">
          <div class="input-group">
            <select name="plan_id" class="form-control" style="margin-left: -600px;">
            <option value="">Search by Plan</option>
            <?php foreach($plan_list as $val) { ?>
            <option value="<?=$val->id?>" <?php if($val->id==$plan_id) { ?> selected="selected"<?php } ?>><?=$val->title?></option>
            <?php } ?>
            </select>
            <input type="text" class="form-control" placeholder="Keyword" style="margin-left: -400px;" name="keyword" value="<?=$keyword?>">
            
			<input type="text" class="form-control date-picker" placeholder="Start Date" style="margin-left: -200px;" id="start_date" name="start_date" value="<?=$start_date?>">
            <input type="text" class="form-control date-picker" placeholder="End Date" name="end_date" value="<?=$end_date?>">
            <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
            </span> </div>
        </form>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i> </div>
        <div class="count">
          <?=$total?>
        </div>
        <h3>Total Users</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check"></i> </div>
        <div class="count">
          <?=$active?>
        </div>
        <h3>Active</h3>
      </div>
    </div>
    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-ban"></i> </div>
        <div class="count">
          <?=$inactive?>
        </div>
        <h3>Inactive</h3>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>User's list </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th style="width:300px">Purchased Plans</th>
                <!--<th>User type</th>-->
                <th>Status</th>
                <th>Add date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              foreach($list as $val) {  
              ?>
              <tr>
                <td><?=$val->name?></td>
                <td><?=$val->email?></td>
                <?php $planArr = $this->User_Model->getUserpurchasedPackages($val->id);
				        $planName = array();
				        foreach($planArr as $valArr) { 
						$planName[] = $valArr->title;
						} $planName = array_unique($planName); ?>
                <td><?=(empty($planName)?'No plan':implode(',',$planName))?></td>
                <?php /*?><td><?php if(in_array('BigwigVideo Free',$planName) || $planName=='') { echo ''; } else { echo 'paid user'; } ?></td><?php */?>
                <td><button type="button" class="btn btn-success btn-xs"><?=$val->status?></button></td>
                <td><?php echo date($this->config->item('Reading_date_time_format'),$val->created) ;?></td>
                <td><?php if($add_plan_per=='yes') { ?>
                  <a href="javascript:" class="btn btn-primary btn-xs addPlan" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add Plan" ></i> </a>
                  <?php } ?>										
				 			  
                  <?php if($reset_per=='yes') { ?>
                  <a href="javascript:" class="btn btn-primary btn-xs resetPass" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="Reset Password" ></i> </a>
                  <?php } ?>
                  <?php if($status_per=='yes') { ?>
                  <?php if($val->status=='inactive'){ ?>
                  <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Active" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-user-status/active/'.$val->id?>"><i class="fa fa-check"></i> </a>
                  <?php } else { ?>
                  <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Inactive" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-user-status/inactive/'.$val->id?>"><i class="fa fa-ban"></i> </a>
                  <?php } } ?>
                  <?php if($login_per=='yes') { ?>
                  <a href="javascript:" class="btn btn-danger btn-xs loginlink" title="Login" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'login-user/'.$val->id?>"><i class="fa fa-unlock"></i> </a>
                  <?php } ?>
                  <?php if($view_per=='yes') { ?>
                  <a href="javascript:" class="btn btn-primary btn-xs viewlink" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View" ></i> </a>
                  <?php } ?>
                  <?php if($edit_per=='yes') { ?>
                  <a href="<?=$this->config->item('spanel_url').'edit-user/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
                  <?php } ?>
                  <?php if($delete_per=='yes' && $val->id != 1) { ?>
                  <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-user/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="dataTables_paginate">
              <ul class="pagination">
                <?=$paging?>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg modaldiv" tabindex="-1" role="dialog" aria-hidden="true"></div>
<script src="<?=$this->config->item('adminAssetsPath')?>js/bootbox.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/datepicker/daterangepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.date-picker').daterangepicker({
     singleDatePicker: true,
     calender_style: "picker_2"
  }, function(start, end, label) {
     console.log(start.toISOString(), end.toISOString(), label);
  });
});


$('body').delegate(".pagination a", 'click', function(event) {
    event.preventDefault();
	var url = $(this).attr('href');
	window.history.pushState('', '', url);
    $(".x_content").load(location.href + " .x_content"); 
});


$('body').delegate(".viewlink", 'click', function() {

    var posturl = spanel_url+'view-user';
	var user_id = $(this).attr('data-id');

    $.ajax({
        url: posturl,
        dataType: 'json',
        type: "POST",
        data: {user_id: user_id},
        success: function(data) {
            if (data.success) {
                $('.modaldiv').html(data.html);
            }
        },
    });
});
$('body').delegate(".addProduct", 'click', function() {    var posturl = spanel_url+'add-user-product';	var user_id = $(this).attr('data-id');    $.ajax({        url: posturl,        dataType: 'json',        type: "POST",        data: {user_id: user_id},        success: function(data) {            if (data.success) {                $('.modaldiv').html(data.html);            }        },    });});
$('body').delegate(".addPlan", 'click', function() {

    var posturl = spanel_url+'add-user-plan';
	var user_id = $(this).attr('data-id');

    $.ajax({
        url: posturl,
        dataType: 'json',
        type: "POST",
        data: {user_id: user_id},
        success: function(data) {
            if (data.success) {
                $('.modaldiv').html(data.html);
            }
        },
    });
});

$('body').delegate(".resetPass", 'click', function() {

    var posturl = spanel_url+'reset-user-password';
	var user_id = $(this).attr('data-id');

    $.ajax({
        url: posturl,
        dataType: 'json',
        type: "POST",
        data: {user_id: user_id},
        success: function(data) {
            if (data.success) {
                $('.modaldiv').html(data.html);
            }
        },
    });
});
$('body').delegate(".deletelink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to delete this user?", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
	  }
	}); 
});
$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this user?", function(result) {
	  if(result) {
	     window.location.href = statusurl;
	  }
	}); 
});
$('body').delegate(".loginlink", 'click', function() {
    
	loginurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to login with this user?", function(result) {
	  if(result) {
		 window.open(loginurl,'_blank');
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
