<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(SPPATH . 'head'); ?>
	<?php $this->load->view(SPPATH . 'common_css'); ?>
</head>

<body class="smart-style-1">

	<?php $this->load->view(SPPATH . 'header'); ?>

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php $this->load->view(SPPATH . 'sidebar'); ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">

		<?php $this->load->view(SPPATH . 'breadcrumb'); ?>

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
													<h1><?php echo $profile['company_name']; ?>
														<br>
														<small> SERVICE PROVIDER , DAC</small></h1>

													<ul class="list-unstyled">
														<li>
															<p class="text-muted">
																<i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $profile['phone_day']; ?></span>
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
																<!-- <br /> -->
																<!-- City: &nbsp;&nbsp;<?php //echo $profile['city']; ?> -->
																<!-- <br /> -->
																<!-- State: &nbsp;&nbsp;<?php //echo $profile['state']; ?> -->
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

											<form id="edit-profile" class="smart-form" action="<?php echo base_url().SPPATH . 'profile/update_profile'; ?>" method="post" enctype="multipart/form-data">
												<!-- <header>Edit Profile</header> -->

												<fieldset>
													<section>
														<label class="input"> <i class="icon-append fa fa-envelope"></i>
														<input type="text" name="email" placeholder="Email address" value="<?php echo $profile['email']; ?>">
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-user"></i>
														<input type="text" name="username" placeholder="Username" value="<?php echo $profile['username']; ?>">
													</section>

													<!-- <section>
														<label class="input"> <i class="icon-append fa fa-phone"></i>
														<input type="text" name="phone" placeholder="Phone" value="<?php //echo $profile['phone']; ?>">
													</section> -->

													<section>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
														<input type="password" name="password" placeholder="Password" id="password">
													</section>

													<section>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
														<input type="password" name="passwordConfirm" placeholder="Confirm password">
													</section>

													<div class="note txt-color-teal">
														<strong>Note:</strong>  Only Enter Password When You Want To Chnage It
													</div>
													<br/>

													<section>
														<label class="input"> <i class="icon-append fa fa-cog"></i>
														<input type="text" name="company_name" placeholder="Name" value="<?php echo $profile['company_name']; ?>">
													</section>
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
												</fieldset>

												<fieldset>
													<!-- <div class="row">
														<section class="col col-6">
															<label class="input">
																<input type="text" name="latitude" placeholder="Latitude" value="<?php echo $profile['latitude']; ?>">
															</label>
														</section>
														<section class="col col-6">
															<label class="input">
																<input type="text" name="longitude" placeholder="Longitude" value="<?php echo $profile['longitude']; ?>">
															</label>
														</section>
													</div> -->

													<!-- <div class="row">
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
													</div> -->

													<!-- <section>
														<label class="input">
															<label>Zip Code *</label>
															<input type="text" name="zipcode" placeholder="Zip Code" value="<?php echo $profile['zipcode']; ?>">
														</label>
													</section> -->

													<section class="">
														<label class="textarea">
															<label>Type of Facility *</label>
															<textarea rows="3" name="type_of_facility" placeholder="Type of Facility"><?php echo $profile['type_of_facility']; ?></textarea>
														</label>
													</section>

													<section class="">
														<label class="textarea">
															<label>Address *</label>
															<textarea rows="3" name="address" placeholder="Address ..."><?php echo $profile['address']; ?></textarea>
														</label>
													</section>

													<section>
														<label class="input">
															<label>Current Hours of Road Operation *</label>
															<input type="text" name="hours_of_road_operation" placeholder="Current Hours of Road Operation" value="<?php echo $profile['hours_of_road_operation']; ?>">
														</label>
													</section>

													<section>
														<label class="input">
															<label>Phone *</label>
															<input type="text" name="phone_day" placeholder="Day" value="<?php echo $profile['phone_day']; ?>">
														</label>
													</section>
													<section>
														<label class="input">
															<input type="text" name="phone_night" placeholder="Night" value="<?php echo $profile['phone_night']; ?>">
														</label>
													</section>
													<section>
														<label class="input">
															<input type="text" name="phone_cell" placeholder="Cell" value="<?php echo $profile['phone_cell']; ?>">
														</label>
													</section>
													<section>
														<label class="input">
															<label>Tax Identification Number *</label>
															<input type="text" name="tax_identification_number" placeholder="Tax Identification Number" value="<?php echo $profile['tax_identification_number']; ?>">
														</label>
													</section>
												</fieldset>

												<!-- <fieldset>
													<section>
														<div class="form-group">
															<label>Service Provides *</label>
															<select name="service_provide[]" id="service_provide" multiple class="select2">
																<?php $services_old = explode(',',$profile['service_provide']); ?>
																<?php foreach($services as $service){ ?>
																	<option value="<?php echo $service['service_id']; ?>" <?php if(in_array($service['service_id'],$services_old)){ echo "selected"; } ?>>
																		<?php echo $service['title']; ?>
																	</option>
																<?php } ?>
															</select>
														</div>
													</section>
												</fieldset> -->

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

	<?php $this->load->view(SPPATH . 'footer'); ?>

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

	<?php $this->load->view(SPPATH . 'common_js'); ?>

	<script>
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
						url: '<?php echo base_url().SPPATH . 'profile/usernameCheck_edit'; ?>',
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
						url: '<?php echo base_url().SPPATH . 'profile/emailCheck_edit'; ?>',
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
				company_name: {
					required: true
				},
				// latitude:{
				// 	required: true,
				// 	number:true,
				// },
				// longitude:{
				// 	required: true,
				// 	number:true,
				// },
				// city: {
				// 	required: true
				// },
				// state: {
				// 	required: true
				// },
				// zipcode: {
				// 	required: true,
				// 	number:true,
				// },
				// "service_provide[]": "required",
				type_of_facility: {
					required: true
				},
				address: {
					required: true,
				},
				hours_of_road_operation:{
					required: true,
					numbers:true,
				},
				phone_day:{
					required: true,
					digits:true,
				},
				phone_night:{
					required: true,
					digits:true,
				},
				phone_cell:{
					required: true,
					digits:true,
				},
				tax_identification_number: {
					required: true,
				},
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
				latitude:{
					number: 'Please enter valid latitude'
				},
				longitude:{
					number: 'Please enter valid longitude'
				},
			},

			// Do not change code below
			errorPlacement: function(error, element) {
				error.insertAfter(element.parent());
			},
			ignore: 'input[type=hidden]'
		});
	</script>

</body>

</html>