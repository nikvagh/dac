<div class="form-box">
	<form id="membership_form" action="" method="post" enctype="multipart/form-data">

		<?php $cnt = 1; foreach ($packages as $key => $val) { ?>
			<?php 
				$wrapper = false; if(($key)%3 == 0){ $wrapper = true; }
				$cnt++;
			?>
			<?php if($wrapper){ $cnt = 1; ?> <div class="row flex-row"> <?php } ?>

				<div class="col-md-4 membership_box">
					<div class="">
						<div class="md-box">
							<h4><?php echo $val->name; ?></h4>
						</div>
						<div class="md-box md-price"><?php echo "$".$val->amount; ?></div>
						<div class="md-box">
							<?php 
								$pack_ary = package_validity_converter($val->validity);
								echo $val->validity . ' [' . $pack_ary['txt'] . '] ';
							?>
						</div>

						<div class="md-box md-services">
							<?php 
								if(!empty($val->service_names)){
									$cnt = 0;
									echo "<ul>";
									foreach($val->service_names as $val1){
										if($cnt % 2 == 0){
											$class = 'odd';
										}else{
											$class = 'even';
										}
										echo '<ol class="'.$class.'"> - '.$val1.'</ol>';
										$cnt++;
									}
									echo "</ul>";
								}
							?>
							<?php //echo implode('<br/>', $val->service_names); ?>
						</div>
						<div class="md-box md-radio">
							<div style="">
								<input type="radio" name="package_id" value="<?php echo $val->id; ?>">
							</div>
						</div>
					</div>
				</div>

			<?php if($cnt == 2){ ?> </div> <?php } ?>
		<?php } ?>

		<div class="row">
			<div class="col-sm-12">
				<span class="error text-danger validation-message" data-field="package_id"></span>
			</div>

			<div class="col-sm-3">
				<div class="form-group">
					<!-- <label class="form-control-label">Coupon</label> -->
					<input type="text" name="coupon" class="form-control" placeholder="Coupon" value="">
					<span class="error text-danger validation-message" data-field="coupon"></span>
				</div>
			</div>
		</div>
		<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
	</form>

	<div class="text-right">
		<button class="btn btn-default btn-flat btn-pill" onclick="cancel('membership')">Cancel</button>
		<button class="btn btn-primary btn-submit btn-pill" onclick="membershipCreate()">Save</button>
	</div>
</div>