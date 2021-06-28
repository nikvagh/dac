<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"><?php echo $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- <div class="col-sm-12">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Services</th>
                                    <th>Price</th>
                                    <th>Validity</th>
                                    <th></th>
                                </tr>
                                <?php foreach($packages as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo implode('<br/>',$val->service_names); ?></td>
                                        <td>
                                            <?php 
                                                $pack_ary = package_validity_converter($val->validity);
                                                echo $val->validity.' ['.$pack_ary['txt'].'] ';
                                            ?>
                                        </td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><input type="radio" name="package_id" value="<?php echo $val->id; ?>" <?php if($form_data->package_id == $val->id){ echo "checked"; } ?>></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <span class="error text-danger validation-message" data-field="package_id"></span>
                        </div> -->

                        <table class="table breakSpace align-items-center dataTable table-hover table-striped">
                            <tr>
                                <th>Package</th>
                                <td><?php echo $form_data->package_name; ?></td>
                            </tr>
                        </table>
                            
                        <div class="col-sm-6">
                            <label class="form-control-label">Start Date *</label>
                            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Start Date" value="<?php echo $form_data->start_date; ?>">
                            <span class="error text-danger validation-message" data-field="start_date"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-control-label">End Date *</label>
                            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" value="<?php echo $form_data->end_date; ?>">
                            <span class="error text-danger validation-message" data-field="end_date"></span>
                        </div>

                        <!-- <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label">Coupon</label>
                                <input type="text" name="coupon" class="form-control" placeholder="Coupon" value="">
                                <span class="error text-danger validation-message" data-field="coupon"></span>
                            </div>
                        </div> -->

                    </div>
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(MEMBER.'membership'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>