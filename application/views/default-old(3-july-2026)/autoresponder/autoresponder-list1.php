<style>
    .export-btn{
        background: radial-gradient(100% 100% at 50.00% 0%, #AA70ED 0%, #5340D7 100%);
        border: 0px;
        color: white;
        padding: 10px 40px;
        margin: 3px 10px;
        border-radius: 5px;
    }
    .delete-btn{
        color:#fff;
        font-size:18px;
        padding-left:15px;
    }
    .delete-btn:hover{
        color:red;
    }
</style>
<!-- Main Container Start -->
<div class="container-wrapper container-open" ng-controller="autoresponderListCtrl">
    <title><?php echo $this->config->item('productName') ?> | Leads</title>
    <!-- Main Container Start -->

    <div class="container-fluid container-padding stylehight" style=" height: calc(94vh);">
        <div class="row align-items-center mt50">
            <div class="col-12">
                <div class="title-line">
                    Leads
                </div>
                <p class="container-page-subtitle mt10">Checkout all Leads Generated using Chatbot.</p>
            </div>
        </div>
        <div class="row mt30">
        <div class="col-md-12 col-xl-12 text-md-end">
            <li class="allcheck">
                <!--<input class="checkbox-custom showoption ng-pristine ng-untouched ng-valid" type="checkbox" id="checkAll" ng-click="toggleSelection()" ng-model="check_all_selected">-->
                <!--<label for="checkAll" class="checkbox-custom-label"></label>-->
                <input id="checkAll" class="form-check-input showoption ng-pristine ng-untouched ng-valid" type="checkbox" ng-model="check_all_selected" ng-click="toggleSelection()" style="margin-top:0px;">
                <label for="checkAll" class="form-label"></label>
            </li>
            <button type="button" class="export-btn" ng-click="ExportData()">Export</button>
    		        <div class="search-bar float-end">
                        <input type="text" class="search form-control" placeholder="Search.." ng-model="productParams.search_key" ng-change="getAutoResponderList()">
                        <div class="search-icon">
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
                                     <th>
                                        <!--<input class="checkbox-custom showoption" type="checkbox" required="" id="checkAll" ng-click="toggleSelection()" ng-model="check_all_selected">
                                            <label for="checkAll" class="checkbox-custom-label"></label>-->
                                        <input id="checkAll" class="form-check-input" type="checkbox" ng-model="allChecked" ng-click="toggleAll(conversation_list, allChecked)" ng-checked="conversation_list && isAllSelected(conversation_list)">
                                        <label for="checkAll" class="form-label"></label>


                                    </th>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>ChatBot</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="field-design" ng-cloak ng-show="autoresponder_list.length > 0">
                                <tr ng-repeat="autoresponder in autoresponder_list">
                                   
                                    <td > <input id="autoresponder{{autoresponder.id}}" class="form-check-input" type="checkbox" ng-model="autoresponder.selected" ng-click="single_check()">
                                                        <label for="autoresponder{{autoresponder.id}}" class="form-label"></label></td>
                                                        <td></td>
                                    <td>{{ autoresponder.name }} </td>
                                    <td>{{ autoresponder.email }} </td>
                                    <td>{{ autoresponder.prompt_name }} </td>
                                    <td>{{ autoresponder.created_date }}</td>
                                   <td><a href="#" class="delete-btn"><span class="icon-list-delete"></span></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-space-between align-items-center">
                    <div class="col-6 align-items-center text-md-start text-center" style="padding-right: 15px;">
                        <div class="filter-text">
                            <div class="d-flex gap-3 align-items-center justify-content-start">
                                <span></span>
                                <select class="selectpicker fiter-drop" ng-model="productParams.item_per_page" ng-change="getConversationList()">
                                    <option value="10">Show 10 Rows</option>
                                    <option value="20">Show 20 Rows</option>
                                    <option value="30">Show 30 Rows</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-md-end mt10">
                       <nav aria-label="...">
                          <ul class="pagination" style="gap:0px">
                            <li class="page-item">
                              <a ng-click="conversationListPagination('privew')" class="page-link" href="#" tabindex="-1" aria-disabled="true"><span class="icon-left"></span></a>
                            </li>
                            <!-- <li class="page-item" ng-repeat="x in totalpages" ng-class="{active : x == productParams.current_page}"><a class="page-link" href="#">{{x}}</a></li> -->
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <!-- <li class="page-item active" aria-current="page"> -->
                            <!--  <a class="page-link" href="#">{{productParams.current_page}}</a>-->
                            <!--</li>-->
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                              <a class="page-link" ng-click="conversationListPagination('next')" href="#"><span class="icon-right"></span></a>
                            </li>
                          </ul>
                        </nav>
                    </div>
                </div>
                
                
                <!--    <div class="row d-flex justify-space-between align-items-center">-->
                <!--        <div class="col-6 align-items-center text-md-start text-center filter-text" style="/* padding-right: 15px; */">-->
                <!--           <div class="d-flex gap-3 align-items-center text-center text-md-start">-->
                <!--    <span>Show</span>-->
                <!--    <select class="selectpicker fiter-drop" ng-model="productParams.item_per_page" ng-change="autoresponderListPagination()">-->
                <!--        <option>10</option>-->
                <!--        <option>20</option>-->
                <!--        <option>30</option>-->
                <!--    </select>-->
                <!--    <span>Entries</span>-->
                <!--</div>-->
                <!--        </div>-->
                <!--        <div class="col-6 text-md-end text-center">-->
                <!--            <div class="pagination">-->
                        
                <!--        <a href="javascript:void(0)?" ng-click="autoresponderListPagination('privew')">◄</a>-->
                <!--        <input type="text" placeholder="1" class="form-control" ng-model="productParams.current_page" ng-change="getAutoResponderList()">-->
                <!--        <a href="javascript:void(0);" ng-click="autoresponderListPagination('next')">►</a>-->
                <!--    </div>-->
                <!--        </div>-->
                <!--    </div>-->
                   
                    <div class="text-center white-clr" ng-if="autoresponder_list.length == 0"> No Record Found</div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Main Container End -->


    <script>
        var app = angular.module('AppModule', []);
        app.controller('autoresponderListCtrl', function($scope, $http) {

            /* Start loading Conversation List and pagination Operations*/
            $scope.autoresponder_list = [];
            
           var delete_icon_disable_cls = 'listdisabled';
            var delete_icon_enable_cls = 'filter-btn';
            
            $scope.check_all_selected = false;
            $scope.scales = '';
            $scope.productParams = {
                search_key: '',
                item_per_page: '10',
                current_page: 1
            }

            $scope.totalpages = 1;
            $scope.check_all_selected = false;



            $scope.autoresponderListPagination = function(type) {
                console.log($scope.productParams);
                $scope.current_page = 1;

                if ((type == "next" && $scope.productParams.current_page >= $scope.totalpages) || (type == "privew" && $scope.productParams.current_page == 1)) {
                    return;
                }
                if (type == "privew") {
                    $scope.productParams.current_page -= 1;
                }
                if (type == "next") {
                    $scope.productParams.current_page += 1;
                }

                if ($scope.productParams.current_page > 1) {
                    $scope.scales = $scope.productParams.current_page - 1;
                    $scope.page_count = $scope.productParams.current_page - 1;
                    $scope.page_count = $scope.page_count + 0;
                } else {
                    $scope.scales = '';
                }

                $scope.getAutoResponderList();
            }

            $scope.get_product_condition = function() {
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


            $scope.getAutoResponderList = function() {
                // alert();
                $scope.check_all_selected = false;
                var data = $scope.get_product_condition();
                var search_url = "<?= base_url() . 'get-autoresponder-lead-list' ?>";
                $http({
                    method: 'POST',
                    url: search_url,
                    data: data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(function(response) {
                    if (response.data.error) {
                        showFlash(response.data);
                        alert('Error found');
                        return;
                    } else {
                        // alert('success found');
                      
                        $scope.autoresponder_list = response.data.data;
                        $scope.total_items = response.data.total_items;
                        $scope.totalpages = Math.ceil($scope.total_items / $scope.productParams.item_per_page);
                        if($scope.autoresponder_list.length !== 0){
                            $('.stylehight').removeAttr('style');
                        }
                        
                    }
                });

            };

            $scope.getAutoResponderList();


            $scope.download_autoResponderLead = function(autoresponder){
                var queryStr = "<?= base_url('download-autoresponder-lead')?>?id="+ autoresponder.id;
                
                window.location.href = queryStr;
                return;
                    
	        }

        
             $scope.toggleSelection = function() {
                angular.forEach($scope.autoresponder_list, function(item) {
                    item.selected = $scope.check_all_selected;
                });

                if ($scope.check_all_selected) {
                    $scope.delete_icon_cls_var = delete_icon_enable_cls;
                } else {
                    $scope.delete_icon_cls_var = delete_icon_disable_cls;
                }
            };
            
            $scope.ExportData = function(){
                
               var checkboxes = [];
                angular.forEach($scope.autoresponder_list, function (x) {
                    if (x.selected) {
                        checkboxes.push(x.id);
                        check_flag = true;
                    }
                    
                });
                $http({
                    method: 'POST',
                    url:  siteUrl + 'export-csv',
                    data: {
                        'ids':checkboxes
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(function(response) {
                    var blob = new Blob([response.data], { type: 'text/csv' });
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = `lead_data${Date.now()}.csv`;
                    a.click();
                });
                    // window.location.href = siteUrl + 'exportcsv&ids='+;
                }
                
             $scope.single_check = function() {
                $scope.total_check = 0;
                angular.forEach($scope.all_data, function(item) {
                    if (item.selected) {
                        $scope.total_check++;
                    }
                });

                if ($scope.limit == $scope.total_check ||
                    ($scope.filtered_records < $scope.limit && $scope.total_check == $scope.filtered_records)
                ) {
                    $scope.check_all_selected = true;
                } else {
                    $scope.check_all_selected = false;
                }

                if ($scope.total_check > 0) {
                    $scope.delete_icon_cls_var = delete_icon_enable_cls;
                } else {
                    $scope.delete_icon_cls_var = delete_icon_disable_cls;
                }
            }


        });
    </script>
