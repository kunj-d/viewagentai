<style>
   ul.sub-child {
        background-color: #161346;
        border-radius: 10px;
    }

    ul.sub-child li.nav-item {
        margin-bottom: 0px;
    }

    .sidebar-menu ul li ul.sub-child li.nav-item a {
        padding: 7px;
        min-height: 40px;
    }

    .sidebar-menu ul li ul.sub-child li.nav-item a span.menu-title {
        font-size: 14px;
    }

    ul.sub-child.dropOn {
        opacity: 1;
        height: 80px;
    }.

    #addBusinesslist img{
        display:none!important;
    }

    ul.sub-child {
        background-color: #161346;
        opacity: 0;
        transition: 0.3s ease;
        /*display: none;*/
        height: 0px;
    }

    .sidebar-menu ul li.nav-item.active ul.sub-child a.nav-link {
        font-weight: 600;
        border-radius: 10px;
        color: var(--white-color);
        background: transparent;
    }

    

    .rotate {
        -moz-transition: all 2s linear;
        -webkit-transition: all 2s linear;
        transition: all 2s linear;
    }

    .rotate.down {
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    span.icon-dropdown.rotate {
        transition: all 0.3s ease !important;
    }

    .rotate1 {
        -moz-transition: all 2s linear;
        -webkit-transition: all 2s linear;
        transition: all 2s linear;
    }

    /* .rotate1.down {
        -moz-transform: rotate(180deg);
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    } */

    span.icon-dropdown.rotate1 {
        transition: all 0.3s ease !important;
    }

    span.icon-close1.rotate1 {
        transition: all 0.3s ease !important;
    }
    .confirm-del.show{
        display: flex!important;
        align-items: center;
    }
    
</style>
  <!-- Container Start -->
  <div class="container-wrapper container-open">
  	<title><?php echo $this->config->item('productName') ?> | FAQ's</title>
  	<!-- Main Container Start -->
  	<!--<div class="container-fluid container-padding" style=" min-height: calc(93.4vh);">-->
  	<div class="container-fluid container-padding">
  		<div class="row d-flex align-items-center">
  			<div class="col-md-3">
  				<div class="title-line">
  					FAQ's
  				</div>
  			</div>
			  <div class="col-md-9  d-flex align-items-center gap-3 justify-content-end">
			  <a href="https://support.bizomart.com/support/home" target="_blank" class="btn btn-primary"><span>Contact Us</span></a>
				<!-- <form class="m-0" method="post" action="<?= base_url('faqs') ?>">
					<div class="search-bar ">
						<input type="text" class="search form-control" name="search"  placeholder="Search.." value="<?php if($search){ echo $search;}?>">
						<div class="search-icon" id="searchVal" style="cursor:pointer;">
							<span class="icon-search"></span>
						</div>
					</div>
				</form> -->

			</div>
  		</div>
  		
  	    <div class="row accordion-list mt-5">
  		<div class="col-12">
  			<div class="accordion w-100" id="accordionExample">
  				<?php
					if ($fetch_data) {
						foreach ($fetch_data as $key => $faq) { ?>
  						<div class="accordion-item">
  						    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse<?php echo $key; ?>">
                                	<?php echo $key + 1; ?>. <?php echo $faq->question; ?> </button>
                            
                             <div id="collapse<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample" style="">
  								<div class="faq-wrapper">
  									<div class="faq-text">
  										<?php echo $faq->answers; ?>
  									</div>
  									<?php
										$like_active = "";
										$dislike_active = "";
										foreach ($likedata as $likes) {
											if ($likes->faq_id == $faq->id && $likes->user_id == $user_id && $likes->status == '1') {
												$like_active = "likeactivate";
											} elseif ($likes->faq_id == $faq->id && $likes->user_id == $user_id && $likes->status == '-1') {
												$dislike_active = "dislikeactivate";
											}
										}
										?>
  									<div class="d-flex align-items-center gap-3">
  										<!-- <div class="faq-text">Was this helpful?</div> -->
  										<div class="d-flex align-items-center gap-3 like-nenu">
  											<div class="thumbs-up">
  											    <a href="javascript:" faq-id="<?php echo $faq->id; ?>" id="like<?php echo $faq->id; ?>" onclick="sendLikeDislike(this)" title="Like" class="<?php echo $like_active; ?>" style="margin-right:10px"><i class="icon-thumbs-up"></i></a>
  											<a href="javascript:" faq-id="<?php echo $faq->id; ?>" id="dislike<?php echo $faq->id; ?>" onclick="sendLikeDislike(this)" title="Dislike" class="<?php echo $dislike_active; ?>"><i class="icon-thumbs-down"></i></a>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>

  						</div>
  					<?php }
					} else {
						//echo '<div class="alert alert-warning alert-dismissible" role="alert">Record Not Found.</div>';
						?>
  					<div class="col-xs-12  mt30px xsmt25px">
  						<!--- Title Section ------->
  						<div class="col-md-12 col-sm-12 col-xs-12 padding0">
  							<div class="row">
  								<div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3">


  									<div class="col-xs-12 padding0 ">


  										<img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive center-block mt6 xsmt6">
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

  	</div>
  	
  	</div>
  	
  	<script>

function sendLikeDislike(ele){
	
	var faqId = $(ele).attr('faq-id');	
	var title = $(ele).attr('title');
	var siteUrl = '<?php echo base_url('faqs-like-dislike-json'); ?>';
	var url = siteUrl;
	$.ajax({
		method: "POST",
		url: url,
		data: { faq_id:faqId, title:title },
		success: function(data){
			if(data == 1){
			$("#dislike"+faqId).removeClass('dislikeactivate');
			$("#like"+faqId).addClass('likeactivate');		
			}
			if(data == 2){
				$("#like"+faqId).removeClass('likeactivate');
				$("#dislike"+faqId).addClass('dislikeactivate');		
			}
		}
	});
}

$(document).ready(function(){
	$(document).on("keyup",".searchbox",function(){
		var searchbox = $(this).val();
		var url = '<?php echo site_url('faq/search-faq'); ?>';
		$.ajax({
			method: "POST",
			url: url,
			data: {search:searchbox},
			success: function(data){
				$(".search_result").html(data);
			}
		});
		
	});
	
});
</script>
