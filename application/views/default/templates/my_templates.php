<div class="container-wrapper container-open">
	<title><?php echo $this->config->item('productName') ?> | My Graphics</title>
    <!-- Main Container Start -->
    <div class="container-fluid container-padding">
    	<div class="row align-items-center">
            <div class="col-md-6 col-12">
                <div class="title-line"><?php echo isset($use) && $use ? 'Select ' : ''; ?>My Graphics</div>
                <!--(<?php echo count(html_escape($templates)); ?>)-->
            </div>
            <div class="col-12 col-md-6 col-xl-6 text-md-end mt-3 mt-md-0">
	            <div class="ai-employee-tabs gap-3">
	                <a href="<?= base_url('templates'); ?>" class="btn btn-primary">All Graphics</a>
                    <a href="#" class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal" data-bs-target="#user-prebuild-existing-template" ng-if="data.level == 0"> Start With Blank </a>
	            </div>    
	        </div>
        </div>
        <!--<div class="row">-->
        	
        <!--</div>-->

        <div class="row mt20 mt-md30">
            <div class="col-md-12">
                <div class="h-equal" style="border-radius: 10px; background: var(--theme-color); padding: 20px; color: var(--white-color);">
                    <div class="col-12 p0 nfc-para">
                        <div class="row">
                            <?php if(isset($total) && $total == 0){ ?>
                            <div class="col-12 col-md-12 col-xl-12">
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
								<div class="row pg-append-template-row row-gap-2">
									<?php for( $i=0; $i < count($templates); $i++) { ?>
									<div class="col-md-4 col-xl-3">
                                    	<div class="appoint-wall template-editor-wrapper">
                                    		<div class="media">
                                    			<img src="<?php echo $templates[$i]['thumb'] != '' ? base_url() .'app/'. $templates[$i]['thumb'] : base_url() . 'app/assets/editor/assets/images/'.($templates[$i]['template_size'] == '628x628' ? 'empty_campaign.jpg' : 'empty_campaign_long.jpg'); ?>" alt="" class="w-100">
                                    			<div class="template-buttons">
                                    				<?php if(!(isset($use) && $use)){ ?>
                                    					<div class="flex grid-buttons text-center">
                                    					    <a title="View Template" class="grid-image-view text-center ed_open_image" data-mfp-src="<?php echo $templates[$i]['thumb'] != '' ? base_url() . 'app/' . $templates[$i]['thumb'] : base_url() . 'app/assets/images/empty_campaign.jpg'; ?>"><i class="fa-solid fa-eye"></i></a>
                                    						<a download="image.jpg" href="<?php echo $templates[$i]['thumb'] !=  '' ? base_url() .'app/'. $templates[$i]['thumb'] . '?q=' . time() : base_url() . 'app/assets/editor/assets/images/'.($templates[$i]['template_size'] == '628x628' ? 'empty_campaign.jpg' : 'empty_campaign_long.jpg'); ?>" class="grid-image-view text-center" title="Download"><i class="fa-solid fa-download"></i></a>
                                    						<a href="<?php echo base_url(); ?>editor/edit/<?php echo html_escape($templates[$i]['campaign_id']); ?>/<?php echo html_escape($templates[$i]['template_id']); ?>" class="pg-template-status grid-image-view text-center" title="<?php echo empty($templates[$i]['template_name']) ? 'edit Unnamed' : 'edit:-'.$templates[$i]['template_name']; ?>"><i class="fa-solid fa-file-pen"></i></a>
                                    						<a href="#" class="template_action grid-image-view text-center" title="<?php echo html_escape($this->lang->line('ltr_templ_title_delete')); ?>" data-action="delete" data-template_id="<?php echo $templates[$i]['template_id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                    					</div>
                                    				<?php } else { ?>
                                    					<div class="create-btn">
                                    						<a href="<?php echo base_url() . 'campaign/use_template/'.$templates[$i]['user_id'].'/'.$templates[$i]['template_id']; ?>" class="btn btn-primary d-block w-100">
                                    							<?php echo html_escape($this->lang->line('ltr_prebuild_temp_use_this')); ?>
                                    						</a>
                                    					</div>
                                    				<?php } ?>
                                    			</div>
                                    		</div>
                                			<div class="template-title">
                                				<p class="m-0"><?php echo empty($templates[$i]['template_name']) ? 'Unnamed' : $templates[$i]['template_name']; ?></p>
                                			</div>
                                    	</div>
                                    </div>
									<?php } ?>
								</div>
								<?php } ?>
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
					<h5 class="modal-title" id="user-prebuild-existing-template-label"><?php echo html_escape($this->lang->line('ltr_prebuild_temp_create_new')); ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<!--<div class="col-md-12">-->
						<!--	<label> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_select_web')); ?></label>-->
						<!--	<select id="campaign_id" class="form-control ed_campaign_select_chng">-->
						<!--		<option value=""> <?php echo html_escape($this->lang->line('ltr_prebuild_temp_create_web')); ?></option>-->
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
	                		<input type="text"  value="" id="template_name" class="form-control">
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
	<input type="hidden"  id="base_url" value="<?php echo base_url(); ?>">
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