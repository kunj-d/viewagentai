<!-- Main Container Start -->
<div class="container-wrapper container-open" ng-controller="sessionListCtrl">
    <title><?php echo $this->config->item('productName') ?> | AutoResponder List</title>
    <!-- Main Container Start -->

    <div class="container-fluid container-padding stylehight" style=" height: calc(94vh);">
        <div class="row align-items-center mt50">
            <div class="col-12">
                <div class="title-line">
                  Session Details
                </div>
            </div>
        </div>
        <div class="row mt30">
        <div class="col-md-12 col-xl-12 text-md-end">
                    		        <div class="search-bar float-end">
                                        <input type="text" class="search form-control" ng-model="productParams.search_key" ng-change="getConversationList()" placeholder="Search..">
                                        <div class="search-icon" ng-click="getConversationList()">
                                            <span class="icon-search"></span>
                                        </div>
                                    </div>
                                    <!-- <a href="#" id="inactiveicon" class="action-btn red-btn-outline " ng-click="delete_multiple()" style="display:none;"> <i class="icon-list-delete"></i></a> -->
                                </div>
          </div>
        
        <div class="row mt30">
            <div class="col-12">
                <div class="table-wrapper">
                    <div class="table-responsive">
                        <table class="table table-borderless table-design">
                            <thead class="field-design">
                                <tr>
                                    <th>NAME</th>
                                    <th>Email</th>
                                    <th>Activity</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody class="field-design">
                                <tr  ng-repeat="item in conversation_list">
                    
                                    <td>{{item.name}}</td>
                                   <td>{{item.email}}</td>
                    				<td>{{item.activity}}</td>
                    				<td>{{item.description}}</td>
                    				<td>{{(item.created)*1000 | date : "d MMM y" }}</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center white-clr" ng-if="conversation_list.length == 0"> No Record Found</div>
                    <div class="pagination" >
                            <a href="#" ng-click="conversationListPagination('privew')">Previous</a>
                            <input type="text" placeholder="1" class="form-control" ng-model="productParams.current_page" ng-change="getConversationList()">
                            <a href="#" ng-click="conversationListPagination('next')">Next</a>
                        </div>

                    
                </div>
            </div>
        </div>
              
        <!-- <div class="row mt20 mt-md30 align-items-center text-md-end" >-->
        <!--    <div class="col-12 col-md-12 col-xl-12 text-center text-md-end filter-text mt20 mt-md30" style="padding-right: 15px;">-->
        <!--        <div class="d-flex gap-3 align-items-center justify-content-end">-->
        <!--            <span>Show</span>-->
        <!--            <select class="selectpicker fiter-drop" ng-model="productParams.item_per_page" ng-change="getConversationList()">-->
        <!--                <option>10</option>-->
        <!--                <option>20</option>-->
        <!--                <option>30</option>-->
        <!--            </select>-->
        <!--            <span>Entries</span>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>

    <!-- Main Container End -->
    
    
    
    
    
    
    
    
    
    
    

    <script>
        var app = angular.module('AppModule', []);
        app.controller('sessionListCtrl', function($scope, $http) {
            
           /* Start loading Conversation List and pagination Operations*/
        $scope.conversation_list = [];
        $scope.scales='';
        $scope.productParams = {       
            search_key: '',
            item_per_page: '10',
            current_page: 1
        }

        $scope.totalpages = 1;
        $scope.check_all_selected = false;
        $scope.conversationListPagination = function(type) {
        $scope.current_page = 1;
         
        if ((type == "next" && $scope.productParams.current_page >= $scope.totalpages) || (type == "privew" && $scope.productParams.current_page == 1)) {
                 return;
             } 
         if(type == "privew") {
             $scope.productParams.current_page -=1;
         }
         if(type == "next") {
             $scope.productParams.current_page +=1;
         }
         
         if($scope.productParams.current_page > 1) {
             $scope.scales = $scope.productParams.current_page -1;
             $scope.page_count = $scope.productParams.current_page -1;
             $scope.page_count  = $scope.page_count + 0;
         }else {
             $scope.scales = '';
         }
         
         $scope.getConversationList();
     }



     $scope.get_product_condition = function () {
     
     var data = '';
     if ($scope.productParams.search_key != '') {
         data += 'search_key=' + $scope.productParams.search_key;
     }
     if ($scope.productParams.item_per_page != '') {
         data += '&items_per_page=' + $scope.productParams.item_per_page;
     }
     if ($scope.productParams.current_page != '') {
         data += '&current_page=' + $scope.productParams.current_page;
     }
    
     return data;
 }

     $scope.getConversationList = function (){
        $scope.check_all_selected = false;
        var data  = $scope.get_product_condition();
        var search_url="<?= base_url().'get-session-list-json' ?>";		
        $http({
                method 	: 'POST',
                url 	: search_url,
                data 	: data,
                headers : {'Content-Type': 'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest'}
        }).then(function(response) {
                    if (response.data.error) {
                        showFlash(response.data);
                        return;
                    }
                    else {
                        $scope.conversation_list=response.data.data;
                        console.log($scope.conversation_list); 
                        
                        $scope.total_items = response.data.total_items;
                        $scope.totalpages = Math.ceil($scope.total_items / $scope.productParams.item_per_page);
                          if($scope.conversation_list.length !== 0){
                            $('.stylehight').removeAttr('style');
                        }
                    }
                });
 
     };

     $scope.getConversationList();

     /* End loading Conversation List and pagination Operations*/



    /* Start Conversation Delete operation */

    $scope.delete_confirm = function(conversation) {	
            $("#deleteModal").modal('show');
            $('#deleteModal .yes').on('click', function(e) {
            $("#deleteModal").modal("hide");
            $scope.delete_conversation(conversation.id,'single');
            });
        }

        $scope.delete_conversation = function(ids,type) {
        
            var queryStr = "<?= base_url('delete-team-member-json')?>";
            $http({
            method:'POST',
            url: queryStr,
            data:$.param({
                ids:ids,type:type
            }),
            headers:{'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}

            }).then(function(response){		
            flashNow({'success': {'message': 'Delete record successfully'}});
                $scope.getConversationList();
            });
        }

        /* End Conversation Delete operation */





    /* Start multiple row delete*/
    $scope.delete_multiple = function () {
            var check_flag = false;
            var checkboxes = [];
            angular.forEach($scope.conversation_list, function (x) {
                if (x.checked) {
                    checkboxes.push(x.id);
                    check_flag = true;
                }
                
            });
            console.log('delete multipe');
          //alert(check_flag); return;
            if (!check_flag) {
                flashNow({'error': {'message': "Sorry! You have not selected any Campaign"}});
            } else {
					$("#deleteModalMultilpe").modal('show');
            		$('#deleteModalMultilpe .yes').on('click', function(e) {
                    $("#deleteModalMultilpe").modal("hide");
                        $scope.delete_conversation(checkboxes,'multiple');
            		 });
            }
            //$scope.check_all_selected = false;

        }
		
/*	$scope.delete_confirm_multiple = function(checkboxes) {	
		$("#deleteModalMultilpe").modal('show');
		 $('#deleteModalMultilpe .yes').on('click', function(e) {
        $("#deleteModalMultilpe").modal("hide");

				var url = "<?= base_url('delete-team-member-json'); ?>" + '?id_data=' + checkboxes;
                    // console.log(url);return;

                    $http.post(url).then(function (response) {
                        $scope.data = response.data;
                        if ($scope.data.success) {
                            flashNow(response.data);
                            $scope.getConversationList();
                        }
                    });
                    $scope.check_all_selected = false;
		});
	}*/


	
	$scope.isAllSelected = function (list) {
		if (list === undefined) {
			return false;
		}
		return (
			list.length &&
			list.every(function (item) {
			   
				return item.checked;
			})
		);
	};
	
	$scope.toggleAll = function (list, allChecked) {
		angular.forEach(list, function (item) {
			item.checked = allChecked;
			if(item.checked == true) {
			    $("#inactiveicon").css("display", "block");    
			} else {
			    $("#inactiveicon").css("display", "none");    
			}
			
		});
	};


    $scope.uncheck = function () {
            $scope.total_check = 0;
            angular.forEach($scope.conversation_list, function (x) {
                if (x.checked) {
                    $scope.total_check++;
                }
            });
           
            console.log('test', $scope.total_check);
            
            if ($scope.productParams.item_per_page == $scope.total_check) {
                $scope.check_all_selected = true;
            } else {
                $scope.check_all_selected = false;
            }
            if ($scope.total_check > 0) {
                $("#inactiveicon").css("display", "block");
                //$("#inactiveicon").attr("data-target", "#deleteModal").addClass('cursor');

            } else {
                 $("#inactiveicon").css("display", "none");
               // $("#inactiveicon").addClass('listdisabled').removeClass("filter-btn");
               // $("#inactiveicon").attr("data-target", "#deleteModal").removeClass('cursor');


            }

        }









         

        });
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
