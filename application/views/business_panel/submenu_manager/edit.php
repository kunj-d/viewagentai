<div class="right_col" role="main">
   
     <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-product-manager'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
			
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Menu <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="menu_id" class="form-control" >
									<?php
									foreach($menuData as $menu){
										echo '<option value="'.$menu->id.'" >'.$menu->menu.'</option>';
									}?>
						</select>
                        <span class='form_error'><?=form_error('menu_id')?></span>
                      </div>
					  
                    </div>
					
					 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Submenu <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="submenu" class="form-control col-md-7 col-xs-12 title" name="submenu" value="<?=$submenu?>">
                        <span class='form_error'><?=form_error('submenu')?></span>
                      </div>
					  
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Route <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="title" class="form-control col-md-7 col-xs-12 title" name="route" value="<?=$route?>">
                        <span class='form_error'><?=form_error('route')?></span>
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
