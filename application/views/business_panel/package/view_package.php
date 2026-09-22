<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">
        Package detail</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <!-- price element -->
                      <div class="pricing">
                          <div class="title">
                            <h2><?=$detail->title?></h2>
							<?php if($detail->plan_type=='free') { ?>
                            <h1>free</h1>
							<?php } else { ?>
							<h1>$ <?=$detail->price?></h1>
							<?php } ?>
                          </div>
                          <div class="x_content">
						  <div class="col-md-4 col-sm-6 col-xs-12">
						   <h3>APPS <i class="fa fa-arrow-down"></i></h3>
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
								<?php  $fieldsdata = unserialize($detail->fields);
								       foreach($fieldsdata as $key=>$val) { 
									   $app_name = $this->Common_Modal->getSingleFieldFromAnyTable('app_name','id',$key,'tbl_apps');
									   ?>
									 <h3> <?=$app_name?> </h3> 
									  <?php foreach($val as $key1=>$val1) {
									   $fieldsdetail = $this->Package_Model->getPackageFieldDetail($key1);
									   ?>
		 
                                  <li><i class="fa fa-check text-success"></i> <?=$fieldsdetail->field_name?> <strong> <?=$fieldsdata[$fieldsdetail->app_id][$fieldsdetail->id][0]?> <?=($fieldsdetail->field_type!='none'?$fieldsdata[$fieldsdetail->app_id][$fieldsdetail->id][1]:'')?></strong></li>
								  <?php }  } ?>
                                </ul>
								
                              </div>
                            </div>
						  </div>
						   <?php $overages = unserialize($detail->overages); 
						   if($overages) { ?>
						  <div class="col-md-4 col-sm-6 col-xs-12">
							<h3>OVERAGES <i class="fa fa-arrow-down"></i></h3>
                            <div class="pricing_features">
							<ul class="list-unstyled text-left">
                             
							  <?php foreach($overages as $key2=>$valOv) { ?>
							  <?php $appDetail = $this->Package_Model->getPackageFieldAndAppNameBYid($key2); ?>
							   <li> <h4><?=$appDetail->field_name?> ( <?=$appDetail->app_name?> )</h4>
							      <?php for($i=0;$i<sizeof($valOv['data']);$i++) { ?>
							       <strong> <?=$valOv['data'][$i]?> <?=$valOv['data_type'][$i]?>  
									Price : $ <?=$valOv['price'][$i]?> / <?=$valOv['data_price'][$i]?></strong>
							      <?php } ?>
							  </li>
							  <?php } ?>
							  
							  
                            </div>
						  </div>
						  <?php } ?>
						  <div class="col-md-4 col-sm-6 col-xs-12">
							<h3>OTHER DETAILS <i class="fa fa-arrow-down"></i></h3>
							<div class="pricing_features">
							
							<ul class="list-unstyled text-left">
							   <li>Features - <strong><?=$detail->plan_name?></strong></li>
							   <li>Sell Type - <strong><?=$detail->sell_type?></strong></li>
                            </div>
						  </div>
                          </div>
                        </div>
               <!-- price element -->
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