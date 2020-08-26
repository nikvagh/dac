<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<?php $this->load->view(SPPATH . 'head_nologin'); ?>
        <?php $this->load->view(SPPATH . 'common_css_nologin'); ?>
	</head>
	
	<body class="animated fadeInDown">

		<?php $this->load->view(SPPATH . 'header_nologin'); ?>

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
							<form action="<?php echo site_url(SPPATH.'login/dologin/')?>" method="post" id="login-form" class="smart-form client-form">
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
											<a href="forgotpassword.html">Forgot password?</a>
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

		<?php $this->load->view(SPPATH . 'common_js_nologin'); ?>

	    <!-- JQUERY VALIDATE -->
		<script src="<?php echo $this->assets; ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

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