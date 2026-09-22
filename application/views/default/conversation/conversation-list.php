<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<style>
    .dataTables_filter label {
    color: var(--black-color) !important;
}
a#del{
    position: relative;
    top: 72px;
    left: 6.6%;
}
</style>
<div class="container-wrapper container-open" ng-app="AppModule" ng-controller="conversationListCtrl" ng-cloak>
		<title><?php echo $this->config->item('productName') ?> || Ai Agents</title>
        <!-- Main Container Start -->
        <div class="container-fluid container-padding">
            <div class="row align-items-center" style="margin-top:50px;">
                <div class="col-12">
                    <div class="title-line">
                        My Conversation
                    </div>
                    <p class="container-page-subtitle mt10">Check & Edit all Conversation here</p>
                </div> 
            </div>


            <div class="table-wrapper mt20 mt-md50">
                <div class="table-responsive">
                     <!--<a href="#" class="action-btn red-btn-outline" id="del" style="display:none"> <i class="icon-list-delete"></i></a>-->
                    <table id="data-table" class="table table-striped px-4" style="width:100%; margin-top:50px !important;">
                        <thead class="">
                            <tr>
                                <!--<th>-->
                                <!--    <input id="checkAll" class="form-check-input ng-pristine ng-untouched ng-valid"-->
                                <!--        type="checkbox">-->
                                <!--    <label for="checkAll" class="form-label"></label>-->
                                <!--</th>-->
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Expert</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $i = 1;
                            foreach($lists as $key => $v){ 

                            ?>
                            <tr>
                                <!--<td>-->
                                <!--      <div >-->
                                <!--            <input class="form-check-input checkBox" id="check<?php echo $v['id']; ?>" data-id="<?php echo $v['id']; ?>" type="checkbox" >-->
                                <!--            <label class="form-label" for="check<?php echo $v['id']; ?>"></label>-->
                                <!--        </div>-->
                                <!--</td>-->
                                <td><?= $i++ ?></td>
                                <td><?= $v['chat_name'] ?></td>
                                <td><?= $v['category_name'] ?></td>
                                <td><?= $v['created_at'] ?></td>
                               
                                <td>
                                    <div class="action-link d-flex" style="gap:10px;">
                                        <?php if($v['assistant_status'] == 'default' || $v['assistant_status'] == 'super_vachat') { ?>
                                            <a href="<?php echo  base_url('download_conversation').'?id='.$v['id'] ?>" class="action-btn blue-btn-outline"  data-id="<?= $v['id'] ?>"> <i class="icon-library-download"></i></a>
                                        <?php } ?>
                                        <form action="<?= base_url() ?>conversation" method="post">
                                            <input type="hidden" name="chat_id" value="<?php echo $v['id']; ?>">
                                            <input type="hidden" name="assistant_id" value="<?php echo $v['prompt_id']; ?>">
                                            <button type="submit" class="action-btn blue-btn-outline" style="padding:5px"> <i class="icon-list-edit"></i></button>
                                        </form>
                                        <a href="#" class="action-btn red-btn-outline" ng-click="delete_confirm(<?php echo $v['id']; ?>)"> <i class="icon-list-delete"></i></a>
                                        


                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        
          
<!-- Delete Modal Popup Made by shadab-->
<div class="modal new-folder-modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-15 p-md30">
                <img class="img-fluid d-block mx-auto"
                    ng-src="<?= $this->config->item('assetsPath')?>images/folder-img.png"
                    src="<?= $this->config->item('assetsPath')?>images/folder-img.png" style="margin-bottom: 15px;">
                <h5 class="fw-normal">Are You Sure?</h5>
                <div class="mt10 description">
                    Do you really want to delete this item? This item <br class="d-none d-lg-block">
                    cannot be recovered
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary yes">Delete</button>
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
         $('#data-table').DataTable();
         
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
                             data: { ids: selectedData },
                            url: siteUrl + 'delete_conversation_multiple',
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
        app.controller('conversationListCtrl', function($scope, $http) {



            /* Start loading Conversation List and pagination Operations*/
            $scope.conversation_list = [];
            $scope.scales = '';
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

                $scope.getConversationList();
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

            $scope.getConversationList = function() {
                $scope.check_all_selected = false;
                var data = $scope.get_product_condition();
                var search_url = "<?= base_url() . 'get_conversation_list' ?>";
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
                        return;
                    } else {
                        $scope.conversation_list = response.data.data;
                        $scope.total_items = response.data.total_items;
                        $scope.totalpages = response.data.no_of_pages;
                        if ($scope.conversation_list.length !== 0) {
                            $('.stylehight').removeAttr('style');
                        }
                    }
                });

            };

            $scope.getConversationList();

            /* End loading Conversation List and pagination Operations*/

            // on enter function call
            
            $('#searchText').on('keypress', function (e) {
                var code = e.keyCode || e.which;
                if (code == 13) {
                     jsLoader(true);
                    $scope.getConversationList();
                     jsLoader(false);
                }
            });

            /* Start Conversation Delete operation */

            $scope.delete_confirm = function(id) {
                $("#deleteModal").modal('show');
                $('#deleteModal .yes').on('click', function(e) {
                    $("#deleteModal").modal("hide");
                    $scope.delete_conversation(id);
                });
            }

            $scope.delete_conversation = function(id) {
                var queryStr = "<?= base_url('delete_conversation') ?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    data: $.param({
                        id: id
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }

                }).then(function(response) {
                    flashNow({
                        'success': {
                            'message': 'Delete record successfully'
                        }
                    });
                     location.reload();
                    // $scope.getConversationList();
                });
            }

            /* End Conversation Delete operation */





            /* Start multiple row delete*/
            $scope.delete_multiple = function() {
                var check_flag = false;
                var checkboxes = [];
                angular.forEach($scope.conversation_list, function(x) {
                    if (x.checked) {
                        checkboxes.push(x.id);
                        check_flag = true;
                    }

                });
                console.log('delete multipe');
                //alert(check_flag); return;
                if (!check_flag) {
                    flashNow({
                        'error': {
                            'message': "Sorry! You have not selected any Campaign"
                        }
                    });
                } else {

                    $scope.delete_confirm_multiple(checkboxes);
                }
                //$scope.check_all_selected = false;

            }

            $scope.delete_confirm_multiple = function(checkboxes) {
                $("#deleteModalMultilpe").modal('show');
                $('#deleteModalMultilpe .yes').on('click', function(e) {
                    $("#deleteModalMultilpe").modal("hide");

                    var url = "<?= base_url('delete_conversation_multiple'); ?>" + '?id_data=' + checkboxes;
                    // console.log(url);return;

                    $http.post(url).then(function(response) {
                        $scope.data = response.data;
                        if ($scope.data.success) {
                            flashNow(response.data);
                            $scope.getConversationList();
                            $('.delete_multiple_buttons').hide();
                        }
                    });
                    $scope.check_all_selected = false;
                });
            }



            $scope.isAllSelected = function(list) {
                if (list === undefined) {
                    return false;
                }
                return (
                    list.length &&
                    list.every(function(item) {

                        return item.checked;
                    })
                );
            };

            $scope.toggleAll = function(list, allChecked) {
                angular.forEach(list, function(item) {
                    item.checked = allChecked;
                    if (item.checked == true) {
                        $("#inactiveicon").css("display", "block");
                    } else {
                        $("#inactiveicon").css("display", "none");
                    }

                });
            };


            $scope.uncheck = function() {
                $scope.total_check = 0;
                angular.forEach($scope.conversation_list, function(x) {
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



            //////////End multiple row delete /////////

            $scope.download_conversation = function(id) {
                var queryStr = "<?= base_url('download_conversation') ?>?id=" + id;

                window.location.href = queryStr;
                return;

            }


            $(document).on('click', '.pdfDownload', function() {
                var id = $(this).data('id');
                window.location.href = siteUrl + 'pdfgenerate?id=' + id
            });
            
             /// shadab storing code
            $scope.reverseSort = false; // Initialize the sorting order
            $scope.sortByColumn = function (columnName) {
               console.log( $scope.sortByColumn );
                if ($scope.sortColumn == columnName) {
                    $scope.reverseSort = !$scope.reverseSort;
                } else {
                   
                    $scope.sortColumn = columnName;
                    $scope.reverseSort = false; // Default to ascending order
                }
        };

        }); // End conversationListCtrl


        /* -----------------Loader -------------------  */
   function jsLoader(add) {
       if (add === undefined) {
           add = false;
       }
       $(".temp_js_loader").remove();
       if (add) {
           $("body").append('<div class="temp_js_loader" style="background: rgba(0, 0, 0, 0.34);;width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?= $assetsBasePath ?>assets/images/grabiris_loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0; height:100px"></div>');
       }
   };
        
       

    </script>