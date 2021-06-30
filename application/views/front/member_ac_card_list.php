<div class="row text-right">
	<div class="col-md-12 text-center mb-20">
		<a href="#" onClick="load_card_add()" class="btn-sm btn-secondary">Add New Card</a>
	</div>
</div>

<?php if(!empty($list)){ ?>

<ul class="card_ul">
	<?php $cnt=1; foreach($list as $key => $val) { ?>
		<?php 
			$wrapper = false; if(($key)%3 == 0){ $wrapper = true; }
			$cnt++;
		?>

		<?php if($wrapper){ $cnt = 1; ?> <div class="row flex-row"> <?php } ?>
			<div class="col-sm-4 card_box">
				<div>
					<div class="md-box md-details"> <?php echo $val->name.' <br/> '.$val->number.' <br/> Expiry - '.$val->expiry_month.'/'.$val->expiry_year.' <br/> CVV - '.$val->cvv; ?> </div>
					<div class="md-box"> 
						<a class="btn1 btn-block btn-default text-center" onClick="load_card_edit('<?php echo $val->id; ?>')">
							<i class="fa fa-edit"> </i>
						</a>
						<a class="btn1 btn-block btn-primary text-center mt-0" onClick="confirmDelete('<?php echo $val->id; ?>','card')">
							<i class="fa fa-trash"> </i>
						</a> 
					</div>
				</div>
			</div>
		<?php if($cnt == 3){ ?> </div> <?php } ?>
	<?php } ?>
</ul>

<?php }else{ 
		$this->load->view(FRONT.'no_data_found');
	}
?>
