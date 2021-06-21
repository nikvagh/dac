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
                                        <td width="25%">Name</td>
                                        <td><?php echo $form_data->firstname." ".$form_data->lastname; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $form_data->username; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $form_data->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $form_data->phone; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?php echo $form_data->address; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Profile Pic</td>
                                        <td><img src="<?php echo base_url(CUSTOMER_IMG.$form_data->profile); ?>" width="80"/></td>
                                    </tr>
                                    <tr>
                                        <td>Active</td>
                                        <td>
                                            <?php if($form_data->status == 'Enable'){ ?>
                                                <span class="badge badge-pill badge-default"><?php echo $form_data->status; ?></span>
                                            <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $form_data->status; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="id" value="<?php echo $form_data->sp_id; ?>"> -->
                <!-- </form> -->

                <!-- <div class="row">
                    <div class="col-3">
                        <div class="card bg-gradient-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase mb-0">Total Jobs Assign</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalJobAssigned; ?></span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                                    <a href="<?php echo base_url(ADMIN.'serviceProvider/appointmentList/totalJobAssigned/'.$form_data->sp_id); ?>" class="text-white"> View</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card bg-gradient-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase mb-0">Total Jobs Complete</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalJobSuccess; ?></span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                                    <a href="<?php echo base_url(ADMIN.'serviceProvider/appointmentList/totalJobSuccess/'.$form_data->sp_id); ?>" class="text-white"> View</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card bg-gradient-warning">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase mb-0">Total Jobs In Progress</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalJobInProgress; ?></span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                                    <a href="<?php echo base_url(ADMIN.'serviceProvider/appointmentList/totalJobInProgress/'.$form_data->sp_id); ?>" class="text-white"> View</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            <!-- <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'dispatch'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="view_update()">Submit</button>
            </div> -->
        </div>
    </div>
</div>