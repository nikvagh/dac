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
                                        <td><?php echo $form_data->company_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $form_data->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $form_data->phone_day; ?></td>
                                    </tr>
                                    <tr>
                                        <td>EIN/SSN</td>
                                        <td><?php echo $form_data->EIN; ?></td>
                                    </tr>
                                    <tr>
                                        <td>W9</td>
                                        <td>
                                            <?php if($form_data->W9 != ""){ ?>
                                                <a href="<?php echo base_url(W9_PATH.$form_data->W9); ?>" target="_blank">Click To View Documents</a>
                                            <?php }else{ ?>
                                                Documents are not uploaded.    
                                            <?php } ?>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>COI</td>
                                        <td>
                                            <?php if($form_data->COI != ""){ ?>
                                                <a href="<?php echo base_url(COI_PATH.$form_data->COI); ?>" target="_blank">Click To View Documents</a>
                                            <?php }else{ ?>
                                                Documents are not uploaded.    
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <?php if($form_data->status == 'yes'){ ?>
                                                <span class="badge badge-pill badge-default"><?php echo $form_data->status; ?></span>
                                            <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $form_data->status; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Co-Workers</td>
                                        <td>
                                            <?php 
                                                foreach($form_data->CoWorkers as $key=>$val){ 
                                                    echo $val->name."<br/>";
                                                } 
                                            ?>
                                        </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="id" value="<?php echo $form_data->sp_id; ?>"> -->
                <!-- </form> -->

                <div class="row">
                    <div class="col-3">
                        <div class="card bg-gradient-success">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase mb-0">Total Jobs Assigned</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalJobAssigned; ?></span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                                    <a href="<?php echo base_url(ADMIN.'serviceProvider/appointmentList/totalJobAssigned/'.$form_data->sp_id); ?>" class="text-white"> View</a>
                                    <!-- <span class="text-nowrap">Since last month</span> -->
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card bg-gradient-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase mb-0">Total Jobs Completed</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalJobSuccess; ?></span>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                                    <a href="<?php echo base_url(ADMIN.'serviceProvider/appointmentList/totalJobSuccess/'.$form_data->sp_id); ?>" class="text-white"> View</a>
                                    <!-- <span class="text-nowrap">Since last month</span> -->
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
                                <!-- <span class="text-nowrap">Since last month</span> -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'dispatch'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="view_update()">Submit</button>
            </div> -->
        </div>
    </div>
</div>