<form id="profile_form" action="" method="post" enctype="multipart/form-data">
	<table class="profile-table table-striped">
		<tr>
			<td>User Name</td>
			<td><?php echo $this->member->loginData->username; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $this->member->loginData->email; ?></td>
		</tr>
		<tr>
			<td>Referral Code</td>
			<td><?php echo $this->member->loginData->refer_code; ?></td>
		</tr>
	</table>
	<br>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">First Name *</label>
				<input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $this->member->loginData->firstname; ?>">
				<span class="error text-danger validation-message" data-field="firstname"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Last Name *</label>
				<input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $this->member->loginData->lastname; ?>">
				<span class="error text-danger validation-message" data-field="lastname"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Phone *</label>
				<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $this->member->loginData->phone; ?>">
				<span class="error text-danger validation-message" data-field="phone"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Password (New Password Only)</label>
				<input type="password" name="password" class="form-control" placeholder="Password" value="">
				<span class="error text-danger validation-message" data-field="password"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-10 file-box-wrapper">
					<div class="form-group">
						<label class="form-control-label">Profile</label>
						<label class="file-box">
							<span class="name-box">Drag or Select Files</span>
							<input type="hidden" name="image_old" id="image_old" value="<?php echo $this->member->loginData->profile; ?>" />
							<input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg" />
						</label>
					</div>
				</div>
				<div class="col-lg-2 d-flex align-items-center pre-img-box">
					<img src="<?php echo base_url(CUSTOMER_IMG.$this->member->loginData->profile); ?>" id="" class="img-fluid" style="border-radius:20px;"/>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<h5>Billing Address</h3>

			<!-- <select name="state" id="state" class="form-control select2">
				<option value="<?php //echo $this->member->loginData->state; ?>"><?php //echo $form_data->state_name; ?></option>
			</select> -->

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label class="form-control-label">Country *</label>
						<select name="country" id="country" class="form-control">
							<option value="<?php echo $this->member->loginData->country; ?>"><?php echo $form_data->country_name; ?></option>
						</select>
						<span class="error text-danger validation-message" data-field="country"></span>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label class="form-control-label">State *</label>
						<input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $this->member->loginData->state; ?>">
						<span class="error text-danger validation-message" data-field="state"></span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label class="form-control-label">City *</label>
						<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $this->member->loginData->city; ?>">
						<span class="error text-danger validation-message" data-field="city"></span>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label class="form-control-label">Zip Code *</label>
						<select name="zip" id="zip" class="form-control select2">
							<option value="<?php echo $this->member->loginData->zip; ?>"><?php echo $this->member->loginData->zip; ?></option>
						</select>
						<span class="error text-danger validation-message" data-field="zip"></span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="form-control-label">Address *</label>
						<textarea name="address" id="" cols="30" rows="3" class="form-control"><?php echo $this->member->loginData->address; ?></textarea>
						<span class="error text-danger validation-message" data-field="address"></span>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="id" value="<?php echo $this->member->loginData->id; ?>">
	</div>
</form>

<div class="text-right">
	<button class="btn btn-primary btn-submit btn-flat btn-pill" onclick="saveProfile()">Save</button>
</div>