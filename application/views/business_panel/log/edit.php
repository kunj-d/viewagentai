<script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-faq'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if(validation_errors()) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                  </button><?=validation_errors()?></div>
				<?php } ?>
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Category <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="faq_category_id" class="form-control col-md-7 col-xs-12">
						  <option  value="">Select Category</option>
						  <?php foreach($categories as $valcat) { ?>
						  <option value="<?=$valcat->id?>" <?php if($faq_category_id==$valcat->id) { ?> selected="selected" <?php } ?>><?=$valcat->title?></option>
						  <?php } ?>
						</select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Log Title <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						 <input type="text" name="log_title" class="form-control col-md-7 col-xs-12" value="<?php echo $log_title;?>">
					  </div>
                    </div>

					  
					
					 
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Description <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<textarea name="answers" class="form-control col-md-7 col-xs-12" id="editor1"><?=$answers?></textarea>
						<?php if($this->config->item("Writing_enable_text_editor")=='Enable'){ ?>
						<script>
							CKEDITOR.replace( 'editor1' );
						</script>
						<?php } ?>
					  </div>
                    </div>
					
					 
					 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Select Type <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					   
						<select name="type" class="form-control col-md-7 col-xs-12">
						  <option  value="">Select Type</option>
						  <option  value="fixed" <?php if($type=='fixed'){ echo "selected";}?>>Fixed</option>
						  <option  value="added" <?php if($type=='added'){ echo "selected";}?>>Added</option>
						</select>
                      </div>
                    </div>
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<script type="text/javascript">
$(document).ready(function() {
$('body').delegate(".title", 'keyup blur', function() {
	 var text = $(this).val();
	 var slug = text.toString().toLowerCase()
	.replace(/\s+/g, '-')           // Replace spaces with -
	.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
	.replace(/\-\-+/g, '-')         // Replace multiple - with single -
	.replace(/^-+/, '')             // Trim - from start of text
	.replace(/-+$/, '');
	
	$('.slug').val(slug);
	

});

/*-------------------------- delete faq attachment starts here ------------------------------------*/
$('body').delegate(".DeleteIcon", 'click', function() {
	var site_url = '<?php echo site_url();?>';
    var posturl = site_url+'BMS/delete_attachment';
	var id = '<?php echo $faq_id;?>';
	var content = $(this).attr('data-content');
	$that = $(this);
	$.ajax({
        url: posturl,
        dataType: 'json',
        type: "POST",
        data: {id: id,content:content},
        success: function(data) {
            if(data.msg == 'success')
			{
				$that.parent('.attachment').hide();
			}
        },
    });
});
/*-------------------------- delete faq attachment ends here ------------------------------------*/


});
</script>
