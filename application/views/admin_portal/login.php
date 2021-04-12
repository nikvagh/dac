<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title> Drip Admin</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-rtl.min.css"> 

		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/your_style.css">

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="<?php echo $this->assets; ?>img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo $this->assets; ?>img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?php echo $this->assets; ?>img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->assets; ?>img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->assets; ?>img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->assets; ?>img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	</head>
	
	<body class="animated fadeInDown">

		<header id="header">
			<div id="logo-group">
				<span id="logo"> <img src="<?php echo $this->assets; ?>img/logo.png"> </span>
			</div>
            <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> 
                <a href="#" class="btn btn-info">Create account</a> 
            </span>
		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger fade in">
                                <button class="close" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-times"></i>
                                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

						<div class="well no-padding">
							<form action="<?php echo site_url(ADMINPATH.'login/dologin/')?>" method="post" id="login-form" class="smart-form client-form">
								<header class="bg-color-teal txt-color-white no-border box-hedaer">Sign In</header>
								<fieldset class="bg-color-white">
									<section>
										<label class="label">Username</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="username" name="username">
											<!-- <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label> -->
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
                                    </section>
                                    
                                    <section>
                                        <div class="note">
											<a href="">Forgot password?</a>
										</div>
                                    </section>
                                    
									<!-- <section>
										<label class="checkbox">
											<input type="checkbox" name="remember" checked="">
											<i></i>Stay signed in</label>
                                    </section> -->
								</fieldset>
								<footer>
									<input type="submit" name="submit" class="btn btn-info" value="Sign in">
										
								</footer>
							</form>

						</div>
								
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->	

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

	    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo $this->assets; ?>js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="<?php echo $this->assets; ?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="<?php echo $this->assets; ?>js/bootstrap/bootstrap.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo $this->assets; ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>
		
		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo $this->assets; ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<script src="<?php echo $this->assets; ?>js/app.min.js"></script>

		<script type="text/javascript">
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						username : {
							required : true,
							// email : true
						},
						password : {
							required : true,
							// minlength : 3,
							// maxlength : 20
						}
					},
                    errorClass: 'error text-danger text-italic',
					// Messages for form validation
					messages : {
						email : {
							required : 'Please enter your email address',
							email : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
                        element.addClass('text-danger');
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

	</body>
</html>