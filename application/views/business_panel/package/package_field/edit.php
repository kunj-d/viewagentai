<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-package-fields'?>"><i class="fa fa-backward"></i></a>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose App <span class="required">*</span></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_single form-control" tabindex="-1" name="app_id">
						<?php foreach($appList as $valApp) { ?>
                          <option value="<?=$valApp->id?>" <?php if($valApp->id==$app_id){ ?> selected="selected" <?php } ?>><?=$valApp->app_name?></option>
						<?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Field Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="field_name" required="required" class="form-control col-md-7 col-xs-12" name="field_name" value="<?=$field_name?>">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="condition_val">Condition Value <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="condition_val" required="required" class="form-control col-md-7 col-xs-12" name="condition_val" value="<?=$condition_val?>">
                      </div>
                    </div>
					
					<div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="overages" style="padding:0px">Overages <span class="required">*</span></label>
					  <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="radio" id="overages" class="form-control col-md-7 col-xs-12 flat" name="overages" value="yes" <?php if($overages=='yes') { ?> checked="checked" <?php } ?>> &nbsp; Yes &nbsp;
						<input type="radio" id="overages" class="form-control col-md-7 col-xs-12 flat" name="overages" value="no" <?php if($overages=='no') { ?> checked="checked" <?php } ?>> &nbsp; No &nbsp;
					  </div>
				</div>
	
					<div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Input Type <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_single form-control input_type" tabindex="-1" name="input_type">
                          <option value="text" <?php if($input_type=='text'){ ?> selected="selected" <?php } ?>>Text Box</option>
                          <option value="select" <?php if($input_type=='select'){ ?> selected="selected" <?php } ?>>Select Box</option>
                        </select>
                      </div>
                    </div>
					
					<div class="form-group input_val" style="display:<?php if($input_type=='select'){ ?> block <?php } else { ?>none <?php } ?>">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="input_val">Input Value <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="tags_1" type="text" class="tags form-control" value="<?=$input_val?>" name="input_val" />
                      </div>
                    </div>
					<div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_type" style="padding:0px">Field Type <span class="required">*</span></label>
					  <div class="col-md-6 col-sm-6 col-xs-12">
						<input type="radio" id="field_type" class="form-control col-md-7 col-xs-12 flat" name="field_type" value="data" <?php if($field_type=='data') { ?> checked="checked" <?php } ?>> &nbsp; Data &nbsp;
						<input type="radio" id="field_type" class="form-control col-md-7 col-xs-12 flat" name="field_type" value="validity" <?php if($field_type=='validity') { ?> checked="checked" <?php } ?>> &nbsp; Validity &nbsp;
						<input type="radio" id="field_type" class="form-control col-md-7 col-xs-12 flat" name="field_type" value="none" <?php if($field_type=='none') { ?> checked="checked" <?php } ?>> &nbsp; None &nbsp;
					  </div>
				</div>
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
  </script>
  <!-- /form validation -->
   <!-- select2 -->
  <link href="<?=$this->config->item('adminAssetsPath')?>css/select/select2.min.css" rel="stylesheet">
  <!-- select2 -->
  <script src="<?=$this->config->item('adminAssetsPath')?>js/select/select2.full.js"></script>
   <script>
    $(document).ready(function() {
      $(".select2_single").select2({});
    });
  </script>
  <!-- tags -->
  <script src="<?=$this->config->item('adminAssetsPath')?>js/tags/jquery.tagsinput.min.js"></script>
  <!-- input tags -->
  <script>
    function onAddTag(tag) {
      alert("Added Value: " + tag);
    }

    function onRemoveTag(tag) {
      alert("Removed Value: " + tag);
    }

    function onChangeTag(input, tag) {
      alert("Changed Value: " + tag);
    }

    $(function() {
      $('#tags_1').tagsInput({
        width: 'auto'
      });
    });
  </script>
  <!-- /input tags -->
  <script>
  $('.input_type').on('change', function(event){
  var input_type = $(this).val();
  if(input_type=='text')
   {   $('input#tags_1').val('');
       $('.input_val').hide('slow'); }
  else { $('.input_val').show('slow'); }
  });
  </script>
