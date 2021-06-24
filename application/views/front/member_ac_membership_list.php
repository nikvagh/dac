<div class="row text-right">
	<div class="col-md-12">
		<a href="#" onClick="load_membership_add()" class="btn-sm btn-default">Purchase New Package</a>
	</div>
</div>
<ul class="membership_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row">
				<div class="col-md-9">
					<?php echo $val->package_name; ?>
					<br/>
					<?php echo date('M d, Y H:i',strtotime($val->start_date)) .' - '.date('M d, Y H:i',strtotime($val->end_date)); ?>
				 </div>
				<div class="col-md-3 text-right">
					<?php
						if($val->validity_status == 'Ongoing'){
							$status_theme = "success";
						}elseif($val->validity_status == 'Pending'){
							$status_theme = "primary";
						}elseif($val->validity_status == 'Expired'){
							$status_theme = "danger";
						}
					?>
					<a class="btn btn-sm btn-pill btn-<?php echo $status_theme; ?>"><?php echo $val->validity_status; ?></a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>
<br/>
<div class="pagination_wrapper membership_pagination">
	<?php echo $pagination; ?>
</div>