<style>



 </style>
 <!-- Container Start -->
    <div class="container-wrapper container-open " ng-app="AppModule" ng-controller="virtualAssitant" ng-cloak>
        <title><?php echo $this->config->item('productName') ?> | Lets Work</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding" >
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="title-line">
                    <i class="fa-regular fa-circle-left me-2"></i>Choose From Templates
                    </div>
                    <p class="container-page-subtitle mt10">Find your AI assistant quickly! Get ready to explore our fantastic lineup of AI chat assistants</p>
                </div>
            </div>
            <div class="row mt10">
                <div class="col-md-12 col-12">
                    <div class="search-bar" style="max-width: 100vw">
                        <input type="text" class="search1 form-control" placeholder="Search for AI Assistants..." id="searchText" ng-model="searchQuery">
                    </div>
                </div>
            </div>
            <div class="row mt10">
                <div class="col-md-12 col-12">
                    <div class="tabs-banner style-2 p-0 bg-transparent">
                        <ul class="f-12 w600 white p-0 m-0 tabs-list"  onclick="tabActive(event)">
                            <li class="active" ng-click="changeTab('all')">All Agents</li>
                            <li ng-click="changeTab(1)">Business</li>
                            <li ng-click="changeTab(2)">Coach</li>
                            <li ng-click="changeTab(4)">Education</li>
                            <li ng-click="changeTab(6)">Health</li>
                            <li ng-click="changeTab(7)">Leisure</li>
                            <li ng-click="changeTab(8)">Specialist</li>
                            <li ng-click="changeTab(10)">Other</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class='row mt20 mt-md30 row-gap row-cols-xxl-5 row-cols-lg-4 row-cols-sm-2'>
              <div class="col">
                  <div class="templates-card active">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <div class="content">
                          <h6 class="title">YouTube Short Scripts</h6> 
                          <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                        </div>
                        <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              <div class="col">
                  <div class="templates-card ">
                      <div class="template-image">
                          <img src="<?= $this->config->item('assetsPath')  ?>/images/default-img.png">
                      </div>
                      <h6 class="title">YouTube Short Scripts</h6> 
                      <div class="select-box">
                            <a href="#" class="btn btn-light text-dark">Select Template</a> 
                        </div>
                  </div>
                  
              </div>
              
                
                <div ng-if="allList.length == 0" class="d-none">
                   <div class="col-xs-12  mt30px xsmt25px">
          				<div class="col-md-12 col-sm-12 col-xs-12 padding0">
          					<div class="row">
          						<div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3">
          							<div class="col-xs-12 padding0 ">
          								<img src="<?= $assetsFolder ?>images/no-record-found.png" class="img-responsive center-block mt6 xsmt6">
          								<div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Record Found</div>
          							</div>
          						</div>
          					</div>
          				</div>
          			</div>
                </div>
                
            </div>
            
        </div>
        
    <script>
        // $(document).ready(function(){
        //     $('.meta .fa-star').click(function(){
        //         if($(this).hasClass('far')){
        //             $(this).addClass('fas').removeClass('far');
        //         }else{
        //             $(this).addClass('far').removeClass('fas');
        //         }
        //     })
        // })
    </script>
      
    <script type="text/javascript">
        var tabsList = document.querySelector(".tabs-list");
        tabsList.addEventListener("click", tabActive);
    
        function tabActive(event) {
            // Check if the clicked element is within the .tabs-list
            if (event.target.closest('.tabs-list')) {
                var activeTab = document.querySelector(".tabs-list .active");
                if (activeTab !== null) {
                    activeTab.classList.remove("active");
                }
                event.target.classList.add("active");
            }
        }
    </script>
 <script>
    var app = angular.module("AppModule", []);
    
    app.controller("virtualAssitant", function($scope, $http, $timeout) {
        $scope.deletedDataId = '';
        $scope.search = '';
        $scope.status = 'all';
        
        $scope.toggleStatus = function(id){
            if($("#star_"+id).hasClass('far')){
                $scope.setStatus = 1;
                $("#star_"+id).addClass('fas').removeClass('far');
            }else{
                $scope.setStatus = 0;
                $("#star_"+id).addClass('far').removeClass('fas');
            }
            $scope.updateStatus(id,$scope.setStatus);
        }
        
        
       $scope.updateStatus =  function(listId,value) {
            var data = {
                id: listId,
                value: value
            };

            $http({
                method: 'POST',
                url: siteUrl + 'virtual-assistant/updateFav-status',
                data: $.param(data),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
               flashNow({
                        'success': {
                            'message': response.data.message
                        }
             });
            }).catch(function(error) {
                console.error('Error updating database:', error);
            });
        }



        $scope.availableFeatures = JSON.parse(`<?php echo json_encode($available_features) ?>`);
        
        $scope.selectedTab = 'all'; 

            $scope.changeTab = function(tabId) {
                $scope.selectedTab = tabId;
            };
        
         
            $scope.filterAssistants = function(assistant) {
                if ($scope.selectedTab === 'all') {
                    return true;
                } else {
                    return assistant.main_category_id == $scope.selectedTab;
                }
            };
        
        

        $scope.openWarningModal = function(assistant) {
            $('#warningModal').modal('show'); // Show the Bootstrap modal
            $('#warningModal .yes').on('click', function(e) {
                $("#warningModal").modal("hide");
                $scope.deleteVa(assistant.id);
            });
        };
        
        $scope.seachValue = function(){
            if($scope.search.length > 1){
                getVA();
            }else{
                $timeout(function(){
                    getVA();
                },200);
            }
        // getVA();
             
        }

        $scope.changestatus = function(id,status) {
             jsLoader(true);
            $http({
                method: 'POST',
                url: siteUrl + 'virtual-assistant/change-status',
                aync: false,
                data: {
                    id: id,
                    'status':status,
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                getVA();
                 jsLoader(false);
            });

        }
        
        $scope.deleteVa = function(id,status) {
             jsLoader(true);
            $http({
                method: 'POST',
                url: siteUrl + 'virtual-assistant/delete',
                aync: false,
                data: {
                    id: id,
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                getVA();
                 jsLoader(false);
            });

        }

        $(document).on('click', '#searchVal', function() {
            jsLoader(true);
             getVA();
             jsLoader(false);
        });
        
        $(document).on('click', '.vaTabs', function() {
            $scope.search = '';
            jsLoader(true);
            // $scope.status = $(this).data('type');
            getVA();
            jsLoader(false);
        });

        function getVA() {
            $http({
                method: 'POST',
                url: siteUrl + 'virtual-assistant/get-va',
                aync: false,
                data: {
                    'status': $scope.status,
                    'search': $scope.search,
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }).then(function(response) {
                // if ($scope.status == 'active') {
                //     $scope.activeList = response.data.list;
                // } else if ($scope.status == 'inactive') {
                //     $scope.inactiveList = response.data.list;
                // } else {
                    $scope.allList = response.data.list;
                    // $scope.$apply();
                // }
            });
        }



        getVA();

        $scope.autoresponder_options = <?php echo json_encode($autoresponder); ?>;
        $scope.assiesten_id = '';
        $scope.autoresponders = '';
        $scope.autoresponder_list_response = [];
        $scope.autoresponder_model_show = function(assiesten_id) {
            $("#exampleAutoresponderModal").modal("show");

            $scope.assiesten_id = assiesten_id;
            jsLoader(true);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('get_save_autoresponder_forms'); ?>',
                data: {
                    'id': $scope.assiesten_id
                },
                dataType: 'json',
                success: function(response) {
                    jsLoader(false);
                    $scope.autoresponders = response.data.autoresponder_id;

                    if (response.data.autoresponder_id == 0 || response.data.autoresponder_id == '') {
                        $scope.autoresponders = '';


                    } else {

                        setTimeout(function() {
                            $('.selectpicker').selectpicker('refresh')
                            $scope.setResponderFormList(response.data.autoresponder_id);
                            //$scope.autoresponders  = response.data.autoresponder_id;  

                        }, 500);


                    }

                    $scope.$apply();


                }
            });
        }

        $scope.save_autoresponder_data = function() {
            var autoresponder = $('#autoresponder').find(":selected").val();
            var select_list = $('#select_list').find(":selected").val();
            jsLoader(true);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('save_autoresponder_forms'); ?>',
                data: {
                    'id': $scope.assiesten_id,
                    autoresponder: autoresponder,
                    select_list: select_list
                },
                dataType: 'json',
                success: function(response) {
                    jsLoader(false);
                    $('#exampleAutoresponderModal').modal('hide');
                    // setTimeout(function(){ $('.selectpicker').selectpicker('refresh')}, 500);


                }
            });
        }
        
        $(document).on('click','.getEmbedCode',function(){
           var code = $(this).data('code'); 
           $('#modalMessage').text(code);
          $('#vaMessageModal').modal('show');
        });
        
         $scope.copyContent = async (text) => {
         try {
            let text = $('#modalMessage').text();
             await navigator.clipboard.writeText(text);
             toastr.info('Content copied to clipboard');
         } catch (err) {
             console.error('Failed to copy: ', err);
         }
     }


        $scope.change_auoresponder_option = function() {

            var autoresponder_ids = $scope.autoresponders;
            $(".responder_form_option").after().remove();

            $("#select_list").html('<option class="responder_form_option" value="">Select List</option>');
            setTimeout(function() {
                $('.selectpicker').selectpicker('refresh')
            }, 500);

            if (autoresponder_ids != '') {
                $scope.setResponderFormList(autoresponder_ids);
            } else {
                /*   var select_lists = $('#select_list');
                select_lists.children('.responder_form_option').remove();*/

            }
        }

        $scope.setResponderFormList = function(autoresponder_ids) {

            $(".list_id").remove();
            jsLoader(true);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('autoresponder_forms'); ?>',
                data: {
                    'autoresponder_id': autoresponder_ids
                },
                dataType: 'json',
                success: function(response) {
                    jsLoader(false);


                    $.each(response, function(index, value) {

                        // $scope.autoresponder_list_response.push({listid: value.listid, title: value.title });

                        $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "'>" + value.title + "</option>");
                    });


                    setTimeout(function() {
                        $('.selectpicker').selectpicker('refresh')
                    }, 500);


                }
            });
        }


        $scope.autoresponder_model_close = function() {
            $("#exampleAutoresponderModal").modal("hide");
            $scope.autoresponders = '';
            $(".responder_form_option").after().remove();

            $("#select_list").html('<option class="responder_form_option" value="">Select List</option>');
            setTimeout(function() {
                $('.selectpicker').selectpicker('refresh')
            }, 500);

        }
        

         $scope.formSubmit = function (id){
             jsLoader(true);
            var submitDiv = document.getElementById("submitDiv"+id);
            var form = document.getElementById("myForm"+id);
            form.submit();

        }
        

    });


    $(document).ready(function() {
        // function formSubmit (id){
        //      console.log(id);
        //     var submitDiv = document.getElementById("submitDiv"+id);
        //      console.log(submitDiv);
        //     var form = document.getElementById("myForm"+id);
        
        //     submitDiv.addEventListener("click", function () {
        //         // Trigger form submission
        //         form.submit();
        //     });
        // }
        
         

        $(function() {
            /* $(document).on("change", "#autoresponder", function () {
                 var autoresponder_ids =  $(this).find('option:selected').val()
             
             if(autoresponder_ids != '') {
                 setResponderFormList(autoresponder_ids);
             }
            
             });*/




        });


        function isListShow() {

            if ($(this).find('option:selected').val() == 15 || $(this).find('option:selected').val() == 17) {
                return true;
            } else {
                return false;
            }
        }
        
        /* function setResponderFormList(autoresponder_ids) {
             alert(1);
             $(".list_id").remove();
             responderLoader(true);
             $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url('autoresponder_forms'); ?>',
                 data: {'autoresponder_id': autoresponder_ids},
                 dataType: 'json',
                 success: function (response) {
                     responderLoader(false);
                     console.log(response); 
                     $.each(response, function (index, value) {
                     
                         $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "'>" + value.title + "</option>");
                     });
                     
                     
                     setTimeout(function(){ $('.selectpicker').selectpicker('refresh')}, 500);
                  

                 }
             });
         }*/

        /* function responderLoader(add) {
        if (add === undefined) {
        	add = false;
        }
        $(".temp_js_loader").remove();
        if (add) {
        	$("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assets_folder; ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');}
        }*/
    });
   

</script>
        