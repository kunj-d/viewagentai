<title><?php echo $this->config->item('productName') ?> | Bonuses</title>

<!-- Page Content Start -->
<div class="container-wrapper container-open">
	<div class="container-fluid container-padding mt20 mt-md50">
		<div class="row">

			<!-- Header title Start -->
			<div class="col-xs-12 padding0">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="title-line">
							<?php echo $fetch_data[0]->bonus_category_title; ?>
						</div>
						<p class="container-page-subtitle mt10">
							<?php if ($slug == 'bonuses-by-partners') {
								echo "Enjoy more awesome bonuses here";
							} elseif ($slug == 'more-useful-resources') {
								echo "Compliment your purchase with useful resources";
							} else {
								echo "Enjoy bonuses with your purchase";
							}
							?>
						</p>
					</div>
				</div>
			</div>
			<!-- Header title end -->

			<!---Tabs buttons start--->
			<div class="col-xs-12 padding0">
				<div class="row">
					<div class="col-12">
						<ul
							class="nav nav-pills nav-pills-style-2 nav-pills-with-gradient">
							<?php $AllCat = $this->Common_Modal->getAllBonuses(); ?>
							<?php
							if ($AllCat) {
								foreach ($AllCat as $cat) {
									$i = 1;
									?>
							<li class="nav-item">
								<a class="nav-link justify-content-center text-center h-100 <?php if ($slug == $cat->slug) {
									echo "active";
								} ?>"
									href="<?php echo site_url() . 'bonuses/' . $cat->slug; ?>"
									title="<?php echo ucwords($cat->title); ?>">
									<?php echo ucwords($cat->title); ?>
								</a>
							</li>

							<?php
							$i = $i + 1;
								}
							}
							?>

						</ul>
					</div>

				</div>
			</div>
			<!---Tabs buttons end--->


			<!-- View & Play Graph of Video Start -->
			<div class="col-12">
				<!--- Title Section ------->
				<div class="wrapper-box">
					<div class="row">
					    <div class="col-12">
						    <div class="tab-content">

							<!---- IM-University-Bonuses------>
							<div class="tab-pane fade active show" id="bonus-tab1" role="tabpanel" aria-labelledby="nav-home-tab">
							    <div class="row row-gap-2">
    								<?php
        								if($fetch_data && $fetch_data[0]->title != ''){
                							$i=1;
                							foreach($fetch_data as $data){	
            						?>
                            <div class="col-md-4 col-lg-3">
                                <div class="tab-box">
                                    <img src="<?php echo $this->config->item('assetsPath').'uploads/bonus_image/'.$data->image;?>" alt="GetGist" class="mx-auto d-block img-fluid" style="max-height: 150px;">
                                    <div class="mt10 tab-heading"><?php echo $i.". ".$data->title;?></div>
                                   
                                    <?php if($data->bonus_category_title == "VIP Bonuses") {?>
                                        <a href="<?php echo $data->url;?>" class="btn btn-primary mt-2" target="_blank">Access Now</a>
                                    <?php }else{?>
                                        <a href="<?php echo $data->url;?>" class="btn btn-primary mt-2" target="_blank">Download</a>
                                    <?php }?>
                                    
                                </div>
                            </div>

                            <?php $i++; } } ?>
								</div>


								<!---- topstorysites bonus------>




							</div>


						</div>
						</div>
					</div>
					<!--- Title Section end----->

				</div>
			</div>


		</div>
	</div>

<!-- Page Content End -->