<?php
$business_btn = '<a class="appoint-link" href="' . base_url('create-workspace') . '"><span class="icon-create-new-campaign"></span>&nbsp; Add New</a>';
// pr($assetsPath);
// die;
?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<!--    <style>-->
<!--        .dropdown-item.active, .dropdown-item:active {-->
<!--    color: #fff;-->
<!--    text-decoration: none;-->
<!--    background-color: #5340d7;-->
<!--        }-->
      
<!--    .dataTables_filter label {-->
<!--    color: #fff !important;-->
<!--}-->

<!--    </style>-->
 <style>
    div#data-table_wrapper .col-sm-5 {
        display: flex;
        flex-direction: row-reverse;
        gap: 10px;
    }
 </style>   
<title><?php echo $this->config->item('productName') ?> | Workspace</title>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="customersCtrl" id="customersCtrl">
    <!-- Main Container Start -->
    <div class="container-fluid container-padding" style=" min-height: calc(93.9vh);">
        <div class="row d-flex align-items-center">
            <div class="col-12">
                <div class="row align-items-center row-gap-2">
                    <div class="col-md-8 col-xs-12">
                        <h1 class="title-line">Manage Workspace</h1>
                        <p class="container-page-subtitle mt10">Create & manage all your workspace here</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="create-btn" >
                            <?= $business_btn ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="page-content">
                    <div class="">
                        <div class="row">
                           
                        <?php /*
                            <!-- Filter Section Starts -->
                            <div class="col-xs-12 padding0">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end text-md-end">
                                        
                                        <!--<div class="search-bar">-->
                                        <!--    <input type="text" class="search form-control" placeholder="Search.." id="searchKey" ng-model="searchKey" ng-change="reset_data()">-->
                                        <!--    <div class="search-icon" ng-click="get_searched_data()">-->
                                        <!--        <span class="icon-search"></span>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                            <!-- Filter Section Ends -->
                            <!-- Table start-->
                            */ ?>
                            <div class="col-xs-12 padding0">
                                 <div class="table-wrapper mt20 mt-md30">
                                        <div class="table-responsive">
                                            <table id="data-table" class="table table-borderless table-design">
                                                <thead class="field-design">
                                                    <tr>
                        
                                                        <th style="width:5%">S.No.</th>
                                                        <th class="text-center" style="width:20%">Logo</th>
                                                        <th>WorkSpace</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="field-design">
                                                     <?php 
                                                         $i = 1;
                                                        foreach($lists as $key => $v){ 
                                                        ?>
                                                    <tr>
                        
                                                         <td><?= $i++ ?></td>
                                                        <td >
                                                            <div class="businessbox">
                                                                <img src="<?= ($v['logo'] == 'default_business_logo.png') ? $uploadPath.'default_images/default_business_logo.png': $this->config->item('bucket_url') . $v['logo']  ?>"
                                                                    class="img-fluid mx-auto d-block">
                                                            </div>
                                                        </td>
                                                        <td class="ng-binding">
                                                            <div class="f-18 mb-2 lh100"><?= $v['title'] ?></div>
                                                            
                                                            <p class="f-14 w400"><?= $v['domain'].'.'.$this->config->item('productSite') ?></p>
                                                            <p class="f-14 w400">Created on <?= date('Y-m-d H:i A',$v['created']) ?>
                                                            </p>
                                                        </td>
                        
                                                        <td>
                                                            <div class="action-link">
                                                                <a href="<?php echo base_url('workspace_switch') .'/'. $v['id'] ?>" class="action-btn blue-btn-outline" title="Switch"
                                                                    class="filter-btn"> <i class="fa-solid fa-repeat"></i></a>
                                                                <a href="<?php echo base_url('workspace-settings').'/'. $v['id'] ?>" class="action-btn blue-btn-outline" title="Settings"
                                                                    class="filter-btn"> <i class="fa-solid fa-gear"></i></a>
                                                                <a href="#" class="action-btn red-btn-outline"
                                                                    ng-click="delete_confirm(<?= $v['id'] ?>);" title="Delete" class="filter-btn"> <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                            <!-- Table end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Modal Popup -->
<div class="modal fade pop" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modelw-450">
    <div class="modal-content delete-model">
      <div class="modal-body text-center">
        <div class="model-icon">
          <i class="icon-list-delete"></i>
        </div>
        <h4 class="modal-title mt20">Are You Sure?</h4>
        <div class="mt10 description">
            Do you really want to delete this item? This item <br class="d-none d-lg-block">
            cannot be recovered
        </div>
        <div class="mt30">
          <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="base-btn red-btn yes">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Delete Modal Popup End -->



<div class="modal fade pop" id="deleteModalMultilpe" tabindex="-1" aria-labelledby="deleteModalMultilpeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modelw-450">
    <div class="modal-content delete-model">
      <div class="modal-body text-center">
        <div class="model-icon">
          <i class="icon-list-delete"></i>
        </div>
        <h4 class="modal-title mt20">Are You Sure?</h4>
        <div class="mt10 description">
            Do you really want to delete the selected items? <br class="d-none d-lg-block">
           These items cannot be recovered
        </div>
        <div class="mt30">
          <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="base-btn red-btn yes">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>



    <!-- Script for Active/Disactive Filter Icons -->
    <script>
        $(document).ready(function() {
         $('#data-table').DataTable();

        });
    </script>


    <script>
        var app = angular.module('AppModule', []);
        app.controller('customersCtrl', function($scope, $http) {

            var delete_url = siteUrl + 'delete-workspace-json';
               /****
             *******************************Delete Operations**********************************
             ****/
           
            
            
            
           $scope.delete_confirm = function(item) {	
            $("#deleteModal").modal('show');
            $('#deleteModal .yes').on('click', function(e) {
            $("#deleteModal").modal("hide");
            $scope.delete_single_record(item);
            });
            }
        


          /****
         *******************************Delete Operations**********************************
         ****/
            $scope.delete_single_record = function (ids) {
                 var url = delete_url + '?ids=' + ids;
                $http.post(url).then(function (response) {
                    if (response.data.success) {
                         window.location.href = '<?php echo base_url(); ?>workspace';
                       // get_list_data();
                    }
                    flashNow(response.data);
                });
            }
    
    
            $scope.show_msg = function(msg) {
                flashNow({
                    'error': {
                        'message': msg
                    }
                });
            };
        });
    </script>