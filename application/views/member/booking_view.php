<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"><?php echo $title; ?> Details</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- <form id="form1" action="" method="post" enctype="multipart/form-data"> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table breakSpace align-items-center dataTable table-hover">
                                <tbody class="list">
                                    <tr>
                                        <td width="25%">Order Id</td>
                                        <td><?php echo "#".$form_data->id; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Order Type</td>
                                        <td><?php if($form_data->appointment_type == "book_now"){ echo 'Book Now'; }else if($form_data->appointment_type == "book_now"){ echo 'Schedule Booking'; }; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Service Provider</td>
                                        <td>
                                            <?php
                                                if($form_data->company_name == ""){
                                                    echo 'Service Provider Deleted';
                                                }else{
                                                    echo '<a href="'.base_url(MEMBER.'serviceProvider/view/'.$form_data->sp_id).'">'.$form_data->company_name.'</a>';
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
                                        <td class="breakSpace"><?php echo implode(', ',$form_data->service_names); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Addons</td>
                                        <td class="breakSpace"><?php echo implode(', ',$form_data->addon_names); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Time</td>
                                        <td><?php echo $form_data->date.' '.$form_data->time; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Vehicle</td>
                                        <td><?php echo $form_data->vehicle_name.' - '.$form_data->vehicle_year; ?></td>
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
                                        <td><?php echo '$ '.$form_data->total_amount; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Payable Amount</td>
                                        <td><?php echo '$ '.$form_data->total_payable; ?></td>
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
                                            <a href="<?php echo base_url(MEMBER.'booking/invoice/'.$form_data->id) ?>">Click To Download</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="id" value="<?php echo $form_data->sp_id; ?>"> -->
                <!-- </form> -->
            </div>
            <!-- <div class="card-footer text-right">
                <a href="<?php echo base_url(MEMBER.'dispatch'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="view_update()">Submit</button>
            </div> -->
        </div>
    </div>
</div>