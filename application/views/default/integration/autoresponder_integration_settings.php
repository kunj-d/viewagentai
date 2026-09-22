<div class="tab-pane fade show <?php echo $active_tab == "autoresponder" ? 'in active show' : ''; ?>" id="autoresponder" role="tabpanel" aria-labelledby="autoresponder">
      <?php   
    if(in_array('autoresponder_integration',$this->session->userdata('features')) ) {
    ?>
    <div class="row">
        <?php if($autoresponders){
        foreach ($autoresponders as $key => $profile) {
            // pr($profile);
            // die;
            $fields = $profile->autoresponder_fields;
        ?>
            <div class="col-12 col-md-4 mt-4">
                <div class="tab-box">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $profile->autoresponder_id ?>" />
                        <input type="hidden" name="autoresponder_title" value="<?php echo $profile->title ?>" />
                        <input type="hidden" name="autoresponder_display_title" value="<?php echo $profile->display_title ?>" />
                        <input type="hidden" name="active_pos" value="<?php echo $key; ?>" />
                        <input type="hidden" name="active_tab" value="autoresponder" />

                        <img src="<?php echo $autoresponders_image_folder . $profile->logo; ?>" alt="GetGist" class="mx-auto d-block img-fluid">
                        <?php
                        $displayTitle = '';
                        if ($profile->display_title == "Oppyo") {
                            $displayTitle = 'text-uppercase';
                        }
                        ?>
                        <div class="mt10 tab-heading <?php echo $displayTitle; ?>"> <?php echo $profile->display_title; ?></div>
                        <!--<div class="mt10 tab-para">-->
                        <!--    Not Integrated-->
                        <!--</div>-->
                        <div class="mt20 integration">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop<?php echo $profile->autoresponder_id; ?>" type="button" class="btn theme-btn-blue dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Integrate
                                    </button>
                                    <ul class="dropdown-menu <?php if (isset($error_title) && $error_title == $profile->title) { echo 'show'; } ?>" id="user_popup<?= $profile->autoresponder_id; ?>"  aria-labelledby="btnGroupDrop<?php echo $profile->autoresponder_id; ?>">
                                        <?php
                                        foreach ($fields as $field) {
                                            $field_value = "";
                                            foreach ($autoresponder_values as $value) {
                                                if ($profile->autoresponder_id == $value->autoresponder_id) {
                                                    $credential = json_decode($value->credentials);
                                                    $field_name = $field->field_name;
                                                    $field_value = $credential->$field_name;
                                                }
                                            } ?>
                                            <div class="form-group ng-scope mt10">
                                                <label for="title" class="f-14 d-gblue-clr ng-binding" <?php echo $field->display_title; ?></label>
                                                    <input type="<?php echo $field->field_type; ?>" value="<?php if ($field_value) {
                                                        echo $field_value;
                                                    } ?>" name="<?php echo $field->field_name; ?>" class="form-control field-h40 f-14 ng-pristine ng-untouched ng-valid ng-empty" 
                                                    placeholder="<?php echo $field->placeholder; ?>">
                                            </div>
                                            <div class="col-lg-3 col-md-2 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt5px">
                                                <?php if ($profile->autoresponder_id == 9 && $field->field_name == 'api_subdomain') {
                                                    echo ".sendlane.com";
                                                } ?>
                                            </div>

                                        <?php } ?>
                                        <?php if ($profile->autoresponder_id == 5) { ?>
                                            <div class="mt-2">
                                                Redirect Url
                                            </div>
                                            <div class="mt-2">
                                                <?php echo site_url('integrations-aweber'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($error_title) && $error_title == $profile->title) { ?>
                                            <div class="col-xs-12 padding0 mb30px xsmb15px">
                                                <div class="form-group">
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"></div>
                                                    <div class="mt-2">
                                                        <span class="text-danger"><?php echo $error; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="text-center mt10">
                                            <button type="button" class="f-16 base-btn default-btn cancelbutton" ng-click="popup_close('<?= $profile->autoresponder_id ?>')"><i class="btn-close"></i></button>
                                            <button type="submit" class="aweber_integration f-16 theme-btn-blue default-btn">Save
                                                API Credentials</button>

                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        <?php } } else { ?>
  					<div class="col-xs-12  mt30px xsmt25px">
  						<!--- Title Section ------->
  						<div class="col-md-12 col-sm-12 col-xs-12 padding0">
  							<div class="row">
  								<div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3 mt-5">


  									<div class="col-xs-12 padding0 ">


  										<img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-fluid mx-auto d-block img-responsive center-block mt6 xsmt6">
  										<div class="md16 sm15 xs15 w600 text-center mt1 xsmt2 mt-2">No Record Found</div>
  										<!--div class="text-center mt1 xsmt2">
                                    <?= $buy_new_product_btn ?>
                                </div-->
  									</div>


  								</div>


  							</div>
  						</div>
  						<!--- Title Section end----->
  					</div>
  					<!-- No Record Found End -->
  				<?php } ?>
    </div>
    
    
     <?php } else { ?>
                    <div class="col-xs-12 padding0 mt20 mt-md50">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 ">
								<div class="col-xs-12 tab-content text-center">
									<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12 mt2 xsmt2 mb5 xsmb5">
										<img src="<?php echo $this->config->item("assetsTemplatePath"); ?>images/logo.png" class="img-fluid d-block mx-auto integration-logo">
										<div class="title-line mt20">Please Upgrade Your Plan To Use This Feature</div>
											<div class="base-btn theme-btn-blue mt20">
												<a href="<?php echo site_url("subscription");?>" class="newstory-btn" style="color:#fff;">Upgrade Now</a>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
    <?php } ?>
</div>