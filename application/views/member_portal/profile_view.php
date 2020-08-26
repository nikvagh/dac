<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(MEMBERPATH . 'head'); ?>
	<?php $this->load->view(MEMBERPATH . 'common_css'); ?>
</head>

<body class="smart-style-1">

	<?php $this->load->view(MEMBERPATH . 'header'); ?>

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php $this->load->view(MEMBERPATH . 'sidebar'); ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">

		<?php $this->load->view(MEMBERPATH . 'breadcrumb'); ?>

		<!-- MAIN CONTENT -->
		<div id="content">

			<!-- row -->
			<div class="row">
				<!-- col -->
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<?php echo $title; ?>
					</h1>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-check"></i>
					<strong>Success</strong> <?php echo $this->session->flashdata('success');?>
				</div>
				<br/>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-times"></i>
					<strong>Error!</strong> <?php echo $this->session->flashdata('success');?>
				</div>
				<br/>
			<?php endif; ?>

			<div class="row">
				<div class="col-sm-12">

					<div class="well well-sm">
						<div class="row">

							<div class="col-sm-12 col-md-12 col-lg-6">
								<div class="well well-light well-sm no-margin no-padding">

									<div class="row">
										<div class="col-sm-12">

											<div class="row">
												<div class="col-sm-3 profile-pic">
													<?php
														if(file_exists(PROFILE_PATH.$profile['profile'])){
															$profile_pic = base_url().PROFILE_PATH.'thumb/120x120_'.$profile['profile'];
													 	}else{
															$profile_pic = $this->assets.'img/avatars/male.png';
													 	}
													?>
													<img src="<?php echo $profile_pic; ?>" alt="Member Pic">
													<!-- <div class="padding-10">
																<h4 class="font-md"><strong>1,543</strong>
																<br>
																<small>Followers</small></h4>
																<br>
																<h4 class="font-md"><strong>419</strong>
																<br>
																<small>Connections</small></h4>
															</div> -->
												</div>
												<div class="col-sm-6">
													<h1><?php echo $profile['firstname']; ?> <span class="semi-bold"><?php echo $profile['lastname']; ?></span>
														<br>
														<small> MEMBER , DAC</small></h1>

													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $profile['phone']; ?></span>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo $profile['email']; ?>
															</p>
														</li>
														<li>
															<p class="text-muted">
																<i class="fa fa-globe"></i>&nbsp;&nbsp;<?php echo $profile['address']; ?>
																<br />
																City: &nbsp;&nbsp;<?php echo $profile['city']; ?>
																<br />
																State: &nbsp;&nbsp;<?php echo $profile['state']; ?>
															</p>
														</li>
														<!-- <li>
																	<p class="text-muted">
																		<i class="fa fa-skype"></i>&nbsp;&nbsp;<span class="txt-color-darken">john12</span>
																	</p>
																</li> -->
														<!-- <li>
																	<p class="text-muted">
																		<i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Free after <a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="Create an Appointment">4:30 PM</a></span>
																	</p>
																</li> -->
													</ul>
													<br>
												</div>
											</div>

										</div>
									</div>

								</div>

								<br/>
								<!-- Widget ID (each widget will need unique ID)-->
								<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">

									<header class="txt-color-white bg-color-teal">
										<!-- <span class="widget-icon"> <i class="fa fa-edit"></i> </span> -->
										<h2>Vehicles </h2>
									</header>

									<!-- widget div-->
									<div>

										<!-- widget edit box -->
										<div class="jarviswidget-editbox">
											<!-- This area used as dropdown edit box -->

										</div>
										<!-- end widget edit box -->

										<!-- widget content -->
										<div class="widget-body no-padding">

											<form id="edit-vehicle" class="smart-form" action="<?php echo base_url().MEMBERPATH . 'profile/update_profile'; ?>" method="post" enctype="multipart/form-data">
												<!-- <header>Edit Profile</header> -->

												<fieldset class="vehicle_box">
													<?php if(!empty($vehicles)){ ?>
														<?php foreach($vehicles as $key => $val){ ?>
															<div class="row vehicle_row" id="vehicle_row_<?php echo $key; ?>">
																<section class="col col-8">
																	<label class="input">
																		<input type="text" name="vehicle_name[<?php echo $key; ?>]" placeholder="Vehicle Name" value="<?php echo $val['name']; ?>">
																	</label>
																</section>
																<section class="col col-2">
																	<label class="input">
																		<select name="vehicle_year[<?php echo $key; ?>]" class="form-control">
																			<option value=""></option>
																			<?php foreach($last_30_yr as $yr){ ?>
																				<option value="<?php echo $yr; ?>" <?php if($yr == $val['year']){ echo "selected"; } ?>> <?php echo $yr; ?> </option>
																			<?php } ?>
																		</select>
																	</label>
																</section>
																<section class="col col-2">
																	<?php if($key == 0){ ?>
																		<button class="btn btn-primary btn-sm vehicle_add_btn"><i class="fa fa-plus"></i></button>
																	<?php }else{ ?>
																		<button class="btn btn-danger btn-sm vehicle_remove_btn"><i class="fa fa-minus"></i></button>
																	<?php } ?>
																</section>
															</div>
														<?php } ?>
													<?php }else{ ?>
														<fieldset class="vehicle_box">
															<div class="row vehicle_row" id="vehicle_row_0">
																<section class="col col-8">
																	<label class="input">
																		<input type="text" name="vehicle_name[0]" placeholder="Vehicle Name" value="">
																	</label>
																</section>
																<section class="col col-2">
																	<label class="input">
																		<select name="vehicle_year[0]" class="form-control">
																			<option value=""></option>
																			<?php foreach($last_30_yr as $yr){ ?>
																				<option value="<?php echo $yr; ?>"> <?php echo $yr; ?> </option>
																			<?php } ?>
																		</select>
																	</label>
																</section>
																<section class="col col-2">
																	<button class="btn btn-primary btn-sm vehicle_add_btn"><i class="fa fa-plus"></i></button>
																</section>
															</div>
														</fieldset>
													<?php } ?>
												</fieldset>

												<footer>
													<button type="submit" name="submit_vehicle" class="btn btn-primary">Save</button>
												</footer>
											</form>

										</div>
										<!-- end widget content -->

									</div>
									<!-- end widget div -->

								</div>
								<!-- end widget -->

							</div>

							<article class="col-sm-12 col-md-12 col-lg-6">

								<!-- Widget ID (each widget will need unique ID)-->
								<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">

									<header class="txt-color-white bg-color-teal">
										<!-- <span class="widget-icon"> <i class="fa fa-edit"></i> </span> -->
										<h2>Edit Profile </h2>
									</header>

									<!-- widget div-->
									<div>

										<!-- widget edit box -->
										<div class="jarviswidget-editbox">
											<!-- This area used as dropdown edit box -->

										</div>
										<!-- end widget edit box -->

										<!-- widget content -->
										<div class="widget-body no-padding">

											<form id="edit-profile" class="smart-form" action="<?php echo base_url().MEMBERPATH . 'profile/update_profile'; ?>" method="post" enctype="multipart/form-data">
												<!-- <header>Edit Profile</header> -->

												<fieldset>
													<div class="row">
														<section class="col col-6">
															<label class="input">
																<input type="text" name="firstname" placeholder="First name" value="<?php echo $profile['firstname']; ?>">
															</label>
														</section>
														<section class="col col-6">
															<label class="input">
																<input type="text" name="lastname" placeholder="Last name" value="<?php echo $profile['lastname']; ?>">
															</label>
														</section>
													</div>

													<section>
														<label class="input"> <i class="icon-append fa fa-user"></i>
															<input type="text" name="username" placeholder="Username" value="<?php echo $profile['username']; ?>">
															<!-- <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label> -->
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
															<input type="text" name="email" placeholder="Email address" value="<?php echo $profile['email']; ?>">
															<!-- <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label> -->
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-phone"></i>
															<input type="text" name="phone" placeholder="Phone" value="<?php echo $profile['phone']; ?>">
															<!-- <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label> -->
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
															<input type="password" name="password" placeholder="Password" id="password">
															<!-- <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label> -->
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
															<input type="password" name="passwordConfirm" placeholder="Confirm password">
															<!-- <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label> -->
													</section>

													<div class="note">
														<strong>Note:</strong>  Only Enter Password When You Want To Chnage It
													</div>

												</fieldset>

												<fieldset>
													<section>
														<label class="label">Profile Picture </label>
														<div class="input input-file">
															<span class="button">
																<input type="file" id="profile_pic" name="profile_pic" onchange="this.parentNode.nextSibling.value = this.value">Browse
															</span>
															<input type="text" placeholder="Include Image Only" readonly="">
														</div>
														<input type="hidden" name="profile_pic_old" value="<?php echo $profile['profile']; ?>"/>
													</section>
					
													<section>
														
													</section>
												</fieldset>

												<fieldset>
													<section class="">
														<label class="textarea">
															<textarea rows="3" name="address" placeholder="Street Address ..."><?php echo $profile['address']; ?></textarea>
														</label>
													</section>

													<div class="row">
														<section class="col col-6">
															<label class="input">
																<input type="text" name="city" placeholder="City" value="<?php echo $profile['city']; ?>">
															</label>
														</section>
														<section class="col col-6">
															<label class="input">
																<input type="text" name="state" placeholder="State" value="<?php echo $profile['state']; ?>">
															</label>
														</section>
													</div>
												</fieldset>

												<footer>
													<button type="submit" name="submit" class="btn btn-primary">Save</button>
												</footer>
											</form>

										</div>
										<!-- end widget content -->

									</div>
									<!-- end widget div -->

								</div>
								<!-- end widget -->

							</article>

						</div>
					</div>

				</div>
			</div>


		</div>
		<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

	<?php $this->load->view(MEMBERPATH . 'footer'); ?>

	<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
	<div id="shortcut">
		<ul>
			<li>
				<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
			</li>
			<li>
				<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
			</li>
			<li>
				<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
			</li>
			<li>
				<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
			</li>
			<li>
				<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
			</li>
			<li>
				<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
			</li>
		</ul>
	</div>
	<!-- END SHORTCUT AREA -->

	<!--================================================== -->

	<?php $this->load->view(MEMBERPATH . 'common_js'); ?>

	<script>

		$(document).ready(function() {
		// 	pageSetUp();

			$('.vehicle_year').datepicker({
				dateFormat: 'yy',
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>',
				minDate: 0,
				changeMonth: true, 
				changeYear: true,
			});

		})

		$('.vehicle_add_btn').click(function(e){
			e.preventDefault();

			last_row_id = $('.vehicle_box .vehicle_row').last().attr('id');
			// console.log(last_row_id);
			last_row_ary = last_row_id.split('_');
			last_row = last_row_ary[2];
			new_row = parseInt(last_row) + 1;
			// console.log(new_row);

			html = "";
			html += '<div class="row vehicle_row" id="vehicle_row_'+new_row+'">'+
						'<section class="col col-8">'+
							'<label class="input">'+
								'<input type="text" name="vehicle_name['+new_row+']" placeholder="Vehicle Name" value="">'+
							'</label>'+
						'</section>'+
						'<section class="col col-2">'+
							'<label class="input">'+
								'<select name="vehicle_year['+new_row+']" class="form-control">'+
									'<option value=""></option>'+
									<?php foreach($last_30_yr as $yr){ ?>
										'<option value="<?php echo $yr; ?>"> <?php echo $yr; ?> </option>'+
									<?php } ?>
								'</select>'+
							'</label>'+
						'</section>'+
						'<section class="col col-2">'+
							'<button class="btn btn-danger btn-sm vehicle_remove_btn"><i class="fa fa-minus"></i></button>'+
						'</section>'+
					'</div>';

			$("#"+last_row_id).after(html);
		});

		$('body').on('click', '.vehicle_remove_btn', function(e) {
			e.preventDefault();
			$(this).parents('.vehicle_row').remove();
		});

		var errorClass = 'invalid';
		var errorElement = 'em';

		var $registerForm = $("#edit-profile").validate({
			errorClass: errorClass,
			errorElement: errorElement,
			highlight: function(element) {
				$(element).parent().removeClass('state-success').addClass("state-error");
				$(element).removeClass('valid');
			},
			unhighlight: function(element) {
				$(element).parent().removeClass("state-error").addClass('state-success');
				$(element).addClass('valid');
			},

			// Rules for form validation
			rules: {
				username: {
					required: true,
					remote:
                    {
						url: '<?php echo base_url().MEMBERPATH . 'profile/usernameCheck_edit'; ?>',
						type: "post",
						// data:
						// {
						// 	email: function()
						// 	{
						// 		return $('#register-form :input[name="email"]').val();
						// 	}
						// }
                    }
				},
				email: {
					required: true,
					email: true,
					remote:
                    {
						url: '<?php echo base_url().MEMBERPATH . 'profile/emailCheck_edit'; ?>',
						type: "post",
						// data:
						// {
						// 	email: function()
						// 	{
						// 		return $('#register-form :input[name="email"]').val();
						// 	}
						// }
                    }
				},
				password: {
					// required: true,
					minlength: 3,
					maxlength: 20
				},
				passwordConfirm: {
					// required: true,
					minlength: 3,
					maxlength: 20,
					equalTo: '#password'
				},
				firstname: {
					required: true
				},
				address: {
					required: true
				},
				city: {
					required: true
				},
				state: {
					required: true
				},
				phone: {
					required: true
				}
			},

			// Messages for form validation
			messages: {
				username: {
					remote: 'Username Already Exist'
				},
				login: {
					required: 'Please enter your login'
				},
				email: {
					required: 'Please enter your email address',
					email: 'Please enter a VALID email address',
					remote: 'Email Already Exist'
				},
				password: {
					// required: 'Please enter your password'
				},
				passwordConfirm: {
					// required: 'Please enter your password one more time',
					equalTo: 'Please enter the same password as above'
				},
				firstname: {
					required: 'Please select your first name'
				},
				lastname: {
					required: 'Please select your last name'
				},
				phone: {
					required: 'Please enter your Phone Number'
				},
				// terms: {
				// 	required: 'You must agree with Terms and Conditions'
				// }
			},

			// Do not change code below
			errorPlacement: function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	</script>

</body>

</html>