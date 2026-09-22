
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
                    <h4 style="text-align:center;">PDF Step By step Guides</h4>
                    <div style="border:1px solid #1ABB9C;">
						<div class="row text-center">
							<div class="col-md-6 col-sm-6 col-xs-12">
								Title
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								Url
							</div>
						</div>
                        <br>
                        <?php for($i=1;$i<=$guide_urls_counts;$i++){ ?>
                          <div class="form-group">
							<!--label class="control-label col-md-3 col-sm-3 col-xs-12" for="guide_urls"><?php if($i==1) {?>URLS<?php }?></span>
                            </label-->
							<div class="col-md-5 col-sm-5 col-xs-12">
                            <input name="guide_urls_titles[]" class="form-control col-md-7 col-xs-12" clsss="guide_urls_titles" value="<?php if(isset($guide_urls_titles[$i-1])) echo $guide_urls_titles[$i-1];?>"></textarea>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                            <input name="guide_urls[]" class="form-control col-md-7 col-xs-12" clsss="guide_urls" value="<?php if(isset($guide_urls[$i-1])) echo $guide_urls[$i-1];?>"></textarea>
                            </div>
								<?php if($i==1) {?>
									<a href="javascript:" class="btn btn-success" id="add_new_guide" onclick="$('#div_add_new_guide').clone().appendTo('#target_div_add_new_guide')">Add New</a>
								<?php }else{ ?>
									<a href="javascript:" class="btn btn-danger remove_new_guide" onclick="$(this).closest('.form-group').remove()">Remove</a>
								<?php } ?>
                          </div>
                        <?php } ?>
                        
                        <div id="target_div_add_new_guide">
                        </div>
                        <span class='form_error'><?=form_error('guide_urls[]')?></span>
						<span class='form_error'><?=form_error('guide_urls_titles[]')?></span>
                    </div>



                    <h4 style="text-align:center;">Videos</h4>
                    <div style="border:1px solid #1ABB9C;">
						<div class="row text-center">
							<div class="col-md-6 col-sm-6 col-xs-12">
								Title
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								Url
							</div>
						</div>
                        <br>
                        <?php for($i=1;$i<=$video_urls_counts;$i++){ ?>
                          <div class="form-group">
							<!--label class="control-label col-md-3 col-sm-3 col-xs-12" for="video_urls"><?php if($i==1) {?>URLS<?php }?></span>
                            </label-->
                            <div class="col-md-5 col-sm-5 col-xs-12">
                            <input name="video_urls_titles[]" class="form-control col-md-7 col-xs-12" clsss="video_urls_titles" value="<?php if(isset($video_urls_titles[$i-1])) echo $video_urls_titles[$i-1];?>"></textarea>
                            </div>
							<div class="col-md-5 col-sm-5 col-xs-12">
                            <input name="video_urls[]" class="form-control col-md-7 col-xs-12" clsss="video_urls" value="<?php if(isset($video_urls[$i-1])) echo $video_urls[$i-1];?>"></textarea>
                            </div>
                            <?php if($i==1) {?>
                                <a href="javascript:" class="btn btn-success" id="add_new_guide" onclick="$('#div_add_new_video').clone().appendTo('#target_div_add_new_video')">Add New</a>
                            <?php }else{ ?>
                                <a href="javascript:" class="btn btn-danger remove_new_video" onclick="$(this).closest('.form-group').remove()">Remove</a>
                            <?php } ?>
                          </div>
                        <?php } ?>
                        
                        <div id="target_div_add_new_video">
                        </div>
                        <span class='form_error'><?=form_error('video_urls[]')?></span>
						<span class='form_error'><?=form_error('video_urls_titles[]')?></span>
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


        <div style="display:none;">
            <div class="form-group" id="div_add_new_guide">
              <!--label class="control-label col-md-3 col-sm-3 col-xs-12" for="guide_urls"> <span class="required"></span>
              </label-->
              <div class="col-md-5 col-sm-5 col-xs-12">
              <input name="guide_urls_titles[]" class="form-control col-md-7 col-xs-12" clsss="guide_urls_titles"></textarea>
              </div>
			  <div class="col-md-5 col-sm-5 col-xs-12">
              <input name="guide_urls[]" class="form-control col-md-7 col-xs-12" clsss="guide_urls"></textarea>
              </div>
             
                  <a href="javascript:" class="btn btn-danger remove_new_guide" onclick="$(this).closest('.form-group').remove()" >Remove</a>
              
            </div>
        </div>

        <div style="display:none;">
            <div class="form-group" id="div_add_new_video">
              <!--label class="control-label col-md-3 col-sm-3 col-xs-12" for="video_urls"> <span class="required"></span>
              </label-->
              <div class="col-md-5 col-sm-5 col-xs-12">
              <input name="video_urls_titles[]" class="form-control col-md-7 col-xs-12" clsss="video_urls_titles"></textarea>
              </div>
			  <div class="col-md-5 col-sm-5 col-xs-12">
              <input name="video_urls[]" class="form-control col-md-7 col-xs-12" clsss="video_urls"></textarea>
              </div>
             
                  <a href="javascript:" class="btn btn-danger remove_new_video" onclick="$(this).closest('.form-group').remove()" >Remove</a>
              
            </div>
        </div>
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
