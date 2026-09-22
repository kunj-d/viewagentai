<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if(validation_errors()) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                  </button><?=validation_errors()?></div>
				<?php } ?>
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">	
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Display Name <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" id="display_title" class="form-control col-md-7 col-xs-12 title" placeholder="Enter Name" name="server_name" value="<?php echo $get_detail->name?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" >Type <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" id="title" class="form-control col-md-7 col-xs-12 title" name="server_type" placeholder="Enter Server Type" value="<?php echo $get_detail->type;?>">
                      </div>
                    </div>
					
					<div class="form-group">
						<div class="added_rows col-md-12 col-sm-12 col-xs-12" >
					<?php  
					$i=0;
					foreach($Sending_server_fields as $value) {
					?>
						<div class="form-group field_list" >
							<input type="hidden" id="credential_id[]" class="form-control col-md-4 col-xs-12 " name="credential_id[]" placeholder="Placeholder" value="<?php echo $value->id;?>">						
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="credential_title">Credential Field <span class="required">*</span>
							</label>
							<div class="col-md-8 col-sm-6 col-xs-12">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="form-group field_list" >
										<input type="text" id="credential_title[]" class="form-control col-md-4 col-xs-12" name="credential_title[]" placeholder="Title" value="<?php echo $value->title;?>">
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
										<div class="form-group field_list" >
											<input  type="text" id="credential_name[]" class="form-control col-md-4 col-xs-12 ServerfieldName" name="credential_name[]" placeholder="Field Name" value="<?php echo $value->name?>">
										</div>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12">
										<div class="form-group field_list" >
											<input type="text" id="credential_default_value[]" class="form-control col-md-4 col-xs-12" name="credential_default_value[]" placeholder="Default value" value="<?php echo $value->field_value?>">
										</div>
									</div>
									<div class="col-md-2 col-sm-12 col-xs-12" >
										<div class="form-group field_list" >
											<input type="text" id="credential_order[]" class="form-control col-md-4 col-xs-12 " name="credential_order[]" placeholder="Sorting Order" value="<?php echo $value->sorting_order?>">
										</div>
									</div>	
									
									
									<div class="col-md-3 col-sm-12 col-xs-12">
										<div class="form-group field_list" >
											<select id="<?=$i?>" name="credential_input[]" name="credential_input[]" class="form-control col-md-4 col-xs-12 inputClass">
												<option value="text" <?php echo $value->input_type=='text' ? 'selected':''?>>Text</option>
												<option value="select" <?php echo $value->input_type=='select' ? 'selected':''?>>Select</option>
																						
											</select>
										</div>
									</div>	
									<div class="col-md-5 col-sm-12 col-xs-12 option_<?=$i?>" style="display:<?php echo $a = ($value->input_value=='')?'none':'';?>">
										<div class="form-group field_list" >
											<input type="text" id="credential_options[]" class="form-control col-md-4 col-xs-12 " name="credential_options[]" placeholder="Enter Options (Comma Seprately)" value="<?php echo $value->input_value?>">
										</div>
									</div>
									<div class="col-md-5 col-sm-12 col-xs-12 placeholder_<?=$i?>" style="display:<?php echo $a = ($value->input_value=='')?'':'none';?>">
										<div class="form-group field_list" >
											<input type="text" id="credential_placeholder[]" class="form-control col-md-4 col-xs-12 " name="credential_placeholder[]" placeholder="Placeholder" value="<?php echo $value->placeholder?>">
										</div>
									</div>									
									
								
							</div>
							<div class="col-md-1 col-sm-3 col-xs-12">
								<button type="button" class="btn btn-success remove">Remove</button>
							</div>
							
						</div>
					<?php 
					$i=$i+1;
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
							<select name="server_status" id="server_status" class="form-control col-md-7 col-xs-12">
								<option value="active" <?php if(isset($get_detail->status)) { echo $get_detail->status=='active'? 'selected':'' ;} ?>>Active</option>
								<option value="inactive" <?php if(isset($get_detail->status)) { echo $get_detail->status=='inactive'? 'selected':'' ;}?>>Inactive</option>
							</select>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type"> <span class="required"></span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
						<span class="form_success form_success_message text-success"><?php if($this->session->flashdata('success')) { echo $this->session->flashdata('success'); } ?></span>
                      </div>
                    </div>
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 ">
                      <a href="#" class="btn btn-success btnSUBMIT">Submit</a>
                      <input style="display:none" type="submit" class="btn btn-success btnFormSUBMIT" >
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
		$(document).on("click", ".btnSUBMIT",function(){
			var inputs = $(".ServerfieldName");
			for(var i = 0; i < inputs.length; i++){
					if($(inputs[i]).val()=='server_type'){
					PNotify.removeAll();
					new PNotify({
									title: 'Error',
									text: 'Value server_type is Reserved !',
									type: 'error'
									});
					e.preventDefault();
					}
			}
			$('.btnFormSUBMIT').click();
		});
	
	
var i=0,j=100;
	$(document).on("click", ".addmore",function(){
		// var $clone=$(".field_list:first").clone();
		// console.log($clone);
		
		$clone='<div class="form-group field_list" ><input type="hidden" id="credential_id[]" class="form-control col-md-4 col-xs-12 " name="credential_id[]" placeholder="Placeholder" value=""><label class="control-label col-md-3 col-sm-3 col-xs-12" for="credential_title">Credential Field <span class="required">*</span></label><div class="col-md-8 col-sm-6 col-xs-12"><div class="col-md-3 col-sm-12 col-xs-12"> <div class="form-group field_list"><input required type="text" id="credential_title[]" class="form-control col-md-4 col-xs-12" name="credential_title[]" placeholder="Title" value=""></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group field_list" ><input required type="text" id="credential_name[]" class="form-control col-md-4 col-xs-12 ServerfieldName " name="credential_name[]" placeholder="Field Name" value=""></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group field_list"> <input type="text" id="credential_default_value[]" class="form-control col-md-4 col-xs-12" name="credential_default_value[]" placeholder="Default value" value=""></div></div><div class="col-md-2 col-sm-12 col-xs-12" ><div class="form-group field_list" ><input required type="text" id="credential_order[]" class="form-control col-md-4 col-xs-12 " name="credential_order[]" placeholder="Sorting Order" value=""></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group field_list" ><select id="'+j+'" name="credential_input[]" name="credential_input[]" class="form-control col-md-4 col-xs-12 inputClass"><option value="text">Text</option><option value="select" >Select</option></select></div></div><div style="display:none" class="col-md-5 col-sm-12 col-xs-12 option_'+j+'" ><div class="form-group field_list" ><input type="text" id="credential_options[]" class="form-control col-md-4 col-xs-12 " name="credential_options[]" placeholder="Enter Options (Comma Seprately)" value=""></div></div><div class="col-md-5 col-sm-12 col-xs-12 placeholder_'+j+'"> <div class="form-group field_list"><input type="text" id="credential_placeholder[]" class="form-control col-md-4 col-xs-12 " name="credential_placeholder[]" placeholder="Placeholder" value=""></div></div></div><div class="col-md-1 col-sm-3 col-xs-12"><button type="button" class="btn btn-success remove">Remove</button></div></div>';
		$('.added_rows').append($clone);
		i++;
		j++;
		
	});
	$(document).on("click", ".remove",function(){
			$(this).closest(".field_list").remove();
			i--;
		
	});
	$(document).on("change", ".inputClass",function(){
			$(".option_"+this.id).toggle();
			$(".placeholder_"+this.id).toggle();
			
	});
	

});
</script>
