<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Team weblogs <small> Saglus Team weblogs </small> </h3>
		<br/>
      </div>
      <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			  <form action="" method="post">
                <div class="input-group">
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
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User's weblogs </h2>
			 <?php if($clear_per=='yes') { ?>
            <ul class="nav navbar-right panel_toolbox">
                    <li><a href="javascript:" data-href="<?=$this->config->item('spanel_url').'team-web-logs-clear'?>" class="btn btn-danger btn-xs clearlink" title="Clear all logs" data-toggle="tooltip" data-placement="top"><i class="fa fa-recycle"></i></a></li>
                  </ul>
				  <?php } ?>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
				  <th>Id</th>
                  <th>Email</th>
                  <th>Login Date</th>
                  <th>Login Ip</th>
				  <th>Browser</th>
				  <th>Operating System</th>
                </tr>
              </thead>
              <tbody>
			 <?php for($i=0;isset($allPages[$i]);$i++) { ?>
                <tr>
                  <td><?=$allPages[$i]->log_id?></td>
                  <td><?=$allPages[$i]->email?></td>
                  <td><?=date($this->config->item('Reading_date_time_format').' A',strtotime($allPages[$i]->login_date))?></td>
                  <td><?=$allPages[$i]->login_ip?></td>
				  <td><?=$allPages[$i]->browser?></td>
				  <td><?=$allPages[$i]->operating_system?></td>
                </tr>
			<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

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
$(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
$('body').delegate(".clearlink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Clear all weblogs?", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
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
