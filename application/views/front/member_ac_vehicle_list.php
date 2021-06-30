
<div class="row text-right">
	<div class="col-md-12 text-center mb-20">
		<a href="#" onClick="load_vehicle_add()" class="btn-sm btn-secondary">Add New Vehicle</a>
	</div>
</div>
<ul class="vehicle_ul">

	<?php if(!empty($list)){ ?>
		<?php $cnt=1; foreach($list as $key => $val) { ?>
			<?php 
				$wrapper = false; if(($key)%2 == 0){ $wrapper = true; }
				$cnt++;
			?>

			<?php if($wrapper){ $cnt = 1; ?> <div class="row flex-row"> <?php } ?>
				<div class="col-sm-6 vehicle_box">
					<div>
						<div class="md-box md-details"> <?php echo $val->name.' - '.$val->year; ?> </div>
						<div class="md-box"> 
							<a class="btn1 btn-block btn-default text-center" onClick="load_vehicle_edit('<?php echo $val->id; ?>')">
								<i class="fa fa-edit"> </i>
							</a>
							<a class="btn1 btn-block btn-primary text-center mt-0" onclick="confirmDelete('<?php echo $val->id; ?>','vehicle')">
								<i class="fa fa-trash"> </i>
							</a> 
						</div>
					</div>
				</div>
			<?php if($cnt == 2){ ?> </div> <?php } ?>
		<?php } ?>
	<?php }else{ 
			$this->load->view(FRONT.'no_data_found');
		}
	?>

</ul>