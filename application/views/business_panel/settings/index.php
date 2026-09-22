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
						 <label class="control-label" for="title">Value</label>
							<input type="text" id="value" class="form-control col-md-7 col-xs-12 title"  placeholder="Enter Value" name="value" value="<?php echo $value;?>">
						 
                      </div>
					  
					  
					  <div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="title">Type <span class="required">*</span></label>
                       
							<select name="type" class="form-control col-md-7 col-xs-12 OptionType">
							   <option value="">Select</option>
							   <option value="textbox" <?php if($type=="textbox"){ echo "selected";}?>>textbox</option>
							   <option value="textarea" <?php if($type=="textarea"){ echo "selected";}?>>textarea</option>
								<option value="dropdown" <?php if($type=="dropdown"){ echo "selected";}?>>dropdown</option>
								<option value="radio" <?php if($type=="radio"){ echo "selected";}?>>radio</option>
								<option value="checkbox" <?php if($type=="checkbox"){ echo "selected";}?>>checkbox</option>
								<option value="file" <?php if($type=="file"){ echo "selected";}?>>file</option>
							</select>
							<span class="TypeError error"></span>
                      </div>
                  
				  
				  
					<div class="col-md-6 col-sm-6 col-xs-12">
						 <label class="control-label" for="placeholder">Placeholder
                      </label>
                         <input type="text" id="placeholder"  placeholder="Enter Placeholder" class="form-control col-md-7 col-xs-12 placeholder" name="placeholder" value="<?php echo $placeholder?>">
						<span class="valueError error"></span>
                      </div>
					 
					<div class="col-md-6 col-sm-6 col-xs-12"> 
						<div class="total_options" id="total_options">
								<button type="button" class="sag_add" sag_element="element1" sag_max_limit="100" sag_container="total_options" sag_model="OptionName">Add Option</button>
								<div class="col-lg-6">Options</div>
								<div class="col-lg-3">Default</div>
								<div class="clearfix"></div>
								<?php 
								foreach($options as $key =>$option){
								
								?>
								 <div class="element1">
										<p  class="sag_count"></p>
										<div class="col-lg-6"><input class="form-control FormInput" placeholder="Enter Value" name="OptionName[]" value="<?php echo $option;?>"></div>
										<div class="col-lg-3 "><input type="radio"  name="radio_input" value="<?php echo $key;?>" <?php if($default_option==$option){ echo 'checked';}?> />&nbsp;&nbsp;<input type="button" value="X" class="sag_remove" value="<?php echo $site_settings->title;?>" sag_container="total_options" sag_model="OptionName" sag_element="element1" />
										</div>
										<div class="clearfix"></div>
								</div>
								<?php
								}?>
						</div>
						 
					</div>
					
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
 

<script type="text/javascript" language="javascript" src="<?php echo site_url().'assets/dashboard'?>/js/ajax.js" sag_element="sag_update" ></script>
