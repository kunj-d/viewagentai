<style>
    .dropdown-item.active,
    .dropdown-item:active {

        color: #fff;

        text-decoration: none;

        background-color: #5340d7;
    }
</style>

<!-- Container Start -->

<div class="container-wrapper container-open">

    <title><?php echo $this->config->item('productName') ?> | Client</title>

    <!-- Main Container Start -->

    <div class="container-fluid container-padding" style="min-height: calc(93.5vh); ">

        <div class="row d-flex align-items-center">

            <div class="col-12">

                <div class="page-content ng-scope" ng-app="myApp" ng-controller="customersCtrl" id="customersCtrl">

                    <div class="row">

                        <!-- Header title Start -->

                        <div class="col-xs-12 mb20">

                            <div class="row">

                                <div class="col-md-8 col-sm-7 col-xs-12">

                                    <h1 class="md20 title-line text-dark lh110">Add a New Client</h1>

                                    <!-- <p class="container-page-subtitle">Add your Clients Here</p> -->

                                    <!-- <ul class="md14 f-14 f-md-14 text-dark">

                                            <li>All fields are mandatory</li>

                                            <li class="mt-1">Once you hit Add Client, System generated login details will be delivered to provided email address.</li>

                                        </ul> -->

                                    <!--<p class="md14 f-14 f-md-14 text-dark"><span class="required mt5">*</span>All fields are mandaory</p>-->

                                </div>

                                <!--<div class="col-md-4 col-sm-5 col-xs-12 mainright">

                                        <div class="create-btn d-flex justify-content-sm-end justify-content-start">

                                            <a href="#" class="appoint-link">Add New Member</a>

                                        </div>

                                    </div>->

                                </div>

                            </div>

                            Header title end -->

                                <div class="col-xs-12">

                                    <div class="whitesection add-member">

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Client Name </label>

                                            </div>

                                            <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 mb20">

                                                <input type="text" placeholder="Enter Your Client Name"
                                                    class="form-control search1" name="name" id="name">

                                                <span
                                                    class="error required mt5"><?php echo form_error('name'); ?></span>

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Client Email </label>

                                            </div>

                                            <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 mb20">

                                                <input type="text" placeholder="Enter Your Client Email"
                                                    class="form-control search1" name="email" id="email">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Issue AI Credits to your client </label>

                                            </div>

                                            <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 mb20">
                                                <input type="number" placeholder="Ex. 1000,2000 or 5000"
                                                    class="form-control search1" name="image_balance" id="image_balance"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>


                                        </div>

                                        <!-- <div class="row mb20 align-items-center">

                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                            <label class="text-dark">Copilot Training Data Size (in Kb) </label> 

                                        </div>

                                        <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 mb20">
                                            <input type="number" placeholder="Ex. 1000,2000 or 5000" class="form-control search1" name="training_balance" id="training_balance" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                        
                                         <ul class="md14 f-14 f-md-14 text-dark">
                                            <li>All fields are required. Once you click 'Add Client,' the system will automatically send login details to the specified email address.</li>
                                        </ul>
                                    </div> -->




                                        <div class="row mb20 align-items-center">

                                            <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                            <label class="text-dark">Assign Workspace</label>

                                        </div>

                                          

                                        <div class="col-lg-4 col-md-5 col-sm-8 col-xs-12 mb20">

                                              <select class="selectpicker form-control search1" name="business" id="business">  

                                                <option value=''>Select Workspace</option>

                                              <?php foreach ($business as $key => $value) { ?>

                                                    <option value='<?php echo $value->id ?>'><?php echo $value->title; ?></option>

                                                <?php } ?>

                                          

                                            </select>

                                        </div>--->

                                            <!--<div class="col-lg-1 col-md-3 col-sm-4 col-xs-12 mb20">

                                            <label class="text-dark">User Level<span class="red">*</span></label>

                                        </div>

                                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-12 mb20">

                                            <select class="selectpicker form-control">  

                                                <option value='Select Business'>Select Business</option>

                                                <option value='option1'>option1</option>

                                                <option value='option2'>option2</option>

                                                <option value='option3'>option3</option>

                                                <option value='option4'>option4</option>

                                            </select>

                                        </div>

                                        <div class="create-btn col-lg-3 col-lg-offset-0 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">

                                            <a href="javascript:" class="appoint-link"> Grant More Permissions</a>

                                        </div>--->

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-8 col-md-8 d-flex justify-content-start">

                                                <a href="<?= base_url('client-management') ?>"
                                                    class="btn btn-outline mr10">Cancel</a>

                                                <input type="submit" class="btn btn-primary save-data"
                                                    value="Add client">

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>









    <!-- Script to Hide/Show Category section -->

    <script type="text/javascript">

        $(document).on('click', ".save-data", function () {

            var user_name = $('#name').val();

            var user_email = $('#email').val();

            var business = $('select#business option:selected').val();

            var imageBalance = $("#image_balance").val();

            var training_balance = $("#training_balance").val();



            // jsLoader(true);

            $.ajax({

                dataType: 'json',

                type: "POST",

                url: "<?php echo base_url('add-client-member-json'); ?>",

                data: { user_name: user_name, user_email: user_email, business: business, imageBalance: imageBalance },

                beforeSend: function () {

                    $(".form_error").html("");

                },

                success: function (response) {

                    console.log(response);

                    // jsLoader(false);

                    if (response.error != undefined) {

                        if ((response.error.type == "inline")) {

                            $.each(response.error["error_data"], function (index, value) {

                                $("." + index).html(value.replace("{field}", index));

                            });

                        }

                        if (response.error) {

                            toastr.error(response.error.message);

                        }

                    }

                    if (response.success) {

                        document.location = response.redirect;

                    }

                }

            });

        });





    </script>