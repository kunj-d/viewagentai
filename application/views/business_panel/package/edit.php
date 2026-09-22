<div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$page_title?></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a data-toggle="tooltip" data-placement="top" title="Go Back" href="<?=$this->config->item('spanel_url').'manage-packages'?>"><i class="fa fa-backward"></i></a>
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
				  <form class="form-horizontal form-label-left" id="planForm" method="post">
				   <!-- Smart Wizard -->
                  <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                      <li>
                        <a href="#step-1">
                          <span class="step_no">1</span>
                          <span class="step_descr">
                                            Step 1<br />
                                            <small>Choose Apps</small>
                                        </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-2">
                          <span class="step_no">2</span>
                          <span class="step_descr">
                                            Step 2<br />
                                            <small>Provide package details</small>
                                        </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-3">
                          <span class="step_no">3</span>
                          <span class="step_descr">
                                            Step 3<br />
                                            <small>Pricing details</small>
                                        </span>
                        </a>
                      </li>
                      <li>
                        <a href="#step-4">
                          <span class="step_no">4</span>
                          <span class="step_descr">
                                            Step 4<br />
                                            <small>Review</small>
                                        </span>
                        </a>
                      </li>
                    </ul>
                    <div id="step-1">
					<!-- Step 1 data come here -->
                    </div>
                    <div id="step-2">
                     <!-- Step 1 data come here -->
                    </div>
                    <div id="step-3">
                      <!-- Step 1 data come here -->
                    </div>
                    <div id="step-4">
                     <!-- Step 1 data come here -->
                    </div>

                  </div>
                  <!-- End SmartWizard Content -->
				  </form>

                   
					
					

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
  <!-- form wizard -->
  <script type="text/javascript" src="<?=$this->config->item('adminAssetsPath')?>js/wizard/jquery.smartWizard.js"></script>
		<script type="text/javascript">
    $(document).ready(function() {
      // Smart Wizard
      $('#wizard').smartWizard();

      function onFinishCallback() {
        $('#wizard').smartWizard('showMessage', 'Finish Clicked');
        alert('Finish Clicked');
      }
    });
	var page_type = '<?=$page_type?>';
	var detail = '<?=$detail?>';
  </script>