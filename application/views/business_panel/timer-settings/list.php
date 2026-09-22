<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Timer Manager <small> Saglus Timer Manager </small> </h3>
		<br/>
      </div>
      <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			  <form action="" method="Get">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Keyword"  name="keyword" value="<?=$keyword?>">
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
            <h2>Timer's list </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  
                  <th>Title</th>
                  <th>Type</th>
                  <th>Start Date</th>
				  <!-- <th>Time</th> -->
				  <th>Time Zone</th>
				  <th>Repeat In</th>
				  
				  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 	foreach($list as $val) { ?>
			  
			  
                <tr>
               
                  <td><?=$val->title?></td>                
                  
				  <td><?=$val->type?></td>   
          <td><?=$val->enddate?></td>
          <!-- <td><?=$val->endtime?></td> -->
          <td><?=$val->timezone?></td>
          <td><?php if ($val->type=='evergreen')echo $val->repeatin .' hour'; ?> </td>	 
             
                 <td>		
					
					  
					   <?php if($edit_per=='yes') { ?>
                      <a href="<?=$this->config->item('spanel_url').'edit-timer-manager/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
					  <?php } ?>
					  
					   <?php if($delete_per=='yes') { ?>
                      <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-timer-manager/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
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

/*$('body').delegate(".viewlink", 'click', function() {

    var posturl = spanel_url+'view-timer-manager';
	var id = $(this).attr('data-id');

    $.ajax({
        url: posturl,
        dataType: 'json',
        type: "POST",
        data: {id: id},
        success: function(data) {
            if (data.success) {
                $('.modaldiv').html(data.html);
            }
        },
    });
});*/

$('body').delegate(".deletelink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to delete this Template?", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
	  }
	}); 
});
$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this Template?", function(result) {
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
