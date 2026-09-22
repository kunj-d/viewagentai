 <style>
[ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
  display: none !important;
}
</style>
 
 <!-- Container Start -->
    <div class="container-wrapper container-open">
    <title><?php echo $web_sitetitle;?> Text to Audio</title>
        <!-- Main Container Start --> 
        <div class="container-fluid container-padding mt30 mt-md50" ng-app="myApp" ng-controller="libCtrl">

            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <div class="title-line">
                        Voiceover
                    </div>
                    <p class="container-page-subtitle mt10">Transform text into immersive audio experiences with Text to Audio conversion.</p>
                </div>
            </div>
            <div class="row mt20 align-items-center">
                <div class="col-12 col-md-12">
                    <div class="tab-design">
                        <a class="nav-link" href="<?php echo base_url('vox')?>">Create Audio</a>
                        <a class="nav-link active" href="<?php echo base_url('vox-list')?>">Audio List</a>
                    </div>
                </div>
            </div>
        
        
            <div class="row mt20 mt-md30 align-items-center">
                <div class="col-6 col-md-5 col-xl-4 d-flex align-items-center gap-3">
                    <div class="searchbox">
                        <input type="text" ng-model="searchKey" ng-change="reset_data()" ng-keypress="on_enter_get_data($event)" class="form-control" placeholder="Search">
                    </div>
                      <a href="#" id="inactiveicon"  class="action-btn red-btn-outline " ng-click="delete_multiple()" style="display:none;" > <i class="icon-list-delete"></i></a>
                    </div>
                    <div class="col-6 col-md-7 col-xl-8 text-center text-md-end filter-text">
                       <div class="d-flex gap-3 align-items-center justify-content-end">
                        <span>Show</span>
                        <select class="selectpicker fiter-drop" ng-model="limit" ng-change="sorted_on = 'created';sorted_by = 'desc';get_sorted_data()">
                           <option value='10'>10</option>
                           <option value='20'>20</option>
                           <option value='30'>30</option>
            			   <option value='30'>40</option>
            			   <option value='30'>50</option>
                        </select>
                        <span>Entries</span>
                        </div>
                    </div>
               </div>
               
            <div class="row mt30">
        <div class="col-12">
            <div class="table-wrapper">
                <div class="table-responsive">
			
               <table class="table table-borderless table-design" >
                  <thead class="field-design">
                     <tr>
                          <th>  
                        
                        
                                <input id="checkAll" type="checkbox" ng-model="allChecked" class="form-check-input"
				ng-click="toggleAll(all_data, allChecked)" 
				ng-checked="all_data && isAllSelected(all_data)">
									<label for="checkAll"></label>
                                
                                
                                </th>
                         <th>S.No.</th>
                        <th>Title</th>
                        <th><?=my_caption('tts_text_preview')?></th>
						<th><?=my_caption('tts_text_characters_count')?></th>
						<th><?=my_caption('tts_language')?></th>	  
						<th><?=my_caption('global_time')?></th>
						<th><?=my_caption('global_actions')?></th>
                     </tr>
                  </thead>
                  <tbody ng-cloak ng-show="all_data.length>0" class="field-design">
                     <tr ng-repeat="item in all_data">
                         
                         <td>
                                        <div ng-init="all_data[$index].is_disabled=item.is_default"> 
                                        <input class="form-check-input checkbox" id="check{{item.id}}" type="checkbox" ng-model="item.checked"
											ng-disabled="item.is_disabled" ng-change="uncheck()">
										<label for="check{{item.id}}"></label>
										</div>
                                    </td>
                          <td ng-if="$index+1 <= 9"> {{scales}}{{$index+1}}</td>
									   <td ng-if="$index+1 == 10"> {{productParams.current_page}}0 </td>
                        <td>{{item.title}}</td>
                        <td>{{ item.text | limitTo: 100 }}{{item.text.length > 100 ? '...' : ''}}</td>
                        <td>{{item.characters_count}} </td>
                        <td>{{item.language_name}}</td>
                        <td>{{item.created_time}}</td>
                        <td>
                           <div class="action-link"><a href="<?php echo base_url('tts-download/');?>{{item.ids}}" class="action-btn blue-btn-outline"> <i class="icon-library-download"></i></a>
                              <a href="javascript:void(0)" ng-click="play_file(item)" class="action-btn blue-btn-outline"> <i class="icon-support size-icon"></i></a>
                              <a href="javascript:void(0)" ng-click="actionQuery(item)" class="action-btn red-btn-outline" > <i class="icon-list-delete"></i></a>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="pagination" ng-if="all_data.length > 0">
               <a ng-click="get_next_or_prev_page_data('prev')">Previous</a>
               <input type="text" ng-keypress="get_page_no_wise_data($event)" ng-model="pageNo" class="form-control">
               <a ng-click="get_next_or_prev_page_data('next')">Next</a>
            </div>
            
            	<div class="text-center" ng-if="all_data.length == 0">  No Record Found</div>
         </div>
      </div>
   </div>
               
        
        
        </div>
