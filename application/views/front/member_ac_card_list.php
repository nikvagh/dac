<div class="row text-right">
	<div class="col-md-12">
		<a href="#" onClick="load_card_add()" class="btn-sm btn-default">Add New Card</a>
	</div>
</div>
<ul class="card_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row">
				<div class="col-md-9"> <?php echo $val->name.' <br/> '.$val->number.' <br/> Expiry - '.$val->expiry_month.'/'.$val->expiry_year.' <br/> CVV - '.$val->cvv; ?> </div>
				<div class="col-md-3 text-right">
					<a class="btn btn-sm btn-pill btn-secondary" onClick="load_card_edit('<?php echo $val->id; ?>')"><i class="fa fa-edit"> </i></a>
					<a class="btn btn-sm btn-pill btn-transparent" onclick="confirmDelete('<?php echo $val->id; ?>','card')"><i class="fa fa-trash"> </i></a>
				</div>
			</div>
		</li>
	<?php } ?>
</ul>