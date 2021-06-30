<form id="card_form" action="" method="post" enctype="multipart/form-data">
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
				<label class="form-control-label">Number *</label>
				<input type="text" name="number" class="form-control" placeholder="Number" value="">
				<span class="error text-danger validation-message" data-field="number"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Expiry Month *</label>
				<select name="expiry_month" id="expiry_month" class="form-control select2">
					<option value=""> -- select --</option>
					<?php foreach (get_month() as $val) { ?>
						<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="expiry_month"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Expiry Year *</label>
				<select name="expiry_year" id="" class="form-control select2">
					<option value=""> -- select --</option>
					<?php foreach (get_next_30_yr() as $val) { ?>
						<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="expiry_year"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">CVV *</label>
				<input type="text" name="cvv" class="form-control" placeholder="CVV" value="">
				<span class="error text-danger validation-message" data-field="cvv"></span>
			</div>
		</div>

	</div>

	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-default btn-flat btn-pill" onclick="cancel('card')">Cancel</button>
	<button class="btn btn-primary btn-submit btn-pill" onclick="cardCreate()">Save</button>
</div>