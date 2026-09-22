 <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<!--<script src=""></script>-->
<style>
    .export-btn{
        background: var(--blue-gradient);
        border: 0px;
        color: white;
        padding: 10px 40px;
        margin: 3px 10px;
        border-radius: 5px;div.dt-buttons>.dt-button:hover:not(.disabled)
    }
    .delete-btn{
        color:#fff;
        font-size:18px;
        padding-left:15px;
    }
    .delete-btn:hover{
        color:red;
    }
    div.dt-buttons>.dt-button:first-child, div.dt-buttons>div.dt-button-split .dt-button:first-child{
        background: var(--blue-gradient);
        border-radius: 5px;
        padding: 10px 20px 10px 20px;
        color: #fff;
    }
       div.dt-buttons>.dt-button:hover:not(.disabled), div.dt-buttons>div.dt-button-split .dt-button:hover:not(.disabled) {
        background: var(--blue-gradient);
        padding: 10px 20px 10px 20px;
        color: #fff;
        border-color: var(--theme-br2);
    }
    .dataTables_filter label{color:var(--black-color) !important;}
     #data-table.table>:not(:last-child)>:last-child>* {
        border-bottom-color: var(--theme-br);
    }
    .dt-buttons {
        position: relative;
        left: 51px;
    }
</style>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="autoresponderListCtrl" ng-cloak>
        <title><?php echo $this->config->item('productName') ?> | App Response List</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">

        <div class="row align-items-center">
            <div class="col-12">
                <div class="title-line">
                    App Response
                </div>
                <p class="container-page-subtitle mt10">Checkout All Response Generated Using Apps.</p>
            </div>
        </div>

            <div class="table-wrapper mt-2 mt-md-3">
                <div class="table-responsive">
                    <table id="data-table" class="table table-borderless table-design dataTable no-footer" style="width:100%; margin-top:30px !important;">
                        <thead class="">
                            <tr>
                               <th>S.No.</th>
                                <th>App Name</th>
                                <th>Response</th> 
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $i = 1;
                            foreach($lists as $key => $val){ 

                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td ><?= $val['ca_name'] ?></td>
                                <td><?= ($val['ca_ending_action_type']==1?"GPT Response":($val['ca_ending_action_type']==2?"Redirect to URL":"Thank You Message")) ?></td> 
                                <td><?= $val['cavr_created_on'] ?></td>
                                 <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="javascript:void(0)" ng-click="viewresponse(<?php echo $val['cavr_id'] ?>)" class="action-btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        <a href="#" class="action-btn red-btn-outline delete-lead" data-id="<?php echo $val['cavr_id'] ?>"> <i class="icon-list-delete"></i></a></td>
                                    </div>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div style="clear:both"></div>
        
        <!-- Modal -->
        <div class="modal fade" id="responsemodal" tabindex="-1" aria-labelledby="responsemodallabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="responsemodallabel" style="font-size: 1rem;">{{allList[0].ca_name}}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="response-boxes">
                        <div class="response-box" ng-repeat="list in allList">
                            <div class="form-group">
                               <div>
                                   <label>{{list.caq_question_label}}</label>
                                   <p>{{list.caq_question_text}}</p>
                               </div>
                               <div class="mt10">
                                   <label>Response</label>
                                   <p>{{list.cavq_visitor_input}}</p>
                               </div>
    
                            </div>
                        </div>
                   </div>
                </div>
                
                </div>
            </div>
        </div>
        <!-- Modal -->

     <script>
     $(document).ready(function() {
        $('#data-table').DataTable( {
            // 'processing': true,
            // 'serverSide': true,
            // "order": [[ 0, "desc" ]],
            "text":  'Export',
            dom:
              "<'row'<'col-sm-3'l><'col-sm-4'><'col-sm-5'Bf>>" +
                "<'row'<'col-sm-12 table-responsive 'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-8'p>>",
              buttons: [
                        {
                            extend: 'excelHtml5',
                            title: 'App Response',
                            text: 'Export.csv'
                        },
                        // {
                        //     extend: 'pdfHtml5',
                        //     title: 'User list'
                        // }
                    ],
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50,'100']],
        } );
        
        $('.delete-lead').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
              // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will be delete this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                             data: { id: id },
                            url: siteUrl + 'autoresponder-lead-list/delete-app-response',
                            success: function(response) {
                                    location.reload();
                                // if(response.data.status == 1){
                                // }else{
                                //     toastr.error('Something went wrong');
                                // }
                            }
                        });
                    }
                });
            
            
            
            
           
        });
    });
    </script>
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


            // $scope.getAutoResponderList = function() {
            //     // alert();
            //     $scope.check_all_selected = false;
            //     var data = $scope.get_product_condition();
            //     var search_url = "<?= base_url() . 'getapp-response-list' ?>";
            //     $http({
            //         method: 'POST',
            //         url: search_url,
            //         data: data,
            //         headers: {
            //             'Content-Type': 'application/x-www-form-urlencoded',
            //             'X-Requested-With': 'XMLHttpRequest'
            //         }
            //     }).then(function(response) {
            //         if (response.data.error) {
            //             showFlash(response.data);
            //             alert('Error found');
            //             return;
            //         } else {
            //             // alert('success found');
                      
            //             $scope.autoresponder_list = response.data.data;
            //             $scope.total_items = response.data.total_items;
            //             $scope.totalpages = Math.ceil($scope.total_items / $scope.productParams.item_per_page);
            //             if($scope.autoresponder_list.length !== 0){
            //                 $('.stylehight').removeAttr('style');
            //             }
                        
            //         }
            //     });

            // };

            // $scope.getAutoResponderList();


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
            
            
             $scope.viewresponse = function (id) {
                var cavq_cavr_id = id;
                var fd = new FormData();
                fd.append('cavq_cavr_id', cavq_cavr_id);
                $http({
                method: 'POST',
                        url: siteUrl + 'autoresponder-lead-list/app-response-question',
                        aync: false,
                        data: fd,
                        dataType: "json",
                        transformRequest: angular.identity,
                        headers: {
                        'Content-Type': undefined
                        }
                }).then(function(response) {
                if (response.data.status == true) {
                   $scope.allList = response.data.list;
                    $('#responsemodal').modal("show");
                } else {
                toastr.error('Something went wrong');
                }
                });
                
                }
            
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
    
    
    
