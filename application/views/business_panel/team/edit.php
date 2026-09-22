<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-users'?>"><i class="fa fa-backward"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if(validation_errors() || $img_error) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span>
                  </button><?=validation_errors()?> <br /> <?=$img_error?></div>
				<?php } ?>
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12" name="name" value="<?=$name?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email" value="<?=$email?>">
                      </div>
                    </div>
					<?php if($page_name=='add'){?>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12" name="password" value="">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm_pass">Confirm Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="confirm_pass" required="required" class="form-control col-md-7 col-xs-12" name="confirm_pass" value="">
                      </div>
                    </div>
					<?php } ?>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="phone" required="required" class="form-control col-md-7 col-xs-12" name="phone" value="<?=$phone?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Department <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="department" required="required" class="form-control col-md-7 col-xs-12" name="department" value="<?=$department?>">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile_image">Profile Image <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" id="profile_image" <?php if($page_name=='add'){?> required="required" <?php } ?> class="form-control col-md-7 col-xs-12" name="profile_image" value="<?=$profile_image?>">
                      </div>
                    </div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<br />
					<?php if($edit_per=='yes' || $page_name=='add') { ?>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="privileges">Assign privileges <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
              <ul style="list-style:none;">
			  
				 <?php foreach($allManagers as $valMngr) { ?>
					   <li><a href="javascript:" class="btn btn-success btn-sm managerLi"><i class="fa <?=$valMngr->class_name?>"></i> &nbsp;<?=$valMngr->manager_name?>&nbsp;<i class="fa fa-chevron-down"></i></a>
					   
							   <?php $submanagers	=	$valMngr->subManagers; ?>
								<ul style="list-style:none; display:<?php if(in_array($valMngr->mng_id,$selectArray)) { echo 'block'; } else { echo 'none'; } ?>" class="submanagersUl">
									 <?php foreach($submanagers as $valSub) { ?>
									  <li>
									  <input type="checkbox" class="submanagerCheckbox flat" name="managers[]" id="<?=$valSub->mng_id?>"  value="<?=$valSub->mng_id?>" <?php if($valSub->selected == 'yes') { ?> checked="checked" <?php } ?> /> <label for="<?=$valSub->mng_id?>" style="cursor:pointer;"> <?=$valSub->manager_name?></label>
									  
										  <?php if($valSub->permission!='0'){  ?>
										  <?php $permissions	=	explode(',',$valSub->permission); ?>
											  <ul style="list-style:none; display:<?php if(in_array($valSub->mng_id,$allowed)) { echo 'block'; } else { echo 'none'; } ?>" class="permissionUl">
												 <?php foreach($permissions as $valPer) { ?>
													  <li>
													        <input type="checkbox" class="flat" name="permission[<?=$valSub->mng_id?>][]"   value="<?=$valPer?>" <?php if(in_array($valPer,$permission[$valSub->mng_id])) { ?> checked="checked" <?php } ?> /> <label  style="cursor:pointer;"> <?=$valPer?></label>
													  </li>
												   <?php } ?>
											  </ul>
										  <?php } ?>
									  
									  </li>
									  <?php } ?>
								</ul>
						  
					   </li>
				 <?php } ?>
				 
			  </ul>
                      </div>
                    </div>
					
					<?php } ?>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
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
	<!-- form validation -->
  <script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/parsley/parsley.min.js"></script>

		  <!-- form validation -->
  <script type="text/javascript">

    $(document).ready(function() {
      $.listen('parsley:field:validate', function() {
        validateFront();
      });
      $('#demo-form2 .btn').on('click', function() {
        $('#demo-form2').parsley().validate();
        validateFront();
      });
      var validateFront = function() {
        if (true === $('#demo-form2').parsley().isValid()) {
          $('.bs-callout-info').removeClass('hidden');
          $('.bs-callout-warning').addClass('hidden');
        } else {
          $('.bs-callout-info').addClass('hidden');
          $('.bs-callout-warning').removeClass('hidden');
        }
      };
    });
    try {
      hljs.initHighlightingOnLoad();
    } catch (err) {}

$('body').delegate(".managerLi", 'click', function() {
    $(this).parent().find('.submanagersUl').toggle('slow');
});
$('body').delegate(".icheckbox_flat-green", 'click', function() {
    $(this).parent().find('.permissionUl').toggle('slow');
});
$('.submanagerCheckbox').on('ifChecked', function(event){
  $(this).parent().parent().find('.permissionUl').show('slow');
});
$('.submanagerCheckbox').on('ifUnchecked', function(event){
  $(this).parent().parent().find('.permissionUl').hide('slow');
  $(this).parent().parent().find('input').iCheck('uncheck');
});
  </script>
  <!-- /form validation -->
