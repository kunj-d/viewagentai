<?php if($step_number==1) { ?>
<?php foreach($appList as $val) { ?>
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="pricing">
    <div class="title">
      <h2>
        <?=$val->app_name?>
      </h2>
    </div>
    <div class="x_content">
      <div class="pricing_footer">
        <input type="checkbox" id="app_id" required="required" class="form-control col-md-7 col-xs-12 flat app_id requiredField1" name="app_id[]" value="<?=$val->id?>">
      </div>
    </div>
  </div>
</div>
<?php } ?>
<script>
 if ($("input.flat")[0]) {
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}
</script>
<?php } 
else if($step_number==2) { ?>
<div class="x_content">
  <ul class="list-unstyled timeline">
    <?php foreach($app_ids as $key=>$valField){  ?>
    <li>
      <div class="block" >
        <div class="tags"> <a href="javascript:" class="tag" title="<?=$valField->app_name?>"> <span>
          <?=$valField->app_name?>
          </span> </a> </div>
        <div class="block_content">
          <?php foreach($valField->fieldList as $valF){ ?>
          <div class="jumbotron">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field-<?=$valF->id?>">
              <?=$valF->field_name?>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if($valF->input_type=='text') { ?>
                <input type="text" id="field-<?=$valF->id?>" required="required" class="form-control col-md-7 col-xs-12 requiredField2" name="fieldval[<?=$valF->app_id?>][<?=$valF->id?>][]" value="" >
                <?php } else if($valF->input_type=='select') {
	      $input_val = explode(',',$valF->input_val); ?>
                <select name="fieldval[<?=$valF->app_id?>][<?=$valF->id?>][]" required="required" class="form-control col-md-7 col-xs-12 requiredField2">
                  <?php foreach($input_val as $valI) { ?>
                  <option value="<?=$valI?>">
                  <?=$valI?>
                  </option>
                  <?php } ?>
                </select>
                <?php } ?>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <?php if($valF->field_type=='validity') { ?>
                <select name="fieldval[<?=$valF->app_id?>][<?=$valF->id?>][]" required="required" class="form-control col-md-7 col-xs-12 requiredField2">
                  <option value="day">Day</option>
                  <option value="month">Month</option>
                  <option value="year">Year</option>
                  <option value="un">Life Time</option>
                </select>
                <?php } else if($valF->field_type=='data') { ?>
                <select name="fieldval[<?=$valF->app_id?>][<?=$valF->id?>][]" required="required" class="form-control col-md-7 col-xs-12 requiredField2">
                  <option value="mb">MB</option>
                  <option value="gb">GB</option>
                  <option value="tb">TB</option>
                  <option value="un">Unlimited</option>
                </select>
                <?php } ?>
              </div>
            </div>
            <?php if($valF->overages=='yes') { ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field-overages"><a href="javascript:" class="remove_overage" onclick="remove_overage(this)"><i class="fa fa-remove"></i> </a> Overages </label>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <input type="text" id="field-overages" required="required" class="form-control col-md-7 col-xs-12 requiredField2" name="overages[<?=$valF->id?>][data][]" value="" data-inputmask="'mask': '999-999'" placeholder="data">
              </div>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <select name="overages[<?=$valF->id?>][data_type][]" required="required" class="form-control col-md-7 col-xs-12 requiredField2">
                  <option value="mb">MB</option>
                  <option value="gb">GB</option>
                  <option value="tb">TB</option>
                </select>
              </div>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <input type="text" id="field-overages" required="required" class="form-control col-md-7 col-xs-12 requiredField2" name="overages[<?=$valF->id?>][price][]" value="" placeholder="price">
              </div>
              <div class="col-md-2 col-sm-6 col-xs-12">
                <select name="overages[<?=$valF->id?>][data_price][]" required="required" class="form-control col-md-7 col-xs-12 requiredField2">
                  <option value="mb">MB</option>
                  <option value="gb">GB</option>
                  <option value="tb">TB</option>
                </select>
              </div>
            </div>
            <a href="javascript:" class="add_overage"><i class="fa fa-plus"></i> </a>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
    </li>
    <?php } ?>
  </ul>
</div>
<!-- input mask -->
<script src="<?=$this->config->item('adminAssetsPath')?>js/input_mask/jquery.inputmask.js"></script>
<!-- input_mask -->
<script>
    $(document).ready(function() {
      $(":input").inputmask();
    });
	
	$('.add_overage').on('click', function(event){
     var cont = $(this).prev('.form-group').clone().find("input").val("").end();
	 $(this).prev('.form-group').after(cont);
	 $(":input").inputmask();
});
function remove_overage(id) {

     if($(id).parent().parent().parent().find('.remove_overage').length!=1)
	 $(id).parent().parent().remove();
}
  </script>
<!-- /input mask -->
<?php } 
else if($step_number==3) { ?>
<h3> Price & other details</h3>
<div class="jumbotron">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Plan Name</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="title" required="required" class="form-control col-md-7 col-xs-12 requiredField3" name="title" value="">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="feature_plan">Feature Plan</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select name="feature_plan" required="required" class="form-control col-md-7 col-xs-12 requiredField3">
	  <?php foreach($feature_plans as $valFe) { ?>
        <option value="<?=$valFe->id?>"><?=$valFe->plan_name?></option>
	  <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plan_type" style="padding:0px">Package Type</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat plan_type requiredField3" name="plan_type" value="free">
      &nbsp;Free &nbsp;
      <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat plan_type requiredField3" name="plan_type" value="paid">
      &nbsp; Paid &nbsp; </div>
  </div>
  <div class="form-group priceDiv" style="display:none">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="price" class="form-control col-md-7 col-xs-12 requiredField3" name="price" value="">
    </div>
  </div>



  







  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sell_type" style="padding:0px">Sell Type</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="fe-0">
      &nbsp; Free &nbsp;
      <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="fe-1">
      &nbsp; Front End 1 &nbsp;
       <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="fe-2">
      &nbsp; Front End 2 &nbsp;
       <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="fe-3">
      &nbsp; Front End 3 &nbsp;
	   <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="us-1">
      &nbsp; UP Sell 1 &nbsp;
      <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="us-2">
      &nbsp; UP Sell 2 &nbsp;
	  <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="us-3">
      &nbsp; UP Sell 3 &nbsp;
	   <input type="radio" id="plan_type" class="form-control col-md-7 col-xs-12 flat requiredField3" name="sell_type" value="us-4">
      &nbsp; UP Sell 4 &nbsp;
      </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jvz_product_id">JVZoo Product Id</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="jvz_product_id" class="form-control col-md-7 col-xs-12" name="jvz_product_id" value="">
      </div>
  </div>
</div>
<script>
$('.plan_type').on('ifClicked', function(event){
  var plan_type = $(this).val();
  if(plan_type=='free')
   {   $('input#price').val('');
       $('.priceDiv').hide('slow'); }
  else { $('.priceDiv').show('slow'); }
});
 if ($("input.flat")[0]) {
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}
</script>
<?php } 
else if($step_number==4) { ?>

<div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <!-- price element -->
                      <div class="pricing">
                          <div class="title">
                            <h2><?=$alldata['title']?></h2>
							<?php if($alldata['plan_type']=='free') { ?>
                            <h1>free</h1>
							<?php } else { ?>
							<h1>$ <?=$alldata['price']?></h1>
							<?php } ?>
                          </div>
                          <div class="x_content">
						  <div class="col-md-4 col-sm-6 col-xs-12">
						   <h3>APPS <i class="fa fa-arrow-down"></i></h3>
                            <div class="">
                              <div class="pricing_features">
                                <ul class="list-unstyled text-left">
								<?php  $fieldsdata = $alldata['fieldval'];
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
						  <?php $overages = $alldata['overages']; ?>
						  <?php if($overages) { ?>
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
							  
							  </ul>
                            </div>
						  </div>
						  <?php } ?>
						  <div class="col-md-4 col-sm-6 col-xs-12">
							<h3>OTHER DETAILS <i class="fa fa-arrow-down"></i></h3>
							<div class="pricing_features">
							
							<ul class="list-unstyled text-left">
							<?php $plan_name = $this->Common_Modal->getSingleFieldFromAnyTable('plan_name','id',$alldata['feature_plan'],'tbl_feature_plans'); ?>
							   <li>Features - <strong><?=$plan_name?></strong></li>
							   <li>Sell Type - <strong><?=$alldata['sell_type']?></strong></li>
							   <li>JVZoo Product Id - <strong><?=($alldata['jvz_product_id']!=''?$alldata['jvz_product_id']:'N/A')?></strong></li>
							   </ul>
                            </div>
						  </div>
                          </div>
                        </div>
               <!-- price element -->
            </div>
          </div>
        </div>
		
      </div>

<?php } ?>
<script>
$('.app_id').on('ifClicked', function(event){
  resubmit_app = true;
});
</script>
