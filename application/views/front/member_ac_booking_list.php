<h5>Ongoing Bookings</h5>

<div class="row text-right">
	<div class="col-md-12">
		<a href="#" onClick="load_booking_add()" class="btn-sm btn-default">Book Now</a>
	</div>
</div>

<ul class="booking_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row">
				<div class="col-md-9">
					<?php
						if($val->company_name == ""){
							if($val->status_id == 1){
								echo 'Service Provider: Service Provider is not assigned.';
							}else{
								echo 'Service Provider: Service Provider is Deleted';
							}
						}else{
							echo 'Service Provider: '.$val->company_name;
						}
					?>
					<br/>
					<?php echo date('M d, Y',strtotime($val->date)) .' '.date('H:i',strtotime($val->time)); ?>
					<br/>
					<?php echo 'Total Amount: $'.$val->total_amount; ?>
					<br/>
					<?php echo 'Payable Amount: $'.$val->total_payable; ?>
				 </div>
				<div class="col-md-3 text-right">
					<a class="btn btn-sm btn-pill btn-default margin-bottom-10" style="<?php echo 'background:'.$val->bgColor.';'.'color:'.$val->color.'!important'; ?>"><?php echo $val->status_txt; ?></a><br>
					<a class="btn btn-sm btn-pill btn-secondary" onclick="load_booking_view('<?php echo $val->id; ?>')"><i class="fa fa-eye"></i></a>
					<a class="btn btn-sm btn-pill btn-primary" href="<?php echo base_url('memberAccount/load_booking_invoice/'.$val->id) ?>"><i class="fa fa-download"></i> Invoice</a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>

<br/>
<div class="pagination_wrapper booking_pagination">
	<?php echo $pagination; ?>
</div>