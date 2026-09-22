jQuery(document).ready(function($) {
"use strict";
	$('#baseUrl').hide(); 


	// $(document).on('click', '#saveAppSet', function(e) {
	//     e.preventDefault();
	//     var appSetName = $('#appSetName').val(); 
	//     $.ajax({
	//         type: 'post',
	//         url: 'save-app-set',
	//         data: { 
	//             'setName': appSetName,
	//             // 'selectedApps' : selectedApps,
	//             // 'status' : 1
	//         },
	//         dataType: 'json',
	//         success: function(data) {
	//             if (data.in_id) {
	//                 console.log('New in_id:', data.in_id);
	//                 toastr.success(data.msg, 'Success');
	//                 setTimeout(function() {
	// 					window.location.href = data.redirectUrl;
	// 				}, 1000);
	//             } else if (data.error) {
	//                 console.error('Error saving app set:', data.error);
	//                 toastr.error(data.error, 'Error');
	//             }
	//         },
	//         error: function(xhr, status, error) {
	//             console.error('AJAX error:', status, error);
	//         }
	//     });
	// });
});

// var myApp = angular.module('AppModule',[]);


// myApp.controller("myCon2",function($scope, $http){

// 	$scope.selectedApps = [];
// 	$scope.appSetName = '';
// 	$scope.search = '';
// 	$scope.status = 'all';
// 	$scope.allSetsList = '';
// 	$scope.setsCount = '';

// 	$scope.toggleActive = function() {
// 		$scope.isActive = !$scope.isActive;
// 	};

//     $scope.select = function(app) {
// 		$scope.selectedApp = app;
// 	};

// 	$scope.toggleSelect = function(app) {
// 		const index = $scope.selectedApps.findIndex(selectedApp => selectedApp.ca_id === app.ca_id);
// 		if (index > -1) {
// 			$scope.selectedApps.splice(index, 1);
// 		} else {
// 			$scope.selectedApps.push(app);
// 		}
// 	};

// 	$scope.isSelected = function(app) {
// 		return $scope.selectedApps.some(selectedApp => selectedApp.ca_id === app.ca_id);
// 	};
//     function getAppsList() {
// 		$http({
// 			method: 'POST',
// 			url: siteUrl + 'get-apps-list',
// 			aync: false,
// 			data: {
// 				'status': $scope.status,
// 				'search': $scope.search,
// 			},
// 			headers: {
// 				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
// 			}
// 		}).then(function(response) {
// 			$scope.allSetsList = response.data.data.appsList;
// 			$scope.appSetName = "App Set " + response.data.data.setsCount;
// 		});
// 	}
// 	getAppsList();


	

// 	$scope.saveAppSet = function() {
//        alert(); 
//          var appSetName = $scope.appSetName == undefined ? '' : $scope.appSetName;
        
//          var fd = new FormData();
//                 fd.append('appSetName', appSetName);
              
//           $http({
//                     method: 'POST',
//                     url: siteUrl + 'save-app-set',
//                     aync: false,
//                     data: fd,
//                     dataType: "json",
//                     transformRequest: angular.identity,
//                     headers: {
//                         'Content-Type': undefined
//                     }
//                 }).then(function(response) {
//                     quesObj = {};
//                     jsLoader(false);
//                     if (response.data.status == true) {
//                         $('#templatemodal').modal("hide");
//                         toastr.success(response.data.msg);
//                         window.location.href = siteUrl +'create-newapp/'+response.data.customer_apps_id;
//                     } else if (response.data.error) {
//                         toastr.error(response.data.error.msg);
//                     } else {
//                         toastr.error('Something went wrong');
//                     }
//                 });
//        }

// });