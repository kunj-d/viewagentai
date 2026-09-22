<style>
.form-control,.form-control:focus,.bootstrap-select>.dropdown-toggle{
    color: var(--grey-color) !important;
}
</style>

<div class="container-wrapper container-open">
    	<title><?php echo $this->config->item('productName') ?> | Graphics</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding">
    	<div class="row align-items-center">
            <div class="col-md-6">
                <div class="title-line"><?php echo isset($use) && $use ? 'Select ' : ''; ?>Ai Graphics</div>
                <!--(<?php echo count(html_escape($templates)); ?>)-->
            </div>
            <div class="col-12 col-md-6 col-xl-6 text-md-end mt-2 mt-md-0">
	            <div class="ai-employee-tabs gap-3">
	                <a href="<?= base_url('my_templates'); ?>" class="btn btn-primary">My Graphics</a>
                    <a href="#" class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal" data-bs-target="#user-prebuild-existing-template" ng-if="data.level == 0"> Start With Blank </a>
	            </div>    
	        </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="h-equal" style="border-radius: 10px; background: var(--theme-color); padding: 20px; color: var(--white-color);">
                    <div class="col-12 f-16 w700 p0">
                    	<div class="row pg-template-filter-wrapper row-gap-2">
                    		<?php if(!(isset($use) && $use)){ ?>
	                    		<div class="col-md-4 pg-template-filter">
	                    			<label for="redirect_bundle"><?php echo html_escape($this->lang->line('ltr_prebuild_filter_title')); ?></label>
	                    			<input type="hidden"  id="base_url" value="<?php echo base_url();?>">
									<select class="" id="redirect_bundle">
										<option value=""><?php echo html_escape($this->lang->line('ltr_prebuild_temp_sel_cat')); ?> </option>
										<option value="custom"> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_create_custom')); ?> </option>
										<optgroup label="WordPress Images">
											<option value="1200x885" <?php echo $size == '1200x885' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_video_thumb')); ?></option>
											<option value="1200x1200" <?php echo $size == '1200x1200' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_video_squre')); ?></option>
										</optgroup>
										<optgroup label="Social Media">
											<option value="940x940" <?php echo $size == '940x940' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_post')); ?></option>
											<option value="628x628" <?php echo $size == '628x628' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_squre')); ?></option>
											<option value="1080x1080" <?php echo $size == '1080x1080' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_insta_post')); ?></option>
											<option value="735x1102" <?php echo $size == '735x1102' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_pint_pins')); ?></option>
											<option value="1024x512" <?php echo $size == '1024x512' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_twit_post')); ?></option>
											<option value="497x373" <?php echo $size == '497x373' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_g_post')); ?></option>
											<option value="851x315" <?php echo $size == '851x315' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_covers')); ?></option>
											<option value="1500x500" <?php echo $size == '1500x500' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_twit_header')); ?></option>
										</optgroup>
										<optgroup label="AD Images">
											<option value="1200x628" <?php echo $size == '1200x628' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_web_conv')); ?></option>
											<option value="1200x900" <?php echo $size == '1200x900' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_page_post_eng')); ?></option>
											<option value="1200x444" <?php echo $size == '1200x444' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_fb_page_likes')); ?></option>
											<option value="800x200" <?php echo $size == '800x200' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_twit_lead')); ?></option>
											<option value="590x295" <?php echo $size == '590x295' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_twit_promoted')); ?></option>    
											<option value="300x250" <?php echo $size == '300x250' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_adword_md')); ?></option>    
											<option value="336x280" <?php echo $size == '336x280' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_adword_lg')); ?></option>    
											<option value="728x90" <?php echo $size == '728x90' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_adword_leader')); ?></option>
											<option value="250x250" <?php echo $size == '250x250' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_adword_250')); ?></option>                           
											<option value="300x600" <?php echo $size == '300x600' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_adword_300')); ?></option>                           
										</optgroup>
										<optgroup label="Website Headers">
											<option value="1920x250" <?php echo $size == '1920x250' ? 'selected' : ''; ?> > <?php echo html_escape($this->lang->line('ltr_prebuild_temp_web_head')); ?></option>
										</optgroup>
										<optgroup label="Miscellaneous">
											<option value="1920x1080" <?php echo $size == '1920x1080' ? 'selected' : ''; ?> ><?php echo html_escape($this->lang->line('ltr_prebuild_temp_web_banner')); ?></option>
										</optgroup>
									</select>
	                    		</div>
	                    	<?php } ?>
                    		<div class="col-md-4">
                    			<label for="get_template_sub_cat"><?php echo html_escape($this->lang->line('ltr_prebuild_temp_sort_by')); ?></label>
								<select class="get_template_sub_cat" id="get_template_sub_cat">
									<option value="all"> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_sort_by_all')); ?></option>
									<?php for($sc=0;$sc<count($subcat);$sc++){ ?>
										<option value="<?php echo $subcat[$sc]['sub_cat_id']; ?>"><?php echo $subcat[$sc]['name']; ?></option>
									<?php } ?>
								</select>
		                    </div>
		                    <div class="col-md-4 pg-input-holder pg-search-filter">
		                    	<label for="ed_search_template_nm"> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_search_by')); ?></label>
								<input type="text" class="form-control" placeholder="Graphics name" id="ed_search_template_nm" >
								<span class="pg-search-filter-icon search d-none"></span>
		                    </div>	
                    	</div>
                    </div>
                    <div class="col-12 p0 nfc-para">
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                            	<hr class="dashboard-line">
                                <div class="pg-selected-category-wrap">
									<h6 class="pg-selected-category-title fw-normal"></h6>
								</div>
                            </div>
                            <?php if(isset($total) && $total == 0){ ?>
                            <div class="col-12 col-md-12 col-xl-12 mt20">
								<div class="text-center">
									<span class="pg-empty-icon">
										<img src="<?php echo base_url(); ?>app/assets/images/empty-folder.png" alt="">
									</span>
									<h3> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_no_temp_title')); ?></h3>
									<p> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_no_temp_desc')); ?></p>
									<div class="create-btn text-center">
										<a href="#" style="font-size: 16px;" data-bs-toggle="modal" data-bs-target="#user-prebuild-existing-template" ng-if="data.level == 0"><?php echo html_escape($this->lang->line('ltr_prebuild_temp_no_temp_btn')); ?></a>
					                </div>
								</div>
                            </div>
							<?php return ''; } ?>
							
							<div class="col-12 col-md-12 col-xl-12">
								<?php if(count($templates)) { ?>
								<div class="row pg-append-template-row">
									<?php for( $i=0; $i < count($templates); $i++) { ?>
									<div class="col-md-4 col-xl-3 mt20">
										<div class="appoint-wall template-editor-wrapper">
			                                <div class="media">
		                                    	<img src="<?php echo $templates[$i]['thumb'] != '' ? base_url() .'app/'. $templates[$i]['thumb'] : base_url() . 'app/assets/images/'.($templates[$i]['template_size'] == '628x628' ? 'empty_campaign.jpg' : 'empty_campaign_long.jpg'); ?>" alt="" class="w-100">
		                                        <div class="template-buttons">
                                                	<?php if(!(isset($use) && $use)){ ?>
                                                		<!--<a href="" class="pg-template-status" title="<?php echo empty($templates[$i]['template_name']) ? 'Unnamed' : $templates[$i]['template_name']; ?>">-->
                                                		<!--	<span class="pg-template-status-center template-buttons-inner">-->
                                                		<!--		<span class="btn btn-primary ed_open_image" data-mfp-src="<?php //echo $templates[$i]['thumb'] != '' ? base_url() .'app/'. $templates[$i]['thumb'] : base_url() . 'app/assets/images/empty_campaign.jpg'; ?>"> <?php //echo html_escape($this->lang->line('ltr_prebuild_temp_view_temp_btn')); ?></span>-->
                                                		<!--		<span data-mfp-src="#user-prebuild-existing-template" class="btn btn-primary pg-popup-link" data-template_userID="<?php //echo $templates[$i]['user_id']; ?>" data-get_template_id="<?php echo $templates[$i]['template_id']; ?>"><?php //echo html_escape($this->lang->line('ltr_prebuild_temp_use_temp')); ?></span>-->
                                                		<!--	</span>-->
                                                		<!--</a>-->
                                                		<div class="flex grid-buttons text-center">
                                                            <a title="View Graphics" class="grid-image-view text-center ed_open_image" data-mfp-src="<?php echo $templates[$i]['thumb'] != '' ? base_url() . 'app/' . $templates[$i]['thumb'] : base_url() . 'app/assets/images/empty_campaign.jpg'; ?>"><i class="fa-solid fa-eye"></i></a>
                                                            <a title="Use this Graphics" data-mfp-src="#user-prebuild-existing-template" class="grid-image-view text-center pg-popup-link" data-template_userID="<?php echo $templates[$i]['user_id']; ?>" data-get_template_id="<?php echo $templates[$i]['template_id']; ?>"><i class="fa-solid fa-file-pen"></i></a>
                                                        </div>

                                                		
                                                	<?php } else { ?>
                                                		<div class=" create-btn">
                                                			<a href="<?php echo base_url() . 'campaign/use_template/'.$templates[$i]['user_id'].'/'.$templates[$i]['template_id']; ?>" class="btn btn-primary d-block w-100">
                                                				<?php echo html_escape($this->lang->line('ltr_prebuild_temp_use_this')); ?>
                                                			</a>
                                                		</div>
                                                	<?php } ?>
                                                </div>
		                                    </div>
		                                    <div class="template-title">
	                                            <p class='m-0'><?php echo empty($templates[$i]['template_name']) ? 'Unnamed' : $templates[$i]['template_name']; ?></p>
	                                        </div>
				                        </div>
									</div>
									<?php } ?>
								</div>
								<?php } ?>
								<!-- Load More Button  -->
								<div class="pg-load-more-wrap create-btn text-center mt20">
									<a class="pg-btn pg-load-more-btn hide" data-size="<?php echo $size; ?>" data-use="<?php echo isset($use) && $use ? true : false; ?>"> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_load_more')); ?></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    
    <!-- Modal  -->
    <div class="modal fade" id="user-prebuild-existing-template" tabindex="-1" role="dialog" aria-labelledby="user-prebuild-existing-template-label" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="user-prebuild-existing-template-label">Create New Graphics</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<!--<div class="col-md-12">-->
						<!--	<label> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_select_web')); ?></label>-->
						<!--	<select id="campaign_id" class="form-control ed_campaign_select_chng">-->
						<!--		<option value=""><?php echo html_escape($this->lang->line('ltr_prebuild_temp_create_web')); ?></option>-->
						<!--		<?php if(isset($campaigns) && !empty($campaigns)){ ?>-->
						<!--		<?php foreach($campaigns as $cam){ ?>-->
						<!--			<option value="<?php echo $cam['campaign_id']; ?>"><?php echo $cam['name']; ?></option>-->
						<!--		<?php } ?>-->
						<!--		<?php } ?>-->
						<!--	</select>-->
						<!--	<label class="mt-2 campaign_name_label"> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_web_name')); ?></label>-->
						<!--	<input type="text"  value="" placeholder="<?php echo html_escape($this->lang->line('ltr_prebuild_temp_web_name')); ?>" id="campaign_name" class="form-control campaign_name_label">-->
						<!--</div>-->
						<div class="col-md-12 mt-2">
							<label for="template_name">Graphic Name</label>
	                		<input type="text"  value="" id="template_name" class="form-control mt10">
						</div>
					</div>
					<div class="row custom_html_size"></div>
				</div>
				<div class="modal-footer pg-modal-btn-wrap">
					<input type="hidden" id="template_userID" value="">
					<input type="hidden" id="get_template_id" value="">
					<input type="hidden" id="m_template_size" value="<?php echo $size; ?>">
					<button type="button" class="btn btn-primary"  id="ed_create_template"><?php echo html_escape($this->lang->line('ltr_prebuild_temp_create_btn')); ?></button>
				</div>
			</div>
	  	</div>
	</div>
	<!-- Modal  -->
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/jquery.toaster.js"></script>
<script type='text/javascript' src="<?= $this->config->item('assetsPath') ?>js/main.js"></script>
<script>
if($('.pg-selected-category-title').length){
	var rta = $('#redirect_bundle option:selected').text();
	$('.pg-selected-category-title').text(rta);		
}

