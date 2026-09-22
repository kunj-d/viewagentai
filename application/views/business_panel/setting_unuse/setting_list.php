<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> Setting <small> Saglus Setting Manager </small> </h3>
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
	
<!--/* 	<div class="row top_tiles">
	        <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-envelope"></i>
                </div>
                <div class="count"><?=$total?></div>

                <h3>Total FAQ</h3>
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
          </div> */-->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Setting list </h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Value</th>
				  <th>Placeholder</th>
				  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php foreach($data as $val) { ?>
				<tr>
					<td><?php echo $val['title'];?></td>
					<td><?php echo $val['value'];?></td>
					<td><?php echo $val['placeholder'];?></td>
					<td><?php echo $val['type'];?></td>
					<td>
					  

                    <a href="<?=$this->config->item('spanel_url').'edit-setting/'.$val['id'];?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>


                    <a href="javascript:" class="btn btn-danger btn-xs deletelink" title="Delete" data-toggle="tooltip" data-placement="top" data-href="<?=$this->config->item('spanel_url').'delete-setting/'.$val['id']?>"><i class="fa fa-trash-o"></i> </a>

				  </td>
				</tr>
			  <?php } ?>				
              </tbody>
            </table>
			<div class="dataTables_paginate">
              <ul class="pagination">
                <? //=$paging ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade bs-example-modal-lg modaldiv" tabindex="-1" role="dialog" aria-hidden="true"></div>
<script src="<?=$this->config->item('adminAssetsPath')?>js/bootbox.js"></script>

<script type="text/javascript">
/* $('body').delegate(".viewlink", 'click', function() {

    var posturl = spanel_url+'view-faq';
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


$('body').delegate(".statuslink", 'click', function() {
    
	statusurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to Change status of this FAQ?", function(result) {
	  if(result) {
	     window.location.href = statusurl;
	  }
	}); 
}); */

$('body').delegate(".deletelink", 'click', function() {
    
	deleteurl = $(this).attr('data-href');
	bootbox.confirm("Are you sure to delete this FAQ?", function(result) {
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
