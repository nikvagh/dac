<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('front/head'); ?>
</head>
<?php $this->load->view('front/header'); ?>
<body class="account-page">

	<!-- Page Heading Section Start -->
	<div class="pagehding-sec">
		<div class="pagehding-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Account</h1>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Account</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->

	<div class="container container-large">

		<div class="row flex-row">
			<div class="col-md-12">
				<div class="alert alert-success margin-top-15 margin-bottom-0" id="success-alert" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-check"></i> <strong>Success!</strong> <span class="success_msg"></span>
				</div>
			</div>
		</div>
		<div class="row flex-row">
			<div class="col-md-12">
				<div class="alert alert-danger margin-top-15 margin-bottom-0" id="error-alert" style="display: none;">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-check"></i> <strong>Error!</strong> <span class="error_msg"></span>
				</div>
			</div>
		</div>

		<div class="row flex-row my-account ">
			<div class="col-md-3 col-xs-12 sidebar">
				<ul class="sidebar-ul">
					<li class="text-center name-box">
						<h2 class="text-center">Hello, <?php echo ucwords($this->member->loginData->firstname.' '.$this->member->loginData->lastname); ?></h2>
						<span class="join_date_span">Account since <?php echo date('M d, Y',strtotime($this->member->loginData->datecreated)); ?></span>
					</li>
					<li class="active"><a data-toggle="pill" href="#membership"> My Memberships </a></li>
					<li><a data-toggle="pill" href="#booking"> Bookings </a></li>
					<li><a data-toggle="pill" href="#vehicle"> My Vehicles </a></li>
					<li><a data-toggle="pill" href="#payment"> My Payments </a></li>
					<li><a data-toggle="pill" href="#refer"> Refer A Friend </a></li>
					<li><a data-toggle="pill" href="#profile"> My Profile </a></li>
					<li><a href="<?php echo base_url('memberLogin/logout'); ?>"> Sign Out </a></li>
				</ul>
			</div>

			<div class="col-md-9 col-xs-12">
				<div class="tab-content-box <?php echo $page; ?>">
					<div class="tab-content">
						<div id="membership" class="tab-pane fade in active">
							<h3>My Memberships</h3>
							<div class="member_ac_membership"></div>
						</div>

						<div id="booking" class="tab-pane fade">
							<h3>Bookings</h3>
							<div class="member_ac_booking"></div>
							<br>

							<div class="member_ac_booking_prev"></div>
						</div>

						<div id="vehicle" class="tab-pane fade">
							<div class="row">
								<div class="col-sm-9"><h3>Vehicle</h3></div>
							</div>
							<div class="member_ac_vehicle"></div>
						</div>

						<div id="payment" class="tab-pane fade">
							<h3>My Cards</h3>
							<div class="member_ac_card"></div>
							
							<br/>
							<h3>My payments</h3>
							<div class="member_ac_payment"></div>

							<!-- <ul class="vehicle_ul">
								<li>
									<div class="row">
										<div class="col-md-9"> Honda City - 2012 </div>
										<div class="col-md-3 text-right">
											<a class="btn btn-sm btn-pill btn-secondary"><i class="fa fa-edit"> </i></a>
										</div>
									</div>
								</li>
								<li>
									<div class="row">
										<div class="col-md-3"></div>
									</div>
								</li>
							</ul> -->
						</div>

						<div id="refer" class="tab-pane fade">
							<h3>Refer A Friend</h3>
							<div class="member_ac_refer"></div>
						</div>

						<div id="profile" class="tab-pane fade">
							<h3>Profile Information</h3>
							<div class="member_ac_profile"></div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade" id="confirm_model" role="dialog"></div>
	
	<?php $this->load->view('front/footer'); ?>
</body>
</html>