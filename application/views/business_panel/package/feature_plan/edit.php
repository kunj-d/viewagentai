<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-feature-plans'?>"><i class="fa fa-backward"></i></a>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plan_name">Plan Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="plan_name" required="required" class="form-control col-md-7 col-xs-12" name="plan_name" value="<?=$plan_name?>">
                      </div>
                    </div>
                    
					
					
				<div class="form-group">
					  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_type" style="padding:0px">Features <span class="required">*</span></label>
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <ul class="to_do">
					  <?php foreach($appList as $valApp) { ?>
                        <li>
						  <h2> <?=$valApp->app_name?> <i class="fa fa-arrow-circle-down"></i></h2>
						  <?php foreach($valApp->feature_list as $valF) { ?>
                          <p style="margin-bottom: 6px;margin-left: 60px;">
                            <input type="checkbox" class="flat" value="<?=$valF->id?>" name="feature_ids[]" <?php if(in_array($valF->id,$feature_ids)){ ?> checked="checked" <?php } ?>> <?=$valF->feature?> </p>
						  <?php } ?>
                        </li>
						<?php } ?>
                      </ul>
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
