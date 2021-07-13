<form id="vehicle_form" action="" method="post" enctype="multipart/form-data">
	
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Make *</label>
				<input type="text" name="make" class="form-control" placeholder="Make" value="">
				<span class="error text-danger validation-message" data-field="make"></span>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Model *</label>
				<input type="text" name="name" class="form-control" placeholder="Name" value="">
				<span class="error text-danger validation-message" data-field="name"></span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Year *</label>
				<select name="year" id="" class="form-control select2">
					<?php foreach (get_last_30_yr() as $val) { ?>
						<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="year"></span>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Color *</label>
				<select name="color" id="" class="form-control select2">
					<option value="">-- select ---</option>
					<?php foreach($vehicle_colors as $key=>$val) { ?>
						<option value="<?php echo $val->color; ?>"><?php echo $val->color; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="color"></span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4">
			<div class="form-group">
				<label class="form-control-label">License </label>
				<input type="text" name="license" class="form-control" placeholder="License" value="">
				<span class="error text-danger validation-message" data-field="License"></span>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="form-group">
				<label class="form-control-label">Odometer </label>
				<input type="text" name="odometer" class="form-control" placeholder="Odometer" value="">
				<span class="error text-danger validation-message" data-field="odometer"></span>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="form-group">
				<label class="form-control-label">VIN </label>
				<input type="text" name="vin" class="form-control" placeholder="VIN" value="">
				<span class="error text-danger validation-message" data-field="vin"></span>
			</div>
		</div>
	</div>

	<input type="hidden" name="member_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-default btn-flat btn-pill" onclick="cancel('vehicle')">Cancel</button>
	<button class="btn btn-primary btn-submit btn-pill" onclick="vehicleCreate()">Save</button>
</div>