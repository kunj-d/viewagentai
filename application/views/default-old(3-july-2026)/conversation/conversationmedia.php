<style>
	 .assistant-img {
		 width: 140px;
		 height: 130px;
		 border-radius: 100%;
		 border: 1px solid #374073;
		 background: #27215D;
	}
	.library-result {
		height: 250px;
		margin-bottom:24px;
		position: relative;
	}
	.library-result img {
		width:100%;
		height: 100%;
		object-fit :cover
	}
	.library-result .overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		background: rgba(0,0,0,0.5);
		opacity:0;
		transition: all 0.8s;
	}
	.library-result .overlay:hover{
		opacity:1;
	}
	.library-result .overlay a {
		width: 40px;
		height: 40px;
		background: var(--theme-bg);
		display: flex;
		justify-content: center;
		align-items: center;
		margin-right: 10px;
		border-radius: 5px;
		/* opacity: 1; */
		color: var(--grey-color);
		font-size: 18px;
	}
	.library-result .overlay a:hover{
		background:var(--theme-br2);
		color:var(--white-color);
	}
	.library-result .overlay a:last-child{
		margin-right:0;
	}
	.right-btn {
	position: absolute;
	right: 0px;
	background: var(--blue-gradient1);
	border:0px;
	color:var(--theme-color);
	z-index:9999;
}
.right-btn:hover{
	color:var(--theme-color) !important;
}
.right-sidebar {
	position: fixed;
	right: -100%;
	 transition: 0.5s;
	 top:60px;
	 z-index:999;
	 max-width:350px;
	 background: var(--theme-bg2);
	 border-radius: 10px;
}
.right-sidebar.slideOn {
	right: 0;
}
.sidebar-btn a{
	position: absolute !important;
	top: -20px !important;
	right: 55px !important;
}
.sidebar-btn a {
	padding: 8px 30px 9px;
}
.sidebar-btn .theme-btn-blue{border-radius:5px;}
.chat-bot-close{
	position: relative;
	color: var(--white-color);
	top: 55px;
	left: 49%;
}


.chatBG-header:focus{
	position: absolute !important;
	top: 88px !important;
}
/*.chatBG-item.dropbg .chatBG-header:focus {*/
/*     transform: scale(3); */
/*     opacity: 0; */
/*     z-index: -1; */
/*}*/
div#accordionExample{width:300px;}
a.dark-bg.ng-binding.ng-scope:focus{
	background: var(--theme-color2) !important;
}
.text-generater a:hover{
	 transform: scale(1.01);
}

 .chat-superva .regenerator-text.showOn {
	display: block;
	width: 120px;
	margin-top: 0;
	left:90px;
	height:145px;
}
.chat-superva.regenerator-text {
	border-radius: 10px 10px 0px 0px;
	border: 1px solid #374073;
	border-bottom: 0px solid #374073;
	background: #27215D;
	padding: 10px;
	display: none;
	position: absolute;
	bottom: 100%;
	left: 10.2%; 
	/* transform: translateX(-50%); */
	margin-top: 100px;
	transition: all 0.5s;
}
.left-tg-border .title-line{
	background: var(--theme-color2);
	border-radius: 10px;
	padding: 5px;
}
.prompt .title-line{
	background: var(--theme-color2);
	border-radius: 10px;
	padding: 5px;
}

.icon-list-edit1 {
	font-size: 20px;
	background: #fff;
	border: 1px solid var(--blue-gradient);
	padding: 5px;
	color: var(--blue-gradient);
}
.mic-off{
	content: url(app/assets/images/mic.png);
	width: 24px;
	height: 24px;
	display:inline-block;
	cursor:pointer;
}
.mic-on{
	content: url(app/assets/images/microphone1.gif);
	width: 24px;
	height: 24px;
}


