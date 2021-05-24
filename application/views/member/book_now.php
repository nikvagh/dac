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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Location *</label>
                                <textarea name="location" id="location" rows="3" class="form-control"></textarea>
                                <span class="error text-danger validation-message" data-field="location"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Zip Code *</label>
                                <select name="zipcode" id="zipcode" class="form-control"></select>
                                <span class="error text-danger validation-message" data-field="zipcode"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Vehicle *</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control select2">
                                    <option value="">--select--</option>
                                    <?php foreach($vehicles as $val){ ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->name.' - '.$val->year; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="vehicle_id"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Package *</label>
                                <select name="package_id" id="package_id" class="form-control select2">
                                    <option value="">--select--</option>
                                    <?php foreach($packages as $val){ ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="package_id"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Add On</label>
                                <select name="addOn[]" id="addOn" class="form-control select2" multiple="">
                                    <?php foreach($addOns as $val){ ?>
                                        <option value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="addOn[]"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Time *</label>
                                <input type="text" name="time" id="time" class="form-control"/>
                                <span class="error text-danger validation-message" data-field="time"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
                    <input type="hidden" name="latitude" id="latitude" value="">
                    <input type="hidden" name="longitude" id="longitude" value="">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(MEMBER.'booking'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>