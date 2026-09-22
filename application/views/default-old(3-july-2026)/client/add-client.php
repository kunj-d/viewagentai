

<title><?php echo $this->config->item('productName') ?> | Add a New Client </title>

<!-- Page Content Start -->
<div class="container-wrapper container-open">
    <div class="container-fluid container-padding">
        <div class="row">
            <!-- Header title Start -->
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Add a New Client</h5>
                            <p class="feature-subtitle mb-0">
                                Add your clients here
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
                                

                                <div class="col-12 privileges manager mb-3" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                                            Privileges:</div>
                                        <div class="col-lg-10 col-md-8 col-sm-8 col-12">
                                            View Basic, Manage Playlist, Create Playlist, Delete Playlist, Manage Campaign, Create Campaign, Delete Campaign, Manage Session, Analytics, Manage Social Campaign, Create Social Campaign, Delete Social Campaign (Dummy Content)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 padding0 mainsection"></div>
                            <div class="text-end">
                                <a href="<?= site_url('client-management') ?>" class="btn btn-danger buttongap">Cancel</a>
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
        $(".usersection:first").find(".custom").hide();
        $(document).on('change', "select.rolechooser", function () {
            $(this).parents(".usersection").find(".customrole").hide();
            $(this).parents(".usersection").find(".manager").hide();
            $(this).parents(".usersection").find(".analyst").hide();
            $(this).parents(".usersection").find(".marketer").hide();

            if ($(this).val() == 4) {
                $(this).parents(".usersection").find(".customrole").show();
            } else {
                if ($(this).val() == 1) {
                    $(this).parents(".usersection").find(".manager").show();
                } else if ($(this).val() == 2) {
                    $(this).parents(".usersection").find(".analyst").show();
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

        



        $clone.find(".manager").hide();
        $clone.find(".marketer").hide();
        $clone.find(".analyst").hide();
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
            url: "<?php echo base_url('add-client-json'); ?>",
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