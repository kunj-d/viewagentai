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

    <title><?php echo $this->config->item('productName') ?> | Manage Client</title>

    <!-- Main Container Start -->

    <div class="container-fluid container-padding" style="min-height:unset!important;">

        <div class="row d-flex align-items-center">

            <div class="col-12">

                <div class="page-content ng-scope" ng-app="myApp" ng-controller="customersCtrl" id="customersCtrl">

                    <div class="row">

                        <!-- Header title Start -->

                        <div class="col-xs-12 mb20">

                            <div class="row">

                                <div class="col-md-8 col-sm-7 col-xs-12">

                                    <h1 class="md30 title-line text-dark lh110">Manage Client</h1>

                                    <p class="container-page-subtitle">Edit & Manage Client Details Here</p>

                                    <ul class="md14 f-14 f-md-14 text-dark p-0 m-0">

                                        <li>All fields are mandatory</li>

                                    </ul>

                                </div>



                                <!--<div class="col-md-4 col-sm-5 col-xs-12 mainright">

                                        <div class="create-btn d-flex justify-content-sm-end justify-content-start">

                                            <a href="#" class="appoint-link">Add New Member</a>

                                        </div>

                                    </div>->

                                </div>

                            </div> -->

                                <!-- Header title end  -->

                                <div class=" col-xs-12">

                                    <div class="whitesection add-member">

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Client Name </label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <input type="text" placeholder="Enter Your Client Name"
                                                    class="form-control search1" name="name" id="name"
                                                    value="<?php echo $team_data['name'] ?>">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Client Email </label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <input type="text" placeholder="Enter Your Client Email"
                                                    class="form-control search1" name="email" id="email"
                                                    value="<?php echo $team_data['email'] ?>" readonly
                                                    style="background:transparent;">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Change Password </label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <input type="password" placeholder="Enter New Password"
                                                    class="form-control search1" name="passwordpassword" id="password"
                                                    value="<?php echo $team_data['password'] ?>" readonly
                                                    style="background:transparent;">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Available AI Credits</label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <!--<input type="number" placeholder="Enter AI Image Credit To Be Issue" class="form-control search1" name="image_balance" id="image_balance">-->

                                                <?php echo $team_data[credit] ?>

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Add More Issue AI Credits to your
                                                    client</label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <input type="number" placeholder="Enter Issue AI Credits to your client"
                                                    class="form-control search1" name="image_balance_2"
                                                    id="image_balance_2">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Available Copilot Training Data Size (in
                                                    Kb)</label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <!--<input type="number" placeholder="Enter AI Image Credit To Be Issue" class="form-control search1" name="image_balance" id="image_balance">-->

                                                <?php echo $team_data[credit] ?>

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                                <label class="text-dark">Add More Copilot Training Data Size (in
                                                    Kb)</label>

                                            </div>

                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb20">

                                                <input type="number"
                                                    placeholder="Enter Copilot Training Data Size (in Kb)"
                                                    class="form-control search1" name="image_balance_3"
                                                    id="image_balance_3">

                                            </div>

                                        </div>

                                        <div class="row mb20 align-items-center">

                                            <!--<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 mb20">

                                            <label class="text-dark">Assign Workspace</label>

                                        </div>

                                          

                                        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-12 mb20">

                                              <select class="selectpicker form-control" name="business" id="business">  

                                                <option value=''>Select Workspace</option>

                                              <?php foreach ($business_list as $key => $value) { ?>

                                                    <option value='<?php echo $value->id ?>' <?php if ($value->id == $team_data['last_business_id']) {
                                                           echo 'selected';
                                                       } ?> ><?php echo $value->title; ?></option>

                                                <?php } ?>

                                          

                                            </select>

                                        </div>--->



                                        </div>

                                        <div class="row">

                                            <div class="col-lg-12 d-flex justify-content-center">

                                                <a href="<?= base_url('client-management') ?>"
                                                    class="btn btn-danger mr10">Cancel</a>

                                                <input type="submit" class="btn btn-primary save-data"
                                                    value="Save Changes">

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

            var imageBalance = parseInt($("#image_balance_2").val());

            var training_balance = parseInt($("#image_balance_3").val());

            var team_user_id = '<?php echo $team_data['id']; ?>'



            // jsLoader(true);

            $.ajax({

                dataType: 'json',

                type: "POST",

                url: "<?php echo base_url('edit-client-member-json'); ?>",

                data: { user_name: user_name, user_email: user_email, business: business, team_user_id: team_user_id, imageBalance: imageBalance },

                beforeSend: function () {

                    $(".form_error").html("");

                },

                success: function (response) {

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