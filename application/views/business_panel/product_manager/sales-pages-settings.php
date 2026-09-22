
<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?><br>Product : - <?=$product_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-product-manager'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
			
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
                    <h4 style="text-align:center;">Squeeze Page</h4>
                    <div style="border:1px solid #1ABB9C;">
                          <br>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Squeeze Page Php File <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="html_file" onchange="readHtmlURL(this)">
                              <span class='form_error'><?=form_error('html_file')?></span>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Assets zip file <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="assets_file" onchange="readZipURL(this)">
                              <span class='form_error'><?=form_error('assets_file')?></span>
                            </div>
                          </div>

                    </div>



                    <h4 style="text-align:center;">Front End Plan</h4>
                    <div style="border:1px solid #1ABB9C;">
                          <br>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Front End Sales Page Php File <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="html_file1" onchange="readHtmlURL(this)">
                              <span class='form_error'><?=form_error('html_file1')?></span>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Assets zip file <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="assets_file1" onchange="readZipURL(this)">
                              <span class='form_error'><?=form_error('assets_file1')?></span>
                            </div>
                          </div>

                    </div>



                    <h4 style="text-align:center;">Upsell Plan</h4>
                    <div style="border:1px solid #1ABB9C;">
                          <br>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Upsell Sales Page Php File <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="html_file2" onchange="readHtmlURL(this)">
                              <span class='form_error'><?=form_error('html_file2')?></span>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Assets zip file <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="assets_file2" onchange="readZipURL(this)">
                              <span class='form_error'><?=form_error('assets_file2')?></span>
                            </div>
                          </div>

                    </div>
					
					<h4 style="text-align:center;">JV Page</h4>
                    <div style="border:1px solid #1ABB9C;">
                          <br>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">JV Page Php File <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="html_file3" onchange="readHtmlURL(this)">
                              <span class='form_error'><?=form_error('html_file2')?></span>
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Assets zip file <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="file" id="slug" class="form-control col-md-7 col-xs-12 slug" name="assets_file3" onchange="readZipURL(this)">
                              <span class='form_error'><?=form_error('assets_file2')?></span>
                            </div>
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
<script>
  function readHtmlURL(input) {
    var file = input.files[0];
    var imagefile = file.type;
    var match= ["document/php"];
    if(imagefile!=match[0] && imagefile!=''){
        $(input).val('');
        PNotify.removeAll();
        new PNotify({title: 'Error',text:'The File type you are attempting to upload is not allowed.',type: 'error'});		
        return false;
    }
    
  }


  function readZipURL(input) {
    var file = input.files[0];
    var imagefile = file.type;
    var match= ["application/x-zip-compressed"];
    if(imagefile!=match[0] || imagefile==''){
        $(input).val('');
        PNotify.removeAll();
        new PNotify({title: 'Error',text:'The File type you are attempting to upload is not allowed.',type: 'error'});		
        return false;
    }
    
  }
</script>



