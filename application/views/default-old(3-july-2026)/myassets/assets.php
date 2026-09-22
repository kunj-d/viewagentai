<style>
.folder-wall1{
    border-radius: 10px;
    border: 1px solid var(--theme-br);
    background: var(--theme-color);
    padding: 20px;
    cursor: pointer;
    height:100%;
}
.appoint-title{
    color: var(--black-color);
    font-size: 16px;
    font-weight: 600;
}
.appoint-text{
    color: #626786;
    font-weight: 400;
    font-size: 1rem;
    line-height: 1.250rem;
}
.appoint-para{
    color: var(--grey-color);
    font-weight: 400;
    font-size: 1rem;
    line-height: 1.250rem;
}
.appoint-inner .dash-drop{
    position: absolute;
    top: 0;
    right: 0;
    z-index: 3;
}
.appoint-inner .dash-drop li a{
    color: var(--black-color);
    text-decoration: none;
    font-size: 14px;
}
.appoint-inner{
    position: relative;
    overflow: hidden;
}
.appoint-inner img{
    width : 70px;
}

.appoint-inner .appoint-btn{
    position: absolute;
    background: rgba(0, 0, 0, 0.50);
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.3s ease;
    text-align: center;
    z-index: 2;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.appoint-inner .appoint-btn .appoint-link{
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--white-color); 
    text-decoration: none;
    border-radius: 10px;
    background: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);
    padding: 10px 20px;  
}
.appoint-inner .appoint-btn .dismiss-link{
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.250rem;
    color: var(--danger-color);
    text-decoration: none;
    border-radius: 10px;
    background: var(--white-color);
    padding: 10px 20px;
}

.folder-wall1:hover .appoint-btn {
    opacity: 1
 }
