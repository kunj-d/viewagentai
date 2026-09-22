<div class="right_col" role="main" >
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php echo $page_title;?> <small> Saglus Socialmozo</small> </h3>
		<br/>
      </div>
      <div class="title_right">
             
            </div>
    </div>
    <div class="clearfix"></div>
		<div class="row top_tiles">
	
		<div class="col-md-2 col-sm-2 col-xs-12" style="float:left">
		<select class="form-control input-sm" id="default_filter" style="float:left;width:100px;">
              <option value="" mytag="">Action</option>
              <option value="repromote">Repromote</option>
              <option value="delete" mytag="delete" sag_url="<?php echo $this->config->item('spanel_url').'deleteall-socialmozo/'.$val->id?>">Delete</option>
              <option value="report">Report</option>
             </select>
			 </div>
			 <div class="col-md-1 col-sm-1 col-xs-12">
			 
			 <input type="button" class="sag_delete_all" style="float:left;width:50px;margin-left:-82px;" value="GO"/>
			
			
			 </div>
		
		  <div class="col-md-2 col-sm-2 " style="float:left">
			<input type="text" class="form-control date-picker" placeholder="Start Date" style="margin-left:-81px;" id="start_date" name="startdate" value="<?php $start_date?>">
		  </div>
	
	     <div class="col-md-2 col-sm-2 col-xs-12" style="float:left" >
          <input type="text" class="form-control date-picker" placeholder="End Date"  style="margin-left:-81px;"  id="end_date" name="enddate" value="<?php $end_date?>">
	     </div>
	     <div class="col-md-3 col-sm-3 col-xs-12 form-group  top_search">
			 <div class="input-group">
                  <input type="text" class="form-control" placeholder="Keyword" id="keyword" style="margin-left:-70px;" name="keyword" value="<?php $keyword?>">
                  <span class="input-group-btn">
                            <button class="btn btn-default" id="profitmozo_search" class="profitmozo_search" style="margin-left:-70px;" type="submit" url="<?php echo $this->config->item('spanel_url');?>socialmozosearch">Go!</button>
                        </span>
                </div>
			
			  
			 </div>
	</div>
<div class="col-md-2 col-sm-2 col-xs-12 form-group  " style="float:right">
			show : <select class="form-control input-sm"   id="per_page" >
<option value="10"  >10</option>
<option value="25"  >25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
              </div>
          
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Socialmozo List </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap " id="socialmozo_list" cellspacing="0" width="100%">
              <thead>
                <tr >
				 <th><input type="checkbox" id="sag_select_all"></th>
                  <th>SocialMozo Name</th>
                  <th>Image</th>
				  <th>Plateform</th>
				  <th>Schdule Date</th>
                  <th>Promote Page</th>
				  <th>Action</th>
				 
                </tr>
              </thead>
              <tbody>
			  <?php foreach($list as $val) { 

			  ?>
			    <tr class="sag_remove_container<?php $val->id; ?>">
					<td><input type="checkbox" class="sag_checkbox" multiple="multiple" value="<?php echo $val->id;?>" ></td>
					<td><?=$val->title;?></td>
					<td><img src="<?=$this->config->item('upload_folder').'templates/'.'template'.$val->template_id.'.png';?>" style="height:50px; width:50px"/></td>
					<td><?php if($val->type=='y') { echo 'Youtube'; } else if($val->type=='v') { 'Vimeo'; } else { echo 'VideoWhizz'; } ?></td>
					<td><?php echo date("d-m-Y", strtotime($val->schedule_on));?></td>
					<td><?php  if($val->type=='PP'){ echo "profitpage";}else { echo "profitmozo";} ?></td>
					<td>
					<?php if($view_per=='yes') { ?>
					  <a href="javascript:" class="btn btn-primary btn-xs viewlink" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View" ></i> </a>
					  <?php } ?>
					   <?php if($edit_per=='yes') { ?>
                      <a href="<?=$this->config->item('spanel_url').'edit-socialmozo/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
					  <?php } ?>
					  
					   <?php if($delete_per=='yes') { ?>
                      <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-socialmozo/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
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
	
	
	<!--table ng-controller="userController">
	 <tr ng-repeat="user in users">
          <td>{{user.id}}</td>
        </tr>
</table-->
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

</script>

<script type="text/javascript">
$('body').delegate(".viewlink", 'click', function() {

    var posturl = spanel_url+'view-training-videos';
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
});

$('body').delegate(".deletelink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to delete this Socialmozo?", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
	  }
	}); 
});
$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this Video?", function(result) {
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

