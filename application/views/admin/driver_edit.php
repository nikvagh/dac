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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">First Name *</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $form_data->first_name; ?>">
                                <span class="error text-danger validation-message" data-field="first_name"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" placeholder="last Name" value="<?php echo $form_data->last_name; ?>">
                                <span class="error text-danger validation-message" data-field="last_name"></span>
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
                                <label class="form-control-label">Zip code *</label>
                                <input type="text" name="pincode" class="form-control" placeholder="Zip code" value="<?php echo $form_data->pincode; ?>">
                                <span class="error text-danger validation-message" data-field="pincode"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Start Time *</label>
                                <input type="text" name="start_time" id="start_time" class="form-control" placeholder="Start Time" value="<?php echo $form_data->start_time; ?>" autocomplete="off">
                                <span class="error text-danger validation-message" data-field="start_time"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">End Time *</label>
                                <input type="text" name="end_time" id="end_time" class="form-control" placeholder="End Time" value="<?php echo $form_data->end_time; ?>" autocomplete="off">
                                <span class="error text-danger validation-message" data-field="end_time"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Branch *</label>
                                <select name="branch[]" id="" class="form-control select2" multiple>
                                    <option value="">--Select--</option>
                                    <?php foreach($branches as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>" <?php if(in_array($val->id,$form_data->branch_ids)){ echo "selected"; } ?>><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="branch[]"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Profile Pic</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="image_old" id="image_old" value="<?php echo $form_data->profile; ?>"/>
                                            <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(DRIVER_IMG.$form_data->profile); ?>" id="" class="img-fluid" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Driving License</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="driving_license_old" id="driving_license_old" value="<?php echo $form_data->driving_license; ?>"/>
                                            <input type="file" name="driving_license" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(DRIVER_LICENSE_IMG.$form_data->driving_license); ?>" id="" class="img-fluid" />
                                </div>
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
                <a href="<?php echo base_url(ADMIN.'driver'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>