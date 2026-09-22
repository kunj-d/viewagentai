<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Package Orders <small> Saglus Order manager </small> </h3>
		<br/>
      </div>
      <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			  <form action="" method="post">
                <div class="input-group">
				<input type="text" class="form-control" placeholder="Keyword" style="margin-left: -400px;" name="keyword" value="<?=$keyword?>">
                  <input type="text" class="form-control date-picker" placeholder="Statr Date" style="margin-left: -200px;" id="start_date" name="start_date" value="<?=$start_date?>">
                  <input type="text" class="form-control date-picker" placeholder="End Date" name="end_date" value="<?=$end_date?>">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                </div>
			 </form>
              </div>
            </div>
    </div>
    <div class="clearfix"></div>
	
	<div class="row top_tiles">
	        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-shopping-cart"></i>
                </div>
                <div class="count"><?=$total?></div>

                <h3>Total Orders</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-ellipsis-h"></i>
                </div>
                <div class="count"><?=$process?></div>

                <h3>Process</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check"></i>
                </div>
                <div class="count"><?=$complete?></div>

                <h3>Complete</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-ban"></i>
                </div>
                <div class="count"><?=$pending?></div>

                <h3>Pending</h3>
              </div>
            </div>
          </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Orders's list </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Package</th>
                  <th>User Detail</th>
				  <th>Price</th>
                  <th>Payment Mode</th>
				  <th>Payment Status</th>
                  <th>Order Time</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($list as $val) { ?>
                <tr>
                  <td><a href="javascript:" class="viewpkg" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$val->package_id?>"><?='#'.$val->package_id.' '.$val->title?></a></td>
				  <td><?php if($val->user_id){ echo '<a href="javascript:" class="viewUser" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="'.$val->user_id.'">'.$this->Common_Modal->getSingleFieldFromAnyTable('name','id',$val->user_id,'tbl_user').'</a>'; } ?> &nbsp;<?=$val->user_email?></td>
                  <td><?=$val->price?></td>
                  <td><?=$val->payment_mode?></td>
				  <?php if($val->payment_status=='new'){ $process = 25;  $color = 'green'; }
				        else if($val->payment_status=='process'){ $process = 50; $color = 'green'; }
						else if($val->payment_status=='pending'){ $process = 75; $color = 'red'; }
						else if($val->payment_status=='complete'){ $process = 100; $color = 'green'; } ?>
                  <td class="project_progress">
                   <div class="progress progress_sm">
                    <div class="progress-bar bg-<?=$color?>" role="progressbar" data-transitiongoal="<?=$process?>"></div>
                   </div>
                   <small><?=$val->payment_status?></small>
                  </td>
                  <td><?=date('d-m-Y h:i:s A',$val->order_time)?></td>
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

$('body').delegate(".viewpkg", 'click', function() {

    var posturl = spanel_url+'view-package';
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
$('body').delegate(".viewUser", 'click', function() {

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
</script>