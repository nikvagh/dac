<form id="membership_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Vehicle *</label>
                                <select name="vehicle" id="" class="form-control select2">
                                    <option value="">--select--</option>
                                    <?php foreach ($vehicles as $key => $val) { ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="year"></span>
                            </div>
                        </div> -->

		<div class="col-sm-12">
			<table class="table table-hover table-striped">
				<tr>
					<th>Name</th>
					<th>Services</th>
					<th>Price</th>
					<th>Validity</th>
					<th></th>
				</tr>
				<?php foreach ($packages as $key => $val) { ?>
					<tr>
						<td><?php echo $val->name; ?></td>
						<td><?php echo implode('<br/>', $val->service_names); ?></td>
						<td>
							<?php
							// echo "<pre>"; print_r($val);
							$pack_ary = package_validity_converter($val->validity);
							echo $val->validity . ' [' . $pack_ary['txt'] . '] ';
							?>
						</td>
						<td><?php echo $val->amount; ?></td>
						<td><input type="radio" name="package_id" value="<?php echo $val->id; ?>"></td>
					</tr>
				<?php } ?>
			</table>
			<span class="error text-danger validation-message" data-field="package_id"></span>
		</div>

		<div class="col-sm-12">
			<div class="form-group">
				<label class="form-control-label">Coupon</label>
				<input type="text" name="coupon" class="form-control" placeholder="Coupon" value="">
				<span class="error text-danger validation-message" data-field="coupon"></span>
			</div>
		</div>

	</div>
	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-primary btn-submit btn-pill" onclick="membershipCreate()">Save</button>
</div>