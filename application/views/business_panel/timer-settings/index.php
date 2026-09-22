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
				  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left AddOptions" action="" method="post" >

                    
					 
                      <div class="col-md-6 col-sm-6 col-xs-12">
						  <label class="control-label" for="title">Countdown title</label>
                        <input type="text" id="key" class="form-control col-md-7 col-xs-12 title" name="title" placeholder="Event Name" value="<?php echo $edit_detail->title?>">
						<span class="titleError error"></span>
                      </div>
                    
					  
					  <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="title">Type<span class="required">*</span></label>
                      		<select name="type" class="form-control col-md-7 col-xs-12 optiontypes">
								<option value="evergreen"<?php echo ($edit_detail->type=='evergreen')?"selected":" "; ?>>Evergreen </option>
								<option value="fixedtime" <?php echo ($edit_detail->type=='fixedtime')?"selected":" "; ?>>Fixed Time</option>
							</select>
							<span class="TypeError error"></span>
                      </div>
					  
					  
                  	<div class="col-md-6 col-sm-6 col-xs-12 fixedtime f-evergreen">
					    <label class="control-label" for="placeholder">Countdown to date</label>
                        <input type="text" class="form-control date-picker" placeholder="Start Date" id="start_date" name="start_date" value="<?php echo date("m/d/Y", $edit_detail->enddate)?>" autocomplete="off">
						<span class="valueError error"></span>
                      </div>
					 

					<div class="col-md-6 col-sm-6 col-xs-12 fixedtime f-evergreen">
					 <label class="control-label" for="title">Event time</label>
					<div class="inlineform">
                     <select id="date_hour" name="countdown_hrs" class="form-control">
						<option value="00" selected="selected" <?php echo ($edit_detail->endtime[0]=='00')?"selected":" "; ?>>12 AM</option>
						<option value="01" <?php echo ($edit_detail->endtime[0]=='01')?"selected":" "; ?>>01 AM</option>
						<option value="02" <?php echo ($edit_detail->endtime[0]=='02')?"selected":" "; ?>>02 AM</option>
						<option value="03" <?php echo ($edit_detail->endtime[0]=='03')?"selected":" "; ?>>03 AM</option>
						<option value="04" <?php echo ($edit_detail->endtime[0]=='04')?"selected":" "; ?>>04 AM</option>
						<option value="05" <?php echo ($edit_detail->endtime[0]=='05')?"selected":" "; ?>>05 AM</option>
						<option value="06" <?php echo ($edit_detail->endtime[0]=='06')?"selected":" "; ?>>06 AM</option>
						<option value="07" <?php echo ($edit_detail->endtime[0]=='07')?"selected":" "; ?>>07 AM</option>
						<option value="08" <?php echo ($edit_detail->endtime[0]=='08')?"selected":" "; ?>>08 AM</option>
						<option value="09" <?php echo ($edit_detail->endtime[0]=='09')?"selected":" "; ?>>09 AM</option>
						<option value="10" <?php echo ($edit_detail->endtime[0]=='10')?"selected":" "; ?>>10 AM</option>
						<option value="11" <?php echo ($edit_detail->endtime[0]=='11')?"selected":" "; ?>>11 AM</option>
						<option value="12" <?php echo ($edit_detail->endtime[0]=='12')?"selected":" "; ?>>12 PM</option>
						<option value="13" <?php echo ($edit_detail->endtime[0]=='13')?"selected":" "; ?>>01 PM</option>
						<option value="14" <?php echo ($edit_detail->endtime[0]=='14')?"selected":" "; ?>>02 PM</option>
						<option value="15" <?php echo ($edit_detail->endtime[0]=='15')?"selected":" "; ?>>03 PM</option>
						<option value="16" <?php echo ($edit_detail->endtime[0]=='16')?"selected":" "; ?>>04 PM</option>
						<option value="17" <?php echo ($edit_detail->endtime[0]=='17')?"selected":" "; ?>>05 PM</option>
						<option value="18" <?php echo ($edit_detail->endtime[0]=='18')?"selected":" "; ?>>06 PM</option>
						<option value="19" <?php echo ($edit_detail->endtime[0]=='19')?"selected":" "; ?>>07 PM</option>
						<option value="20" <?php echo ($edit_detail->endtime[0]=='20')?"selected":" "; ?>>08 PM</option>
						<option value="21" <?php echo ($edit_detail->endtime[0]=='21')?"selected":" "; ?>>09 PM</option>
						<option value="22" <?php echo ($edit_detail->endtime[0]=='22')?"selected":" "; ?>>10 PM</option>
						<option value="23" <?php echo ($edit_detail->endtime[0]=='23')?"selected":" "; ?>>11 PM</option>
					</select>
						
					<select id="date_minute" name="countdown_mins" class="form-control">
					<option value="15" selected="selected" <?php echo ($edit_detail->endtime[1]=='15')?"selected":" "; ?>>15</option>
					<option value="30" <?php echo ($edit_detail->endtime[1]=='30')?"selected":" "; ?>>30</option>
					<option value="45" <?php echo ($edit_detail->endtime[1]=='45')?"selected":" "; ?>>45</option>
					<option value="00" <?php echo ($edit_detail->endtime[1]=='00')?"selected":" "; ?>>00</option>
					</select>
					</div>
					<span class="TypeError error"></span>
					</div>	
					  
					  
					<div class="col-md-6 col-sm-6 col-xs-12 evergreen f-evergreen">
					    <label class="control-label" for="placeholder">Repeat In</label>
                         <select id="date_mins" name="countdown_hour" class="form-control">						
						<option value="1" selected="selected" <?php echo ($edit_detail->repeatin=='1')?"selected":" "; ?>>1 Hour</option>
						<option value="2 " <?php echo ($edit_detail->repeatin=='2')?"selected":" "; ?>>2 Hour</option>
						<option value="3" <?php echo ($edit_detail->repeatin=='3')?"selected":" "; ?>>3 Hour</option>
						<option value="4" <?php echo ($edit_detail->repeatin=='4')?"selected":" "; ?>>4 Hour</option>
						<option value="5" <?php echo ($edit_detail->repeatin=='5')?"selected":" "; ?>>5 Hour</option>
						<option value="6" <?php echo ($edit_detail->repeatin=='6')?"selected":" "; ?>>6 Hour</option>
						<option value="7" <?php echo ($edit_detail->repeatin=='7')?"selected":" "; ?>>7 Hour</option>
						<option value="8" <?php echo ($edit_detail->repeatin=='8')?"selected":" "; ?>>8 Hour</option>
						<option value="9" <?php echo ($edit_detail->repeatin=='9')?"selected":" "; ?>>9 Hour</option>
						<option value="10" <?php echo ($edit_detail->repeatin=='10')?"selected":" "; ?>>10 Hour</option>
						<option value="11" <?php echo ($edit_detail->repeatin=='11')?"selected":" "; ?>>11 Hour</option>
						<option value="12" <?php echo ($edit_detail->repeatin=='12')?"selected":" "; ?>>12 Hour</option>
					</select>
                    </div>
					  
					 <div class="col-md-6 col-sm-6 col-xs-12 clear">
					    <label class="control-label" for="placeholder">TimeZone<span class="required">*</span></label>
                         <select id="" name="timezone" class="form-control">
						<option value="EST" selected="selected" <?php echo ($edit_detail->timezone=='EST')?"selected":" "; ?>>EST</option>
						<option value="EDT" <?php echo ($edit_detail->timezone=='EDT')?"selected":" "; ?>>EDT</option>
					</select>
                    </div>
                    
                    
                    
                    <div class="col-md-6 col-sm-6 col-xs-12 clear">
					    <label class="control-label" for="placeholder">Coupon Code<span class="required">*</span></label>
                        <input type="text" class="form-control col-md-7 col-xs-12 title" name="coupon_code" placeholder="Event Name" value="<?php echo $edit_detail->coupon_code?>">
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
					    <label class="control-label" for="placeholder">Discount<span class="required">*</span></label>
                        <input type="text" class="form-control col-md-7 col-xs-12 title" name="coupon_off" placeholder="Event Name" value="<?php echo $edit_detail->coupon_off?>">
                    </div>
                    
							
					 
					 <div class="clearfix"></div> 
					<div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-xs-12 text-right">
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
/* $(function () {
	  var posturl = '<?php echo site_url("timer-settings")?>';
		$(".AddOptions").on('submit',function(){
			$(".AddOptions").submit();
			return;
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
		
		
	}); */
</script>

<script type="text/javascript" language="javascript" src="<?php echo site_url().'assets/business_panel'?>/js/ajax-settings.js" sag_element="sag_update" ></script>
	
	
	
<!-- DatePicker JS - Add By Jk -->
	
<!-- Script for Show/Hide Type Dropdown -->
<script type="text/javascript">
$(document).ready(function(){
    $(".optiontypes").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".f-evergreen").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".f-evergreen").hide();
            }
        });
    }).change();
});
</script>
	
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/moment/moment.min.js"></script>
<script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/datepicker/daterangepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.date-picker').daterangepicker({
     singleDatePicker: true,
     calender_style: "picker_2"
  }, function(start, end, label) {
     console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>
