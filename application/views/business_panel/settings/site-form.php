<style>
.PlaceholderDiv 
{
	display:none;
}
<?php if($type=='dropdown' || $type=="radio" || $type=="checkbox" || $type=="file"){?>
.total_options{ display:block;}
<?php }
else{
?>
.total_options{ display:none;}
<?php
}
?>

</style>
<span style="display:none;">
				  <div class="element1">
						<p  class="sag_count"></p>
						<div class="col-lg-6"><input class="form-control FormInput" placeholder="Enter Value" name="demo_input" value=""></div>
						<div class="col-lg-3 "><input type="radio"  name="radio_input" value="sss" />&nbsp;&nbsp;<input type="button" value="X" class="sag_remove" value="<?php echo $site_settings->title;?>" sag_container="total_options" sag_element="element1" sag_model="OptionName"  />
						</div>
						<div class="clearfix"></div>
				</div>
			</span>
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
				  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left AddOptions" action="" enctype="multipart/form-data" method="post">

                    <?php
						if($data)
						{
							foreach($data as $data1){
								$title = str_replace($prefix.'.','',$data1->title);
								$title = str_replace('_',' ',$title);
								$title = ucwords($title);
								?>
								<div class="form-group">
								  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $title;?></label>
								  <div class="col-md-6 col-sm-6 col-xs-12">
									<?php
									if($data1->type == 'textbox')
										{

										?>
									<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
									<input type="text" id="key" class="form-control col-md-7 col-xs-12 title" name="values[<?php echo $data1->id;?>]" placeholder="Enter <?php echo $title;?>" value="<?php echo $data1->value;?>" <?php if($data1->editable==1){ echo "readonly";}?>>
									<span class="titleError error"></span>
									<?php
										}
									if($data1->type == 'number')
										{

										?>
									<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
									<input type="number" id="key" Min="0" class="form-control col-md-7 col-xs-12 title" name="values[<?php echo $data1->id;?>]" placeholder="Enter <?php echo $title;?>" value="<?php echo $data1->value;?>" <?php if($data1->editable==1){ echo "readonly";}?>>
									<span class="titleError error"></span>
									<?php
										}
									if($data1->type == 'password')
										{

										?>
									<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
									<input type="password" id="key"  class="form-control col-md-7 col-xs-12 title" name="values[<?php echo $data1->id;?>]" placeholder="Enter <?php echo $title;?>" value="<?php echo $data1->value;?>" <?php if($data1->editable==1){ echo "readonly";}?>>
									<span class="titleError error"></span>
									<?php
										}	
									if($data1->type == 'textarea')
										{
										?>
										<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
										<textarea  class="form-control col-md-7 col-xs-12 title" placeholder="<?php echo 'Enter '.$title;?>" name="values[<?php echo $data1->id;?>]"><?php echo $data1->value;?></textarea>
										<span class="titleError error"></span>
									<?php
										}
										if($data1->type == 'file')
										{
										?>
										<input type="hidden" name="option_images[]" value="<?php echo $data1->title;?>">
										<input type="file" name="values_image[]"><br>
                                        <?php if($data1->value!=''){
											?>
                                            <img src="<?php echo site_url().'assets/settings/'.$data1->value;?>" class="img-responsive" style="max-width:150px;">
                                            <?php
										}?>
										<span class="titleError error"></span>
									<?php
										}
										if($data1->type == 'dropdown')
										{
											$options = json_decode($data1->options);
											 
										?>
											<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
											<select  name="values[<?php echo $data1->id;?>]"  class="form-control">
											<option value="">Select Option</option>
											<?php
												foreach($options as $option)
												{
													?>
													<option value="<?php echo $option?>" <?php if($option == $data1->value){ echo "selected";} else{ if($data1->default_option==$option){ echo "selected";}}?>><?php echo $option;?></option>
													<?php
												}
											?>
											</select>
										<?php										
										}
										if($data1->type == 'radio')
										{
											 
											$options = json_decode($data1->options);
											 
										?>
											<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
											<?php
												foreach($options as $option)
												{
													?>
													<label><input type="radio" value="<?php echo $option;?>" class="form-control" name="values[<?php echo $data1->id;?>]" <?php if($data1->value==$option){ echo 'checked';}else{ if($data1->default_option == $option){ echo "checked";}}?>><?php echo $option;?></label>
													<?php
												}
											?>
										<?php										
										}
										if($data1->type == 'checkbox')
										{
											 
											$options = json_decode($data1->options);
											$values = explode(',',$data1->value); 
										?>
											<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
											<?php
												foreach($options as $option)
												{
													?>
													<label><input type="checkbox" value="<?php echo $option;?>" class="form-control" name="values[<?php echo $data1->id;?>][]" <?php if(in_array($option,$values)){ echo 'checked';} else { if($data->default_option == $option){ echo "checked";}}?>><?php echo $option;?></label>
													<?php
												}
											?>
										<?php										
										}
										if($data1->type == 'yes/no')
										{
											?>
											<input type="hidden" name="option[<?php echo $data1->id;?>]" value="<?php echo $data1->title;?>">
											<label><input type="checkbox" value="1" class="form-control" name="values[<?php echo $data1->id;?>]" <?php if($data1->value=='1'){ echo 'checked';}?>><?php echo $option;?></label>
											<?php
										}
									?> 
								  </div>
								</div>
								 <div class="clearfix"></div>
								<?php
							}
						}
					?>
					 
					
					 
                      
					  
					 
                  
				  
				   
					 
				 
					<div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					  <br><br>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
					 <div class="resultoption"></div>
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

