<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?php //$page_title ?></h2>
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
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">			
					
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="title" class="form-control col-md-7 col-xs-12 name" name="title" value="">
                      </div>
                    </div>
					
					<div class="form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
						<select name="type" class="form-control col-md-7 col-xs-12 type">
						 	<option value="">Choose</option>				  
							 <option value="T">text</option>
							 <option value="S">selectbox</option>
							 <option value="R">radio</option>
							 <option value="C">checkbox</option>
							 <option value="I">image</option>
							 <option value="TA">textarea</option>
							 <option value="DP">datepicker</option>
							 <option value="TP">datetimepicker</option>
							 <option value="CP">datetimepicker</option>
							 
						</select>
                      </div>
                    </div>
					
					<div class="field_type T">
					<div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">Value <span class="required">*</span>
                      </label>
					  <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="value" class="form-control col-md-7 col-xs-12 value" name="value" value="">
                      </div>		
                      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="placeholder">Placeholder <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="placeholder" class="form-control col-md-7 col-xs-12" name="placeholder" value="">
                      </div>
                    </div>
					
					</div>
					
					<div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<div class="field_type S">
						<a href="javascript:void(0)" class="add-more" data-elementClass="S">Add More</a>
						<div class="options options_list_S">
							<input class="setNameKey" type="text" name="option_title[0]" placeholder="option title" onkeyup="$(this).parent(options).find('input[type=radio]').val(this.value)">
							<input class="setNameKey" type="radio" name="option_default"  value="">
							<a href="javascript:void(0)" class="remove" data-elementClass="S">Remove</a>
						</div>
					</div>
					<input type="hidden" value="0" id="N">
					</div>
					</div>
					
					<div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<div class="field_type R">
								<a href="javascript:void(0)" class="add-more" data-type="R">Add More</a>
								<div class="options options_list_R">
									<input type="text" name="option[0]"  placeholder="option title">
									<input type="radio" name="option_default_R[]">
									<button>Remove</button>
								</div>
							</div>
					  </div>
					</div>
					                  
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
$(document).ready(function(){
		$('body').on("change", '.type', function() {
			var value = $(this).val();
			$('.field_type').hide();
			$("."+$(this).val()).show();
		});
	
		$('body').on("click", '.add-more', function() {
			var type = $(this).attr('data-elementClass');
			var $clone=$(".options_list_"+type+":first").clone();
			var num = $('#N').val();
			var numinc = parseInt(num) + 1;
		
	 	$clone.find('.setNameKey').each(function() {
				var fieldName = $(this).attr("name");
				$(this).attr("name", $(this).attr("name").replace(/\d+/, numinc) );
			});
			
			 $('.'+type).append($clone);	
			 $('#N').val(numinc);			
	});

 		$(document).on("click", '.remove', function() {
			var num = $('#N').val();
			//alert(num); //return false;
			if(num!= 0){
			$(this).parents('.options').remove();
			var numdec = parseInt(num) - 1;
			$('#N').val(numdec);
			}
			
			
		});	
});

</script>
<style>
.field_type{
	display:none;
}
</style>
