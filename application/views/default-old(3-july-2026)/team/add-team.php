

<title><?php echo $this->config->item('productName') ?> | Add a New Member</title>

<!-- Page Content Start -->
<div class="container-wrapper container-open">
    <div class="container-fluid container-padding">

        <div class="row">
            <!-- Header title Start -->
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Add a New Member</h5>
                            <p class="feature-subtitle mb-0">
                                Add your team here
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header title end -->

            <!-- Main Section Starts-->
            <div class="col-sm-8">
                <div class="whitesection">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">Name <span class="red">*</span></label>
                            <input type="text" placeholder="Name" class="form-control" name="name" id='name'>
                            <span class="form_error form_error_name"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Email <span class="red">*</span></label>
                            <input type="text" placeholder="Email" class="form-control" name="email" id='email'>
                            <span class="form_error form_error_email"></span>
                        </div>
                        <div class="col-12">
                            <div class="usersection">
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">User Level <span class="red">*</span></label>
                                            <select class="selectpicker rolechooser role" name="user_role[]" title="Select User Level" data-dropup-auto="false" data-size="5">
                                                <option value=""> Select User</option>
                                                <?php foreach ($role_types as $key => $user_role) { ?>
                                                    <option value="<?php echo $user_role->id; ?>"><?php echo $user_role->title; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="form_error form_error_role"></span>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Access To <span class="red">*</span></label>
                                            <select class="selectpicker user_business website" title="Select Workspace" data-dropup-auto="false" data-size="5" name="user_business[]">
                                                <option value="">Select Workspace</option>
                                                <?php foreach ($business_list as $key => $user_business) { ?>
                                                    <option value="<?php echo $user_business->id; ?>"><?php echo $user_business->domain; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="form_error form_error_business"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12  privileges manager mb-3" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 ">
                                            Privileges:</div>
                                        <div class="col-lg-10 col-md-8 col-sm-8 col-12  mt0 xsmt10px">
                                            Will have Full Access but Cannot create a new user and new Workspace
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12  privileges editor mb-3" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 ">
                                            Privileges:</div>
                                        <div class="col-lg-10 col-md-8 col-sm-8 col-12  mt0 xsmt10px">
                                            Complete Video Editor , Templates
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12  privileges marketer mb-3" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 ">
                                            Privileges:</div>
                                        <div class="col-lg-10 col-md-8 col-sm-8 col-12  mt0 xsmt10px">
                                            Avatar, Video, Templates, Automation, Ai Agent.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12  privileges custom mb-3 customrole" style="display: none;">

                                    <div class="row mb-3 xsmb15px">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 md16 sm15 xs15 mt7px xsmt0px">
                                            Assign User Role<span class="red">*</span></div>
                                        <div class="col-lg-7 col-md-8 col-sm-8 col-12 md16 sm15 xs15 mt0 xsmt10px">
                                            <input type="text" class="form-control assign_name" placeholder="Assign User Role" name="assign_name[]">
                                            <span class="form_error form_error_assign_name"></span>
                                        </div>
                                    </div>
                                    <div class="row mt10px xsmt15px">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12 ">
                                            Privileges:</div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-12  mt0 xsmt10px privilege_input1">
                                            <span class="form_error form_error_privilege"></span>
                                            <div class="row mb-3 xsmb0px">
                                                <?php
                                                $counter = 0;
                                                foreach ($all_privilege as $key => $privilege) {
                                                    $counter++;
                                                    if ($counter == 3) {
                                                        $counter = 0;
                                                    }
                                                    ?>
                                                    <div class="col-md-4 col-sm-6 col-12 mt0 xsmt10px custom_privilege">
                                                        <input class="showoption checkbox-custom" type="checkbox" value="<?php echo $privilege->id; ?>" name="role_privilege[]" id="<?php echo $privilege->slug.$key; ?>">
                                                        <label for="<?php echo $privilege->slug.$key; ?>" class="checkbox-custom-label w400">
                                                            &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $privilege->title; ?></label>
                                                    </div>

                                                    <?php
                                                    if ($counter == 0) {
                                                        echo '</div><div class="row mb-3 xsmb0px">';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-12 privileges manager mb-3" style="display: none;">-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-lg-2 col-md-3 col-sm-4 col-12">-->
                                <!--            Privileges:</div>-->
                                <!--        <div class="col-lg-10 col-md-8 col-sm-8 col-12">-->
                                <!--            Create Avatar,Delete Avatar,Create Video,Edit Video,Delete Video,Templates,Auto Reply,Auto Comment,Ai Agent,Whitelabel,My Profile,Automation                                            -->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            <div class="col-12 padding0 mainsection"></div>
                            <div class="text-end">
                                <a href="<?= site_url('team-management') ?>" class="btn btn-danger buttongap">Cancel</a>
                                <input type="submit" class="btn btn-primary autobtn save-data ms-2" value="Add">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Section Ends-->

        </div>
    </div>

<!-- Page Content End -->


<script type="text/javascript">
    $(document).ready(function () {
        // $(".rolechooser").change(function(){
        //     $(this).find("option:selected").each(function(){
        //         var optionValue = $(this).attr("value");
        //         if(optionValue){
        //             $(".privileges").not("." + optionValue).hide();
        //             $("." + optionValue).show();
        //         } else{
        //             $(".privileges").hide();
        //         }
        //     });
        // }).change();
    });
</script>

<!-- Script to Hide/Show Category section -->
<script type="text/javascript">
    $(document).on('click', '.removerole', function (e) {
//$(this).closest(".repeatedsection").remove();
    });


    $('.addmoreroles').on('click', function () {
//$(".repeatedsection:first").clone().appendTo(".mainsection");
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".usersection:first").find(".custom").hide();
        $(document).on('change', "select.rolechooser", function () {
            $(this).parents(".usersection").find(".customrole").hide();
            $(this).parents(".usersection").find(".manager").hide();
            $(this).parents(".usersection").find(".editor").hide();
            $(this).parents(".usersection").find(".marketer").hide();

            if ($(this).val() == 4) {
                $(this).parents(".usersection").find(".customrole").show();
            } else {
                if ($(this).val() == 1) {
                    $(this).parents(".usersection").find(".manager").show();
                } else if ($(this).val() == 2) {
                    $(this).parents(".usersection").find(".editor").show();
                } else if ($(this).val() == 3) {
                    $(this).parents(".usersection").find(".marketer").show();
                }
            }
            return;
        });
    });
</script>

<!-- Script to Hide/Show Category section -->
<script type="text/javascript">
    $(document).on('click', '.removerole', function (e) {
        $(this).parents(".usersection").remove();
        updateCheckInput();
        errorSpan();
    });

    function genrate_string() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }

    $('.addmoreroles').on('click', function () {
        var $clone = $(".usersection:first").clone();
        var rand_str = genrate_string();
        var new_id = '';
        $clone.find(".bootstrap-select").each(function () {
            $(this).replaceWith($(this).find("select.selectpicker"));
        });
        $clone.find(".checkbox-custom").each(function () {
            $(this).prop('checked', false);
        });
        $clone.find(".custom_privilege input").each(function () {
            new_id = $(this).prop('id') + rand_str;
            $(this).prop('id', new_id);
        });
        $clone.find(".custom_privilege label").each(function () {
            new_id = $(this).prop('for') + rand_str;
            $(this).prop('for', new_id);
        });

        // $clone.find(".choose_from_parent input").each(function(){
        // 	var my_id = $(this).prop('id');
        // 	var my_id1 = my_id.substr(0,13);
        // 	new_id =my_id1 +"_"+ rand_str;
        // 	$(this).prop('id',new_id);
        // 	$(this).attr('data-index',rand_str);
        // });
        // $clone.find(".choose_from_parent label").each(function(){
        // 	var my_id = $(this).prop('for');
        // 	var my_id1 = my_id.substr(0,13);
        // 	new_id =my_id1 +"_"+ rand_str;
        // 	$(this).prop('for',new_id);
        // });



        $clone.find(".manager").hide();
        $clone.find(".marketer").hide();
        $clone.find(".editor").hide();
        $clone.find(".custom").hide();

        $clone.find("select.role").val("");
        $clone.find("select.website").val("");
        $clone.find("input.assign-name").val("");
        $clone.find(".form_error").html("");
        $clone.find(".addmorebtn").html('<a title="Report" class="cancelbtn removerole">Remove</a>');
        $clone.insertAfter(".usersection:last");
        //$clone.appendTo(".mainsection");
        $('.selectpicker').selectpicker('refresh');
        updateCheckInput();
        errorSpan();

    });
    function updateCheckInput() {
        $(".check-privilege-input").each(function (index) {
            $(this).find("input").attr("id", 'check-privilege-input' + index);
            $(this).find("label").attr("for", 'check-privilege-input' + index);
        });

        $(".check-role-input").each(function (index) {
            $(this).find("input").attr("id", 'check-role-input' + index);
            $(this).find("label").attr("for", 'check-role-input' + index);
        });
    }

    errorSpan();
    function errorSpan() {
        $(".form_error_role").each(function (index) {
            $(this).removeClass("form_error_role0");
            $(this).addClass("form_error_role" + index);
        });
        $(".form_error_business").each(function (index) {
            $(this).removeClass("form_error_business0");
            $(this).addClass("form_error_business" + index);
        });

        $(".form_error_assign_name").each(function (index) {
            $(this).removeClass("form_error_assign_name0");
            $(this).addClass("form_error_assign_name" + index);
        });

        $(".form_error_privilege").each(function (index) {
            $(this).removeClass("form_error_privilege0");
            $(this).addClass("form_error_privilege" + index);
        });
    }

    $(document).on('click', ".save-data", function () {
        $('.form_error').html('');
        var teamData = [];
        $(".usersection").each(function (index) {
            var userData = [];
            var role_type = $(this).find("select.rolechooser").val()
            var business = $(this).find("select.user_business").val();
            var assign_name = $(this).find("input.assign_name").val();
            var name = $('#name').val();
            var email = $('#email').val();
            var privilege = [];
            var custom_role = [];
            $(this).find(".choose_role").find("input:checkbox").each(function (index) {
                if ($(this).is(':checked')) {
                    custom_role.push($(this).val());
                }

            });

            $(this).find(".privilege_input1").find("input:checkbox").each(function (index) {
                if ($(this).is(':checked')) {
                    privilege.push($(this).val());
                }
            });

            userData = {role_type: role_type, business: business, assign_name: assign_name, custom_role: custom_role, privilege: privilege};
            teamData.push(userData);
        });
        //console.log(teamData);return;
        var user_name = $('#name').val();
        var user_email = $('#email').val();
        jsLoader(true);
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: "<?php echo base_url('add-team-member-json'); ?>",
            data: {user_name: user_name, user_email: user_email, team_data: teamData},
            beforeSend: function () {
                $(".form_error").html("");
            },
            success: function (response) {
                jsLoader(false);
                if (response.error != undefined) {
                    if ((response.error.type == "inline")) {
                        $.each(response.error["error_data"], function (index, value) {
                            $("." + index).html(value.replace("{field}", index));
                        });
                    } else if (response.error.type == "flash") {
                        flashNow(response);
                    }
                }
                if (response.success) {
                    document.location = response.redirect;
                }
            }
        });
    });




    $(document).on('change', ".choose_from", function () {
        var index = $(this).attr('data-index');
        var choose_from_arr = [];
<?php
foreach ($role_types as $key => $value) {
    if ($value->id != 4) {
        ?>
                if ($('#choose_from_<?php echo $value->id; ?>_' + index).is(':checked')) {
                    choose_from_arr.push(<?php echo $value->id; ?>);
                }
        <?php
    }
}
?>

        if (choose_from_arr.length > 0) {
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: "<?php echo base_url('get-team-choose-from'); ?>",
                data: {ids: choose_from_arr},
                beforeSend: function () {
                    $(".form_error").html("");
                },
                success: function (response) {
                    $(this).find(".privilege_input1").find("input:checkbox").each(function (index) {
                        if ($(this).is(':checked')) {
                            privilege.push($(this).val());
                        }
                    });
                }
            });
        }
    });
</script>