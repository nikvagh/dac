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

	<div class="container">

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

		<div class="row flex-row my-account">
			<div class="col-md-3 sidebar">
				<ul class="sidebar-ul">
					<li class="text-center name-box">
						<h2 class="text-center">Hello, <?php echo $this->member->loginData->firstname.' '.$this->member->loginData->lastname; ?></h2>
						<span class="">Account since <?php echo date('M d, Y',strtotime($this->member->loginData->datecreated)); ?></span>
					</li>
					<li class="active"><a data-toggle="pill" href="#membership"> My Membership </a></li>
					<li><a data-toggle="pill" href="#bookings"> Bookings </a></li>
					<li><a data-toggle="pill" href="#vehicle"> My Vehicles </a></li>
					<li><a data-toggle="pill" href="#payment"> My Payments </a></li>
					<li><a data-toggle="pill" href="#refer"> Refer A Friend </a></li>
					<li><a data-toggle="pill" href="#profile"> Profile </a></li>
					<li><a href="<?php echo base_url('memberLogin/logout'); ?>"> Sign out </a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="tab-content-box">
					<div class="tab-content">
						<div id="membership" class="tab-pane fade">
							<!-- <h3>Ongoing Memberships</h3> -->

							<div class="panel panel-primary">
								<div class="panel-heading">
									<span class=""></span>Ongoing Memberships
								</div>
								<div class="panel-body">
									<ul class="list-group">
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
									</ul>
								</div>
								<!-- <div class="panel-footer">
									<div class="row">
										<div class="col-md-6">
											<h6>Total Count <span class="label label-info">25</span></h6>
										</div>
										<div class="col-md-6">
											<ul class="pagination pagination-sm pull-right">
												<li class="disabled"><a href="javascript:void(0)">«</a></li>
												<li class="active"><a href="javascript:void(0)">1 <span class="sr-only">(current)</span></a></li>
												<li><a href="http://www.jquery2dotnet.com">2</a></li>
												<li><a href="http://www.jquery2dotnet.com">3</a></li>
												<li><a href="http://www.jquery2dotnet.com">4</a></li>
												<li><a href="http://www.jquery2dotnet.com">5</a></li>
												<li><a href="javascript:void(0)">»</a></li>
											</ul>
										</div>
									</div>
								</div> -->
							</div>

							<div class="panel panel-primary">
								<div class="panel-heading">
									<span class=""></span>Expired Memberships
								</div>
								<div class="panel-body">
									<ul class="list-group">
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="checkbox">
												<label for="checkbox"> List group item heading </label>
											</div>
										</li>
									</ul>
								</div>
							</div>

						</div>

						<div id="bookings" class="tab-pane fade">
							<h3>bookings</h3>
							<table class="table align-items-center table-flush dataTable table-hover">
								<thead class="thead-dark">
									<tr>
										<th scope="col" class="sort">#</th>
										<th scope="col" class="sort">Service Provider</th>
										<th scope="col" class="sort">Date</th>
										<th scope="col" class="sort">Time</th>
										<th scope="col" class="sort">Total Amount</th>
										<th scope="col" class="sort">Payable Amount</th>
										<th scope="col" class="sort">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<!-- <tbody class="list">
									<?php foreach($list_current as $key=>$val){ ?>
										<tr>
											<td><?php echo $val->id; //echo "<pre>";print_r($val);  ?></td>
											<td>
												<?php
													if($val->company_name == ""){
														if($val->status_id == 1){
															echo 'Service Provider is not assigned.';
														}else{
															echo 'Service Provider is Deleted';
														}
													}else{
														// echo '<a href="'.base_url(MEMBER.'serviceProvider/view/'.$val->sp_id).'">'.$val->company_name.'</a>';
														echo $val->company_name;
													}
												?>
											</td>
											<td><?php echo $val->date; ?></td>
											<td><?php echo $val->time; ?></td>
											<td><?php echo $val->amount; ?></td>
											<td><?php echo $val->amount; ?></td>
											<td><?php echo $val->status_txt; ?></td>
											<td>
												<a href="<?php echo base_url(MEMBER.'booking/view/'.$val->id) ?>" class="btn btn-sm bg-default text-white">View</a>
												<a href="<?php echo base_url(MEMBER.'booking/invoice/'.$val->id) ?>" class="btn btn-sm bg-gray text-white">Invoice</a>
											</td>
										</tr>
									<?php } ?>
								</tbody> -->
							</table>
						</div>

						<div id="vehicle" class="tab-pane fade">
							<div class="row">
								<div class="col-sm-9"><h3>vehicle</h3></div>
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

						<div id="refer" class="tab-pane fade in active">
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