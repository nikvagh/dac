
<div class="row text-right">
	<div class="col-md-12">
		<a href="#" onClick="load_vehicle_add()" class="btn-sm btn-default">Add New Vehicle</a>
	</div>
</div>
<ul class="vehicle_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row">
				<div class="col-md-9"> <?php echo $val->name.' - '.$val->year; ?> </div>
				<div class="col-md-3 text-right"> 
					<a class="btn btn-sm btn-pill btn-secondary" onClick="load_vehicle_edit('<?php echo $val->id; ?>')"><i class="fa fa-edit"> </i></a>
					<a class="btn btn-sm btn-pill btn-transparent" onclick="confirmDelete('<?php echo $val->id; ?>','vehicle')"><i class="fa fa-trash"> </i></a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>