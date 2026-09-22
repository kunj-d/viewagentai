<!-- icheck -->
<script src="<?=$this->config->item('adminAssetsPath')?>js/custom.js"></script>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        <?=$detail->name?>'s detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Personal Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <table class="table">
                <thead>
                  <tr>
                    <th>Name :</th>
                    <th><?=$detail->name?></th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>Email :</th>
                    <th><?=$detail->email?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Phone :</th>
                    <th><?=$detail->phone?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Department :</th>
                    <th><?=$detail->department?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Status :</th>
                    <th><?=$detail->status?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Created By :</th>
                    <th><?=$this->Common_Modal->getSingleFieldFromAnyTable('name','id',$detail->id,'tbl_sag_user')?></th>
                  </tr>
                </thead>
				<thead>
                  <tr>
                    <th>Add Time :</th>
                    <th><?=date($this->config->item('Reading_date_time_format'),$detail->add_time)?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
		<div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
		   <div class="x_title">
                  <h2>Access Detail</small></h2>
                  <div class="clearfix"></div>
                </div>
            <div class="x_content">
              <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="privileges">privileges 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
              <ul style="list-style:none;">
			  
				 <?php foreach($allManagers as $valMngr) { ?>
					   <li><a href="javascript:" class="btn btn-success btn-sm managerLi"><i class="fa <?=$valMngr->class_name?>"></i> &nbsp;<?=$valMngr->manager_name?>&nbsp;<i class="fa fa-chevron-down"></i></a>
					   
							   <?php $submanagers	=	$valMngr->subManagers; ?>
								<ul style="list-style:none; display:<?php if(in_array($valMngr->mng_id,$selectArray)) { echo 'block'; } else { echo 'none'; } ?>" class="submanagersUl">
									 <?php foreach($submanagers as $valSub) { ?>
									  <li>
									  <input type="checkbox" class="submanagerCheckbox flat" name="managers[]" id="<?=$valSub->mng_id?>"  value="<?=$valSub->mng_id?>" <?php if($valSub->selected == 'yes') { ?> checked="checked" <?php } ?> disabled="disabled" /> <label for="<?=$valSub->mng_id?>" style="cursor:pointer;"> <?=$valSub->manager_name?></label>
									  
										  <?php if($valSub->permission!='0'){  ?>
										  <?php $permissions	=	explode(',',$valSub->permission); ?>
											  <ul style="list-style:none; display:<?php if(in_array($valSub->mng_id,$allowed)) { echo 'block'; } else { echo 'none'; } ?>" class="permissionUl">
												 <?php foreach($permissions as $valPer) { ?>
													  <li>
													        <input type="checkbox" class="flat" name="permission[<?=$valSub->mng_id?>][]"   value="<?=$valPer?>" <?php if(in_array($valPer,$permission[$valSub->mng_id])) { ?> checked="checked" <?php } ?> disabled="disabled"/> <label  style="cursor:pointer;"> <?=$valPer?></label>
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
            </div>
          </div>
        </div>
		
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>