$('body').delegate(".OptionType", 'change', function() {
		var current_val = $(this).val();
			if(current_val == 'dropdown' || current_val == 'radio' || current_val == 'checkbox' || current_val == 'file')
			{
				$('.PlaceholderDiv').css('display','none');
				$('.total_options').css('display','block'); 
			}
			if(current_val == 'textbox' || current_val =='textarea')
			{
				$('.PlaceholderDiv').css('display','block');
				$('.total_options').html('<button type="button" class="sag_add" sag_element="element1" sag_max_limit="100" sag_container="total_options" sag_model="OptionName">Add Option</button><div class="col-lg-3"></div><div class="col-lg-3">Options</div><div class="col-lg-2">Default</div><div class="clearfix"></div>');
				$('.total_options').css('display','none');
			}
			if(current_val == 'file')
			{
				$('.PlaceholderDiv').css('display','none');
				$('.total_options').css('display','none');				 
			}	

});

 
 
});
$(function () {
	var posturl = '<?php echo site_url().'BMS/settings/addoptionaction/'.$id;?>';
		$(".AddOptions").on('submit',function(){
			$(".resultoption").html("<div class='alert alert-info loading wow fadeOut animated'>Hold On...</div>");
			 $.post(posturl,$(".AddOptions").serialize(), function(response){
				 var resp = $.parseJSON(response);
				 if(!resp.status){
						if(resp.msg.title)
						{
							$(".titleError").html(resp.msg.title);
						}
						else{
							$(".titleError").html('');
						}
						if(resp.msg.type)
						{	$(".TypeError").html(resp.msg.type);
						}
						else{
							$(".TypeError").html('');
						}
					}
					else{
					$(".titleError").html('');
					$(".valueError").html('');
					$(".valueType").html('');
					$(".resultoption").html("<div class='alert alert-success login wow fadeIn animated'>"+resp.msg+"</div>");
					$(".AddOptions")[0].reset();
					window.location = resp.url;
				}
			});
		});	
		
		
	});
</script>

<script type="text/javascript" language="javascript" src="<?php echo site_url().'assets/dashboard'?>/js/ajax.js" sag_element="sag_update" ></script>
