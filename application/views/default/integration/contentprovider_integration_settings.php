<div class="tab-pane fade <?php echo $active_tab=="contentprovider"? 'in active show':'' ;?>" id="pills-contentprovider" role="tabpanel" aria-labelledby="pills-contentprovider-tab">
   
    <div class="row">
        <?php if($all_contentprovider){
        foreach ($all_contentprovider as $key => $profile) {
            $fields = $profile->autoresponder_fields;
        ?>
            <div class="col-12 col-md-4 mt-4">
                <div class="tab-box">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $profile->autoresponder_id ?>" />
                        <input type="hidden" name="autoresponder_title" value="<?php echo $profile->title ?>" />
                        <input type="hidden" name="autoresponder_display_title" value="<?php echo $profile->display_title ?>" />
                        <input type="hidden" name="active_pos" value="<?php echo $key; ?>" />
                        <input type="hidden" name="active_tab" value="contentprovider" />

                        <img src="<?php echo $autoresponders_image_folder . $profile->logo; ?>" alt="GetGist" class="mx-auto d-block img-fluid">
                        <div class="mt10 tab-heading"> <?php echo $profile->display_title; ?></div>
                        <!--<div class="mt10 tab-para">-->
                        <!--    Not Integrated-->
                        <!--</div>-->
                        <div class="mt20 integration">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <?php if($profile->display_title != 'Recharge Credit'){ ?>
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                       Integrate
                                    </button>
                                    <?php }else{ ?>
                                     <!-- <button  type="button" class="btn btn-primary dropdown-toggle"data-bs-toggle="modal" data-bs-target="#RechareModal">
                                       Recharge
                                    </button> -->
                                    <a href="https://www.instaengineai.com/credit/" class="btn btn-primary">Recharge</a>
                                    <?php } ?>
                                    <?php if($profile->display_title != 'Recharge Credit'){ ?>
                                    <ul class="dropdown-menu <?php if (isset($error_title) && $error_title == $profile->title) { echo 'show'; } ?>" id="user_popup<?= $profile->autoresponder_id; ?>" aria-labelledby="btnGroupDrop1">
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
                                                <label for="title" class="f-14 d-gblue-clr ng-binding" <?php echo $field->display_title; ?></label>
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
                                        <?php if ($profile->autoresponder_id == 5) { ?>
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt8px xsmt10px">
                                                Redirect Url
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt5px">
                                                <?php echo site_url('integrations-aweber'); ?>
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
                                            <button type="submit" class="aweber_integration f-16 btn btn-primary default-btn">Save
                                                API Credentials</button>
                                                
                                            <button type="button" id="reset_btn_<?php echo $profile->autoresponder_id; ?>"
                                               class="aweber_reset_btn f-16 btn btn-primary default-btn"
                                                 data-id="<?php echo $profile->autoresponder_id; ?>">
                                                 Reset
                                             </button>

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
  						<div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3">


  							<div class="col-xs-12 padding0 ">


  								<img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-fluid d-block mx-auto my-3">
  								<div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
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

<div class="modal fade" id="RechareModal" tabindex="-1" aria-labelledby="saveConversationAssetsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content theme-gray">
      <div class="modal-header">
        <h5 class="modal-title" id="saveConversationAssetsLabel">Recharge Your Ai Interactive Books Credits</h6>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span class="icon-cross"></span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row mt20 mt-md0 overflow-hidden justify-content-center">
            <div class="col-md-6 mt20 mt-md30">
              <div class="folder-wall text-white h-auto">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Ebook.png" class="mx-auto d-block img-fluid" style="height:100%;">
                  </a>
                  
                </div>
                <h6 class="modal-title mt20 text-center" id="">Ai Interactive Books 10K Credit Plan - $10</h6>
                  <div class="mt20 text-center">
                    <a href="https://jvz2.com/c/10103/406047/" target="_blank" class="theme-btn-blue">Recharge Now </a>
                  </div>
                
              </div>
            </div>
            <div class="col-md-6 mt20 mt-md30">
              <div class="folder-wall text-white h-auto">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Ebook.png" class="mx-auto d-block img-fluid" style="height:100%">
                  </a>
                  
                </div>
                <h6 class="modal-title mt20 text-center" id="">Ai Interactive Books 20K Credit Plan - $18</h6>
                  <div class="mt20 text-center">
                    <a href="https://jvz2.com/c/10103/406047/" target="_blank" class="theme-btn-blue">Recharge Now </a>
                  </div>
               
              </div>
            </div>
            <div class="col-md-6 mt20 mt-md30">
              <div class="folder-wall text-white h-auto">
                <div class="btn-group dropstart dash-drop"></div>
                <div class="appoint-inner">
                  <a href="#">
                    <img src="<?= $this->config->item('assetsPath') ?>images/Ebook.png" class="mx-auto d-block img-fluid" style="height:100%">
                  </a>
                  
                </div>
                <h6 class="modal-title mt20 text-center" id="">Ai Interactive Books 30K Credit Plan - $24</h6>
                  <div class="mt20 text-center">
                    <a href="https://jvz2.com/c/10103/406047/" target="_blank" class="theme-btn-blue">Recharge Now </a>
                  </div>
                
              </div>
            </div>
          </div>
      </div>
      <!-- ---tab-pane---conversation End -->
    </div>
  </div>
</div>



<script>
$(document).ready(function() {
    $('[id^="reset_btn_"]').on('click', function() {
        var button = $(this);
        var autoresponderId = button.data('id');
        var dropdownMenu = button.closest('.dropdown-menu');
        var hasValue = false;
        dropdownMenu.find('input').each(function() {
            if ($(this).val().trim() !== '') {
                hasValue = true;
                return false;
            }
        });
        if (!hasValue) {
            Swal.fire({
                icon: 'info',
                title: 'No data to reset',
                text: 'Please enter some credentials before resetting.',
            });
            return; 
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "This will reset your saved API credentials.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= site_url("reset-autoresponder"); ?>',
                    type: 'POST',
                    data: { id: autoresponderId },
                    beforeSend: function() {
                        button.prop('disabled', true).text('Resetting...');
                    },
                   success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status) {
                            Swal.fire('Reset!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Failed!', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        // Swal.fire(
                        //     'Failed!',
                        //     'Could not reset credentials. Please try again.',
                        //     'error'
                        // );
                         toastr.error( 'Could not reset credentials. Please try again.');
                    },
                    complete: function() {
                        button.prop('disabled', false).text('Reset');
                    }
                });
            }
        });
    });
});
</script>

