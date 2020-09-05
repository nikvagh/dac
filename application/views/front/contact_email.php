<style>
	thead{
		background:#e6e6e6;
	}
	.logo{
		display:inline-block;
		width:150px;
		padding:10px;
	}
	.logo img{
		width:100%;
	}
	.contact_email_box{
		width:600px;
		margin:auto;
	}
	.contact_email_box table{
		width: 100%;
		text-align:center;
	}
	tbody tr td{
		padding:10px;
		border:1px dotted #e6e6e6;
		
	}
	table{
		border-collapse:collapse;
	}
</style>
<div class="contact_email_box">
	<table class="table table_bordered" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<td colspan="2">
					<a class="logo" href="<?php echo base_url(); ?>">
						<img src="http://localhost/dac/application/views/front/img/dac2.png" alt="">
					</a>
				</td>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td width="20%">Name</td>
				<td><?php echo $form_data['name']; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $form_data['email']; ?></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><?php echo $form_data['phone']; ?></td>
			</tr>
			<tr>
				<td>Service Type</td>
				<td><?php echo $form_data['service_type']; ?></td>
			</tr>
			<tr>
				<td>Message</td>
				<td><?php echo $form_data['message']; ?></td>
			</tr>
		</tbody>
	</table>
</div>