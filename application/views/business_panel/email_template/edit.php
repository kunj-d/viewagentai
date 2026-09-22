
<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-email-template'?>"><i class="fa fa-backward"></i></a>
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
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Email Type <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="email_type" class="form-control col-md-7 col-xs-12">
						<option value=""> Select Email Type</option>
						<?php foreach($emailTypeList as $valueType) { ?>
						<option value="<?=$valueType->type?>" <?php if($email_type==$valueType->type) { ?> selected="selected" <?php } ?> ><?=$valueType->name?></option>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="subject" class="form-control col-md-7 col-xs-12" name="subject" value="<?=$subject?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="description" class="form-control col-md-7 col-xs-12" name="description" value="<?=$description?>">
                      </div>
                    </div>
					
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					  
						<textarea name="message" class="form-control col-md-7 col-xs-12" id="editor1"><?=$message?></textarea>
						<?php if($this->config->item('Writing_enable_text_editor') == 'Enable'){ ?>
						<script>
							CKEDITOR.replace( 'editor1' );
						</script>
						<?php } ?>
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
			
			<div class="col-md-3 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Email Tags</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				
                    <div class="">
                  <ul class="to_do">
                    <li>
                      <p>Email Verification link <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#email_verification_link#}">Add</button></p>
                    </li>
					<li>
                      <p>Forgot Password link <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#forgot_password_link#}">Add</button></p>
                    </li>
					<li>
                      <p>Name <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#name#}">Add</button></p>
                    </li>
					<li>
                      <p>Email <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#email#}">Add</button></p>
                    </li>
					<li>
                      <p>Login Url <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#login_url#}">Add</button></p>
                    </li>
					<li>
                      <p>Password <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#password#}">Add</button></p>
                    </li>
					<li>
                      <p>Plan Name <button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#plan_name#}">Add</button></p>
                    </li>
					<li>
                      <p>Business Name<button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#business_name#}">Add</button></p>
                    </li>
					<li>
                      <p>Business Domain<button type="button" class="btn btn-round btn-success btn-xs add_email_tag pull-right" value="{#business_domain#}">Add</button></p>
                    </li>
                  </ul>
                </div>
					

                    <div class="ln_solid"></div>
                    

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
		
		$('.slug').val(slug);
		
	
	});

});
</script>
