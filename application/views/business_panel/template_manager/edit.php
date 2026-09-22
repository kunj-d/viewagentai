<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-template-manager'?>"><i class="fa fa-backward"></i></a>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="title" class="form-control col-md-7 col-xs-12 title" name="title" value="<?=$title?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="slug" class="form-control col-md-7 col-xs-12 slug" name="slug" value="<?=$slug?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Type<span class="required">*</span>
                      </label>
					
                      <div class="col-md-6 col-sm-6 col-xs-12">					  
						<select name="type" class="form-control col-md-7 col-xs-12">
						  <?php foreach($options as $key=>$types) { ?>
						<option value="<?=$types->id?>" <?php if($types->id==$type) { ?> selected="selected" <?php } ?>><?=$types->type?></option>
						  <?php } ?>
						</select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Package Plan<span class="required">*</span>
                      </label>
					
                      <div class="col-md-6 col-sm-6 col-xs-12">
					 
					<?php 
					
						if(!empty($package_plan)) {
							foreach($package_plan as $plan){
							?>
								<li style="list-style:none;">
								<input type="checkbox" class="flat" name="package_plan[]" id="<?php echo $plan->id;?>"  value="<?php echo $plan->id;?>" <?php if(in_array($plan->id,$save_plan_id)){ ?> checked="checked" <?php } ?>/> <label for="<?php echo $plan->id;?>" style="cursor:pointer;"> <?php echo ucwords($plan->sell_type)."-".$plan->title." => ";if($plan->price!=""){ echo $plan->price," $" ;} else { echo "free"; }?></label>
								</li>
						<?php } 
						} ?>
					 
                      </div>
                    </div>
					
					
					
					
					<!--<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Business Type <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="business_type_id" class="form-control col-md-7 col-xs-12">
						<option value=""> Select Type</option>
						
						</select>
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Content 
					  <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<textarea name="content" class="form-control col-md-7 col-xs-12" id="editor1"><?php echo $content;//htmlspecialchars($content);?></textarea>
						<?php if($this->config->item('Writing_enable_text_editor') == 'Enable'){ ?>
						<script>
							// CKEDITOR.replace( 'editor1' );
						</script>
						<?php } ?>
                      </div>
                    </div>
					!-->
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Browse HTML File<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="html_file" class="form-control col-md-7 col-xs-12 slug" name="html_file">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Browse Assets Zip File<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="zip" class="form-control col-md-7 col-xs-12 slug" name="zip">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Thumbnail <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="thumbnail" class="form-control col-md-7 col-xs-12 slug" name="thumbnail">
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
<script>
/*-------------------------- Add Email Tag starts here ---------------------------------------------------*/
$('body').delegate(".add_email_tag", 'click', function() {
    
	var perVal = $(this).val();
	CKEDITOR.instances.editor1.insertText(perVal);
});
/*--------------------------  Add Email Tag ends here ---------------------------------------------------*/

$(document).ready(function() {
  $('body').delegate(".title", 'keyup blur', function() {
         var text = $(this).val();
		 var slug = text.toString().toLowerCase()
		.replace(/\s+/g, '-')           // Replace spaces with -
		.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
		.replace(/\-\-+/g, '-')         // Replace multiple - with single -
		.replace(/^-+/, '')             // Trim - from start of text
		.replace(/-+$/, '');
		
		//$('.slug').val(slug);
		
	
	});

});
</script>
