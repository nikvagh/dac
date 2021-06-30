<form id="vehicle_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Name *</label>
				<input type="text" name="name" class="form-control" placeholder="Name" value="">
				<span class="error text-danger validation-message" data-field="name"></span>
			</div>
		</div>

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

	</div>
	<input type="hidden" name="member_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-default btn-flat btn-pill" onclick="cancel('vehicle')">Cancel</button>
	<button class="btn btn-primary btn-submit btn-pill" onclick="vehicleCreate()">Save</button>
</div>