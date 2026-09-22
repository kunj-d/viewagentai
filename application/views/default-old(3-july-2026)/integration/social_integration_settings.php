<?php
if ($active_pos == 'twitter') {
    $active_pos = 0;
} elseif ($active_pos == 'linkedin') {
    $active_pos = 1;
} elseif ($active_pos == 'tumblr') {
    $active_pos = 2;
} elseif ($active_pos == 'pinterest') {
    $active_pos = 3;
} elseif ($active_pos == 'reddit') {
    $active_pos = 4;
} elseif ($active_pos == 'blogger') {
    $active_pos = 5;
} elseif ($active_pos == 'medium') {
    $active_pos = 6;
} elseif ($active_pos == 'wordpress') {
    $active_pos = 7;
}
?>


<div class="tab-pane fade mt-md-4 mt-3 <?php echo $active_tab == 'social' ? 'show active' : ''; ?>" id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
     <?php   
    if(in_array('socialmedia',$this->session->userdata('features')) ) {
    ?>
    <ul class="nav nav-tabs text-center mb-2 mb-sm-4" id="myTab" role="tablist">
        <?php foreach ($social_profiles as $a_key => $a_value): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $a_key == $active_pos ? 'active' : ''; ?>" data-toggle="tab" href="#<?= $a_value['title']; ?>" role="tab" aria-controls="<?= $a_value['title']; ?>" aria-selected="<?php echo $a_key == $active_pos ? 'true' : 'false'; ?>">
                    <div class="icircle">
                        <img src="<?php echo $autoresponders_image_folder . $a_value['logo']; ?>" class="img-responsive center-block">
                    </div>
                    <p class="mt10px"><?= $a_value['display_title']; ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content mt25px">
        <?php 
             foreach ($social_profiles as $key => $social_profile) {
           // if ($social_profiles[$key]['display_title'] == "Tumblr") {
               // $profile_link = $this->config->item('redirectMainUrl') . $social_profile['title'] . '-integration';
         //   } else {
                $profile_link = site_url() . $social_profile['title'] . '-integration';
          //  }
          if($social_profile['title'] == 'wordpress'){
              $profile_link = "";
          }
          if($social_profile['title'] == 'wordpress'){
              $RedirectText = "";
          }else {
              $RedirectText ="Redirection URL";
          }
			if($social_profile['title'] == 'twitter'){
				$plan_var = 'twitter_integration';
			}elseif($social_profile['title'] == 'tumblr'){
				$plan_var = 'tumblr_integration';
			}elseif($social_profile['title'] == 'pinterest'){
				$plan_var = 'pintrest_integration';
			}elseif($social_profile['title'] == 'linkedin'){
				$plan_var = 'linkedin_integration';
			}elseif($social_profile['title'] == 'reddit'){
				$plan_var = 'reddit_integration';
			} elseif($social_profile['title'] == 'wordpress'){
				$plan_var = 'wordpress_integration';
			}else{
				$plan_var = 'blogger_integration';
			}
			
            ?>
           
            <div id="<?= $social_profile['title']; ?>" class="tab-pane fade <?php echo $key == $active_pos ? 'show active' : ''; ?>" role="tabpanel" aria-labelledby="<?= $social_profile['title']; ?>-tab">
                <form action="<?php echo site_url('social-integration'); ?>" method="post">
                    <input type="hidden" name="social_title" value="<?php echo $social_profile['title']; ?>">
                    <input type="hidden" name="id" value="<?php echo $social_profile['social_profile_id']; ?>">
                    <input type="hidden" name="active_pos" value="<?php echo $key; ?>" />
                    <input type="hidden" name="active_tab" value="social" />

                    <div class="col-xs-12">
                        <h3 class="integration-title mb-2 mb-sm-4 d-flex align-items-center gap-3">
                            <img 
                                src="<?php echo $autoresponders_image_folder . $social_profile['logo']; ?>" 
                                class="img-responsive inline" 
                                style="height: 40px;width: 30px;object-fit: contain;
                            ">
                            <?php echo $social_profile['display_title']; ?>
                        </h3>
                    </div>

                    <div class="col-xs-12 padding0" style="margin-bottom: 30px;">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><?php echo $RedirectText ?></label>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 text-wrap">
                                <?php echo htmlspecialchars($profile_link); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $credential = false;
                    foreach ($user_social_settings as $setting) {
                        if ($social_profile['social_profile_id'] == $setting['social_profile_id']) {
                            $credential = json_decode($setting['credentials']);
                        }
                    }
                    ?>
                    <?php foreach ($social_profile['social_fields'] as $field_key => $social_field):
                        $field_value = "";
                        if ($credential) {
                            foreach ($credential as $c_field_name => $c_field_value) {
                                if ($social_field['field_name'] == $c_field_name) {
                                    $field_value = $c_field_value;
                                }
                            }
                        }
                    ?>
                        <div class="col-xs-12 padding0 mb30px">
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><?php echo $social_field['display_title']; ?></label>
                                <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
                                    <input type="<?php echo $social_field['field_type']; ?>"
                                           value="<?= htmlspecialchars($field_value); ?>"
                                           name="<?php echo $social_field['field_name']; ?>"
                                           placeholder="<?php echo $social_field['placeholder']; ?>" class="form-control mb-3"/>
                                    <span class="text-danger"><?php if (isset($social_error[$social_field['field_name']])) echo $social_error[$social_field['field_name']]; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-xs-12 padding0">
                        <div class="form-group row">
                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"></div>
                            <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
                                <button type="submit" class="btn btn-primary">Save API Credentials</button>
                            </div>
                        </div>
                    </div>
                    <?php if($social_profile['title']=="wordpress") { ?>
                    <div class="col-12 mt20">
                        <div class="form-group">
                            <div class="col-lg-2 col-md-3 col-12 form-label">Please Install</div>
                            <div class="col-lg-7 col-md-7 col-12 f-14">
                                <a href="<?php echo $assetsFolder; ?>plugins/Basic_Auth_master.zip" style="text-decoration:none">Authorization Plugins</a>
                            </div>
                        </div>
                    </div>
					<?php }
					?>
                </form>
            </div>
        <?php } ?>
    </div>

    <?php } else { ?>
            <div class="col-xs-12 padding0 mt20 mt-md50">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 ">
						<div class="col-xs-12 tab-content text-center">
							<div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12 mt2 xsmt2 mb5 xsmb5">
								<img src="<?php echo $this->config->item("assetsTemplatePath"); ?>images/logo.png" class="img-fluid d-block mx-auto integration-logo">
								<div class="title-line mt20 justify-content-center">Please Upgrade Your Plan To Use This Feature</div>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


