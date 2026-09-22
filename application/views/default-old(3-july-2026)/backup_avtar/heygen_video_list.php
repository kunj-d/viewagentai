 <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
 <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
 <!--<script src=""></script>-->
 <style>
     .export-btn {
         background: var(--blue-gradient);
         border: 0px;
         color: white;
         padding: 10px 40px;
         margin: 3px 10px;
         border-radius: 5px;
     }

     .delete-btn {
         color: #fff;
         font-size: 18px;
         padding-left: 15px;
     }

     .delete-btn:hover {
         color: red;
     }

     div.dt-buttons>.dt-button:first-child,
     div.dt-buttons>div.dt-button-split .dt-button:first-child {
         background: var(--blue-gradient);
         border-radius: 5px;
         padding: 10px 20px 10px 20px;
         color: #fff;
     }

     div.dt-buttons>.dt-button:hover:not(.disabled),
     div.dt-buttons>div.dt-button-split .dt-button:hover:not(.disabled) {
         background: var(--blue-gradient);
         padding: 10px 20px 10px 20px;
         color: #fff;
         border-color: var(--theme-br2);
     }

     .dataTables_filter label {
         color: var(--black-color) !important;
     }

     #data-table.table>:not(:last-child)>:last-child>* {
         border-bottom-color: var(--theme-br);
     }

     .dt-buttons {
         position: relative;
         left: 51px;
     }
 </style>
 <div class="container-wrapper container-open" ng-app="AppModule" ng-controller="autoresponderListCtrl" ng-cloak>
     <title><?php echo $this->config->item('productName') ?> | Avatar</title>
     <!-- Main Container Start -->
     <div class="container-fluid container-padding">
        <div class="row">
            <?php if(empty($videos)) { ?>
            <div class="col-12">
                <div class="create-first">
                    <img src="<?php echo $this->config->item('assetsPath') ?>images/first-avatar.png" alt="image" class="img-fluid d-block mx-auto">
                    <p class="description">
                        Start now by creating your first avatar.
                    </p>
                    <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAvatarModal">Create Now</a>
                </div>
            </div>
            <?php } else {  ?>
            <div class="col-12">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title-line">
                        AI Tube Avatar
                        </div>
                        <p class="container-page-subtitle ">You haven't created any Avatar yet.</p>
                    </div>
                    <div class="col-md-12 text-end d-flex align-items-sm-center justify-content-between gap-2 flex-column flex-sm-row">
                        <div class="w-50">
                            <div class="search-bar left-icon">
                                <div class="search-icon">
                                    <span class="icon-search"></span>
                                </div>
                                <input type="text" class="search form-control" placeholder="Search for Video" autocomplete="off">
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a href="javascript:void(0)" class="btn btn-outline btn-outline-white">Create Using Template</a>
                            <a href="javascript:void(0)" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAvatarModal">Create New Video</a>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 mt-2 mt-md-3">
                    <div class="col">
                        <div class="avatar-listing">
                            <img src="<?php echo $this->config->item('assetsPath') ?>images/video-pr.png" alt="image" class="avatar-listing-media">
                            <div class="avatar-listing-inner">
                                <div class="top-content d-flex align-items-center justify-content-end">
                                    <div class="d-flex gap-2">
                                        <a class="d-inline-block" href="javascript:void(0);">
                                            <i class="fas fa-star"></i>
                                        </a>
                                    </div>
                                </div>
                                <a class="video-btn"><i class="fa-solid fa-play"></i></a>
                                <div class="bottom-content">
                                    <div class="avatar-flex-content">
                                        <div class="sub-content">
                                            <a href="javascript:void(0);" class="avatar-link">User121</a>
                                            <p class="date">Created on 17-03-2025</p>
                                        </div>
                                        <div class="play-badge">Play<i class="fa-solid fa-circle-play"></i></div>
                                    </div>
                                    <ul class="avatar-listing-icons">
                                        <li 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Copy Embed Code" 
                                            data-bs-original-title="" 
                                            title=""
                                        >
                                            <a data-bs-toggle="modal"><i class="fa-solid fa-copy"></i></a>
                                        </li>
                                        <li 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Share"  
                                            data-bs-original-title="" title="">
                                            <a data-bs-toggle="modal" data-bs-target="#shareModal">
                                                <i class="fa-solid fa-share-from-square"></i>
                                            </a>
                                        </li>

                                        <li 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Edit" 
                                            data-bs-original-title="" title="">
                                            <a href="javascript:void(0);">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </li>

                                        <li class="template-list" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Add to Workspace" 
                                            data-bs-original-title=""
                                            title="">
                                            <a href="javascript:void(0);"><i class="fa-solid fa-file-import workspace-listing "></i></a>
                                            <ul style="max-height: 160px; overflow-y: auto;">
                                                <p class="mb-0">Add to Workspace</p>
                                            </ul>
                                        </li>
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Delete" data-bs-original-title="" title="">
                                            <a style="color: #FF4B4B !important;">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
     </div>

     <!-- Modal for createAvatar -->
     <div class="modal fade" id="createAvatarModal" tabindex="-1" aria-labelledby="createAvatarModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                <div class="modal-header align-items-start">
                    <div class="d-flex flex-column gap-2">
                        <h5 class="modal-title">AI Tube Avatar</h5>
                        <div class="std-btn">
                            <span>See The Difference</span>
                            <i
                                class="fa-solid fa-circle-info ms-2 info-tooltip"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip"
                                data-bs-title="Select the email type with your audience’s needs.">
                            </i>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 <div class="modal-body">
                    <div class="row row-gap">
                        <div class="col-sm-6">
                            <a href="<?= base_url('talking-photo-avatar'); ?>">
                                <div class="createAvatarModal-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-photo.png" alt="image">
                                    <p class="description">Create Photo Avatar</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="javascript:void(0)">
                                <div class="createAvatarModal-box">
                                    <img src="<?php echo $this->config->item('assetsPath') ?>images/create-video.png" alt="image">
                                    <p class="description">Create Video Avatar</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="std-wrapper">
                        <div class="row g-0">
                            <div class="col-6">
                                <a href="javascript:void(0)">
                                    <div class="std-avatar-box">
                                        <span class="title-desc">Create with a Photo</span>
                                        <div class="media-box">
                                            <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0)">
                                    <div class="std-avatar-box border-0">
                                        <span class="title-desc">Create with a Video</span>
                                        <div class="media-box">
                                            <img src="<?php echo $this->config->item('assetsPath') ?>images/std-img/std1.png" alt="image">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Modal for createAvatar -->

     <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

     <script>
         function setLabelList(autoresponder_ids, list_id) {
             $(".list_id").remove();
             responderLoader(true);
             $.ajax({
                 type: 'POST',
                 url: '<?php echo site_url('autoresponder_forms'); ?>',
                 data: {
                     'autoresponder_id': autoresponder_ids
                 },
                 dataType: 'json',
                 success: function(response) {
                     responderLoader(false);
                     $.each(response, function(index, value) {
                         var autoresponderSet = (list_id == value.listid) ? 'selected' : '';
                         $(".responder_form_option").after("<option class='list_id' value='" + value.listid + "' " + autoresponderSet + ">" + value.title + "</option>");
                     });
                     // setTimeout(function () {
                     $('.selectpicker').selectpicker('refresh')
                     // }, 500);
                 }
             });
         }


         function responderLoader(flag) {
             if (flag === undefined) {
                 flag = false;
             }
             $(".temp_js_loader").remove();
             if (flag) {
                 $("body").append('<div class="temp_js_loader" style="background: rgba(200, 200, 200, 0.34);width: 100%;height: 100%;position: fixed;top: 0px;left: 0px;z-index: 9999;"><img src="<?php echo $assetsFolder; ?>images/loader.gif" style="position: absolute;margin: auto;top: 0;bottom: 0;left: 0;right: 0;width:5%"></div>');
             }
         }
     </script>

     <script>
         $(document).ready(function() {
             $("#checkCustomColor_all").click(function() {
                 $('input:checkbox').not(this).prop('checked', this.checked);
             });
         });


         //   $(document).ready(function() {
         //         $('#data-table').DataTable({
         //             rowId: 'row-{{ conversation.id }}' 
         //         });
         //     }); 
         //  $(document).ready(function() {
         //     $('#data-table').DataTable( {


         //         // rowId: 'row-{{ conversation.id }}' 
         //         // 'processing': true,
         //         // 'serverSide': true,
         //         // "order": [[ 0, "desc" ]],
         //         "text":  'Export',
         //         dom:
         //           "<'row'<'col-sm-3'l><'col-sm-4'><'col-sm-5'Bf>>" +
         //             "<'row'<'col-sm-12 table-responsive 'tr>>" +
         //             "<'row'<'col-sm-4'i><'col-sm-8'p>>",
         //           buttons: [
         //                     {
         //                         extend: 'excelHtml5',
         //                         title: 'Leads',
         //                         text: 'Export.csv'
         //                     },
         //                     // {
         //                     //     extend: 'pdfHtml5',
         //                     //     title: 'User list'
         //                     // }
         //                 ],
         //         'lengthMenu': [[10, 25, 50, -1], [10, 25, 50,'100']],
         //     } );

         //     $('.delete-lead').click(function(e) {
         //         e.preventDefault();
         //         var id = $(this).data('id');
         //           // Show SweetAlert confirmation
         //             Swal.fire({
         //                 title: 'Are you sure?',
         //                 text: 'You will be delete this data!',
         //                 icon: 'warning',
         //                 showCancelButton: true,
         //                 confirmButtonColor: '#3085d6',
         //                 cancelButtonColor: '#d33',
         //                 confirmButtonText: 'Yes, delete it!'
         //             }).then((result) => {
         //                 if (result.isConfirmed) {
         //                     $.ajax({
         //                         type: 'POST',
         //                          data: { id: id },
         //                         url: siteUrl + 'autoresponder-lead-list/delete',
         //                         success: function(response) {
         //                                 location.reload();
         //                             // if(response.data.status == 1){
         //                             // }else{
         //                             //     toastr.error('Something went wrong');
         //                             // }
         //                         }
         //                     });
         //                 }
         //             });





         //     });
         // });




         $(document).ready(function() {
             var table = $('#data-table').DataTable({
                 // "text":  'Export',
                 // dom:
                 //   "<'row'<'col-sm-3'l><'col-sm-4'><'col-sm-5'Bf>>" +
                 //     "<'row'<'col-sm-12 table-responsive 'tr>>" +
                 //     "<'row'<'col-sm-4'i><'col-sm-8'p>>",
                 //  /*  buttons: [
                 //             {
                 //                 extend: 'excelHtml5',
                 //                 title: 'Leads',
                 //                 text: 'Export.csv'
                 //             },
                 //         ], */
                 // 'lengthMenu': [[10, 25, 50, -1], [10, 25, 50,'100']],
             });

             // Use event delegation

             $(document).on('click', '.delete-lead', function(e) {
                 e.preventDefault();
                 var id = $(this).data('id');

                 Swal.fire({
                     title: 'Are you sure?',
                     text: 'You will delete this data!',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         $.ajax({
                             type: 'POST',
                             data: {
                                 id: id
                             },
                             url: siteUrl + 'autoresponder-lead-list/delete',
                             success: function(response) {
                                 table.row($(e.target).closest('tr')).remove().draw();
                                 flashNow({
                                     'success': {
                                         'message': 'Content Deleted successfully'
                                     }
                                 });
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



             /* MultiDelete Work Start */

             $scope.selectedEbooks = [];
             $scope.selectAll = false;
             $scope.email_from_name = "";
             $scope.email_replyto = ""
             $scope.schedule_time = new Date();
             // Toggle all checkboxes when clicking "Select All"
             $scope.toggleAll = function() {
                 if ($scope.selectAll) {
                     // Select all IDs
                     $scope.selectedEbooks = <?php echo json_encode(array_column($lists, 'id')); ?>;
                 } else {
                     // Deselect all
                     $scope.selectedEbooks = [];
                 }
             };

             // Ensure "Select All" updates based on selection
             $scope.checkSelection = function(id) {
                 let index = $scope.selectedEbooks.indexOf(id);

                 if (index === -1) {
                     // If not selected, add to the array
                     $scope.selectedEbooks.push(id);
                 } else {
                     // If already selected, remove from the array
                     $scope.selectedEbooks.splice(index, 1);
                 }

                 // Update "Select All" checkbox
                 $scope.selectAll = ($scope.selectedEbooks.length === <?php echo count($lists); ?>);
             };

             // Delete selected eBooks
             $scope.delete_multiple = function() {
                 console.log("Selected Ebooks:", $scope.selectedEbooks);

                 if ($scope.selectedEbooks.length === 0) {
                     flashNow({
                         'error': {
                             'message': 'Please select at least one Email to delete.'
                         }
                     });
                     return;
                 }

                 Swal.fire({
                     title: 'Are you sure?',
                     text: 'This action cannot be undone!',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, delete Selected Ones!',
                     cancelButtonText: 'Cancel'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         $http.post("<?= base_url('delete_multiple') ?>", {
                                 ids: $scope.selectedEbooks,
                                 table_name: 'email'
                             })
                             .then(function(response) {
                                 if (response.data.success) {
                                     flashNow({
                                         'success': {
                                             'message': 'Deleted successfully'
                                         }
                                     });
                                     setTimeout(() => {
                                         location.reload();
                                     }, 1000);
                                 } else {
                                     flashNow({
                                         'error': {
                                             'message': 'Failed to delete!'
                                         }
                                     });
                                 }
                             });
                     }
                 });
             };


             /* Autoresponder Code */

             $scope.formatDateTime = function() {
                 if ($scope.schedule_time) {
                     let date = new Date($scope.schedule_time);
                     let y = date.getFullYear();
                     let m = ('0' + (date.getMonth() + 1)).slice(-2); // Ensure 2 digits
                     let d = ('0' + date.getDate()).slice(-2);
                     let h = ('0' + date.getHours()).slice(-2);
                     let min = ('0' + date.getMinutes()).slice(-2);

                     $scope.formattedDateTime = `${y}-${m}-${d} ${h}:${min}`;
                 }
             };


             if ($scope.chooseAutoResponders !== "" && $scope.chooseAutoResponders != null) {
                 // setTimeout(function () {
                 if ($scope.chooseAutoResponders !== "") {
                     setLabelList($scope.chooseAutoResponders, <?php echo json_encode($emailData['list_id']); ?>);
                 }
                 // }, 1000);
             }


             $scope.getAutoDetails = function() {
                 var queryStr = "<?php echo base_url('autoresponder_list') ?>";
                 $http({
                     method: "post",
                     url: queryStr,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     $scope.autoresponders = response.data;
                 });
             }
             $scope.toggleLeadFormStartOrNResponse = function(val) {
                 $scope.prompt_show_lead_starting_or_n_response = val;
             }

             $scope.feedbackFrom = function(value) {
                 $scope.selectedFeedbackForm = value;
             }


             $scope.getAutoDetails();

             setTimeout(() => {
                 setLabelList($('#chooseAutoResponders').val(), $('#select_list').val());
             }, 1000);


             $scope.selectResponse = function(value) {
                 $scope.userSelctedResponse = value;
                 console.log('$scope.userSelctedResponse', $scope.userSelctedResponse);
             }

             if (!$scope.userSelctedResponse) {
                 $scope.userSelctedResponse = '50 - 150';
             }
             /* Autoresponder Code */



             $scope.convert = function(currentModule, module, id) {
                 var data = {
                     current_module: currentModule,
                     module_name: module,
                     id: id
                 };

                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('convertEmail'); ?>',
                     data: $.param(data),
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     if (response.data.status == 1) {
                         window.location.href = siteUrl + response.data.redirect
                     }

                 }).catch(function(error) {
                     console.error('Error', error);
                 });
             }


             $scope.workspacelist = <?php echo json_encode($workspaceData); ?>;

             $scope.downloadFile = function(format, id) {
                 var postData = $.param({
                     id: id
                 });
                 jsLoader(true);
                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('inkflow-get-data'); ?>',
                     data: postData,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     var emailBody = response.data.email_body;
                     var emailSubject = response.data.emil_subject;
                     if (format === 'html') {
                         var content = "<html><head><title>" + emailSubject + "</title></head><body><h1>" + emailSubject + "</h1><p>" + emailBody + "</p></body></html>";
                         var blob = new Blob([content], {
                             type: "text/html"
                         });
                         saveAs(blob, "email_content.html");
                         jsLoader(false);
                     } else if (format === 'txt') {
                         emailBody = emailBody.replace(/<script\b[^>]*>[\s\S]*?<\/script>/gi, '');
                         emailBody = emailBody.replace(/<style\b[^>]*>[\s\S]*?<\/style>/gi, '');
                         var emailBody = $("<div>").html(emailBody).find("h1, h2, h3, p") // Select specific tags
                             .map(function() {
                                 return $(this).text(); // Extract text content
                             }).get().join("\n\n");

                         var blob = new Blob(["Subject: " + emailSubject + "\n\nBody:\n" + emailBody], {
                             type: "text/plain"
                         });
                         saveAs(blob, "email_content.txt");
                         jsLoader(false);
                     } else if (format === 'pdf') {

                         $http({
                             method: 'POST',
                             url: '<?php echo site_url('inkflow-pdf-download'); ?>',
                             data: postData,
                             headers: {
                                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                             },
                             responseType: 'arraybuffer'
                         }).then(function(response) {
                             var blob = new Blob([response.data], {
                                 type: "application/pdf"
                             });
                             saveAs(blob, "email_content.pdf");
                             jsLoader(false);
                         }).catch(function(error) {
                             toastr.error('An error occurred while generating the PDF.');
                             console.error('Error:', error);
                             jsLoader(false);
                         });
                     }
                 }).catch(function(error) {
                     flashNow({
                         'error': {
                             'message': 'Failed to fetch Content.'
                         }
                     });
                     // toastr.error("Failed to fetch email content.");
                     console.error("Error:", error);
                     jsLoader(false);
                 });
             };

             $scope.save_schedule = function(id, subject = "test", body = "test") {
                 var subjectData = subject;
                 var emailBody = body;

                 if (!subjectData || !$scope.email_from_name || !$scope.email_replyto || !$scope.chooseAutoResponders || !$scope.select_list || !$scope.formattedDateTime || !emailBody) {
                     flashNow({
                         'error': {
                             'message': "Please Check Email Subject, Email Body And These Input Fields are fill or not"
                         }
                     });
                     return;
                 }


                 var postData = {
                     email_subject: subjectData,
                     email_from_name: $scope.email_from_name,
                     email_replyto: $scope.email_replyto,
                     autoresponder_id: $scope.chooseAutoResponders,
                     autoresponder_list: $scope.select_list,
                     schedule_time: $scope.formattedDateTime,
                     email_body: emailBody
                 };

                 jsLoader(true);

                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('autoresponder_schedule_email'); ?>',
                     data: postData,
                     headers: {
                         'Content-Type': 'application/json'
                     },
                 }).then(function(response) {
                     if (response.data.status) {
                         flashNow({
                             'success': {
                                 'message': "Email Scheduled successfully!"
                             }
                         });

                         setTimeout(() => {
                             $('#scheduleModal').modal('hide');
                         }, 500);
                     }

                 }).catch(function(error) {
                     jsLoader(false);
                     flashNow({
                         'error': {
                             'message': "Something Went Wrong"
                         }
                     });
                     setTimeout(() => {
                         $('#scheduleModal').modal('hide');
                     }, 1000);
                 });
             };

             $scope.addgptWorkSpace = function(workspaceid, listid) {
                 var postData = $.param({
                     email_id: listid,
                     business_id: workspaceid
                 });
                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('move-emailWorkspaace'); ?>',
                     data: postData,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     },
                 }).then(function(response) {
                     console.log(response.data);
                     if (response.data.status == 1) {
                         flashNow({
                             'success': {
                                 'message': 'Content Moved to Workspace Successfully.'
                             }
                         });
                         // toastr.success(response.data.msg);
                     } else {
                         flashNow({
                             'error': {
                                 'message': 'Failed to Move Content.'
                             }
                         });
                         // toastr.error(response.data.msg);
                     }
                 });
             }


             $scope.duplicate_func = function(id = null) {
                 let clone_id = id;
                 var blogData = {
                     clone_id: clone_id
                 };


                 jsLoader(true);
                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('duplicate-email'); ?>',
                     data: $.param(blogData),
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     if (response.data.status) {
                         flashNow({
                             'success': {
                                 'message': 'Content Duplicated Successfully'
                             }
                         });
                         // toastr.success(response.data.msg)
                         setTimeout(() => {
                             window.location.href = siteUrl + 'inkflow-email';
                         }, 1000);
                     } else {
                         flashNow({
                             'error': {
                                 'message': 'Failed to duplicate Content.'
                             }
                         });
                         //    toastr.error(response.data.msg)
                     }
                     jsLoader(false);
                 }).catch(function(error) {
                     flashNow({
                         'error': {
                             'message': 'Content Duplicate Failed'
                         }
                     });
                     // toastr.error('Email Duplicated Faild')
                     console.error('Error:', error);
                     jsLoader(false);
                 });
             };



             $scope.toggleStatus = function(id) {
                 var starElement = angular.element(document.querySelector("#star_" + id));
                 // console.log(starElement.hasClass('far'));
                 var isFavorite = starElement.hasClass('far') ? 1 : 0;
                 starElement.toggleClass('far fas');
                 $scope.updateStatus(id, isFavorite);
             };



             $scope.updateStatus = function(emailId, value) {
                 var data = {
                     prompt_id: emailId,
                     value: value
                 };
                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('email-fav'); ?>',
                     data: $.param(data),
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     if (response.data.message) {
                         flashNow({
                             'success': {
                                 'message': response.data.message
                             }
                         });
                     }

                 }).catch(function(error) {
                     console.error('Error updating database:', error);
                 });
             }





             //  $scope.fave_func = function(id =  null) {

             //         let fav_id = id;
             //             var blogData = {
             //                 fav_id : fav_id
             //             };

             //         jsLoader(true);
             //         $http({
             //             method: 'POST',
             //             url: '<?php echo site_url('email-fav'); ?>',
             //             data: $.param(blogData),
             //             headers: {
             //                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
             //             }
             //         }).then(function(response) {
             //             if (response.data.status) {
             //                 // flashNow({
             //                 //     'success': {
             //                 //         'message': response.data.msg
             //                 //     }
             //                 // });
             //                 toastr.success(response.data.msg)
             //                 setTimeout(() => {
             //                     window.location.href = siteUrl +'inkflow-email';
             //                 }, 1000);
             //             } else {

             //               toastr.error(response.data.msg)
             //             }
             //             jsLoader(false);
             //         }).catch(function(error) {

             //             toastr.error('Email Duplicated Faild')
             //             console.error('Error:', error);
             //             jsLoader(false);
             //         });
             //     };



             $scope.copyEmail = function(id) {
                 var postData = $.param({
                     id: id
                 });
                 jsLoader(true);
                 $http({
                     method: 'POST',
                     url: '<?php echo site_url('inkflow-get-data'); ?>',
                     data: postData,
                     headers: {
                         'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                     }
                 }).then(function(response) {
                     var emailSubject = response.data.emil_subject;
                     var emailBody = response.data.email_body;

                     emailBody = emailBody.replace(/<script\b[^>]*>[\s\S]*?<\/script>/gi, '');
                     emailBody = emailBody.replace(/<style\b[^>]*>[\s\S]*?<\/style>/gi, '');
                     var emailBody = $("<div>").html(emailBody).find("h1, h2, h3, p") // Select specific tags
                         .map(function() {
                             return $(this).text(); // Extract text content
                         }).get().join("\n\n");

                     var fullEmail = "Subject: " + emailSubject + "\n\n" + emailBody
                     navigator.clipboard.writeText(fullEmail).then(function() {
                         flashNow({
                             'success': {
                                 'message': 'Content Copied Successfully!'
                             }
                         });
                         // toastr.success("Email content copied successfully!");
                         jsLoader(false);
                     }).catch(function(error) {
                         flashNow({
                             'error': {
                                 'message': 'Failed to copy  content.'
                             }
                         });
                         // toastr.error("Failed to copy email content.");
                         jsLoader(false);
                     });

                 })
             }


             $scope.confirmDelete = function(id) {
                 Swal.fire({
                     title: 'Are you sure?',
                     text: 'This action cannot be undone!',
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, delete it!',
                     cancelButtonText: 'Cancel'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         // Call the delete function here
                         $scope.appdelete(id);
                     }
                 });

             };


             $scope.appdelete = function(id) {
                 var blog_id = id;
                 var fd = new FormData();
                 fd.append('email_id', blog_id);
                 $http({
                     method: 'POST',
                     url: siteUrl + 'delete-email',
                     aync: false,
                     data: fd,
                     dataType: "json",
                     transformRequest: angular.identity,
                     headers: {
                         'Content-Type': undefined
                     }
                 }).then(function(response) {
                     if (response.data.status == true) {
                         // toastr.success(response.data.msg);
                         flashNow({
                             'success': {
                                 'message': 'Content Deleted Successfully.'
                             }
                         });

                         // getCT();
                         location.reload();
                     } else if (response.data.error) {
                         flashNow({
                             'error': {
                                 'message': 'Failed to Delete Content.'
                             }
                         });
                         // toastr.error(response.data.msg);
                     } else {
                         flashNow({
                             'error': {
                                 'message': 'Something went wrong'
                             }
                         });
                         // toastr.error('Something went wrong');
                     }
                 });
             }


         });
     </script>