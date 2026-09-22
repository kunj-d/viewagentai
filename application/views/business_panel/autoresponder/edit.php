<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?php echo $page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?php echo $this->config->item('spanel_url').'manage-autoresponder'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if(validation_errors()) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                  </button><?php echo validation_errors()?></div>
				<?php } ?>
                  <br />
                  <form id="update_form" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Display Title <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" id="display_title" class="form-control col-md-7 col-xs-12 title" name="display_title" value="<?php echo $get_detail->display_title?>">
                      </div>
                    </div>
					
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" id="title" class="form-control col-md-7 col-xs-12 title" name="title" value="<?php echo $get_detail->title?>">
                      </div>
                    </div>

					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Logo <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<div class="col-md-2 col-sm-2 col-xs-4">
							 <img class="img-responsive" src="<?php echo $get_detail->logo;?>" alt="">
						</div>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Change Logo <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="file" id="responder_logo" class="form-control col-md-7 col-xs-12 title" name="responder_logo" >
                      </div>
                    </div>
					
					<div class="form-group">
						<div class="added_rows col-md-12 col-sm-12 col-xs-12" >
					<?php  
					foreach($autoresponder_fields as $value) {
					?>
						<div class="form-group field_list" >
							<input type="hidden" id="credential_id[]" class="form-control col-md-4 col-xs-12 " name="credential_id[]" placeholder="Placeholder" value="<?php echo $value->id;?>">						
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="credential_title">Credential Field <span class="required">*</span>
							</label>
							<div class="col-md-8 col-sm-6 col-xs-12">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
										<input type="text" id="credential_title[]" class="form-control col-md-4 col-xs-12" name="credential_title[]" placeholder="Title" value="<?php echo $value->display_title;?>">
									</div>
								</div>
								<div class="col-md-2 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
										<input type="text" id="credential_name[]" class="form-control col-md-4 col-xs-12 " name="credential_name[]" placeholder="Name" value="<?php echo $value->field_name;?>">
									</div>
								</div>
								<div class="col-md-2 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
										<input type="text" id="credential_default_value[]" class="form-control col-md-4 col-xs-12" name="credential_default_value[]" placeholder="Default value" value="<?php echo $value->default_value;?>">
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
										<input type="text" id="credential_placeholder[]" class="form-control col-md-4 col-xs-12 " name="credential_placeholder[]" placeholder="Placeholder" value="<?php echo $value->placeholder;?>">
									</div>
								</div>
								<div class="col-md-2 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
									<select name="credential_type[]" name="credential_type[]" class="form-control col-md-4 col-xs-12 ">
										<option value="text" <?php echo $value->field_type=='text' ? 'selected':''?>>Text</option>
										<option value="email" <?php echo $value->field_type=='email' ? 'selected':''?>>Email</option>
										<option value="password" <?php echo $value->field_type=='password' ? 'selected':''?>>Password</option>										
									</select>
									</div>
								</div>	
								
							</div>
							<div class="col-md-1 col-sm-3 col-xs-12">
								<button type="button" class="btn btn-success remove">Remove</button>
							</div>
							
						</div>
					<?php 
					}
					?>
					</div>
					
						<div class="col-md-12 col-sm-9 col-xs-12 col-sm-offset-3">
						<button type="button" class="btn btn-success addmore">Add More Credential Field</button>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Status <span class="required">*</span>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<select name="responder_status" class="form-control col-md-7 col-xs-12">
								 <option value="" <?php echo $get_detail->status=='' ? 'selected':''?>>Select</option>						  
								 <option value="1" <?php echo $get_detail->status=='1' ? 'selected':''?>>Active</option>
								 <option value="0" <?php echo $get_detail->status=='0' ? 'selected':''?>>Inactive</option>
							</select>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"> <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<span class="form_success form_success_message text-success"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success'); } ?></span>
                      </div>
                    </div>
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="button" class="btn btn-success success-submit">Submit</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		<script src="<?=$this->config->item('adminAssetsPath')?>js/bootbox.js"></script>
<script type="text/javascript">
$('body').delegate(".success-submit", 'click', function() {
    
	bootbox.confirm("Are you sure to update this Autoresponder detail?", function(result) {
	  if(result) {
	     $("#update_form").submit();
	  }
	}); 
});

$(document).ready(function() {
var i=<?php echo count($autoresponder_fields);?>;
	$(document).on("click", ".addmore",function(){
		var $clone=$(".field_list:first").clone();
		console.log($clone);
		var clone_div=$('.added_rows').append($clone);
		i++;
		
	});
	$(document).on("click", ".remove",function(){
		if(i==1){
		}
		else{
			$(this).closest(".field_list").remove();
			i--;
		}
	});



$('body').delegate(".addmore", 'click', function() {
	 var text = $(this).val();
	 var slug = text.toString().toLowerCase()
	.replace(/\s+/g, '_')           // Replace spaces with -
	.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
	.replace(/\-\-+/g, '_')         // Replace multiple - with single -
	.replace(/^-+/, '')             // Trim - from start of text
	.replace(/-+$/, '');	
	$('#credential_name').val(slug);	
});

});
</script>