.appoint-va{
    position: absolute;
    top: 10px;
    right: 10px;
    color: var(--white-color);
    opacity: 0; z-index: 3;
}
.folder-wall1:hover .appoint-va{
    opacity: 1;
}
.folder-wall1 img{
    width: 100%;
}
.folder-wall1 video{
    width: 100%;
}
.modal-dialog.modal-dialog-centered.modelw-450{
    max-width: 850px;
}
ul.dropdown-menu.show{
    transform: translate3d(-11px, 0px, 0px) !imporatant;
}
</style>


  <!-- Container Start -->
    <div class="container-wrapper container-open ng-cloak" ng-app="AppModule"  ng-controller="myassetsCtrl"><title><?php echo $this->config->item('productName') ?> | My Assets</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding"style=" min-height: calc(94vh);">
            <div class="row align-items-center">
            <div class="col-12">
                <div class="title-line">My Assets
                </div>
                <p class="container-page-subtitle mt10">Check all completed Work's here</p>
            </div>
        </div>
            <div class="row">
             
                
               
               
                  
                  
                <div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            
                            <div class="col-12 col-md-12 col-xl-12 text-md-end">
                                <div class="ai-employee-tabs">
                                    <div class="create-btn" style="margin-right:20px">
                                        <a href="#" class="" style="font-size: 16px;" data-bs-toggle="modal" data-bs-target="#new-folder" ng-if="data.level == 0">
                                            <span class="icon-create-new-campaign" style="font-size:15px;"></span> &nbsp; Create New
                                        </a>
                                         <a href="#" class="" style="font-size: 16px;" ng-if="data.level == 1" ng-click="load_folders()">
                                             <--
                                            <span  style="font-size:18px;"></span>
                                            Back
                                        </a>
                                    </div>
                                    <div class="search-bar mt-2 mt-md-0">
                                        <input type="text" class="search form-control ng-pristine ng-untouched ng-valid" placeholder="Search.." id="searchText" ng-model="assetFilter">
                                        <div class="search-icon" id="searchVal" style="cursor:pointer;">
                                            <span class="icon-search"></span>
                                        </div>
                                    </div>
                                </div>    
                            </div>
            

                        
                            <div class="row row-cols-2 row-cols-md-5">
                                <div class="col mt20 mt-md0 mt-3" ng-repeat="(key, val) in data.records |  filter:assetFilter" ng-if='data.records.length > 0'>
                                    <div class="folder-wall" ng-if="val.file_type == '5' ">
                                        <div class="btn-group dropstart dash-drop">
                                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="icon-option"></span>
                                                </button>
                                                <ul class="dropdown-menu ">
                                                    <li ng-click="initialize_rename(val)"><a href="#"><span class="icon-list-edit"></span> Rename</a></li>
                                                    <li ng-click="initialize_delete(val)"><a href="" ><span class="icon-list-delete"></span> Delete</a></li>
                                                </ul>
                                            </div>
                                        <div class="appoint-inner">
                                            <a href="#" ng-click="select_folder(val.library_object_id, val.title)">
                                                <img src="<?= $this->config->item('assetsPath')?>images/folder-img.png" class="mx-auto d-block img-fluid">
                                                
                                            </a>
                                        </div>
                                        <div class="mt-2 appoint-title text-center">
                                             {{ val.file_name }}
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- For image View-->
                                    
                                   
                                    
                                    
                                    <div class="folder-wall1" ng-if="val.file_type == '1' ">
                                        <div class="appoint-inner">
                                            <a href="#">
                                                <img src="{{val.file}}" class="mx-auto d-block img-fluid" >
                                            </a>
                                            <div class="btn-group dropstart dash-drop">
                                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="icon-option"></span>
                                                </button>
                                                <ul class="dropdown-menu ">
                                                    <li ng-click="initialize_rename(val)"><a href="#"><span class="icon-list-edit"></span> Rename</a></li>
                                                    <li  ng-click="downloadFile(val.file,val.file_extension)"><a href=""><span class="icon-library-download"></span> Download</a></li>
                                                    <li ng-click="initialize_delete(val)"><a href="" ><span class="icon-list-delete"></span> Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="appoint-btn">
                                                <!--<a href="#modal" class="" data-bs-toggle="modal" data-bs-target="#imageModal" style="font-size:30px; color:white;"> <span class="icon-password-view"></span></a>-->
                                                <a href="#" class="" style="font-size:30px; color:white;" ng-click="viewData(val.file,val.file_extension)"><span class="icon-password-view"></span></a>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="mt19 appoint-title text-center">
                                             {{ val.file_name }}
                                        </div>
                                    </div>
                             
                                    <div class="folder-wall1" ng-if="val.file_type == '2' ">
                                        <div class="appoint-inner">
                                            <a href="#">
                                                <video style="width:100%; height: 210px;"    controls> <source ng-src="{{val.file | trustUrl}}" /> 
                                                Your browser does not support the video tag.
                                                </video>
                                            </a>
                                        <div class="btn-group dropstart dash-drop">
                                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="icon-option"></span>
                                                </button>
                                                <ul class="dropdown-menu ">
                                                    <li ng-click="initialize_rename(val)"><a href="#"><span class="icon-list-edit"></span> Rename</a></li>
                                                    <li ng-click="downloadFile(val.file,val.file_extension)"><a href=""><span class="icon-library-download"></span> Download</a></li>
                                                    <li ng-click="initialize_delete(val)"><a href="" ><span class="icon-list-delete"></span> Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="appoint-btn">
                                                <!--<a href="#" class="" style="font-size:30px; color:white;"><span class="icon-password-view"></span></a>-->
                                                <!--<a href="#modal" class="" data-bs-toggle="modal" data-bs-target="#videoModal" style="font-size:30px; color:white;"> <span class="icon-password-view"></span></a>-->
                                                <a href="javascript:void()" class=""  style="font-size:30px; color:white;" ng-click="viewData(val.file,val.file_extension)"> <span class="icon-password-view"></span></a>
                                            </div>
                                        </div>
                                        <div class="mt19 appoint-title text-center">
                                             {{ val.file_name }}
                                        </div>
                                    </div>
                                    
                                    <div class="folder-wall1" ng-if="val.file_type == '3' ">
                                        <div class="appoint-inner" >
                                            <a href="#">
                                                <img src="<?= $assetsPath ?>images/pdf.png"
                                             class="mx-auto d-block img-fluid"
                                             >
                                            </a>
                                        <div class="btn-group dropstart dash-drop" >
                                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="icon-option"></span>
                                                </button>
                                                <ul class="dropdown-menu ">
                                                    <li ng-click="initialize_rename(val)"><a href="#" ><span class="icon-list-edit"></span> Rename</a></li>
                                                    <li data-id="{{val.file}}" class="pdfDownload"><a href=""><span
                                                class="icon-library-download"></span> Download</a></li>
                                                    <li ng-click="initialize_delete(val)"><a href=""><span class="icon-list-delete"></span> Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="appoint-btn">
                                                <a href="#" class="" ng-click="viewData(val.file,val.file_extension)" style="font-size:30px; color:white;"><span class="icon-password-view"></span></a>
                                            </div>
                                        </div>
                                        <div class="mt19 appoint-title text-center">
                                             {{ val.file_name }}
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                      </div>
                </div>
            </div>
        </div>
        
        
         
                       
        
    <!--Start Create Folder Modal-->
    <div class="modal new-folder-modal fade" id="new-folder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    
        <div class="modal-dialog modal-dialog-centered">
    
            <div class="modal-content">
                 <form ng-submit="create_folder()" class='mb-0'>
                <div class="modal-body p-15 p-md30">
    
                    <img class="img-fluid d-block mx-auto"
                        ng-src="<?= $this->config->item('assetsPath')?>images/folder-img.png"
                        src="<?= $this->config->item('assetsPath')?>images/folder-img.png" style="margin-bottom: 15px;">

                        <div class="form-group d-gblue-clr f-14 mb0 mt15 mt-md35" ng-class="{'error-message':general.add_folder_title.error}">
                            <label for="exampleSelect1">Folder name</label>
                            <input type="text" id="createFolderInput"ng-model="general.add_folder_title.value" maxlength="20" class="form-control field-h40 f-14" placeholder="Folder name">
                        
                            <small class="form-text f-14 text-left" ng-show="general.add_folder_title.error">{{ general.add_folder_title.message }}</small>
                        </div>
                </div>
    
                <div class="modal-footer">
    
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
    
                    <button type="submit" class="btn btn-primary">Create</button>
    
                </div>
                 </form>
            </div>
    
        </div>
    </div>
    <!--End Create Folder Modal-->
        
    
    
    

    <!--Start Rename Folder Modal-->
    <div class="modal new-folder-modal fade" id="renameFolder" tabindex="-1" aria-labelledby="exampleModalLabel"
    	aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<form ng-submit="rename_object()" class='mb-0'>
    				<div class="modal-body p-15 p-md30">
    					<img class="img-fluid d-block mx-auto"
    						ng-src="<?= $this->config->item('assetsPath')?>images/folder-img.png"
    						src="<?= $this->config->item('assetsPath')?>images/folder-img.png" style="margin-bottom: 15px;">
    					<h5>Rename Your Folder</h5>
    					<div class="form-group d-gblue-clr f-14 mt-lg-3 mt-2"
    						ng-class="{'error-message':general.add_folder_title.error}">
    						<label for="exampleSelect1">Folder Name</label>
    						<input type="text" id="renameFolderInput" ng-model="general.rename_object_title.value"
    							maxlength="20" class="form-control field-h40 f-14" placeholder="Folder name">
    						<small class="form-text f-14 text-left" style="color:red;"
    							ng-show="general.rename_object_title.error">{{general.rename_object_title.message}}</small>
    					</div>
    				</div>
    
    				<div class="modal-footer">
    					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
    					<button type="submit" class="btn btn-primary">Save</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    <!--End Create Folder Modal-->
        
    
    
    





    <!-- Delete Modal Popup Made by shadab-->
    <div class="modal new-folder-modal fade" id="deleteFolderModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-15 p-md30">
                <img class="img-fluid d-block mx-auto"
                    ng-src="<?= $this->config->item('assetsPath')?>images/folder-img.png"
                    src="<?= $this->config->item('assetsPath')?>images/folder-img.png" style="margin-bottom: 15px;">
                <p>Are You Sure?</p>
                <div class="mt10 description">
                    Do you really want to delete this item? This item <br class="d-none d-lg-block">
                    cannot be recovered
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger yes">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Delete Modal Popup End -->
    
    
        
    <!-- Start Upload Modal -->
    
     <div class="modal fade pop"  id="uploadfileModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modelw-450">
            <div class="modal-content delete-model">
                <div class="modal-body">
                    <span  id="showRespomse" style="white-space: pre-line;"></span>
                   
                  
                    <div class="mt30 text-center">
                        <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="responseDownload" class="base-btn red-btn yes" ng-click="copyContent()" >Copy Text</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade pop"  id="uploadfileModal2" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modelw-450">
            <div class="modal-content delete-model">
                <div class="modal-body">
                    <span  id="showRespomse" style="white-space: pre-line;"></span>
                   
                  
                    <div class="mt30 text-center">
                        <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="responseDownload" class="base-btn red-btn yes" ng-click="copyContent()" >Copy Text</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade pop" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-body">
                     <img  src="" class="mx-auto d-block img-fluid" id="imageFile">
                </div>
            </div>
        </div>
    </div>
    
     <div class="modal fade pop" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-body text-center">
                     <iframe width="420" height="315" src="" id="videoFile"> </iframe>
                </div>
            </div>
        </div>
    </div>
   <!--End image Modal-->
     <script>



    
        
    


  var app = angular.module("AppModule", []);
  app.filter("trustUrl", ['$sce', function ($sce) {
        return function (recordingUrl) {
            return $sce.trustAsResourceUrl(recordingUrl);
        };
    }]);

  app.controller("myassetsCtrl", function ($scope, $http, $timeout) {
      
      
        var copyText ='';
      	$scope.general = {
		select_object:'',
		add_folder_title:{error:false,message:'',value:''},
		rename_object_title:{error:false,message:'',value:'',type:'',id:''},
		select : [],
		all_folders : [],
		select_folder : {error:false,message:'',type:'',id:''},
        all_businesses : [],
		select_business : {error:false,message:'',type:'',id:''},
		upload_types : ['all','image','video','document','audio','other'],
		share : {link:'',email:{error:false,message:'',value:[]},message:'',expiry:'',id:''},
		status : {privacy:'',password:{error:false,message:'',value:'',protected:true},type:'',id:''},
		delete_object : {id:'',type:''},
		transfer_object : {id:'',type:''},
		doc_slug: '',
		doc_edit : false,
		domain : '',
		doc_suffix : ''

	
	};
	
	
	
	$scope.data = {
		records : [],
		total_rows : 0,
		show_total_rows : 0,
		limit : "10",
		current_page: 1,
		search : '',
		type : '',
		filter :[{"title":"","value":"","gate":"or"}],
		first_filter :'uploaded',
		select : {all:false,folder:false,image:false,video:false,audio:false,document:false,other:false},
		order_by :"desc",
		order_type : 'created_date',
		folder_id : '',
		folder_title : '',
		recent:'',
		is_myDrive:'0',
		folder_nav : [],
		level : 0
	}
	
	
	
	
	
	/*-----------------------------------------------------------------------------------*/
     
    $scope.create_folder = function () {
    console.log($scope.general);
    
    	if ($scope.general.add_folder_title.value.trim() == '') {
    		$scope.general.add_folder_title.error = true;
    		$scope.general.add_folder_title.message = 'Folder Name required';
    		return;
    	}
    	var data = '';
    	jsLoader(true);
    	var data = $.param({ 
    	    title: $scope.general.add_folder_title.value, 
    	});
    	$http({
    		url: '<?= base_url('my-assets/add-folder') ?>',
    		method: "POST",
    		data: data,
    		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    	}).then(function (response) {
    			$('#new-folder').modal("hide");
    			$scope.load_folders();
    			$("#createFolderInput").val(null);
    			jsLoader(false);
    	    if(response.data.status == 'success'){
    	        toastr.success(response.data.message);
    	    }else{
    	        toastr.error(response.data.message);
    	    }
    	    
    	}).catch(function (error) {
            console.log(error);
        });

    }
    
    
    /*-----------------------------------------------------------------------------------*/
    
	$scope.load_folders = function(){
	    jsLoader(true);
		$http({
			url: '<?= base_url('my-assets/get-all-folders') ?>',
			method: "POST",
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.then(function(response) {
			if(response.data.status == 'success'){
			 //   alert('ok');
				$scope.general.all_folders = response.data.message.records;
				$scope.data.records = response.data.message.records;
				$scope.data.level = 0;
				
				
				console.log($scope.general.all_folders);
				// $timeout(function () {$('.selectpicker').selectpicker('refresh');});
			}
		});
		
		
		jsLoader(false);
	}
	$scope.load_folders();
	
	/*-----------------------------------------------------------------------------------*/

	/* Start Rename Functions */
	$scope.initialize_rename = function(object){
	    
	    console.log(object);
	    console.log(object.title)
		$("#renameFolder").modal('show');
	    $scope.general.rename_object_title.value = object.title;
		$scope.general.rename_object_title.type= object.file_type;
		$scope.general.rename_object_title.error= false;
		
		
        //5 means folder
        
		if(object.file_type == "5"){
			$scope.general.rename_object_title.id = object.library_object_id;
		}else{
			$scope.general.rename_object_title.id = object.library_object_id;
		}
	}
	
	$scope.rename_object = function(){
		if($scope.general.rename_object_title.value.trim() ==''){
			$scope.general.rename_object_title.error = true;
			$scope.general.rename_object_title.message = 'Folder Name required';
			return;
		}
		if($scope.general.rename_object_title.type == '5'){
		   url = '<?= base_url('my-assets/rename-object') ?>';
			
		}else{
		    
	        url = '<?= base_url('my-assets/rename-object') ?>';
		}
		var data = $.param({ title: $scope.general.rename_object_title.value, id: $scope.general.rename_object_title.id});

            $http({
    			url: url,
    			method: "POST",
    			data: data,
    			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    		}).then(function(response) {
    			//console.log(response);
    			
    			if(response.data.status == 'success'){
    				$scope.general.rename_object_title.error = false;
    				$('#renameFolder').modal('hide');
    				$scope.load_folders();
    			    $("#renameFolderInput").val('');
    			    $scope.general.rename_object_title.value = '';
    				
    			}else{
    				$scope.general.rename_object_title.error = true;
    				$scope.general.rename_object_title.message = response.data.message;
    			}
    				
    		});

	}
  
    $scope.viewData = function(file,extension){
        if(extension == 'doc')
        {
             $http({
        		url: '<?= base_url('my-assets/getdocxdata') ?>',
        		method: "POST",
        		data: {
        		    id:file,
        		},
        		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        	}).then(function (response) {
        	    $('#showRespomse').html("");
        	    $('#showRespomse').html("<p>"+response.data.ai+"</p>");
        	    $('#responseDownload').attr("data-id",file);
        	    $('#uploadfileModal').modal('show');
        			
        	}).catch(function (error) {
                console.log(error);
            });
        }else if(extension == 'png' || extension == 'gif'){
                $('#imageFile').attr('src','')
                $('#imageFile').attr('src',file)
        	    $('#imageModal').modal('show');
        }else if(extension == 'mp4'){
                $('#videoFile').attr('src','')
                $('#videoFile').attr('src',file)
        	    $('#videoModal').modal('show');
        }
        
    }
    
  $scope.copyContent = async () => {
       try {
           var text = $('#showRespomse').text();
           await navigator.clipboard.writeText(text);
           toastr.info('Content copied to clipboard');
       } catch (err) {
           console.error('Failed to copy: ', err);
       }
   }
  
     
    /* End Rename Functions */
    
    $(document).on('click', '.pdfDownload', function () {
       var id = $(this).data('id');
       window.location.href = siteUrl + 'pdfgenerate?id=' + id
   });
    
	
	 $scope.initialize_delete = function (object) {
   
       console.log(object);
       $("#deleteFolderModal").modal('show');
   
       $scope.general.delete_object.type = object.file_type;
   
       if (object.file_type == '1') {
           $scope.general.delete_object.id = object.library_object_id;
       } else {
           $scope.general.delete_object.id = object.library_object_id;
       }
   
       $('#deleteFolderModal .yes').on('click', function (e) {
           $("#deleteFolderModal").modal("hide");
           $scope.delete_folder(object);
       });
   
   }
   $scope.delete_folder = function (object) {
   
       jsLoader(true);
   
       var group_select = false;
       var single_delete = true;
       var data = '';
       var object_id = [];
   
       if (single_delete && !group_select) {
           object_id.push({ type: $scope.general.delete_object.type, id: $scope.general.delete_object.id });
       }
       data += '&object_id=' + JSON.stringify(object_id);
   
       $http({
           url: '<?= base_url('my-assets/delete-object') ?>',
           method: "POST",
           data: data,
           headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
   })
   .then(function (response) {
               $('#deleteFolderModal').modal('hide');
               if(response.data.status == 1){
                    toastr.success(response.data.msg);
                    if(response.data.type == 1){
                        $scope.get_data(true);
                    }else{
                        $scope.load_folders();
                    }
                    jsLoader(false);
               }else{
                    toastr.error(response.data.msg);
               }
               console.log(response.data)
   
   
           });
   	
   	
   
   
   }
   
	/* End Delete Function */
	
	$scope.get_condition = function(){
		var data = '';
		data += 'search='+$scope.data.search;
		data += '&recent='+$scope.data.recent;
		data += '&is_myDrive='+$scope.data.is_myDrive;                          
		data += '&items_per_page='+$scope.data.limit;
		data += '&current_page='+$scope.data.current_page;
		data += '&order_type='+$scope.data.order_type;
		data += '&order_by='+$scope.data.order_by;
		data += '&type='+$scope.data.type;
		data += '&folder_id='+$scope.data.folder_id;
		data += '&select='+JSON.stringify($scope.data.select);

		return data;
	}
	
	$scope.get_data = function(callback = false, msg=''){ 
		
		jsLoader(true);
		var data = $scope.get_condition();

		
		$http({
			url: '<?= base_url('my-assets/open-folder-view') ?>',
			method: "POST",
			data: data,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.then(function(response) {
				
			$scope.data.records = response.data.message.records;
			$scope.data.level = 1 ;
			
			jsLoader(false);
			
			console.log($scope.data.records);
				
		
			
		});
	}
	
	
	
	
	
	$scope.select_folder = function(id,title){
	    
	     

    	$scope.data.folder_id = id;
    	
    	$scope.data.folder_title = title;
    	$scope.data.recent = '';
        $scope.get_data();
    	
    	$scope.data.folder_nav.push({'object_id':id,'title':title})
    	
    	var findflag = false;
    	var updated_nav = [];
    	angular.forEach($scope.data.folder_nav,function(val,key){
    		if(!findflag){
    			updated_nav.push(val);	
    		}
    		if(val.object_id == id){
    			findflag = true;
    		}
    	})
    	$scope.data.folder_nav = updated_nav;
    

    }
   
  
    $scope.downloadFile = function (url,extension) {

        fetch(url)
            .then(response => response.blob())
            .then(blob => {
                // Creating an invisible link
                var link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = 'downloaded.'+extension;

                // Triggering the click event on the link
                link.click();
            })
            .catch(error => console.error('Error downloading image:', error));
    };
	
	

	
	
	
	
	
	
	
	
	
	
	

	

	
});//End myassetsCtrl


</script>
        
        