<div class="modal fade" id="tts_listen_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
		  <h5 class="modal-title"><?=my_caption('tts_player_title')?></h5>
		</div>
		<div class="modal-body">
		  <div class="row">
		    <div class="col-lg-12 text-center mt-3 mb-3">
			  <audio controls id="tts_player" name="tts_player"></audio>
			</div>
		  </div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=my_caption('global_simple_input_modal_close_button')?></button>
		</div>
	  </div>
	</div>
  </div>
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
			<input type="hidden" name="vox_delete" id="vox_delete" class="form-control"> 
          <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Cancel</button>
          <a id="btn_delete" class="base-btn red-btn">Delete</a>
        </div>
      </div>
    </div>
  </div>
</div>

  <?php
	    $global_caption = my_caption('global_view') . '||';
		$global_caption .= my_caption('global_edit') . '||';	
		$global_caption .= my_caption('global_delete') . '||';
		$global_caption .= my_caption('global_delete') . '||';
		$global_caption .= my_caption('global_not_revert') . '||';
		$global_caption .= my_caption('global_yes') . '||';
		$global_caption .= my_caption('global_no') . '||';
		$global_caption .= my_caption('global_cancel') . '||';
		$global_caption .= my_caption('global_ok');
	  ?>
  	  <input type="hidden" name="global_base_url" id="global_base_url" value="<?=base_url()?>">
	  <input type="hidden" name="global_caption" id="global_caption" value="<?=my_esc_html($global_caption)?>">
<!-- Script for Show/Hide Action Dropdown -->
<script>
   var app = angular.module('myApp', []);
   app.controller('libCtrl', function($scope, $http) {
        $scope.member_id_checks = [];
 
  var siteUrl = "<?php echo base_url();?>";
 //alert(siteUrl); die;
        var list_url = siteUrl + 'vox-list-json';
        var old_sorted_on = 'created';
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
            //queryStr += "&sorted_on=" + $scope.sorted_on;
            //queryStr += "&sorted_by=" + $scope.sorted_by;
            //queryStr += "&from_date=" + $scope.from_date;
            //queryStr += "&to_date=" + $scope.to_date;
           
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
                        $scope.check_all_selected = false;
                        $scope.toggleSelection();
                    });
        }
		
		$scope.play_file = function(value){
			$('#tts_listen_modal').modal('show');
			if (value.ids != '') {
				$("#tts_player").attr('controlsList', "");
				$('#tts_view_text').show();
			}
			$("#tts_player").attr("src", value.tts_uri).trigger("play");
		};

		$scope.actionQuery = function(value){
			$('#deleteModal').modal('show');
			$('[name="vox_delete"]').val(value.ids);
		};
		 $('#btn_delete').on('click',function(){
 // return;
            var ids = $('#vox_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('tts-remove/')?>" + ids,
                dataType : "JSON",
                //data : {ids:ids},
                success: function(data){
                   $('#deleteModal').modal('hide');
				   flashNow({'success': {'message': 'Vox Delete SuccessFully...!!!'}});
                   get_list_data();
                   }
                });
            return false;
        });
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
            
            	if($scope.pageNo > 1) {
			$scope.scales = $scope.pageNo -1;
		}else {
			$scope.scales = '';
		}
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
        
        $scope.reset_data = function () {
            if ($scope.searchKey == '') {
                get_list_data();
            }
        };

        $scope.on_enter_get_data = function (event) {
            if (event.which === 13) {
                get_list_data();
            }
        };
        
        
        	 $scope.toggleSelection = function () {
            angular.forEach($scope.all_data, function (x) {
                x.selected = $scope.check_all_selected;
            });
        };
		
		$scope.uncheck = function () {
            $scope.total_check = 0;
            angular.forEach($scope.all_data, function (x) {
                if (x.checked) {
                    $scope.total_check++;
                }
            });
           
            
            if ($scope.limit == $scope.total_check) {
                $scope.check_all_selected = true;
            } else {
                $scope.check_all_selected = false;
            }
            if ($scope.total_check > 0) {
                $("#inactiveicon").css("display", "flex");
               

            } else {
                $("#inactiveicon").css("display", "none");


            }

        }
		
		//////////multiple row delete/////////
        $scope.delete_multiple = function () {
            var check_flag = false;
            var checkboxes = [];
            angular.forEach($scope.all_data, function (x) {
                if (x.checked) {
                    checkboxes.push(x.id);
                    check_flag = true;
                }
            });
            
          //alert(check_flag); return;
            if (!check_flag) {
                flashNow({'error': {'message': "Sorry! You have not selected any Vox"}});
            } else {
				
            $scope.delete_confirm_multiple(checkboxes);
            }
            //$scope.check_all_selected = false;

        }
		
		$scope.delete_confirm_multiple = function(checkboxes) {	
		$("#deleteModalMultilpe").modal('show');
		 $('#deleteModalMultilpe .yes').on('click', function(e) {
        $("#deleteModalMultilpe").modal("hide");
				var url = "<?php echo site_url('default/Tts/delete_tts_multiple'); ?>" + '?id_data=' + checkboxes;
                    //console.log(url);return;
                    $http.post(url).then(function (response) {
                        $scope.data = response.data;
                        if ($scope.data.success) {
                            flashNow(response.data);
                            get_list_data();
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
	
	$scope.toggleAll = function (list, allChecked) {
		angular.forEach(list, function (item) {
			item.checked = allChecked;
				if(item.checked == true) {
			    $("#inactiveicon").css("display", "flex");    
			} else {
			    $("#inactiveicon").css("display", "none");    
			}
		});
	};
        
        
        
        
        
	
   
   
   
   
    });
</script>
        
    