.chat-main-container {
	min-width: 800px;
	min-height: 85vh;
	max-height: 84vh;
	display: flex;
	overflow: hidden;
	box-sizing: border-box;
	width: 100vw;
	height: auto;
	position: relative;
	word-wrap: break-word;
	background-clip: border-box;
	/*margin-bottom: 1.5rem;*/
	box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
	border-radius: 8px;
	padding-left: 0;
	padding-right: 0;
}
.chat-main-container #expand {
	display: none;
}
.chat-main-container .chat-sidebar-container {
	top: 0;
	width: 240px;
	box-sizing: border-box;
	display: flex;
	flex-direction: column;
	border-right: 1px solid var(--theme-br);
	position: relative;
	transition: width 0.05s ease;
}
.chat-sidebar-search {
	border-bottom: 1px solid var(--theme-br) !important;
}
.chat-sidebar-search {
	max-height: 79px;
	min-height: 79px;
	font-size: 16px;
	margin: 0;
	padding: 15px 20px;
	color: var(--grey-color);
	display: flex;
	align-items: center;
	position: relative;
	/*min-height: 3.5rem;*/
	border-bottom: 1px solid var(--theme-br);
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages {
	flex: 1 1;
	overflow: auto;
	overflow-x: hidden;
	padding: 20px;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message {
	padding: 10px 14px;
	background-color: var(--theme-bg2);
	border-radius: 10px;
	margin-bottom: 10px;
	border: 1px solid var(--theme-br);
	transition: background-color 0.3s ease;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	position: relative;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .selected-message {
	border: 1px solid  var(--theme-br) !important;
	background-color: var(--theme-bg2);
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-title {
	font-size: 14px;
	font-weight: 600;
	display: block;
	width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .selected-message .chat-title {
	color: var(--text-dark);
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-info {
	color: var(--grey-color);
	font-size: 12px;
	margin-top: 8px;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions {
	position: absolute;
	top: 25px;
	right: -20px;
	transition: all 0.3s ease;
	opacity: 0;
	cursor: pointer;
	z-index: 100;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions a{
	color:var(--grey-color);
	font-size:16px;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message .chat-actions a:hover{
	color:var(--text-dark);
	font-size:16px;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover, .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus {

	background: var(--theme-bg);
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions, .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions {
	opacity: 0.5;
	right: 10px;
}
.chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions:hover, .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:hover .chat-actions:focus, .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions:hover, .chat-main-container .chat-sidebar-container .chat-sidebar-messages .chat-sidebar-message:focus .chat-actions:focus {
	opacity: 1;
 
}
.chat-main-container .card-footer {
	border-top: 1px solid var(--theme-br) !important;
	min-height: 75px !important;
}
.chat-main-container .chat-message-container {
	width: calc(100% - 240px);
	height: 100%;
	display: flex;
	flex-direction: column;
}
.chat-avatar {
	border-radius: 50%;
	height: 44px;
	width: 44px;
	clear: both;
	display: block;
	position: relative;
}
#chat-system {
	min-height: 400px;
	font-size: 13px;
}
.card-header {
	background: transparent;
	padding:  11px 1.5rem; 
	display: flex;
	min-height: 79px;
	max-height: 79px;
	/*min-height: 3.5rem;*/
	align-items: center;
	margin-bottom: 0;
	border-bottom: 1px solid var(--theme-br);
	position: relative;
}
.card-header:first-child {
	border-radius: 2px 2px 0 0;
}
.card-header:before {
	content: "";
	position: absolute;
	left: 0px;
	padding: 3px;
	border-radius: 0 50px 50px 0;
	height: 20px;
}
.text-muted {
	color: var(--grey-color) !important;
}
.table-action-buttons {
	background: var(--theme-bg);
	border: none;
	border-radius: 5px;
	color: var(--grey-color);
	width: 40px;
	height: 40px;
	text-align: center;
	transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, -webkit-text-decoration-color;
	transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
	transition-duration: 0.15s;
	padding:12px;
}
.table-action-buttons-big {
	/*line-height: 2.4 !important;*/
	font-size: 18px !important;
	width: 40px !important;
	height: 40px !important;
}
.view-action-button, .delete-action-button, .edit-action-button {
	transition: all 0.3s;
}
.openPromt .modal-content{
	max-height:90vh;
	overflow:auto;;
}
@media (max-width: 767px){
	.send-box{
		margin-top:15px;
	}
	.chat-main-container {
		min-width: 100%; 
		min-height: 91vh;
		max-height: 91vh;
		width: 100vw;
		height: auto;
	}
	.chat-main-container .chat-message-container{
		min-width: 100%;
		position: relative;
		left: -265px;
	}
	.chat-sidebar-search{
		padding: 7px 20px;
	}
	.chat-sidebar-container{
		left:-271px;
		transition: 0.5s;
	}
	.chat-sidebar-container.slideOn{
		left: 0px;
		background: var(--theme-bg);
		z-index: 1;
	}
	.card-header {
		display: block;
		/*min-height: block;*/
		align-items: center;
		min-height:8rem;
	}
	.card-header a {display:inline-block;}
	.chatbox-area{
		padding:0;
		height: calc(100vh - 22rem);
	}
	.sender-img{
		width:25px;
	}
	.receiver-img{
		width:25px;
	}
	.chatbox-sendbox{
		padding:10px 0;
	}
	.send-btn{
		max-width:40px;
		max-height:40px;
		font-size:18px;
		padding:10px;
	}
	.chat-superva .regenerator-text.showOn{
		bottom: 120px;
		left: 75px;
	}
}
.view-action-button:hover, .delete-action-button:hover, .edit-action-button:hover {
	transform: translateY(-3px);
	box-shadow: 0 0.5rem 1rem rgba(29, 39, 59, 0.15);
}
.edit-action-button:hover, .edit-action-button:focus {
	background: var(--primary-color);
	color: var(--text-dark) !important;
}
textarea {
	overflow: auto; /* This allows scrolling */
	scrollbar-width: none; /* Firefox */
	-ms-overflow-style: none; /* IE and Edge */
}

textarea::-webkit-scrollbar {
	display: none; /* WebKit browsers */
}
</style>
<!-- Container Start -->
<div class="container-wrapper container-open w-100"  ng-app="AppModule" ng-controller="virtualAssitant" ng-cloak>
	 <title><?php echo $this->config->item('productName') ?> || Stocks</title>
	 <!-- Main Container Start -->
	 <div class="container-fluid container-padding">
		 <div class="row ">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-md-3">
						<?php $this->load->view("default/aigeneration/nav.php"); ?>
					</div>
					<div class="col-md-9">
						<div class="tab-content library-content style-2" id="pills-tabContent">
							<div class="tab-pane fade show active" id="imagetoimage" role="tabpanel" aria-labelledby="imagetoimage-tab">
								
	
								<div class="comman-ai-box d-flex flex-column row-gap-2">
								<p class="m-0" style="font-weight: 500; font-size: 1rem;">Stocks</p>
									<form method="post" enctype="multipart/form-data">
										<div>
											<select class="form-control" ng-model="vaPurpose" ng-change="setSuperVapurpose()" ng-init="vaPurpose = vaPurpose || 'images'">
												<option value="images">Images</option>
												<option value="videos">Videos</option>
												<option value="gifs">Gifs</option>
											</select>
										</div>
										<div class="sample-box ">
											<p>Select No. of Outputs</p>
											<ul class="p-0">
												<li ng-class="{active: selectedNumber == 1}" ng-click="selectNumber(1)">1</li>
												<li ng-class="{active: selectedNumber == 2}" ng-click="selectNumber(2)">2</li>
												<li ng-class="{active: selectedNumber == 3}" ng-click="selectNumber(3)">3</li>
												<li ng-class="{active: selectedNumber == 4}" ng-click="selectNumber(4)">4</li>
											</ul>
										</div>
										<div class="prompt-box">
											<p>Enter A Keyword</p>
											<div class="send-msg chatbox-input">
												<textarea class="form-control" id="inputText" placeholder="Enter A Keyword to Search Image, Video, GIF From 15 Million+ Stock Library." ng-model="chat"></textarea>
											</div>
										</div>
										<div class="text-end">
											<button type="button" ng-click="addMessage()" class="btn btn-primary send-btn" style="margin-top:8px">Search</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="genrate-content-side">
					<span ng-repeat="chat in chating">
						<div ng-if='chat.ai'>
							<div ng-if="chat.type !='chatgpt'">
								<div class="h-auto m-0 row">
									<div class="col-md-6 col-xl-4 mt20" ng-repeat="(key, image) in chat.ai">
										<div class="appoint-wall style-2 template-editor-wrapper">
											<div class="media" ng-show="image.file_type =='image'">
												<img src="{{ image.largeImageURL }}" alt="Image" class="img-fluid d-block mx-auto">
												<div class="template-buttons">
													<div class="flex grid-buttons text-center">
														<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
														<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'png')" ><i class="fa-solid fa-download"></i></a>
														<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(chat.id,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
													</div>
												</div>
											</div>
											<div class="media" ng-show="image.file_type =='gifs'">
												<img src="{{ image.largeImageURL }}" alt="Gifs" class="img-fluid d-block mx-auto">
												<div class="template-buttons">
													<div class="flex grid-buttons text-center">
														<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
														<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'gif')" ><i class="fa-solid fa-download"></i></a>
														<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(chat.id,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
													</div>
												</div>
											</div>
											<div class="media" ng-show="image.file_type =='stickers'">
												<img src="{{ image.largeImageURL }}" alt="Stickers" class="img-fluid d-block mx-auto">
												<div class="template-buttons">
													<div class="flex grid-buttons text-center">
														<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
														<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'gif')" ><i class="fa-solid fa-download"></i></a>
														<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(chat.id,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
													</div>
												</div>
											</div>
											<div class="media" ng-show="image.file_type =='video'">
												<img src="{{ image.largeImageURL }}" style="height:200px;" alt="Video" class="img-fluid d-block mx-auto">
												<div class="template-buttons">
													<div class="flex grid-buttons text-center">
														<a href="javascript:void(0);" class="grid-image-view" ng-click="playVideo(image.small_video)"><i class="fa-solid fa-eye"></i></a>
														<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.small_video,'mp4')" ><i class="fa-solid fa-download"></i></a>
														<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(chat.id,image.small_video)"><i class="fa-solid fa-bookmark"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</span>
					<!-- <div class="h-auto m-0 row" ng-repeat="chat in chating">
						<div class="col-md-6 col-xl-4 mt20" ng-repeat="(key, image) in chat.ai">
							<div class="appoint-wall style-2 template-editor-wrapper">
								<div class="media" ng-show="image.file_type =='image'">
									<img src="{{image.largeImageURL}}">
									<div class="template-buttons">
										<div class="flex grid-buttons text-center">
											<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'png')" ><i class="fa-solid fa-download"></i></a>
											<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(key,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="delete(key)" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal"><i class="fa-solid fa-trash-can"></i></a>
										</div>
									</div>
								</div>
								<div class="media" ng-show="image.file_type =='gifs'">
									<img src="{{image.largeImageURL}}">
									<div class="template-buttons">
										<div class="flex grid-buttons text-center">
											<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'gif')" ><i class="fa-solid fa-download"></i></a>
											<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(key,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="delete(key)" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal"><i class="fa-solid fa-trash-can"></i></a>
										</div>
									</div>
								</div>
								<div class="media" ng-show="image.file_type =='stickers'">
									<img src="{{image.largeImageURL}}">
									<div class="template-buttons">
										<div class="flex grid-buttons text-center">
											<a href="javascript:void(0);" class="grid-image-view" ng-click="showModal(image.largeImageURL)"><i class="fa-solid fa-eye"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.largeImageURL,'gif')" ><i class="fa-solid fa-download"></i></a>
											<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(key,image.largeImageURL)"><i class="fa-solid fa-bookmark"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="delete(key)" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal"><i class="fa-solid fa-trash-can"></i></a>
										</div>
									</div>
								</div>
								<div class="media" ng-show="image.file_type =='video'">
									<img src="{{image.largeImageURL}}">
									<div class="template-buttons">
										<div class="flex grid-buttons text-center">
											<a href="javascript:void(0);" class="grid-image-view" ng-click="playVideo(image.small_video)"><i class="fa-solid fa-eye"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="downloadFile(image.small_video,'mp4')" ><i class="fa-solid fa-download"></i></a>
											<a href="javascript:void(0);" class="grid-image-view" ng-click="saveToGallery(key,image.small_video)"><i class="fa-solid fa-bookmark"></i></a>
											<a href="javascript:void(0)" class="grid-image-view" ng-click="delete(key)" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal"><i class="fa-solid fa-trash-can"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('default/aigeneration/modal-popup'); ?>

	<div class="modal fade" id="StockVideosPopup" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modelw-450">
			<div class="modal-content delete-model">
				<div class="modal-body text-center">
					<div class="mt10 description" id="divVideo">
						<video>
							<source src="https://player.vimeo.com/external/180289892.hd.mp4?s=eb15830073fb988b59fc25009bf30349d2d9eed5&profile_id=119" type="video/mp4" /> 
							Your browser does not support the video tag.
						</video>
					</div>
					<div class="mt30">
						<button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
		
		<!-- Delete Modal Popup End -->
<!---------LightBox ---------->
<link href="<?php echo $assetsBasePath; ?>vendors/lighbox/lightbox-gallery.css" rel="stylesheet" />
<script type='text/javascript' src="<?php echo $assetsFolder; ?>vendors/lighbox/lightbox-gallery.js"></script>
<script type='text/javascript' src="<?= $this->config->item('assetsBasePath') ?>assets/js/speechtotext.js"></script>
<script src="<?= $this->config->item('assetsBasePath') ?>assets/js/selector.js"></script>

<script>
		var imagesListTypes = {'type': 'image-to-image', 'folderType': 'stocks'};
</script>

<?php $this->load->view('default/aigeneration/scripts'); ?>
	 