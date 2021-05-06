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
                    <!-- <div class="table-responsive"> -->
                        <table class="table align-items-center table-flush1 dataTable table-hover">
                            <tbody>
                                <tr>
                                    <td>Customer</td>
                                    <td><?php echo $form_data->firstname.' '.$form_data->lastname; ?></td>
                                </tr>
                                <tr>
                                    <td>Service Provider</td>
                                    <td><?php echo $form_data->firstname.' '.$form_data->lastname; ?></td>
                                </tr>
                                <tr>
                                    <td>Package</td>
                                    <td><?php echo $form_data->package_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Services</td>
                                    <td><?php echo implode(', ',$form_data->service_names); echo " 1111" ?></td>
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
                                    <td><?php echo $form_data->status_txt; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                    </div>
                    </div>



                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Customer *</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2">
                                        <option hidden="hidden" value="">--select--</option>
                                        <?php foreach($customers as $key=>$val){ ?>
                                            <option value="<?php echo $val->id; ?>" <?php if($val->id == $form_data->customer_id){ echo "selected"; } ?>><?php echo $val->firstname.' '.$val->lastname; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="customer_id"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Service Provider *</label>
                                    <select name="sp_id" id="sp_id" class="form-control select2">
                                        <option hidden="hidden" value="">--select--</option>
                                        <?php foreach($sps as $key=>$val){ ?>
                                            <option value="<?php echo $val->sp_id; ?>" <?php if($val->sp_id == $form_data->sp_id){ echo "selected"; } ?>><?php echo $val->company_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="sp_id"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Date *</label>
                                    <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="<?php echo $form_data->date; ?>" autocomplete="off">
                                    <span class="error text-danger validation-message" data-field="date"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Time *</label>
                                    <input type="text" name="time" id="time" class="form-control" placeholder="Time" value="<?php echo date('H:i',strtotime($form_data->time)); ?>" autocomplete="off">
                                    <span class="error text-danger validation-message" data-field="time"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Status *</label>
                                    <select name="status_id" id="status_id" class="form-control select2">
                                        <?php foreach($statuses as $key=>$val){ ?>
                                            <option value="<?php echo $val->id; ?>" <?php if($val->id == $form_data->status_id){ echo "selected"; } ?>><?php echo $val->status_txt; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="status_id"></span>
                                </div>
                            </div>
                        </div>
 
                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'appointment'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>