<title>Bizora AI | Business Finder</title>

<div class="container-wrapper container-open">
    <div class="container-fluid container-padding">
        <div class="row row-gap-2">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center avatar-main-tabs mb-3">
                    <ul class="nav nav-pills nav-pills-style-1 mb-0 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link active" id="pills-lead-finder-tab" data-bs-toggle="pill" data-bs-target="#pills-lead-finder" type="button" role="tab" aria-controls="pills-lead-finder" aria-selected="true">
                                <i class="fa-regular fa-user"></i>
                                Lead Finder
                            </button>
                        </li>
                        <li class="nav-item pointer" role="presentation">
                            <button class="nav-link" id="pills-channel-finder-tab" data-bs-toggle="pill" data-bs-target="#pills-channel-finder" type="button" role="tab" aria-controls="pills-channel-finder" aria-selected="false">
                                <i class="fa-light fa-square-rss"></i>
                                Channel Finder
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-lead-finder" role="tabpanel" aria-labelledby="pills-lead-finder-tab" tabindex="0">
                        <div class="row row-gap-2 align-items-center mb-3">  
                            <div class="col-sm-6">
                                <div class="title-line">
                                    Business Finder
                                </div>
                                <p class="container-page-subtitle mt-1 mb-0">A simple and smart way to find local and online businesses.</p>
                            </div>
                            <div class="col-sm-6 text-sm-end text-start">
                                <a href="<?php echo base_url('business-list'); ?>" class=" btn btn-primary">Go To Contact</a>
                            </div>
                        </div>
                        <div class="theme-card">
                            <div class="row align-items-end g-2">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Business Type
                                            <i 
                                                class="fa-solid fa-circle-info info-tooltip title ms-1"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-html="true"
                                                data-bs-title="Search businesses by category."
                                            >
                                            </i>
                                        </label>
                                        <input id="businessType" type="text" class="form-control form-control-style-2" placeholder="Enter business type (e.g.., ‘restaurant’)">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Location
                                            <i 
                                                class="fa-solid fa-circle-info info-tooltip title ms-1"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-html="true"
                                                data-bs-title="Search businesses by location."
                                            >
                                            </i>
                                        </label>
                                        <input id="location" type="text" class="form-control form-control-style-2" placeholder="Enter location (e.g., ‘Los Angeles’ )">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button id="searchBtn" class="btn btn-primary w-100"><i
                                            class="fa-solid fa-magnifying-glass"></i> Search</button>
                                            <input type="hidden" id="resultCount">
                                </div>
                            </div>
                            <div class="theme-card theme-card-style-2 mt-3 mt-sm-4">
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
                                            <tr>
                                                <td colspan="6" style="padding: 20px 0 0 0;">
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
                    <div class="tab-pane fade" id="pills-channel-finder" role="tabpanel" aria-labelledby="pills-channel-finder-tab" tabindex="0">
                        <div class="row row-gap-2 align-items-center mb-3">  
                            <div class="col-sm-6">
                                <div class="title-line">
                                    Channel Finder
                                </div>
                                <p class="container-page-subtitle mt-1 mb-0">A simple and smart way to find local and online businesses.</p>
                            </div>
                            <div class="col-sm-6 text-sm-end text-start">
                                <a href="<?php echo base_url('business-list'); ?>" class=" btn btn-primary">Go To Contact</a>
                            </div>
                        </div>
                        <div class="theme-card">
                            <div class="row align-items-end g-2">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Enter Keyword
                                            <i 
                                                class="fa-solid fa-circle-info info-tooltip title ms-1"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-html="true"
                                                data-bs-title="Search Lead by category."
                                            >
                                            </i>
                                        </label>
                                        <input id="businessType" type="text" class="form-control form-control-style-2" placeholder="Enter business type (e.g.., ‘restaurant’)">
                                    </div>
                                </div>
                                <div class="col-md-5 d-none">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Location
                                            <i 
                                                class="fa-solid fa-circle-info info-tooltip title ms-1"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-html="true"
                                                data-bs-title="Search businesses by location."
                                            >
                                            </i>
                                        </label>
                                        <input id="location" type="text" class="form-control form-control-style-2" placeholder="Enter location (e.g., ‘Los Angeles’ )">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button id="searchBtn" class="btn btn-primary w-100"><i
                                            class="fa-solid fa-magnifying-glass"></i> Search</button>
                                            <input type="hidden" id="resultCount">
                                </div>
                            </div>
                            <div class="theme-card theme-card-style-2 mt-3 mt-sm-4">
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
                                            <tr>
                                                <td colspan="6" style="padding: 20px 0 0 0;">
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


    <script>
        const searchBtn = document.getElementById('searchBtn');
        const resultsBody = document.getElementById('resultsBody');
        const resultCount = document.getElementById('resultCount');
        const loadingText = document.createElement('p');

        // loadingText.className = "text-center text-primary mb-2";
        // loadingText.innerText = "Please wait... fetching results...";
        // loadingText.style.display = "none";
        // document.querySelector(".theme-card").prepend(loadingText);


        async function getLatLon(place) {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(place)}`;
            const response = await fetch(url, { headers: { "User-Agent": "MyApp" } });
            const data = await response.json();
            if (data.length > 0) {
                return { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };

                // console.log("Latitude:", data[0].lat);
                // console.log("Longitude:", data[0].lon);

            } else {
                console.log("Location not found");
            }
        }





        // function getUserLocation() {
        //     return new Promise((resolve, reject) => {
        //         if (!navigator.geolocation) {
        //             reject("Geolocation not supported by this browser.");
        //         } else {
        //             navigator.geolocation.getCurrentPosition(
        //                 (pos) => resolve({
        //                     lat: pos.coords.latitude,
        //                     lng: pos.coords.longitude
        //                 }),
        //                 (err) => reject("Location access denied or failed.")
        //             );
        //         }
        //     });
        // }

        searchBtn.addEventListener('click', async function () {


         
            const businessType = document.getElementById('businessType').value.trim();
            const location = document.getElementById('location').value.trim();

            if (!businessType) {
                flashNow({
                    'error': {
                        'message': "Please enter business type (e.g., restaurant, gym)."
                    }
                });
                return;
            }
            if (!location) {
                flashNow({
                    'error': {
                        'message': "Enter location (e.g.,  )"
                    }
                });
                return;
            }
   jsLoader(true);
            resultsBody.innerHTML = `<tr><td colspan="6" class="text-center">Getting location...</td></tr>`;
            resultCount.innerText = "0 Results";
            loadingText.style.display = 'block';

            try {
                // const position = await getUserLocation();
                // const lat = ;
                // const lng =;
                const lat_lang = await getLatLon(location);
                if (!lat_lang) {
                     jsLoader(false);
                    flashNow({
                        'error': {
                            'message': "Invalid location."
                        }
                    });

                    resultsBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Invalid location.</td></tr>`;
                    loadingText.style.display = 'none';
                    return;
                }

                const { lat, lng } = lat_lang;

                const response = await fetch("<?= base_url('search-place-keyword') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        lat: lat,
                        lng: lng,
                        keyword: businessType
                    })
                });

                const data = await response.json();
                loadingText.style.display = 'none';

                if (data.results && data.results.length > 0) {
                    renderTable(data.results);
                    resultCount.innerText = `${data.results.length} Results`;
                    jsLoader(false);
                } else if (data.data && data.data.length > 0) {
                    renderTable(data.data);
                    resultCount.innerText = `${data.data.length} Results`;
                    jsLoader(false);
                } else {
                    resultsBody.innerHTML = `<tr><td colspan="6" class="text-center">No results found.</td></tr>`;
                    resultCount.innerText = "0 Results";
                    jsLoader(false);
                }
            } catch (error) {
                loadingText.style.display = 'none';
                console.error(error);
                resultsBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">${error}</td></tr>`;
                jsLoader(false);
            }
        });

        function renderTable(results) {
            resultsBody.innerHTML = "";
            results.forEach(place => {
                const name = place.name || 'N/A';
                const address = place.vicinity || 'N/A';
                const email = place.email || 'N/A';
                const phone = place.international_phone_number || place.formatted_phone_number || 'N/A';
                const website = place.website ? `<a href="${place.website}" target="_blank" class="visit-link">Visit Website</a>` : 'N/A';
                const row = `
      <tr>
        <td><span class="overflow-content" style="width: 190px;">${name}</span></td>
        <td><span class="overflow-content" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="${address}" style="width: 190px;">${address}</span></td>
        <td><span class="overflow-content" style="width: 190px;" title="${email}">${email}</span></td>
        <td><span style="white-space:nowrap;">${phone}</span></td>
        <td><span style="white-space:nowrap;">${website}</span></td>
        <td><a href="#" style="white-space:nowrap;" 
        onclick="addToList('${encodeURIComponent(name)}', '${encodeURIComponent(address)}', '${encodeURIComponent(phone)}', '${encodeURIComponent(website)}','${encodeURIComponent(email)}')"    
           class="action-button">Add to List</a></td>
      </tr>
    `;
                resultsBody.innerHTML += row;
            });
        }
    </script>

    <script>

        async function addToList(name, address, phone, website, email) {
            const payload = {
                name: decodeURIComponent(name),
                address: decodeURIComponent(address),
                phone: decodeURIComponent(phone),
                website: decodeURIComponent(website),
                email: decodeURIComponent(email)
            };
            try {
                const res = await fetch("<?= base_url('save-search-business') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();
                if (data.status) {
                    flashNow({
                        'success': {
                            'message': data.message
                        }
                    });

                } else {
                    flashNow({
                        'error': {
                            'message': data.message
                        }
                    });
                }
            } catch (error) {
                console.error(error);
                // alert('Error sending data to server.');
                flashNow({
                    'error': {
                        'message': "Error sending data to server."
                    }
                });
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>