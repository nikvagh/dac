<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('front/head'); ?>
</head>
<?php $this->load->view('front/header'); ?>
<body>

	<!-- Page Heading Section Start -->
	<div class="pagehding-sec">
		<div class="pagehding-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Register</h1>
						<ul>
							<li><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a>Register</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->

	<div class="container">
	
		<div class="row flex-row my-account">
			<div class="col-md-6 col-md-offset-3 tab-content-box memberRegister">

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<button class="close" data-dismiss="alert">×</button>
						<i class="fa-fw fa fa-times"></i>
						<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>

				<form action="<?php echo site_url('memberRegister/save')?>" method="post" id="login-form">
					<div class="form-group mb-3">
						<input class="form-control" placeholder="User Name" type="text" name="username" value="<?php if(isset($data['form_data']['username'])){ echo $data['form_data']['username']; } ?>">
						<?php if(isset($data['validation']['username'])){ ?>
							<label id="username-error" class="error text-danger text-italic" for="username"><?php echo $data['validation']['username']; ?></label>
						<?php } ?>
					</div>
					<div class="form-group mb-3">
						<input class="form-control" placeholder="Email" type="text" name="email" value="<?php if(isset($data['form_data']['email'])){ echo $data['form_data']['email']; } ?>">
						<?php if(isset($data['validation']['email'])){ ?>
							<label id="email-error" class="error text-danger text-italic" for="email"><?php echo $data['validation']['email']; ?></label>
						<?php } ?>
					</div>
					<div class="form-group mb-3">
						<input class="form-control" placeholder="Phone" type="text" name="phone" value="<?php if(isset($data['form_data']['phone'])){ echo $data['form_data']['phone']; } ?>">
						<?php if(isset($data['validation']['phone'])){ ?>
							<label id="phone-error" class="error text-danger text-italic" for="phone"><?php echo $data['validation']['phone']; ?></label>
						<?php } ?>
					</div>
					<div class="form-group mb-3">
						<input class="form-control" placeholder="Password" type="password" name="password" value="<?php if(isset($data['form_data']['password'])){ echo $data['form_data']['password']; } ?>">
						<?php if(isset($data['validation']['password'])){ ?>
							<label id="password-error" class="error text-danger text-italic" for="password"><?php echo $data['validation']['password']; ?></label>
						<?php } ?>
					</div>
					<div class="form-group mb-3">
						<input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" value="<?php if(isset($data['form_data']['confirm_password'])){ echo $data['form_data']['confirm_password']; } ?>">
						<?php if(isset($data['validation']['confirm_password'])){ ?>
							<label id="confirm_password-error" class="error text-danger text-italic" for="confirm_password"><?php echo $data['validation']['confirm_password']; ?></label>
						<?php } ?>
					</div>
					<div class="form-group mb-3">
						<input class="form-control" placeholder="Referral code" type="text" name="referral_code" value="<?php if(isset($data['form_data']['referral_code'])){ echo $data['form_data']['referral_code']; } ?>">
						<?php if(isset($data['validation']['referral_code'])){ ?>
							<label id="referral_code-error" class="error text-danger text-italic" for="referral_code"><?php echo $data['validation']['referral_code']; ?></label>
						<?php } ?>
					</div>
					<div class="custom-control custom-control-alternative custom-checkbox text-center">
						<input class="custom-control-input" id="staySignedIn" name="staySignedIn" type="checkbox" <?php if(isset($data['form_data']['staySignedIn'])){ echo "checked"; } ?>>
						<label class="custom-control-label" for="staySignedIn">
							<span class="text-muted">Stay signed in</span>
						</label>
					</div>
					<div class="text-center">
						<input type="submit" name="submit" class="btn btn-primary my-4 btn-pill" value="Sign Up">
					</div>
				</form>

				<br/>
				<div class="row">
					<div class="col-md-12 text-center">
						<a href="<?php echo site_url('memberLogin')?>">Login</a>
					</div>
				</div>
				

			</div>
		</div>
	</div>

	<?php $this->load->view('front/footer'); ?>
</body>
</html>