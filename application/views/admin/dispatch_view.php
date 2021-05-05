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


                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Customer</th>
                                    <td><?php echo $val->firstname.' '.$val->lastname; ?></td>
                                </tr>

                                <tr>
                                    <th>Service Provider</th>
                                    <td><?php echo $val->firstname.' '.$val->lastname; ?></td>
                                </tr>


                                <tr>
                                    <th scope="col" class="sort">Service Provider</th>
                                    <th scope="col" class="sort">Date</th>
                                    <th scope="col" class="sort">Duration</th>
                                    <th scope="col" class="sort">Amount</th>
                                    <th scope="col" class="sort">Service At</th>
                                    <!-- <th scope="col" class="sort">Status</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ //echo "<pre>";print_r($val); ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        
                                        <td><?php echo $val->company_name; ?></td>
                                        <td><?php echo $val->date; ?></td>
                                        <td><?php echo $val->duration; ?></td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><?php echo $val->service_at; ?></td>
                                        <!-- <td>
                                            <select name="status" id="" onChange="confirmPublishStatus('dataTableForm',<?php echo $val->id ?>,this,'Y')" class="form-control">
                                                <?php foreach($statuses as $key1=>$val1){ ?>
                                                    <option value="<?php echo $val1->id; ?>" <?php if($val1->id == $val->status_id){ echo "selected"; } ?>><?php echo $val1->status_txt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td> -->
                                        <td>
                                            <a href="<?php echo base_url(ADMIN.'dispatch/view/'.$val->id) ?>" class="btn btn-sm bg-yellow">Details</a>
                                            <!-- <a href="<?php echo base_url(ADMIN.'dispatch/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a> -->
                                            <!-- <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Appointment')" class="btn btn-sm btn-danger text-white">Delete</a> -->
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- <div class="pl-lg-4"> -->

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
                                    <label class="form-control-label">Category *</label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                        <option hidden="hidden" value="">--select--</option>
                                        <?php foreach($categories as $key=>$val){ ?>
                                            <option value="<?php echo $val->category_id; ?>" <?php if($val->category_id == $form_data->category_id){ echo "selected"; } ?>><?php echo $val->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="category_id"></span>
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
                                    <label class="form-control-label">Services *</label>
                                    <select name="services[]" id="services" class="form-control select2" multiple>
                                        <!-- <option hidden="hidden" value="">--select--</option> -->
                                        <?php foreach($services as $key=>$val){ ?>
                                            <option value="<?php echo $val->id; ?>" <?php if(in_array($val->id,$form_data->service_ids)){ echo "selected"; } ?>><?php echo $val->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="services[]"></span>
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

                    <!-- </div> -->
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