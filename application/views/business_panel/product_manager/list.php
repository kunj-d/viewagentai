<style>
.list_btn_width{
  width:122px;
}
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Product Manager <small> Here You can manage products </small> </h3>
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
	
	<div class="row top_tiles">
	        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-envelope"></i>
                </div>
                <div class="count"><?=$total?></div>

                <h3>Total Products</h3>
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
            <h2>Template's list </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  
                  <th>Title</th>
                  <th>Thumbnail</th>
                  <!--<th>Content</th>-->
                  <th>Product Type</th>
                  <th>Sales Page Url</th>
                  <th>Jvz Ipn Product Id</th>
                  <th>CB Ipn Product Id</th>
                  
				  <th>Package Plan</th>
                  <th>Status</th>
				  <th>Add date</th>
				  <th>Modified date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 	foreach($list as $val) { ?>
			  
			  
                <tr>
               
                  <td><?=$val->title?></td>                
                  <td>  
                    <?php if(trim($val->image)!='') { ?>
                     <img src="<?php echo $val->image?>"height="50px" width="50px"/>
                    <?php }else { ?>
                      NA
                    <?php }?>
                  </td>
                  <!--<th><?=$val->content?></th>-->
                  <th><?php if($val->has_purchased=="1"){echo "For Use";}else{echo "For Buy";}?></th>
                  <th><?=$val->sales_page_url?></th>
                  <th><?=$val->ipn_product_id?></th>
                  <th><?=$val->cb_ipn_product_id?></th>
				  
               <td><?php foreach($package_plans as $plans){
						if($plans->product_id==$val->id)
							{	
                //echo ucwords($plans->sell_type)."-".$plans->title."<br>";
                echo $plans->title."<br>";
							}
					}?>
				</td>
                  <td><button type="button" class="btn btn-success btn-xs"><?=$val->status?></button></td>
				  <td><?php echo date($this->config->item('Reading_date_time_format'), $val->created);?></td>
				  <td><?php echo date($this->config->item('Reading_date_time_format'), $val->modified);?></td>
				 
                  <td>
				  <?php if($status_per=='yes') { ?>
				    <?php if($val->status=='inactive'){ ?>
				       <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Active" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-product-manager-status/active/'.$val->id?>"><i class="fa fa-check"></i> </a>
					<?php } else { ?>   
					   <a href="javascript:" class="btn btn-warning btn-xs statuslink" title="Set Inactive" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'change-product-manager-status/inactive/'.$val->id?>"><i class="fa fa-ban"></i> </a>
					<?php } } ?>
					
					   <?php if($view_per=='yes') { ?>
					  <a href="javascript:" class="btn btn-primary btn-xs viewlink" data-toggle="modal" data-target=".bs-example-modal-lg"  data-id="<?=$val->id?>"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View" ></i> </a>
					  <?php } ?>
					  
					   <?php if($edit_per=='yes') { ?>
                      <a href="<?=$this->config->item('spanel_url').'edit-product-manager/'.$val->id?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>
					  <?php } ?>
					  
					   <?php if($delete_per=='yes') { ?>
                      <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-product-manager/'.$val->id?>"><i class="fa fa-trash-o"></i> </a>
					  <?php } ?>

            <br><a href="<?=$this->config->item('spanel_url').'product-sales-pages-setting/'.$val->id?>" class="btn btn-info btn-xs list_btn_width" title="Edit" data-toggle="tooltip" data-placement="top">Endusers Sales <br>Pages Settings </a>
            <br><a href="<?=$this->config->item('spanel_url').'product-materials-setting/'.$val->id?>" class="btn btn-info btn-xs list_btn_width" title="Edit" data-toggle="tooltip" data-placement="top">Endusers Materials <br>settings </a>
           <!-- <br><a href="<?=$this->config->item('spanel_url').'product-fe-materials-setting/'.$val->id?>" class="btn btn-info btn-xs list_btn_width" title="Edit" data-toggle="tooltip" data-placement="top">Endusers Front End<br> Materials settings </a>
            <br><a href="<?=$this->config->item('spanel_url').'product-upsell-materials-setting/'.$val->id?>" class="btn btn-info btn-xs list_btn_width" title="Edit" data-toggle="tooltip" data-placement="top">Endusers Upsell<br> Materials settings </a>
          -->
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

$('body').delegate(".viewlink", 'click', function() {

    var posturl = spanel_url+'view-product-manager';
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
	bootbox.confirm("Are you sure to delete this Product?.<br>All Materials and blogs will be delete.", function(result) {
	  if(result) {
	     window.location.href = deleteurl;
	  }
	}); 
});
$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this Product?", function(result) {
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
