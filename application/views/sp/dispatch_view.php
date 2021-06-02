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
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table breakSpace align-items-center dataTable table-hover">
                                <tbody class="list">
                                    <tr>
                                        <td width="25%">Customer</td>
                                        <td><?php echo $form_data->firstname.' '.$form_data->lastname; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Service Provider</td>
                                        <td class="text-left">

                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <?php 
                                                        if($form_data->sp_id != "" && $form_data->sp_id != null && $form_data->sp_id > 0){
                                                            echo $form_data->company_name;
                                                        }else{
                                                            echo '<span class="badge badge-pill badge-danger">Not Assigned</span>';
                                                        }
                                                    ?>
                                                </div>
                                                <div class="col-6 mr-auto">
                                                    <select class="form-control form-control-sm select2" name="sp_id">
                                                        <option value="">--Select Service Provider--</option>
                                                        <?php foreach($service_providers as $key=>$val){ ?>
                                                            <option value="<?php echo $val->sp_id; ?>"><?php echo $val->company_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

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
                                        <td>Date</td>
                                        <td><?php echo $form_data->date; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Time</td>
                                        <td><?php echo $form_data->time; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Service At</td>
                                        <td><?php echo $form_data->service_at; ?></td>
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
                                        <td>Service Status</td>
                                        <td>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <span class="badge badge-pill badge-default"><?php echo $form_data->status_txt; ?></span>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control form-control-sm select2" name="status_id">
                                                        <option value="">-- Change Status --</option>
                                                        <?php foreach($statuses as $key=>$val){ ?>
                                                            <option value="<?php echo $val->id; ?>"><?php echo $val->status_txt; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'dispatch'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="view_update()">Submit</button>
            </div>
        </div>
    </div>
</div>