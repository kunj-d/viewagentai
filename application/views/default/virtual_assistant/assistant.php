 <style>
  .work-box {

        border-radius: 10px;
        border: 1px solid #374073;
        background: rgba(132, 149, 255, 0.10);
        padding: 25px 25px 8px;
        height: 100%;
        color: #fff;
    }
     .header-section{
            background: #fff;
            background-size: 100% 100%;
            padding: 20px 20px 20px;
        }
        .header-section img{margin-top:-126px; margin-bottom: -127px;}
        .dark-blue{color: #1F0049;}
        .light-purple{color: #B956FF;}
        .f-14{font-size: 14px;}
        .f-28{font-size: 28px;}
        .w700{font-weight: 700;}
        .w400{font-weight: 700;}
        .lh140{line-height: 140%;}
        .purple-box{background: #B956FF; color: #fff; display: inline-block; padding:5px 20px;}
        @media (min-width: 1371px){
            .header-section img{margin-top:-138px; margin-bottom: -118px;}
        }
        @media (min-width: 767px){
            .f-md-36{font-size: 36px;}
            .f-md-28{font-size: 28px;}
            .f-md-16{font-size: 16px;}
            .header-section{
                background: url(app/assets/images/slider.png) no-repeat;
                background-size: 100% 100%;
                padding: 40px 70px 40px;
            }
            
        }
        .appoint-wall:hover{background: var(--theme-bg) !important;}
        .appoint-inner .appoint-btn {background: var(--theme-bg) !important; transition: none;}
        .appoint-btn a{color: #fff; text-decoration: none;}
        .search1 {
            display: block;
            height: 50px;
            padding: 10px 15px !important;
            justify-content: center;
            align-items: flex-start;
            gap: 282px;
            flex-shrink: 0;
            border-radius: 8px;box-shadow: 0px 0px 230px 0px #0000001A;
            border: 1px solid var(--theme-br);
            background: var(--body-bg);
            color: var(--black-color) !important;
        }
        .appoint-btn form{
            height: 100%;
        }
        .upgrade-wall {
            height: 100%;
        }

        .upgrade-wall {
            border-radius: 10px;
            border: 1px solid #E0A94C;
            background: rgba(132, 149, 255, 0.10);
            backdrop-filter: blur(15px);
            padding: 20px;
            cursor: pointer;
        }

        .upgrade-inner {
            position: relative;
            overflow: hidden;
        }

        .upgrade-btn {
            border-radius: 0px;
            background: var(--blue-gradient);
            color: var(--white-color);
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.250rem;
            padding: 15px 30px;
            text-decoration: none;
            display: inline-block;
            border: none;
        }

        .upgrade-inner .upgrade-btn {
            background: rgba(20, 15, 76, 1) !important;
            transition: none;
        }

        .upgrade-inner .upgrade-btn {
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

        .upgrade-inner .upgrade-btn {
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

        .upgrade-wall:hover {
            background: rgba(20, 15, 76, 1) !important;
        }

        .upgrade-inner .upgrade-btn {
            background: rgba(20, 15, 76, 1) !important;
            border-radius: 10px;
            transition: none;
        }

        .upgrade-btn a {
            color: #fff;
            text-decoration: none;
        }

        .upgrade-wall:hover .upgrade-btn {
            opacity: 1;
        }

        .upgrade-inner .upgrade-btn .upgrade-link {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.250rem;
            color: var(--white-color);
            text-decoration: none;
            border-radius: 10px;
            background: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);
            padding: 10px 20px;
            border: 0px;
            margin-top: 0px;
        }

        .upgrade-wall:after {
            content: url(app/assets/images/premiun-tag.png);
            position: absolute;
            right: 15px;
            top: 0px;
            z-index: 2;
        }
    .tabs-banner{
        background: var(--body-bg);
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0px 0px 230px 0px #0000001A;
    }
    .tabs-banner ul li{
        list-style:none;
        display:inline-block;
        padding:7px 15px;
        cursor:pointer;
        font-weight:400;
    }
    .tabs-banner ul .active{
        background:var(--theme-br2);
        border-radius:6px;
    }
 </style>
 <!-- Container Start -->
    <div class="container-wrapper container-open " ng-app="AppModule" ng-controller="virtualAssitant" ng-cloak>
        <title><?php echo $this->config->item('productName') ?> | AI Agents</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding" style=" min-height: calc(93vh);">
            <div class="row">
                <div class="col-12">
                    <div class="feature-banner">
                        <div class="row align-items-center justify-content-between g-0">
                            <div class="col-auto feature-wrap">
                                <h5 class="feature-title">
                                    AI Agents
                                </h5>
                                <p class="feature-subtitle mb-0">
                                    Chat with an AI Expert and Resolve Your Queries
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row mt10">
                <div class="col-md-12 col-12">
                    <div class="search-bar" style="max-width: 100vw">
                        <input type="text" class="search1 form-control" placeholder="Search for AI Agent..." id="searchText" ng-model="searchQuery">
               
                    </div>
                </div>
            </div> -->
            <div class="row mt10">
                <div class="col-md-12 col-12">
                    <div class="tabs-banner">
                        <ul class="f-12 w600 white p-0 m-0 tabs-list"  onclick="tabActive(event)">
                            <!--<li class="active" ng-click="changeTab('all')">All Agents</li>-->
                            <!--<li ng-click="changeTab(1)">Business</li>-->
                            <!--<li ng-click="changeTab(2)">Coach</li>-->
                            <!--<li ng-click="changeTab(4)">Education</li>-->
                            <!--<li ng-click="changeTab(6)">Health</li>-->
                            <!--<li ng-click="changeTab(7)">Leisure</li>-->
                            <!--<li ng-click="changeTab(8)">Specialist</li>-->
                            <!--<li ng-click="changeTab(10)">Other</li>-->
                            <li class="active" ng-click="changeTab(14)">AI Growth Agents</li>
                            <li ng-click="changeTab(12)">IG Agents</li>
                            <li ng-click="changeTab(13)">FB Agents</li>
                            <li ng-click="changeTab(11)">YT Agents</li>
                        </ul>
                    </div>
                </div>
            </div>
            

            
            
            <div class='row mt20 mt-md30 row-gap row-cols-xxl-5 row-cols-lg-4 row-cols-sm-2'>
                <div ng-repeat="list in allList | filter: filterAssistants | filter: searchQuery">
                    <div class="image-box-wrapper h-100" ng-class="list.type">
                        <div class="media">
                            <!--<img class="img-fluid" src="<?= $this->config->item('bucket_url') ?>assets/default/va/{{list.category_image}}" alt="">-->
                            <img class="img-fluid" src="https://cdn.getvisoraai.com/assets/default/va/{{list.category_image}}" alt="">
                        </div>
                        <div class="content">
                            <h5 class="title">{{list.name}}</h5>
                            <p class="description">{{list.category_name}}</p>
                        </div>
                        <div class="appoint-btn">
                            <form action="<?= base_url() ?>conversation" method="post">
                                <input type="hidden" name="assistant_id" value="{{list.id}}">
                                <input type="submit" value="Let's Work" class="appoint-link">
                            </form>
                            <!--<form action="<?= base_url() ?>subscription" method="post">-->
                            <!--    <input type="hidden" name="assistant_id" value="{{list.id}}">-->
                            <!--    <input type="submit" value="Let's Work" class="appoint-link">-->
                            <!--</form>-->
                        </div>
                        <!--<div class="meta">-->
                            <!--<span ng-show="list.type != 'general'" class="badge text-capitalize">-->
                            <!--    <i ng-if="list.type == 'pro'" class="fa-solid fa-crown"></i>-->
                            <!--    <i ng-if="list.type != 'pro'" class="fa-solid fa-gem"></i>-->
                            <!--    {{ list.type }}-->
                            <!--</span>-->
                        <!--</div>-->
                    </div>
                </div>
            
                <div ng-if="allList.length == 0">
                    <div class="col-xs-12 mt30px xsmt25px">
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
        
        // $scope.selectedTab = 'all'; 
        $scope.selectedTab = 14; 

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
                    console.log($scope.allList);
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
        