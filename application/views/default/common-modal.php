<!-- Delete Popup-->

<div id="deleteModal" class="modal fade pop" role="dialog">
  <div class="modal-dialog modal-dialog-centered delete-dialog">

    <!-- Modal content-->
    <div class="modal-content dashmodal">
		
      <div class="modal-body modal-body-delete clearfix">
		<div class="col-12 padding0 mt20px xsmt20px xsmb20px mb20px">
			<img src="<?php echo $assetsFolder;?>images/delete-icon.png" class="img-fluid border shadow mx-auto d-block img-responsive center-block mb-2" style="border-radius: 5px; width: 70px; height: 70px;">
			<div class="mb-3">
				<div class="text-white fs-5 col-12 md18 sm16 xs15 w700 padding0 mt28px xsmt25px text-center msgheading delete-confirm-msg-heading">Deleting This</div>
				<div class="text-white col-12 md14 sm14 xs14 padding0 mt10px xsmt20px text-center delete-confirm-msg">Are you sure you want to delete these files?</div>
			</div>
			<div class="col-md-12 col-sm-12 col-12 md14 sm14 xs14 mt30px xsmt25px text-center">
				<a href="#" class="btn btn-danger autobtn me-1" data-bs-dismiss="modal">Cancel</a>
				<a href="#" class="btn btn-primary buttongap delete-yes-btn">Delete</a>
			</div>
		</div>
      </div>
		
    </div>

  </div>
</div>



<div id="walkModel" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">


    <div class="modal-content dashmodal">
		
      <div class="modal-body modal-body-delete clearfix">
		<div class="col-12 padding0">
			<div class="col-12 md18 sm16 xs15 w700 padding0 text-center msgheading delete-confirm-msg-heading">Take a Quick Tour of Coursova</div>
			<div class="col-12 mt30px">
			<div class="responsive-video">
							<iframe src="https://academypro.dotcompal.com/video/embed/y9ywzpnpxl?autoplay=0" frameborder="0" allowfullscreen="1"></iframe>

			</div>
			</div>
			</div>
		</div>
      </div>
		
    </div>

  </div> 



<div id="howtoModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">


    <div class="modal-content dashmodal">
		
      <div class="modal-body modal-body-delete clearfix">
		<div class="col-12 padding0">
			<div class="col-12 md18 sm16 xs15 w700 padding0 text-center msgheading delete-confirm-msg-heading">Adding Your Own Digital Product</div>
			<div class="col-12 mt30px">
			<div class="responsive-video">
							<iframe src="https://academypro.dotcompal.com/video/embed/dgojhik4fw?autoplay=0" frameborder="0" allowfullscreen="1"></iframe>

			</div>
			</div>
			</div>
		</div>
      </div>
		
    </div>

  </div> 






<!-- My Product Get link Popup-->

<div id="linkModal" class="modal fade" role="dialog">
  <div class="modal-dialog link-dialog">

    <!-- Modal content-->
    <div class="modal-content dashmodal">
		
      <div class="modal-body modal-body-delete clearfix">
		<div class="col-12 padding0 mt10px xsmt10px xsmb10px mb10px">
			<img src="images/link-icon.png" class="img-responsive center-block">
			<div class="col-12 md18 sm16 xs15 w700 padding0 mt28px xsmt25px text-center">Get Course URL</div>
			
			<div class="col-12 md14 sm14 xs14 padding0 mt15px xsmt20px text-center imsite-form">
			<textarea class="form-control" rows="3" disabled>Prodct Link or URL Goes Here....Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</textarea>
			</div>
			
			<div class="col-md-12 col-sm-12 col-12 md14 sm14 xs14 mt30px xsmt25px text-center">
			<a href="#" class="cancelbtn buttongap" data-dismiss="modal">Cancel</a>
			<input type="submit" class="form-control imsite-btn autobtn" value="Copy">
			</div>
		</div>
      </div>
		
    </div>

  </div>
</div>

<!-- Upload Popup -->

<div id="uploadimagepopup" class="modal fade" role="dialog">
   <div class="modal-dialog upload-dialog">
      <!-- Modal content-->
      <div class="modal-content dashmodal">
         <div class="modal-body modal-body-media clearfix">
            <button type="button" class="close cancel" id="close_library" data-dismiss="modal"><i class="icon icon-close"></i></button>
            <div class="col-12 padding0">
							<div class="mediatab">
								<div class="md18 sm16 xs16 w700">Upload Media</div>
								<ul class="nav imsite-nav mt30px xsmt25px">
								<li class="active" id="upload"><a href="#tab1_computer" class="md14 sm14 xs14" data-toggle="tab">From Computer</a></li>
								<?php if(!isset($library_page)){ ?>
								<li class="" id="media"><a id="media_library" data-toggle="tab" class="md14 sm14 xs14" href="#tab2_library">Media Library</a></li>
								<?php } ?>
								</ul>
							</div>
							<div class="tab-content">
									
									<div class="tab-pane fade in active" id="tab1_computer" role="tabpanel">
									<div class="col-12 topmediatab">
									<form action="" method="post" enctype="multipart/form-data" id="library_form" class="imsite-forms">	
										<input name="library_files[]" id="imageInput" class="inputfile inputfile-3"  multiple accept="image/*" type="file" onchange="showfilesnames(this)">
										<label for="imageInput" class="md14 sm14 xs14 w400">Choose File</label>
										<div class="image-file-name-show" id='imageFileNameShow'></div><br><br>

										<div class="md14 sm14 xs14 mt30px xsmt25px mainright">
										<a href="javascript:void" data-dismiss="modal" class="cancelbtn buttongap">Cancel</a>
										<input type="submit" id="submit-btn" class="imsite-btn autobtn" value="Upload">
										</div>
									</form>
									<div id="library_output"></div>
									</div>
									</div>
												
									<div class="tab-pane fade" id="tab2_library" role="tabpanel">
									<div class="col-12  mCustomScrollbar mCustomScrollbarmedia darkscroll">
									<div class="col-12 topmediatab">
									<div class="row" id="showlibrary">
										
										<!--div class="col-md-3 col-sm-3 col-xs-6 mb30px xsmb20px">
											<a href="javascript:">
													<img src="<?php echo $assetsFolder;?>images/article1.png" onClick="" class="img-responsive center-block uploadpimg">
											</a>	
										</div-->
										
									</div>
									</div>
									</div>
									</div>
									
							</div>
            </div>
         </div>
      </div>
   </div>
