<title><?php echo $this->config->item('productName') ?> | Edit Team Member</title>

<!-- Page Content Start -->
<div class="container-wrapper container-open">
	<div class="container-fluid container-padding">
		<div class="row">
			<!-- Header title Start -->
            <div class="col-12">
                <div class="feature-banner">
                    <div class="row align-items-center justify-content-between g-0">
                        <div class="col-auto feature-wrap">
                            <h5 class="feature-title">Manage Team</h5>
                            <p class="feature-subtitle mb-0">
                                Edit & Manage Team Details Here
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header title end -->

			<!-- Main Section Starts-->
			<div class="col-12 whitesection tmwhitesec mt30px xsmt25px imsite-form footer-height">

				<div class="row mb-3 padding0 mb30px xsmb15px">
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt8px xsmt10px">
						Name<span class="red">*</span></div>
					<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 md16 sm15 xs15 mt0 xsmt5px">
						<input type="text" placeholder="Name" class="form-control" name="name" id='name'
							value="<?php echo $team_data['name']; ?>">
						<span class="form_error form_error_name"></span>
					</div>
				</div>

				<div class="row padding0 md14 sm14 xs14 mb0px xsmb15px mb-3">
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt8px xsmt10px">
						Email<span class="red">*</span></div>
					<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 md16 sm15 xs15 mt0 xsmt5px">
						<input type="text" placeholder="Email" class="form-control" name="email" id='email' disabled
							value="<?php echo $team_data['email']; ?>">
						<span class="form_error form_error_email"></span>
					</div>
				</div>
				<div class="usersection mb-3">
					<div class="col-xs-12 md14 sm14 xs14 mb30px xsmb15px mb-3">
						<div class="row align-items-center">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt36px xsmt10px">
								User Level<span class="red">*</span></div>
							<div class="col-lg-3 col-md-8 col-sm-8 col-xs-12 md16 sm15 xs15 mt30px xsmt10px">

								<select class="selectpicker rolechooser role" name="user_role[]"
									title="Select User Level" data-dropup-auto="false" data-size="5">
									<option value=""> Select User</option>
									<?php foreach ($role_types as $key => $user_role) { ?>
										<option value="<?php echo $user_role->id; ?>" <?php if ($team_data['role_id'] == $user_role->id) {
											  echo 'selected';
										  } ?>>
											<?php echo $user_role->title; ?></option>
									<?php } ?>
								</select>
								<span class="form_error form_error_role"></span>

							</div>

							<div
								class="col-lg-1 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt36px xsmt20px tmleft text-nowrap">
								Access To<span class="red">*</span></div>
							<div class="col-lg-3 col-md-8 col-sm-8 col-xs-12 md16 sm15 xs15 mt30px xsmt10px">
								<select class="selectpicker user_business website" title="Select Workspace"
									data-dropup-auto="false" data-size="5" name="user_business[]">
									<option value="">Select Workspace</option>
									<?php foreach ($business_list as $key => $user_business) { ?>
										<option value="<?php echo $user_business->id; ?>" <?php if ($team_data['business_id'] == $user_business->id) {
											  echo 'selected';
										  } ?>>
											<?php echo $user_business->domain; ?></option>
									<?php } ?>
								</select>
								<span class="form_error form_error_business"></span>
							</div>
							<!--<div-->
							<!--	class="addmorebtn col-lg-3 col-lg-offset-0 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 md14 sm14 xs14 mt30px xsmt15px smtextalign">-->
							<!--	<a href="javascript:" class="btn btn-primary autobtn addmoreroles">-->
							<!--		Grant More Permissions</a>-->
							<!--</div>-->


						</div>
					</div>


					<div class="col-xs-12 md14 sm14 xs14 privileges manager mb30px"
						style="<?php if ($team_data['role_id'] != 1) {
							echo 'display: none;';
						} ?>">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt0px xsmt0px">
								Privileges:</div>
							<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt10px">
								Will have Full Access but Cannot create a new user and new Workspace
							</div>
						</div>
					</div>

					<div class="col-xs-12 md14 sm14 xs14 privileges analyst mb30px"
						style="<?php if ($team_data['role_id'] != 2) {
							echo 'display: none;';
						} ?>">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt0px xsmt0px">
								Privileges:</div>
							<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt10px">
								Complete Video Editor , Templates
							</div>
						</div>
					</div>

					<div class="col-xs-12 md14 sm14 xs14 privileges marketer mb30px"
						style="<?php if ($team_data['role_id'] != 3) {
							echo 'display: none;';
						} ?>">
						<div class="row">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt0px xsmt0px">
								Privileges:</div>
							<div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt10px">
								Avatar, Video, Templates, YouTube Publisher, YT Automation, Ai Tube Agent.
							</div>
						</div>
					</div>

					<div class="col-xs-12 md14 sm14 xs14 privileges custom mb30px customrole"
						style="<?php if ($team_data['role_id'] != 4) {
							echo 'display: none;';
						} ?>">

						<div class="row mb30px xsmb15px">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt7px xsmt0px">
								Assign User Role<span class="red">*</span></div>
							<div class="col-lg-7 col-md-8 col-sm-8 col-xs-12 md16 sm15 xs15 mt0 xsmt10px">
								<input type="text" class="form-control assign_name" placeholder="Assign User Role"
									name="assign_name[]" value="<?php echo $team_data['custom_role_title']; ?>">
								<span class="form_error form_error_assign_name"></span>
							</div>
						</div>
						<!--
		<div class="row">            
			<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt0px xsmt0px">
			Choose From:</div>	
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt10px">
			
				<div class="row mb-2 mb-sm-3 choose_from_parent">
					<?php foreach ($role_types as $key => $value) {
						if ($value->id != 4) {
							?>
							<div class="col-md-4 col-sm-4 col-xs-6 mt0 xsmt10px">
								<input class="showoption checkbox-custom choose_from" type="checkbox" value="<?php echo $value->id; ?>" id="choose_from_<?php echo $value->id; ?>_1" data-index='1'>
								<label for="choose_from_<?php echo $value->id; ?>_1" class="checkbox-custom-label w400">
								&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $value->title; ?></label>
							</div>
							<?php
						}
					} ?>
					
				</div>
			</div>
		</div>
		-->
						<div class="row mt-sm-3 mt-2">
							<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 md16 sm15 xs15 mt0px xsmt0px">
								Privileges:</div>
							<div
								class="col-lg-9 col-md-9 col-sm-8 col-xs-12 md14 sm14 xs14 mt0 xsmt10px privilege_input1">
								<span class="form_error form_error_privilege"></span>
								<div class="row mb-2 mb-sm-3">
									<?php
									$counter = 0;
									foreach ($all_privilege as $key => $privilege) {
										$counter++;
										if ($counter == 3) {
											$counter = 0;
										}
										?>
										<div class="col-md-4 col-sm-6 col-xs-12 mt0 xsmt10px custom_privilege">
											<input class="showoption checkbox-custom" type="checkbox"
												value="<?php echo $privilege->id; ?>" name="role_privilege[]"
												id="<?php echo $privilege->slug . $key; ?>" <?php if (in_array($privilege->id, $custom_role_ids)) {
													  echo 'checked';
												  } ?>>
											<label for="<?php echo $privilege->slug . $key; ?>"
												class="checkbox-custom-label w400">
												&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $privilege->title; ?></label>
										</div>

										<?php
										if ($counter == 0) {
											echo '</div><div class="row mb-2 mb-sm-3">';
										}
									} ?>
								</div>


							</div>
						</div>


					</div>
				</div>

				<div class="col-xs-12 padding0 mainsection"></div>

				<div
					class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-4 col-xs-12 col-xs-offset-0 padding0 md14 sm14 xs14 mainright mt0 xsmt20px text-end">
					<a href="<?= site_url('team-management') ?>" class="btn btn-danger buttongap me-1">Cancel</a>
					<input type="submit" class="btn btn-primary autobtn save-data" value="Update">
				</div>

			</div>
			<!-- Main Section Ends-->

		</div>
	</div>

	<!-- Page Content End -->





	<script type="text/javascript">
		$(document).ready(function () {
			//$(".usersection:first").find(".custom").hide();
			$(document).on('change', "select.rolechooser", function () {
				$(this).parents(".usersection").find(".customrole").hide();
				$(this).parents(".usersection").find(".manager").hide();
				$(this).parents(".usersection").find(".analyst").hide();
				$(this).parents(".usersection").find(".marketer").hide();

				if ($(this).val() == 4) {
					$(this).parents(".usersection").find(".customrole").show();
				}
				else {
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
				var user_name = $('#name').val();
				var user_email = $('#email').val();
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

				userData = { role_type: role_type, business: business, assign_name: assign_name, custom_role: custom_role, privilege: privilege, user_name: user_name };
				teamData.push(userData);
			});
			//console.log(teamData);return;

			jsLoader(true);
			$.ajax({
				dataType: 'json',
				type: "POST",
				url: "<?php echo base_url('edit-team-member-json'); ?>",
				data: { team_user_id: <?php echo $team_user_id; ?>, team_id: <?php echo $team_id; ?>, team_data: teamData },
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
						}
						else if (response.error.type == "flash") {
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
			<?php foreach ($role_types as $key => $value) {
				if ($value->id != 4) { ?>
					if ($('#choose_from_<?php echo $value->id; ?>_' + index).is(':checked')) {
						choose_from_arr.push(<?php echo $value->id; ?>);
					}
				<?php }
			} ?>

			if (choose_from_arr.length > 0) {
				$.ajax({
					dataType: 'json',
					type: "POST",
					url: "<?php echo base_url('get-team-choose-from'); ?>",
					data: { ids: choose_from_arr },
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