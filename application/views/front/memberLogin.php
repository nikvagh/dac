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
						<h1>Login</h1>
						<ul>
							<li><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a>Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->

	<div class="container">
	
		<div class="row flex-row my-account">
			<div class="col-md-6 col-md-offset-3 tab-content-box">

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<button class="close" data-dismiss="alert">×</button>
						<i class="fa-fw fa fa-times"></i>
						<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>

				<form id="form1" action="<?php echo site_url('memberLogin/dologin/')?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<input class="form-control" placeholder="Email / Username" type="text" name="username" value="<?php if(isset($data['username'])){ echo $data['username']; } ?>">
					</div>

					<div class="form-group">
						<input class="form-control" placeholder="Password" type="password" name="password" value="<?php if(isset($data['password'])){ echo $data['password']; } ?>">
					</div>

					<label for="remember_me"><input type="checkbox" name="remember_me" id="remember_me"/> Remember me</label>

					<div class="text-center">
						<input type="submit" name="submit" class="btn btn-primary btn-pill" value="Sign in">
					</div>
				</form>
				
				<br/>
				<div class="row">
					<div class="col-md-6 text-left">
						<a href="#">Forgot password</a>
					</div>
					<div class="col-md-6 text-right">
						<a href="<?php echo site_url('memberRegister')?>">Create New Account</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php $this->load->view('front/footer'); ?>
</body>
</html>