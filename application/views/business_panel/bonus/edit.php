<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-bonus'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if(validation_errors() || $img_error) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                  </button><?=validation_errors()?> <?=$img_error?></div>
				<?php } ?>
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Category <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="bonus_category_id" class="form-control col-md-7 col-xs-12">
						  <option  value="">Select Category</option>
						  <?php foreach($categories as $valcat) { ?>
						  <option value="<?=$valcat->id?>" <?php if($bonus_category_id==$valcat->id) { ?> selected="selected" <?php } ?>><?=$valcat->title?></option>
						  <?php } ?>
						</select>
                      </div>
                    </div>
					
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">URL <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="url" class="form-control col-md-7 col-xs-12" name="url" value="<?=$url?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Description <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<textarea name="description" class="form-control col-md-7 col-xs-12" id="editor1"><?=$description?></textarea>
						<?php if($this->config->item('Writing_enable_text_editor') == 'Enable'){ ?>
						<script>
							CKEDITOR.replace( 'editor1' );
						</script>
						<?php } ?>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Image <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="file" name="image" />
                      </div>
                    </div>
					<?php if($image) { ?>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Existing Image </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<img src="<?=$this->config->item('upload_folder').'bonus_image/'.$image;?>" style="height:100px; width:100px"/>
                      </div>
                    </div>
					<?php } ?>
					
					
					
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

});
</script>
