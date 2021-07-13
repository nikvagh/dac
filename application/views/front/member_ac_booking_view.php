<div class="row">
	<div class="col-lg-12">
		<table class="table breakSpace align-items-center dataTable table-hover">
			<tbody class="list">
				<tr>
					<td width="25%">Order Id</td>
					<td><?php echo "#" . $form_data->id; ?></td>
				</tr>
				<tr>
					<td>Order Type</td>
					<td>
						<?php
							if ($form_data->appointment_type == "book_now") {
								echo 'Book Now';
							} else if ($form_data->appointment_type == "schedule_book") {
								echo 'Schedule Booking';
							} 
						?>
					</td>
				</tr>
				<tr>
					<td>Service Provider</td>
					<td>
						<?php
						if ($form_data->company_name == "") {
							if ($form_data->status_id == 1) {
								echo 'Service Provider is not assigned.';
							} else {
								echo 'Service Provider is Deleted';
							}
						} else {
							// echo '<a href="' . base_url(MEMBER . 'serviceProvider/view/' . $form_data->sp_id) . '">' . $form_data->company_name . '</a>';
							echo $form_data->company_name;
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Package</td>
					<td><?php echo $form_data->package_name; ?></td>
				</tr>
				<tr>
					<td>Services</td>
					<td class="breakSpace"><?php echo implode(', ', $form_data->service_names); ?></td>
				</tr>
				<tr>
					<td>Addons</td>
					<td class="breakSpace"><?php echo implode(', ', $form_data->addon_names); ?></td>
				</tr>
				<tr>
					<td>Date Time</td>
					<td><?php echo $form_data->date . ' ' . $form_data->time; ?></td>
				</tr>
				<tr>
					<td>Vehicle</td>
					<td><?php echo $form_data->vehicle_name . ' - ' . $form_data->vehicle_year; ?></td>
				</tr>
				<tr>
					<td>Location</td>
					<td><?php echo $form_data->location; ?></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td><?php echo $form_data->zipcode; ?></td>
				</tr>
				<tr>
					<td>Total Amount</td>
					<td><?php echo '$ ' . $form_data->total_amount; ?></td>
				</tr>
				<tr>
					<td>Payable Amount</td>
					<td><?php echo '$ ' . $form_data->total_payable; ?></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<span class="badge badge-pill badge-default"><?php echo $form_data->status_txt; ?></span>
					</td>
				</tr>
				<tr>
					<td>Invoice</td>
					<td>
						<a href="<?php echo base_url('memberAccount/load_booking_invoice/' . $form_data->id) ?>">Click To Download</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>