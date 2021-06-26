<form id="booking_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Location *</label>
				<textarea name="location" id="location" rows="3" class="form-control"></textarea>
				<span class="error text-danger validation-message" data-field="location"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Zip Code *</label>
				<select name="zipcode" id="zipcode" class="form-control"></select>
				<span class="error text-danger validation-message" data-field="zipcode"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Vehicle *</label>
				<select name="vehicle_id" id="vehicle_id" class="form-control select2">
					<option value="">--select--</option>
					<?php foreach ($vehicles as $val) { ?>
						<option value="<?php echo $val->id; ?>"><?php echo $val->name . ' - ' . $val->year; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="col-lg-12">
			<label class="form-control-label d-flex justify-content-center1">---- Or Add New Vehicle ----</label>
		</div>

		<div class="col-lg-12">
			<div class="row d-flex justify-content-center1">
				<div class="col-lg-4">
					<div class="form-group">
						<input type="text" name="vehicle_name" class="form-control" placeholder="Vehicle Name" value="">
						<!-- <span class="error text-danger validation-message" data-field="vehicle_name"></span> -->
					</div>
				</div>

				<div class="col-lg-4">
					<div class="form-group">
						<select name="vehicle_year" id="" class="form-control select2">
							<option value="">-- Select Year --</option>
							<?php foreach (get_last_30_yr() as $val) { ?>
								<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
							<?php } ?>
						</select>
						<!-- <span class="error text-danger validation-message" data-field="vehicle_name"></span> -->
					</div>
				</div>
			</div>
			<span class="error text-danger validation-message" data-field="vehicle_id"></span><br />
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Package *</label>
				<select name="package_id" id="package_id" class="form-control select2">
					<option value="">--select--</option>
					<?php foreach ($packages as $val) { ?>
						<option value="<?php echo $val->customer_membership_id; ?>"><?php echo '#'.$val->customer_membership_id.' - '. $val->name.' - (Expire On - '.date('d M,y',strtotime($val->end_date)).')'; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="package_id"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Add On</label>
				<select name="addOn[]" id="addOn" class="form-control select2" multiple="">
					<?php foreach ($addOns as $val) { ?>
						<option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="addOn[]"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Time *</label> <br />
				<label><input type="radio" name="appointment_type" value="book_now"> Book Now </label> &nbsp;&nbsp;
				<label><input type="radio" name="appointment_type" value="book_later"> Book Later </label>
				<br />
				<span class="error text-danger validation-message" data-field="appointment_type"></span>
			</div>
		</div>

		<div class="col-lg-6 time_box">
			<div class="form-group">
				<label class="form-control-label">Date Time *</label>
				<input type="text" name="time" id="time" class="form-control" autocomplete="off" />
				<span class="error text-danger validation-message" data-field="time"></span>
			</div>
		</div>

		<div class="col-lg-6 date_time_box">
			<div class="form-group">
				<label class="form-control-label">Date Time *</label>
				<input type="text" name="date_time" id="date_time" class="form-control" autocomplete="off" />
				<span class="error text-danger validation-message" data-field="date_time"></span>
			</div>
		</div>

	</div>
	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
	<input type="hidden" name="latitude" id="latitude" value="">
	<input type="hidden" name="longitude" id="longitude" value="">
</form>

<div class="text-right">
	<button class="btn btn-primary btn-submit btn-pill" onclick="bookingCreate()">Save</button>
</div>