</div>


<!--- custom image upload start --->
<div id="uploadlogoimagepopup" class="modal fade" role="dialog">
   <div class="modal-dialog upload-dialog">
      <!-- Modal content-->
      <div class="modal-content dashmodal">
         <div class="modal-body modal-body-media clearfix">
            <button type="button" class="close cancel" id="close_library" data-dismiss="modal"><i class="icon icon-close"></i></button>
            <div class="col-12 padding0">
							<div class="mediatab">
								<div class="md18 sm16 xs16 w700">Upload Media</div>
								<ul class="nav imsite-nav mt30px xsmt25px">
								<li class="active" id="upload"><a href="#tab1_computer" class="md14 sm14 xs14" data-toggle="tab">From Computer</a></li>
								<?php if(!isset($library_page)){ ?>
								<li class="" id="media"><a id="media_library" data-toggle="tab" class="md14 sm14 xs14" href="#tab2_library">Media Library</a></li>
								<?php } ?>
								</ul>
							</div>
							<div class="tab-content">
									
									<div class="tab-pane fade in active" id="tab1_computer" role="tabpanel">
									<div class="col-12 topmediatab">
									<form action="" method="post" enctype="multipart/form-data" id="library_form" class="imsite-forms">	
										<input name="library_files[]" id="imageInput" class="inputfile inputfile-3"  multiple accept="image/*" type="file" onchange="showfilesnames(this)">
										<label for="imageInput" class="md14 sm14 xs14 w400">Choose File</label>
										<div class="image-file-name-show" id='imageFileNameShow'></div><br><br>

										<div class="md14 sm14 xs14 mt30px xsmt25px mainright">
										<a href="javascript:void" data-dismiss="modal" class="cancelbtn buttongap">Cancel</a>
										<input type="submit" id="submit-btn" class="imsite-btn autobtn" value="Upload">
										</div>
									</form>
									<div id="library_output"></div>
									</div>
									</div>
												
									<div class="tab-pane fade" id="tab2_library" role="tabpanel">
									<div class="col-12  mCustomScrollbar mCustomScrollbarmedia darkscroll">
									<div class="col-12 topmediatab">
									<div class="row" id="showlibrary">
										
										<!--div class="col-md-3 col-sm-3 col-xs-6 mb30px xsmb20px">
											<a href="javascript:">
													<img src="<?php echo $assetsFolder;?>images/article1.png" onClick="" class="img-responsive center-block uploadpimg">
											</a>	
										</div-->
										
									</div>
									</div>
									</div>
									</div>
									
							</div>
            </div>
         </div>
      </div>
   </div>
</div>
<!---- custom image upload end --->


<!-- Logout Popup-->
<div id="logoutModal" class="modal fade" role="dialog">
  <div class="modal-dialog delete-dialog">

    <!-- Modal content-->
    <div class="modal-content dashmodal">
		
      <div class="modal-body modal-body-delete clearfix">
		<div class="col-12 padding0 mt20px xsmt20px xsmb20px mb20px">
			<img src="<?php echo $this->config->item('assetsTemplatePath'); ?>images/logout-icon.png" class="img-responsive center-block">
			<div class="col-12 md18 sm16 xs15 w700 padding0 mt28px xsmt25px text-center">Logout</div>
			<div class="col-12 md14 sm14 xs14 padding0 mt10px xsmt20px text-center">Are you sure you want to logout?</div>
			<div class="col-md-12 col-sm-12 col-12 md14 sm14 xs14 mt30px xsmt25px text-center">
			<a href="javascript:" class="cancelbtn buttongap" data-dismiss="modal">Cancel</a>
			<a href="<?php echo site_url("logout");?>" class="imsite-btn autobtn">Yes</a>
			</div>
		</div>
      </div>
		
    </div>

  </div>
</div>

<!-- Contact Message Popup-->

<div id="contactmsgmodal" class="modal fade" role="dialog">
  <div class="modal-dialog  contactmsg-dialog">

    <!-- Modal content-->
    <div class="modal-content dashmodal">
		
     <div class="modal-body modal-body-delete clearfix">
		<button type="button" class="close cancel" data-dismiss="modal"><i class="icon icon-close"></i></button>
		<div class="col-12 padding0">
			<div class="col-12 md20 sm18 xs16 w600 padding0">Message</div>
			<div class="col-12 md14 sm14 xs14 w400 padding0 mt25px xsmt25px replacemessageTxt">
				
			
			</div>
			
			
		</div>
      </div>
		
    </div>

  </div>
</div>