<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<?php
$add_new_client_btn = '<a class="btn btn-primary" href="' . site_url('add-client') . '">Add New Client</a>';
?>
<title><?php echo $this->config->item('productName') ?> | Client Management</title>

<!-- Page Content Start -->
<div class="container-wrapper container-open"  ng-app="myApp" ng-controller="customersCtrl" id="customersCtrl">
	<div class="container-fluid container-padding" style=" min-height: calc(93.9vh);">
	    <div class="row d-flex align-items-center">
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Client Management</h5>
                            <p class="feature-subtitle mb-0">
                                Create and manage your clients here.
                            </p>
                        </div>
                        <div class="col-auto ms-auto">
                            <div class="create-btn" >
                                <?=$add_new_client_btn?>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 ng-cloak footer-height">
                <div class="page-content">
                    <div class="">
                        <div class="row">
                            <div class="col-xs-12 padding0">
                                 <div class="table-wrapper">
								 		<div class="table-responsive imsite-table imsitenew-table">
                                            <table id="data-table" class="table table-borderless table-design">
												<thead class="field-design">
                                                    <tr>
                                                        <th class="sorting sorting_asc">S.No.</th>
                                                        <th class="sorting">Name</th>
                                                        <th class="sorting">Email</th>
                                                        <th class="sorting">Role</th>
                                                        <th class="sorting">Workspace</th>
                                                        <th class="sorting">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($lists as $conversation) {
                                                    ?>    
                                                        <tr>
                                                            <td><?= $i++ ?></td>
                                                            <!--<td><?= $conversation['name'] ?></td>-->
                                                            <td><?= strlen($conversation['name']) > 15 ? substr($conversation['name'], 0, 15) . '...' : $conversation['name'] ?></td>
                                                            <td style="text-transform:lowercase"><?= $conversation['email'] ?></td>
                                                            <?php if ($conversation['role_id'] == 4): ?>
                                                                <td><?php echo $conversation['custom_role_title']; ?></td>
                                                            <?php else: ?>
                                                                <td><?php echo $conversation['role']; ?></td>
                                                            <?php endif; ?>
                                                            <td><?= $conversation['domain'] ?></td>
                                                            <td>
                                                                <div class="action-link">
                                                                    <a href="<?= site_url('edit-client/' . $conversation['id']) ?>" class="action-btn blue-btn-outline" title="Edit">
                                                                        <i class="fa-solid fa-pen-to-square xs20 sm14 lg20"></i>
                                                                    </a>
                                                                    <a class="action-btn red-btn-outline" ng-click="delete_single_record(<?php echo $conversation['id']; ?>);" title="Delete">
                                                                        <i class="fa-solid fa-trash xs20 sm14 lg20"></i>
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
<!-- Page Content End -->

<!-- Script for Show/Hide Action Dropdown -->
<script>
    $('body').delegate(".mytoggle", 'click', function () {
        //$(".mytoggle").removeClass("active");
        //$(this).addClass("active");
    });
    $(document).click(function () {
        //$(".mytoggle").removeClass("active");
    });
</script>

<!--All Checked Unchecked Checkboxes-->
<script>
    $("#checkAll").click(function () {
        // $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

<!-- Script for Active/Disactive Filter Icons -->
<script>
    $(document).ready(function () {
        // $(".showoption").click(function() {
        // 	if($(this).is(":checked")) {
        // 		$("#inactiveicon").addClass('filter-btn').removeClass("listdisabled");
        // 		$("#inactiveicon").attr("data-target", "#deleteModal").addClass('cursor');
        // 	} else {
        // 		$("#inactiveicon").removeClass('filter-btn').addClass("listdisabled");
        // 		$("#inactiveicon").removeAttr("data-target").removeClass('cursor');
        // 	}
        // });
        $('#data-table').DataTable();
    });
</script>

<script>
    var app = angular.module('myApp', []);
    app.controller('customersCtrl', function ($scope, $http) {
        $scope.default_business_logo = '<?php echo $uploadPath; ?>/default_images/default_business_logo.png';

        var list_url = siteUrl + 'get-client-list-json';
        var delete_url = siteUrl + 'delete-team-member-json';
        var old_sorted_on = 'created';
        var delete_icon_disable_cls = 'listdisabled';
        var delete_icon_enable_cls = 'filter-btn';
        $scope.all_data = [];
        $scope.is_show_data = 0;
        $scope.check_all_selected = false;
        $scope.limit = '10';
        $scope.searchKey = '';
        $scope.pageNo = 1;
        $scope.offset = 0;
        $scope.sorted_on = 'created';
        $scope.sorted_by = 'desc';
        $scope.from_date = '';
        $scope.to_date = '';
        $scope.total_records = 0;
        $scope.filtered_records = 0;
        $scope.totalpages = 1;
        $scope.total_check = 0;
        $scope.delete_icon_cls_var = 'listdisabled';
        var can_delete_item = true;
        var permission_msg = "<?php echo $this->config->item('permission_msg'); ?>";
        var single_item_delte_msg = "Are you sure to delete this record ?";
        var items_delte_msg = "Are you sure to delete these records ?";
        var no_item_select_msg = "Sorry! You have not selected any record.";




        /****
         *******************************Get List**********************************
         ****/
        get_list_data();
        function get_list_data() {
            if ($scope.pageNo == '') {
                $scope.pageNo = 1;
            }
            $scope.check_all_selected = false;
            var queryStr = list_url;
            queryStr += "?limit=" + $scope.limit;
            queryStr += "&searchKey=" + $scope.searchKey;
            queryStr += "&pageNo=" + $scope.pageNo;
            queryStr += "&sorted_on=" + $scope.sorted_on;
            queryStr += "&sorted_by=" + $scope.sorted_by;
            queryStr += "&from_date=" + $scope.from_date;
            queryStr += "&to_date=" + $scope.to_date;
            jsLoader(true);
            $http.get(queryStr)
                    .then(function (response) {
                        jsLoader(false);
                        $scope.all_data = response.data.data;
                        $scope.total_records = response.data.total_records;
                        $scope.filtered_records = response.data.filtered_records;
                        if ($scope.all_data.length == 0) {
                            $scope.is_show_data = 2;
                        } else {
                            $scope.totalpages = Math.ceil($scope.total_records / $scope.limit);
                            $scope.is_show_data = 1;
                        }
                    });
        }

        /****
         *******************************Check Box Operations**********************************
         ****/
        $scope.toggleSelection = function () {
            angular.forEach($scope.all_data, function (item) {
                item.selected = $scope.check_all_selected;
            });

            if ($scope.check_all_selected) {
                $scope.delete_icon_cls_var = delete_icon_enable_cls;
            } else {
                $scope.delete_icon_cls_var = delete_icon_disable_cls;
            }
        };
        $scope.single_check = function () {
            $scope.total_check = 0;
            angular.forEach($scope.all_data, function (item) {
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

        /****
         *******************************Delete Operations**********************************
         ****/
        $scope.delete_single_record = function (ids) {
            console.log(ids);
            if (!can_delete_item) {
                flashNow({'error': {'message': permission_msg}});
            } else {
                deleteConfirm(function () {
                    // console.log('here');
                    var url = delete_url + '?ids=' + ids;
                    $http.post(url).then(function (response) {
                        if (response.data.success) {
                            // get_list_data();
                            location.reload();
                        }
                        flashNow(response.data);
                    });
                }, single_item_delte_msg);
            }
        }

        $scope.delete_multiple_records = function () {
            if (!can_delete_item) {
                flashNow({'error': {'message': permission_msg}});
            } else {
                var check_flag = false;
                var checkboxes = [];
                angular.forEach($scope.all_data, function (item) {
                    if (item.selected) {
                        checkboxes.push(item.team_id);
                        check_flag = true;
                    }
                });
                if (!check_flag) {
                    flashNow({'error': {'message': no_item_select_msg}});
                } else {
                    deleteConfirm(function () {
                        var url = delete_url + '?ids=' + checkboxes;
                        $http.post(url).then(function (response) {
                            if (response.data.success) {
                                get_list_data();
                            }
                            flashNow(response.data);
                            angular.forEach($scope.all_data, function (item) {
                                if (item.selected) {
                                    item.selected = false;
                                }
                            });
                        });
                        $scope.check_all_selected = false;
                    }, items_delte_msg);
                }
                //$scope.check_all_selected=false;
            }
        }

        /****
         *******************************Pagination Operations**********************************
         ****/
        $scope.get_next_or_prev_page_data = function (type) {
            if ($scope.pageNo == '') {
                $scope.pageNo = 1;
            }
            if ((type == "next" && $scope.pageNo >= $scope.totalpages) || (type == "prev" && $scope.pageNo == 1)) {
                return;
            }
            $scope.pageNo = type == 'next' ? ($scope.pageNo + 1) : ($scope.pageNo - 1);
            get_list_data();
        }
        $scope.get_page_no_wise_data = function (event) {
            if (event.which == 13) {
                if ($scope.pageNo > $scope.totalpages || $scope.pageNo < 1) {
                    if ($scope.pageNo == '') {
                        return;
                    }
                    $scope.pageNo = 1;
                }
                get_list_data();
            }
        }

        /****
         *******************************Filter Operations**********************************
         ****/
        $scope.get_searched_data = function () {
            $scope.pageNo = 1;
            get_list_data();
        };
        $scope.get_sorted_data = function () {
            if ($scope.sorted_on == old_sorted_on) {
                $scope.sorted_by = $scope.sorted_by == "desc" ? "asc" : "desc";
            } else {
                $scope.sorted_by = "desc";
            }
            old_sorted_on = $scope.sorted_on;
            $scope.pageNo = 1;
            get_list_data();
        };
        $(document).on("click", function (e) {
            target = e.target || e.srcElement;
            if ($(target).hasClass('text')) {
                angular.element("#customersCtrl").scope().get_sorted_data();
            }
        });

        $('.range-calander').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $scope.from_date = picker.startDate.format('MM/DD/YYYY');
            $scope.to_date = picker.endDate.format('MM/DD/YYYY');
            get_list_data();
        });
        $scope.reset_data = function () {
            if ($scope.searchKey == '') {
                get_list_data();
            }
        };
    });
    
    
    


</script>