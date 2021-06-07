<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Edit <?php echo $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Zone *</label>
                                <select name="zone_id" id="" class="form-control">
                                    <option value="">--Select--</option>
                                    <?php foreach($zones as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>" <?php if($val->id == $form_data->zone_id){ echo "selected"; } ?>><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="zone_id"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $form_data->name; ?>">
                                <span class="error text-danger validation-message" data-field="name"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Latitude *</label>
                                <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="<?php echo $form_data->latitude; ?>">
                                <span class="error text-danger validation-message" data-field="latitude"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Longitude *</label>
                                <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="<?php echo $form_data->longitude; ?>">
                                <span class="error text-danger validation-message" data-field="longitude"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Radius *</label>
                                <input type="text" name="radius" class="form-control" placeholder="Radius" value="<?php echo $form_data->radius; ?>">
                                <span class="error text-danger validation-message" data-field="radius"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Mobile *</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $form_data->mobile; ?>">
                                <span class="error text-danger validation-message" data-field="mobile"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Active *</label>
                                <br/>
                                <label class="custom-toggle">
                                    <input type="checkbox" name="status" <?php if($form_data->status == "Enable"){ echo "checked"; } ?>>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'branch'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>