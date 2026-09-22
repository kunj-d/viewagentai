<div class="tab-pane fade <?php echo $active_tab=="pinecone"? 'in active show':'' ;?>" id="pinecone" role="tabpanel" aria-labelledby="pinecone">
   
    <div class="row">
        <?php if($all_pinecone){
        foreach ($all_pinecone as $key => $profile) {
            $fields = $profile->autoresponder_fields;
        ?>
            <div class="col-12 col-md-4 mt-4">
                <div class="tab-box">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $profile->autoresponder_id ?>" />
                        <input type="hidden" name="autoresponder_title" value="<?php echo $profile->title ?>" />
                        <input type="hidden" name="autoresponder_display_title" value="<?php echo $profile->display_title ?>" />
                        <input type="hidden" name="active_pos" value="<?php echo $key; ?>" />
                        <input type="hidden" name="active_tab" value="pinecone" />

                        <img src="<?php echo $autoresponders_image_folder . $profile->logo; ?>" alt="GetGist" class="mx-auto d-block img-fluid">
                        <div class="mt10 tab-heading"> <?php echo $profile->display_title; ?></div>
                        <!--<div class="mt10 tab-para">-->
                        <!--    Not Integrated-->
                        <!--</div>-->
                        <div class="mt20 integration">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <?php if($profile->display_title != 'Recharge Credit'){ ?>
                                    <button id="btnGroupDrop1" type="button" class="btn theme-btn-blue dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                       Integrate
                                    </button>
                                    <?php }else{ ?>
                                     <button  type="button" class="btn theme-btn-blue dropdown-toggle"data-bs-toggle="modal" data-bs-target="#RechareModal">
                                       Recharge
                                    </button>
                                    <?php } ?>
                                    <?php if($profile->display_title != 'Recharge Credit'){ ?>
                                    <ul class="dropdown-menu <?php if (isset($error_title) && $error_title == $profile->title) { echo 'show'; } ?>" id="user_popup<?= $profile->autoresponder_id; ?>" aria-labelledby="btnGroupDrop1" style="overflow:scroll;">
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
                                            <div class="form-group ng-scope mt10 text-center">
                                                <label for="title" class="f-14 d-gblue-clr ng-binding"> <?php echo $field->display_title; ?></label>
                                                    <input type="<?php echo $field->field_type; ?>" value="<?php if ($field_value) {
                                                                                                                echo $field_value;
                                                                                                            } ?>" name="<?php echo $field->field_name; ?>" class="form-control field-h40 f-14 ng-pristine ng-untouched ng-valid ng-empty" placeholder="<?php echo $field->placeholder; ?>">
                                            </div>
                                            <div class="col-lg-3 col-md-2 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt5px">
                                                <?php if ($profile->autoresponder_id == 9 && $field->field_name == 'api_subdomain') {
                                                    echo ".sendlane.com";
                                                } ?>
                                            </div>

                                        <?php } ?>
                                        <?php if ($profile->autoresponder_id == 39) { ?>
                                            <div class="col-lg-8 col-md-3 col-xs-12 md16 sm15 xs15 mt8px xsmt10px">
                                                Watch How to Free Signup & Get Pinecone API Key – <p><a href="https://www.youtube.com/watch?v=tJUeMxOJ0dI" target="_blank">Click here</a></p>
                                            </div>
                                         
                                        <?php } ?>
                                        <?php if (isset($error_title) && $error_title == $profile->title) { ?>
                                            <div class="col-xs-12 padding0 mb30px xsmb15px">
                                                <div class="form-group">
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"></div>
                                                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt5px">
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
                                    <?php } ?>
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
</div>

<div class="modal fade confirm-del" id="RechareModal" tabindex="-1" aria-labelledby="saveConversationAssetsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="saveConversationAssetsLabel">Recharge Your Intelimateai Credits</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="row row-cols-1 row-cols-md-3 mt20 mt-md0">
            <div class="col mt20 mt-md30">
              <div class="folder-wall">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Intelimateai.png" class="mx-auto d-block img-fluid" style="height:100%;">
                  </a>
                  
                </div>
                <h5 class="modal-title mt20 text-center" id="">Intelimateai 10K Credit Plan - $10</h5>
                  <div class="mt20 text-center">
                    <a href="https://jvz3.com/c/1188867/401180/" class="theme-btn-blue" target="_blank">Recharge Now </a>
                  </div>
                
              </div>
            </div>
            <div class="col mt20 mt-md30">
              <div class="folder-wall">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Intelimateai.png" class="mx-auto d-block img-fluid" style="height:100%">
                  </a>
                  
                </div>
                <h5 class="modal-title mt20 text-center" id="">Intelimateai 20K Credit Plan - $18</h5>
                  <div class="mt20 text-center">
                    <a href="https://jvz3.com/c/1188867/401180/" class="theme-btn-blue" target="_blank">Recharge Now </a>
                  </div>
               
              </div>
            </div>
            <div class="col mt20 mt-md30">
              <div class="folder-wall">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Intelimateai.png" class="mx-auto d-block img-fluid" style="height:100%">
                  </a>
                  
                </div>
                <h5 class="modal-title mt20 text-center" id="">Intelimateai 30K Credit Plan - $24</h5>
                  <div class="mt20 text-center">
                    <a href="https://jvz3.com/c/1188867/401180/" class="theme-btn-blue" target="_blank">Recharge Now </a>
                  </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ---tab-pane---conversation End -->
    </div>
  </div>
</div>

