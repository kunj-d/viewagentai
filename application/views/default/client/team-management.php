<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">   
    <style>
        .dropdown-item.active, .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #5340d7;
        }
        i{
            background: transparent !important
        }
        .dataTables_filter label {
            color: var(--black-clr1) !important;
        }
        #data-table.table>:not(:last-child)>:last-child>* {
        }
        a#del{
            position: absolute;
            right: 20%;
        }
        th.sorting.sorting_asc{
            border-color:var(--theme-br) !important;
        }
        .table>:not(:last-child)>:last-child>*{
            border-bottom-color:var(--theme-br);
        }
        table.dataTable.table-striped>tbody>tr.odd>*{border-color:var(--theme-br) !important;}
    </style>
    <!-- Container Start -->
    <div class="container-wrapper container-open" >
        <title><?php echo $this->config->item('productName') ?> | Client Management</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding" style="min-height: calc(93.5vh);" ng-app="AppModule"  ng-controller="customersCtrlfdf">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <div class="page-content " >
                        <div class="row">
                            <!-- Header title Start -->
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h1 class="md30 title-line lh110">Client Management</h1>
                                        <p class="container-page-subtitle">Create & manage all clients here</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="create-btn text-end mb-3">
                                            <a href="<?php echo base_url('add-client-member')?>" class="appoint-link"><span class="icon-create-new-campaign"></span>&nbsp;&nbsp; Add New</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Header title end -->
                            <!-- Table start-->
                            <!-- Table start-->
               <div class="col-xs-12 mt10px footer-height">
                         <div class="row">   
                            <div class="col-lg-12">  
                               <div class="table-wrapper">
                                     <div class="table-responsive">
                                     <a href="#" class="action-btn red-btn-outline" id="del" style="display:none"><i class="icon-list-delete"></i></a>
                      <table id="data-table" class="table table-striped" style="width: 100%; margin-top: 30px !important;">
                        <thead>
                            <tr>
                                <!--<th>-->
                                <!--    <input id="checkAll" class="form-check-input ng-pristine ng-untouched ng-valid"-->
                                <!--        type="checkbox">-->
                                <!--    <label for="checkAll" class="form-label"></label>-->
                                <!--</th>-->
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <!--<th>WorkSpace</th>-->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php 
                            $i = 1;
                            foreach($lists as $conversation) { 
                            ?>
                            <tr>
                                <!--<td>-->
                                <!--    <div >-->
                                <!--            <input class="form-check-input checkBox" id="check<?php echo $conversation['id']; ?>" data-id="<?php echo $conversation['id']; ?>" type="checkbox" >-->
                                <!--            <label class="form-label" for="check<?php echo $conversation['id']; ?>"></label>-->
                                <!--        </div>-->
                                <!--</td>-->
                                <td><?= $i++ ?></td>
                                <td><?= $conversation['name'] ?></td>
                                <td><?= $conversation['email'] ?></td>
                                <td>
                                    <div class="d-inline-flex gap-3 " style="background: transparent !important;">
                                        <a href="<?php echo base_url() ?>edit-client-member/<?= $conversation['id'] ?>" class="action-btn btn-primary  sharp me-1" style=";"><i class="icon-list-edit icon-edit"></i></a>
                                       <a href="#" class="action-btn red-btn-outline" ng-click="delete_confirm(<?php echo $conversation['id']; ?>)"> <i class="icon-list-delete"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Table end--> 
                            <!-- No Record Found Start -->
                            <div class="col-xs-12 graphsection mt30px xsmt25px ng-hide" ng-if="conversation_list.length == 0">
                                <!--- Title Section ------->
                                <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mt2 xsmt3">                       
                                            <div class="col-xs-12 padding0 footer-height">
                                                <img src="https://grrr.academiyo.com/app/assets/default/images/no-record-found.png" class="img-responsive center-block mt6 xsmt6">
                                                <div class="md16 sm15 xs15 w600 text-center mt1 xsmt2">No Client Member Found</div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <!--- Title Section end----->
                            </div>
                            <!-- No Record Found End --> 
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
     <script>
        //  $('#data-table').DataTable();
        $(document).ready(function() {
            $('#data-table').DataTable({
                rowId: 'row-{{ conversation.id }}' 
            });
        }); 
        $("#checkAll").click(function(){
             $('tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));
             $(this).css({"display":"block"});
        }); 
        $('#data-table').on('change', 'input[type="checkbox"]', function() {
                // Check the number of checkboxes checked
                var checkedCheckboxes = $('input[type="checkbox"]:checked');
                // Toggle the visibility of the multi-delete button based on the number of checked checkboxes
                $('#del').toggle(checkedCheckboxes.length > 1);
            });
             $('#del').on('click', function() {
                // Get an array of data for selected rows
                var selectedData = [];
                $('input[type="checkbox"]:checked').each(function() {
                    // var data = table.row($(this).closest('tr')).data();
                    var data = $(this).data('id');
                    if(data != undefined){
                         selectedData.push(data);
                    }
                    console.log(selectedData);
                });
                // Show SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                             data: { id: selectedData ,type:'multi'},
                            url: siteUrl + 'delete-client-member-json',
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                });
            });
    </script>
    <script>
    var app = angular.module('AppModule', []);
    app.controller('customersCtrlfdf', function($scope, $http) {
       $scope.allChecked = false;
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
        var search_url="<?= base_url().'get-client-list-json' ?>";		
        $http({
                method 	: 'POST',
                url 	: search_url,
                data 	: data,
                headers : {'Content-Type': 'application/x-www-form-urlencoded','X-Requested-With': 'XMLHttpRequest'}
        }).then(function(response) {
            console.log(response.data);
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
         $scope.delete_confirm = function(id) {
                $("#deleteModal").modal('show');
                $('#deleteModal .yes').on('click', function(e) {
                    $("#deleteModal").modal("hide");
                    $scope.delete_conversation(id);
                });
            }
          $scope.delete_conversation = function(id) {
            var queryStr = "<?= base_url('delete-client-member-json')?>";
            $http({
                method: 'POST',
                url: queryStr,
                data: $.param({ id: id, type: 'single' }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;' }
            }).then(function(response) {
                flashNow({ 'success': { 'message': 'Delete record successfully' } });
                $('#data-table').DataTable().row('#row-' + id).remove().draw(); 
                location.reload();
            });
        };
        /* End Conversation Delete operation */
    /* Start multiple row delete*/
   $scope.delete_multiple = function () {
    var checkedConversations = $scope.conversation_list.filter(function (conversation) {
        return conversation.checked;
    });
    var ids = checkedConversations.map(function (conversation) {
        return conversation.id;
    });
    if (ids.length > 0) {
        $scope.delete_conversation(ids, 'multiple');
    }
};
	$scope.delete_confirm_multiple = function(checkboxes) {	
		$("#deleteModalMultilpe").modal('show');
		 $('#deleteModalMultilpe .yes').on('click', function(e) {
        $("#deleteModalMultilpe").modal("hide");
				var url = "<?= base_url('delete-client-member-json'); ?>" + '?id_data=' + checkboxes;
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
	}
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
$scope.toggleAll = function () {
    angular.forEach($scope.conversation_list, function (conversation) {
        conversation.checked = $scope.allChecked;
    });
};
  $scope.uncheck = function () {
    $scope.allChecked = $scope.conversation_list.every(function (conversation) {
        return conversation.checked;
    });
};
   });// End conversationListCtrl
   function jsLoader(add){
        if(add === undefined) {add=false;}
        $(".temp_js_loader").remove();
        if(add){
            $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assetsFolder; ?>images/prezentiq_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;"></div>');
        }	
    }	
 </script>
