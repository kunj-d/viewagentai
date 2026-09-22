<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Package Transaction <small> Saglus Transaction Manager </small> </h3>
		<br/>
      </div>
      <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			  <form action="" method="post">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Keyword" style="margin-left: -400px;" name="keyword" value="<?=$keyword?>">
			<input type="text" class="form-control date-picker" placeholder="Start Date" style="margin-left: -200px;" id="start_date" name="start_date" value="<?=$start_date?>">
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
                <div class="icon"><i class="fa fa-money"></i>
                </div>
                <div class="count"><?=$sale['size'].' ($ '.$sale['totalamount'].')'?></div>

                <h3>SALE</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-reply"></i>
                </div>
                <div class="count"><?=$refund['size'].' ($ '.$refund['totalamount'].')'?></div>

                <h3>Refund</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-eraser"></i>
                </div>
                <div class="count"><?=$BMS['size'].' ($ '.$BMS['totalamount'].')'?></div>

                <h3>BMS</h3>
              </div>
            </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-paypal"></i>
                </div>
                <div class="count"><?=($cb['size']-$CGBK['size']).' ($ '.($cb['totalamount']-$CGBK['totalamount']).')'?></div>

                <h3>ClickBank</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-paypal"></i>
                </div>
                <div class="count"><?=($jvz['size']-$CGBK['size']).' ($ '.($jvz['totalamount']-$CGBK['totalamount']).')'?></div>

                <h3>JVZoo</h3>
              </div>
            </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-paypal"></i>
                </div>
                <div class="count"><?=$jvs['size'].' ($ '.$jvs['totalamount'].')'?></div>

                <h3>JVShare</h3>
              </div>
            </div>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-paypal"></i>
          </div>
          <div class="count"><?=$wp['size'].' ($ '.$wp['totalamount'].')'?></div>

          <h3>Warrior Plus</h3>
        </div>
      </div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-paypal"></i>
                </div>
                <div class="count"><?=$CGBK['size'].' ($ '.($CGBK['totalamount']/100).')'?></div>

                <h3>CGBK Refund</h3>
              </div>
            </div>
          </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Transaction's list </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Package</th>
                  <th>User</th>
				  <th>Transaction From</th>
                  <th>Transaction Type</th>
				  <th>Name</th>
                  <th>Email</th>
                  <th>Item</th>
                  <th>Type</th>
                  <th>Affiliate</th>
				  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Vendor</th>
                  <th>Receipt Num</th>
                  <th>Created On</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($list as $val) { ?>
                <tr>
                  <td><a href="javascript:" class="viewpkg" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?=$val->package_id?>"><?='#'.$val->package_id.' '.$val->title?></a></td>
				          <td><?php echo '<a href="javascript:" class="viewUser" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="'.$val->user_id.'">'.$this->Common_Modal->getSingleFieldFromAnyTable('name','id',$val->user_id,'tbl_user').'</a>'; ?> </td>
                  <td><?=($val->transaction_from?$val->transaction_from:'N/A')?></td>
                  <td><?=($val->transaction_type?$val->transaction_type:'N/A')?></td>
                  <td><?=($val->name?$val->name:'N/A')?></td>
                  <td><?=($val->email?$val->email:'N/A')?></td>
                  <td><?=($val->item?$val->item:'N/A')?></td>
                  <td><?=($val->type?$val->type:'N/A')?></td>
                  <td><?=($val->affiliate?$val->affiliate:'N/A')?></td>
                  <td><?=($val->amount?$val->amount:'N/A')?></td>
                  <td><?=($val->payment_method?$val->payment_method:'N/A')?></td>
                  <td><?=($val->vendor?$val->vendor:'N/A')?></td>
                  <td><?=($val->receipt_num?$val->receipt_num:'N/A')?></td>
                  <td><?=date('d-m-Y h:i:s A',$val->created_on)?></td>
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