<title><?php echo $this->config->item('productName') ?> | Contact</title>
<style>
    .nav-pills {
        &.nav-pills-style-1 {
            box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--theme-br);
        }
    }
    .custom-table {
        thead {
            th {
                text-align: start !important;
            }
        }
    }
</style>
<div class="container-wrapper container-open" ng-app="MyApp" ng-controller="leadCntrl">
    <div class="container-fluid container-padding">
        <div class="row row-gap-2">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center avatar-main-tabs mb-3">
                    <ul class="nav nav-pills nav-pills-style-1 mb-0 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link" ng-click="activetab('business')" id="pills-lead-finder-tab" data-bs-toggle="pill" data-bs-target="#pills-lead-finder" type="button" role="tab" aria-controls="pills-lead-finder" aria-selected="true">
                                <i class="fa-regular fa-user"></i>
                                Lead Finder
                            </button>
                        </li>
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link" ng-click="activetab('channel')" id="pills-channel-finder-tab" data-bs-toggle="pill" data-bs-target="#pills-channel-finder" type="button" role="tab" aria-controls="pills-channel-finder" aria-selected="false">
                                <i class="fa-light fa-square-rss"></i>
                                Channel Finder
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="pills-lead-finder" role="tabpanel" aria-labelledby="pills-lead-finder-tab" tabindex="0">
                        <div class="row row-gap-2 align-items-center mb-3">
                            <div class="col-sm-6">
                                <div class="title-line">
                                    Contact
                                </div>
                                <p class="container-page-subtitle mb-0">View & manage every Lead record you’re saved here.</p>
                                
                            </div>
                            <div class="col-sm-6 text-sm-end text-start">
                                <a href="<?php echo base_url('lead-finder'); ?>" class=" btn btn-primary">Find New Lead</a>
                            </div>
                        </div>
                        <div class="theme-card">
                            <div class="row align-items-end g-2">
                                <div class="col-sm-11">
                                    <div class="search-bar left-icon">
                                        <div class="search-icon">
                                            <span class="icon-search"></span>
                                        </div>
                                        <input type="text" class="search form-control form-control-style-2" placeholder="Search Lead Name or Address..."
                                            autocomplete="off" id="searchText">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <?php
                                        //if (!in_array('export_lead', $this->session->userdata('features'))) {
                                        
                                    ?>
                                    <!-- <a href="<?php echo base_url('subscription'); ?>">  <button class="btn btn-primary w-100" id=""><i class="fa-solid fa-arrow-down-to-line"></i>
                                        Export
                                    </button></a> -->
                                    <?php //} else { ?>
                                    <button class="btn btn-primary w-100" id="exportBtn"><i class="fa-solid fa-arrow-down-to-line"></i>
                                        Export
                                    </button>
                                    <?php //} ?>
                                    
                                </div>
                            </div>
                            <div class="theme-card theme-card-style-2 mt-3 mt-sm-4">
                                <!-- <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="title mb-0">Search Results</h6>
                                    <span id="resultCount" class="placeholder-badge">0 Results</span>
                                </div> -->
                                <div class="table-responsive theme-custom-table">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Lead Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Website</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultsBody">
                                            <?php if (!empty($business_list)) { ?>
                                                <?php foreach ($business_list as $business) { ?>
                                                    <tr>
                                                        <td><span class="overflow-content" style="width: 190px;"><?php echo $business['name']; ?></span></td>
                                                        <td>
                                                            <span 
                                                                class="overflow-content"
                                                                style="width: 190px;"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="<?php echo $business['address']; ?>"
                                                            >
                                                            <?php echo $business['address']; ?>
                                                        </span>
                                                        </td>
                                                        <td><span class="overflow-content" style="width: 190px;"><?= !empty($business['email']) ? $business['email'] : 'N/A'; ?></span></td>
                                                        <td><span style="white-space:nowrap;"><?php echo $business['phone']; ?></span></td>
                                                        <td><span style="white-space:nowrap;"><?= !empty($business['website']) ? $business['website'] : "N/A"; ?></span>
                                                        </td>
                                                        <td><button onclick="deleteConfirmation(<?php echo $business['id']; ?>)"
                                                                class="btn btn-sm btn-primary">Delete</button></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <td colspan="6" style="padding: 20px 0 0 0;">
                                                    <div class="table-no-record"style="display: flex; flex-direction: column; align-items: center; background: var(--theme-br); padding: 20px;">
                                                        <img src="<?= $this->config->item('assetsPath') ?>images/no-record.png" alt="image">
                                                        <p class="mb-0 title">No results found</p>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-channel-finder" role="tabpanel" aria-labelledby="pills-channel-finder-tab" tabindex="0">
                        <div class="row row-gap-2 align-items-center mb-3">
                            <div class="col-sm-6">
                                <div class="title-line">
                                    Channel list
                                </div>
                                <p class="container-page-subtitle mb-0">View and manage your discovered YouTube channel list here.</p>
                                
                            </div>
                            <div class="col-sm-6 text-sm-end text-start">
                                <a href="<?php echo base_url('lead-finder'); ?>" class=" btn btn-primary">Find New Channel</a>
                            </div>
                        </div>
                        <div class="row row-gap-2 gx-3">
                            <div class="col-12">
                                <div class="theme-card mb-3">
                                    <div class="row gx-3 align-items-end">
                                        <div class="col-12 col-sm-6 col-lg-8 col-xl-12">
                                            <div class="search-bar left-icon">
                                                <div class="search-icon">
                                                    <span class="icon-search"></span>
                                                </div>
                                                <input type="text" value="" ng-model="searchChannel" class="search form-control form-control-style-2" placeholder="Search Channel name">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="theme-card">
                                    <div class="table-responsive p-0">
                                        <table class="custom-table custom-table-style-1">
                                            <thead>
                                                <tr>
                                                    <th>Channel Name</th>
                                                    <th>Subscriber</th>
                                                    <th>Videos</th>
                                                    <th>Views</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Visit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <tr ng-repeat="channel in channelData | filter:searchChannel"">
                                                    <td>
                                                        <div class="yt-user-wrap">
                                                            <div class="yt-user-thumb">
                                                                <img ng-src="{{channel.thumbnail}}" alt="Avatar" loading="lazy">
                                                            </div>
                                                            <div class="yt-user-info" style="max-width: 200px;min-width: 200px;">
                                                                <div class="user-name">{{channel.name}}<i class="fa-solid fa-circle-check"></i></div>
                                                                <div class="user-channel-name"><i class="fa-brands fa-youtube"></i> /{{channel.customurl}}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6 class="title-color mb-0">{{channel.subscriber}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6 class="title-color mb-0">{{channel.videos}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6 class="title-color mb-0">{{channel.views}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6 class="title-color mb-0" style="max-width: 200px;min-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{channel.email}}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6 class="title-color mb-0">{{channel.phone}}</h6>
                                                    </td>
                                                     <td class="text-center">
                                                        <a href="https://www.youtube.com/{{channel.customurl}}" target="_blank" class="visit-link"> Visit channel </a>
                                                    </td>
                                                    <td>
                                                       
                                                       <button    ng-click ="deletechanneldata(channel.id)" class="btn btn-primary w-100">
                                                        <i class="fa-regular fa-trash"></i> Delete </button> 
                                                    </td>
                                                </tr>

                                                <tr ng-hide="channelData.length > 0">
                                                    <td colspan="8" style="padding: 20px 0 0 0;">
                                                        <div class="table-no-record"style="display: flex; flex-direction: column; align-items: center; background: var(--theme-br); padding: 20px;">
                                                            <img src="<?= $this->config->item('assetsPath') ?>images/no-record.png" alt="image">
                                                            <p class="mb-0 title">No results found</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this business? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteToList()"
                        id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div> -->


    <!-- Delete Modal Popup -->
    <div class="modal fade pop" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modelw-450">
            <div class="modal-content delete-model">
                <div class="modal-body text-center">
                    <div class="model-icon">
                        <i class="icon-list-delete"></i>
                    </div>
                    <h4 class="modal-title mt20" id="deleteConfirmationModalLabel">Confirm Deletion</h4>
                    <div class="mt10 description">
                        Are you sure you want to delete this business? This action cannot be undone.
                    </div>
                    <div class="mt30">
                        <button type="button" class="base-btn secondary-btn1 mr10" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="base-btn red-btn" onclick="deleteToList()" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal Popup End -->


    <script>
        // ========== ANGULAR APP ==========
        var app = angular.module('MyApp', []);

        app.controller('leadCntrl', function ($scope, $http, $timeout, $sce) {


            $scope.getChannel = function () {
                jsLoader(true);
                var queryStr = "<?php echo base_url('get-channel-data')?>";
                $http({
                    method: 'POST',
                    url: queryStr,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                    .then(function (response) {
                        jsLoader(false);
                        if (response.data.success) {
                            $scope.channelData = response.data.channel_data;
                            // toastr.success(response.data.msg);
                        } else {
                            console.log('Something went wrong!');
                        }
                    })
                    .catch(function (err) {
                        jsLoader(false);
                        console.error(err);
                    });
            };

            $scope.getChannel();



         $scope.deletechanneldata = function(id) {
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
                         $scope.softDelete(id);
                     }
                 });
             };

             $scope.softDelete = function(id) {
                 var id = id;
                 var fd = new FormData();
                 fd.append('id', id);
                 $http({
                     method: 'POST',
                     url: siteUrl + 'delete-channel-data',
                     aync: false,
                     data: fd,
                     dataType: "json",
                     transformRequest: angular.identity,
                     headers: {
                         'Content-Type': undefined
                     }
                 }).then(function(response) {
                     if (response.data.status == true) {
                         toastr.success(response.data.msg);
                            $scope.getChannel();
                     } else if (response.data.error) {
                         toastr.error(response.data.error.msg);
                     } else {
                         toastr.error('Something went wrong');
                     }
                 });
             }


            $scope.activetab = function(tab){

                localStorage.setItem('activeFinderTab', tab);

            }

        });


    </script>

    <script>

            document.addEventListener("DOMContentLoaded", function () {

                let activeTab = localStorage.getItem('activeFinderTab');

                if(activeTab == 'channel'){

                    let triggerEl = document.querySelector('#pills-channel-finder-tab');

                    if(triggerEl){

                        let tab = new bootstrap.Tab(triggerEl);

                        tab.show();
                    }

                }
                else{

                    let triggerEl = document.querySelector('#pills-lead-finder-tab');

                    if(triggerEl){

                        let tab = new bootstrap.Tab(triggerEl);

                        tab.show();
                    }
                }

            });

</script>

    <script>
        const resultsBody = document.getElementById('resultsBody');
        let deleteId = null;

        function deleteConfirmation(id) {
            deleteId = id;
            $('#deleteConfirmationModal').modal('show');
        }
        async function deleteToList() {

            const payload = {
                'id': decodeURIComponent(deleteId)
            };
            try {
                const res = await fetch("<?= base_url('delete-business') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.status) {
                    flashNow({
                        'success': {
                            'message': data.message
                        }
                    });
                    window.location.reload(true);
                   // renderTable(data.list)
                } else {
                    flashNow({
                        'error': {
                            'message': data.message
                        }
                    });
                }
            } catch (error) {
                console.error(error);
                flashNow({
                    'error': {
                        'message': "Error sending data to server."
                    }
                });
            }
            $('#deleteConfirmationModal').modal('hide');
        }

        function renderTable(results) {
            resultsBody.innerHTML = "";
            results.forEach(place => {
                const id = place.id || 'N/A';
                const name = place.name || 'N/A';
                const address = place.address || 'N/A';
                const phone = place.phone || 'N/A';
                const website = place.website ? place.website : 'N/A';
                const row = `<tr>
                                <td>${name}</td>
                                <td>${address}</td>
                                <td>${phone}</td>
                                <td>${website}</td>
                                <td><button onclick="deleteConfirmation(${id})" class="btn btn-sm btn-primary">Delete</button></td>
                            </tr>
                            `;
                resultsBody.innerHTML += row;
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <!-- <script>
document.getElementById("exportBtn").addEventListener("click", exportToExcel);

function exportToExcel() {
    const table = document.querySelector("table");

    const rows = [];
    table.querySelectorAll("tr").forEach(tr => {
        const row = [];
        const cells = tr.querySelectorAll("th, td");

        for (let i = 0; i < cells.length - 1; i++) {
            row.push(cells[i].innerText.trim());
        }

        rows.push(row);
    });

    const ws = XLSX.utils.aoa_to_sheet(rows);

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Business List");

    XLSX.writeFile(wb, "business_list.xlsx");
}
</script> -->
    <script>
        document.getElementById("searchText").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#resultsBody tr");

            rows.forEach(row => {
                let name = row.children[0]?.innerText.toLowerCase() || "";
                let address = row.children[1]?.innerText.toLowerCase() || "";
                let phone = row.children[2]?.innerText.toLowerCase() || "";
                let website = row.children[3]?.innerText.toLowerCase() || "";

                if (
                    name.includes(filter) ||
                    address.includes(filter) ||
                    phone.includes(filter) ||
                    website.includes(filter)
                ) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>

    <script>
        document.getElementById("exportBtn").addEventListener("click", exportToExcel);

        function exportToExcel() {
            const rows = [];

            const headerCells = document.querySelectorAll("thead th");
            const headerRow = [];
            for (let i = 0; i < headerCells.length - 1; i++) {
                headerRow.push(headerCells[i].innerText.trim());
            }
            rows.push(headerRow);

            const bodyRows = document.querySelectorAll("#resultsBody tr");

            bodyRows.forEach(tr => {
                if (tr.style.display === "none") return;

                const cells = tr.querySelectorAll("td");
                const row = [];

                row.push(cells[0].innerText.trim());

                row.push(cells[1].innerText.trim());

                row.push(cells[2].innerText.trim());
                row.push(cells[3].innerText.trim());
                  let websiteCell = cells[4];
                    let websiteText = websiteCell.innerText.trim();
                    let websiteLink = websiteCell.querySelector("a")?.href || "";

                row.push({
                    v: websiteText,
                    l: { Target: websiteLink }
                });

                rows.push(row);
            });

            const ws = XLSX.utils.aoa_to_sheet(rows);

            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Filtered");

            XLSX.writeFile(wb, "business_list_filtered.xlsx");
        }
    </script>