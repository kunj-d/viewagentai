<style>
.PlaceholderDiv 
{
	display:none;
}
 

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
				  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left AddOptions" action="" method="post" onsubmit="return false;" >

                    
					 
                      <div class="col-md-6 col-sm-6 col-xs-12">
						  <label class="control-label" for="title">Key <span class="required">*</span></label>
                        <input type="text" id="key" class="form-control col-md-7 col-xs-12 title" name="title" placeholder="Enter Title" value="<?php echo $title?>">
						<span class="titleError error"></span>
                      </div>
                    
					
					 <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="placeholder">Placeholder
                      </label>
                         <input type="text" id="placeholder"  placeholder="Enter Placeholder" class="form-control col-md-7 col-xs-12 placeholder" name="placeholder" value="<?php echo $placeholder?>">
						<span class="valueError error"></span>
                      </div>
                     
					  
					  
					  <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="title">Type <span class="required">*</span></label>
                       
							<select name="type" class="form-control col-md-7 col-xs-12 OptionType">
								<option value="textbox" <?php if($type=="textbox"){ echo "selected";}?>>textbox</option>
								<option value="number" <?php if($type=="number"){ echo "selected";}?>>Number</option>
								<option value="password" <?php if($type=="password"){ echo "selected";}?>>Password</option>
							    <option value="textarea" <?php if($type=="textarea"){ echo "selected";}?>>textarea</option>
								<option value="dropdown" <?php if($type=="dropdown"){ echo "selected";}?>>dropdown</option>
								<option value="radio" <?php if($type=="radio"){ echo "selected";}?>>radio</option>
								<option value="checkbox" <?php if($type=="checkbox"){ echo "selected";}?>>checkbox</option>
								<option value="file" <?php if($type=="file"){ echo "selected";}?>>file</option>
								<option value="yes/no" <?php if($type=="yes/no"){ echo "selected";}?>>Yes/No</option>
							</select>
							<span class="TypeError error"></span>
                      </div>
                  	<div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="placeholder">Help Text
                      </label>
                         <input type="text" id="placeholder"  placeholder="Enter Help Text" class="form-control col-md-7 col-xs-12 placeholder" name="help" value="<?php echo $help?>">
						<span class="valueError error"></span>
                      </div>
					 
				  
					 
					  
					<div class="col-md-6 col-sm-6 col-xs-12 total_options" id="total_options">
							 
							
								
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
					 <label class="control-label" for="placeholder">Editable</label><br/>
					 <input type="radio" name="editable" value="1" <?php if($editable==1){ echo "checked";}?>>&nbsp;Yes
					 <input type="radio" name="editable" value="0" <?php if($editable==0){ echo "checked";}?>>&nbsp;No
					</div>	
							
					
					 
					 
					
				
					 
					 <div class="clearfix"></div> 
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
		options();		
});
options();		
function options(){

if($(".OptionType").val()=='textbox')
{
	$('.total_options').html('<label class="control-label" for="title">Value</label><input type="text" id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value" value="<?php echo $value;?>">'); 
}
if($(".OptionType").val()=='number')
{
	$('.total_options').html('<label class="control-label" for="title">Value</label><input type="number" Min="0" id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value" value="<?php echo $value;?>">'); 
}
if($(".OptionType").val()=='password')
{
	$('.total_options').html('<label class="control-label" for="title">Value</label><input type="password"  id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value" value="<?php echo $value;?>">'); 
}
if($(".OptionType").val()=='textarea')
{
	$('.total_options').html('<label class="control-label" for="title">Value</label><textarea id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value"><?php echo $value;?></textarea>'); 
}
if($(".OptionType").val() == 'dropdown' || $(".OptionType").val() == 'radio' || $(".OptionType").val() == 'checkbox' || $(".OptionType").val() == 'file')
{
	<?php $i=0;?>
	$('.total_options').html('<button type="button" class="sag_add" sag_element="element1" sag_max_limit="100" sag_container="total_options" sag_model="OptionName">Add Option</button><div class="col-lg-6">Options</div><div class="col-lg-3">Default</div><div class="clearfix"></div><?php foreach($options as $key =>$option){ ++$i;?><div class="element1"><p  class="sag_count"></p><div class="col-lg-6"><input class="form-control FormInput" placeholder="Enter Value" name="OptionName[]" value="<?php echo $option;?>"></div><div class="col-lg-3 "><input type="radio"  name="radio_input" value="<?php echo $key;?>" <?php if($default_option==$option){ echo 'checked';}?> />&nbsp;&nbsp;<input type="button" value="X" class="sag_remove" value="<?php echo $site_settings->title;?>" sag_container="total_options" sag_model="OptionName" sag_element="element1" /></div><div class="clearfix"></div></div><?php }?>'); 
	addMore();
	<?php if($i==0){?>
	$('.sag_add').click();
	<?php }?>
}
if($(".OptionType").val()=='yes/no')
{
	$('.total_options').html('<label class="control-label" for="title"><input type="checkbox" id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value" value="1" <?php if($value=='1'){ echo "checked";};?>>Yes</label>'); 
}



 

 }
 
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

<script type="text/javascript" language="javascript" src="<?php echo site_url().'assets/business_panel'?>/js/ajax-settings.js" sag_element="sag_update" ></script>
