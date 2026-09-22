
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
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">			
					
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="title" class="form-control col-md-7 col-xs-12 name" name="title" value="<?php echo $detail['title']; ?>">
                      </div>
					  <label class="control-label col-md-1 col-sm-1 col-xs-12" for="value">Value <span class="required">*</span>
                      </label>
					  <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="value" class="form-control col-md-7 col-xs-12 value" name="value" value="<?php echo $detail['value']; ?>">
                      </div>
                    </div>
					
					<div class="form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
						<select name="type" class="form-control col-md-7 col-xs-12">
						 						  
							 <option value="T" <?php echo $detail['type']=='T' ? 'selected' :'' ?>>text</option>
							 <option value="S" <?php echo $detail['type']=='S' ? 'selected' :'' ?>>selectbox</option>
							 <option value="R" <?php echo $detail['type']=='R' ? 'selected' :'' ?>>radio</option>
							 <option value="C" <?php echo $detail['type']=='C' ? 'selected' :'' ?>>checkbox</option>
							 <option value="I" <?php echo $detail['type']=='I' ? 'selected' :'' ?>>image</option>
							 <option value="TA" <?php echo $detail['type']=='TA' ? 'selected' :'' ?>>textarea</option>
							 <option value="DP" <?php echo $detail['type']=='DP' ? 'selected' :'' ?>>datepicker</option>
							 <option value="TP" <?php echo $detail['type']=='TP' ? 'selected' :'' ?>>datetimepicker</option>
							 <option value="CP" <?php echo $detail['type']=='CP' ? 'selected' :'' ?>>datetimepicker</option>
							 
						</select>
                      </div>
					
                      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="placeholder">Placeholder <span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" id="placeholder" class="form-control col-md-7 col-xs-12" name="placeholder" value="<?php echo $detail['placeholder']; ?>">
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