if($('.pg-popup-link').length){
	$(document).on('click', '.pg-popup-link', function(e){
		e.preventDefault();
		var href = $(this).attr('href');
		if(href == undefined){
			href = $(this).data('mfp-src');
		}

		var campaign_id = $(this).attr('data-campaign_id');
		var campaign_name = $(this).attr('data-campaign_name');
		var sub_user_id = $(this).attr('data-sub_user_id');
		if(campaign_id != undefined){
			$(href).find('#campaign_id').val(campaign_id);
			$(href).find('#campaign_rename').val(campaign_name);
			if(sub_user_id != undefined) $(href).find('#sub_user_id').val(sub_user_id);
		}
		var template_id = $(this).attr('data-template_id');
		var template_name = $(this).attr('data-template_name');
		if(template_id != undefined){
			$(href).find('#template_id').val(template_id);
			$(href).find('#template_rename').val(template_name);
		}
		var template_userID = $(this).attr('data-template_userID');
		var get_template_id = $(this).attr('data-get_template_id');
	
		if(template_userID != undefined){
	
			$('#user-prebuild-existing-template .custom_html_size').html('');
			$(href).find('#template_userID').val(template_userID);
			$(href).find('#get_template_id').val(get_template_id);
		}
		/*$.magnificPopup.open({
			items: {
				src: $(href)
			},
			type: 'inline',
			callbacks:{
				elementParse: function(item) {
				},
			}
		});*/
		$('#user-prebuild-existing-template').modal('show');
	});

	$('#user-prebuild-existing-template').on('hidden.bs.modal', function (e) {
		jQuery("#campaign_id, #campaign_name, #template_name, #template_userID, #get_template_id").val('');
		jQuery("#campaign_name").prev().show();
		jQuery("#campaign_name").show();
		jQuery(".custom_html_size").remove();
    });

}
</script>