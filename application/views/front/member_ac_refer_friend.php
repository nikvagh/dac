<form id="refer_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h3>Referral Code <br/> <?php echo $this->member->loginData->refer_code; ?></h3>
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" name="link" id="link" class="form-control" value="<?php echo base_url().'memberRegister/refer/'.$this->member->loginData->refer_code; ?>" readonly>
				<span class="error text-danger validation-message" data-field="link"></span>
			</div>
		</div>
		<div class="col-lg-4">
			<button class="btn btn-primary btn-copy">Copy</button>
		</div>

		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" value="">
				<span class="error text-danger validation-message" data-field="email"></span>
			</div>
		</div>
	</div>
	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-primary btn-submit btn-pill" onclick="referFriend()">Send Email</button>
</div>