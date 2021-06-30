
<?php if(!empty($list)){ ?>
	
<ul class="payment_ul">
	<?php foreach($list as $key=>$val){ ?>
		<li row-id="<?php echo $val->id; ?>">
			<div class="row flex-row">
				<div class="col-md-9">
					<?php
						if($val->transaction_type == "Credit"){
							echo '<span class="text-danger font-weight-bold">$'.$val->amount.'</span>';
						}else if($val->transaction_type == "Debit"){
							echo '<span class="text-success font-weight-bold">$'.$val->amount.'</span>';
						}
					?>
					<br/>
					<?php echo $val->description; ?>
					<br/>
					<?php echo '<i class="fa fa-calendar"></i> '.date('M d, Y H:i',strtotime($val->created_at)); ?>
				</div>

				<?php
					if($val->status == 'Pending'){
						$status_theme = "primary";
						$bg_theme = "#00aeef";
					}else if($val->status == 'Failed'){
						$status_theme = "danger";
						$bg_theme = "#d9534f";
					}else if($val->status == 'Success'){
						$status_theme = "success";
						$bg_theme = "#5cb85c";
					}
				?>

				<div class="col-md-3 text-center status-box text-white" style="background:<?php echo $bg_theme; ?>;">
					<!-- <span class="badge badge-lg badge-<?php echo $status_theme; ?>"><?php echo $val->status; ?></span> -->
					<a class="btn btn-sm btn-pill btn-<?php echo $status_theme; ?>"><?php echo $val->status; ?></a>
					<!-- <a class="btn btn-sm btn-pill btn-transparent" onclick="confirmDelete('<?php echo $val->id; ?>','payment')"><i class="fa fa-trash"> </i></a> -->
				</div>
			</div>
		</li>
	<?php } ?>
</ul>
<br/>
<div class="pagination_wrapper payment_pagination">
	<?php echo $pagination; ?>
</div>

<?php }else{ 
		$this->load->view(FRONT.'no_data_found');
	}
?>
