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
                                <label class="form-control-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $form_data->name; ?>">
                                <span class="error text-danger validation-message" data-field="name"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Amount *</label>
                                <input type="text" name="amount" class="form-control" placeholder="Amount" value="<?php echo $form_data->amount; ?>">
                                <span class="error text-danger validation-message" data-field="amount"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description"><?php echo $form_data->description; ?></textarea>
                                <span class="error text-danger validation-message" data-field="description"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Image</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="image_old" id="image_old" value="<?php echo $form_data->image; ?>"/>
                                            <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(PACKAGE_IMG.$form_data->image); ?>" id="" class="img-fluid" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Services *</label>
                                <select name="services[]" id="" class="form-control select2" multiple>
                                    <?php foreach($services as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>" <?php if(in_array($val->id,$form_data->services_ids)){ echo "selected"; } ?>><?php echo $val->name; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error text-danger validation-message" data-field="services[]"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Total Wash *</label>
                                <input type="text" name="total_wash" class="form-control" placeholder="Total Wash" value="<?php echo $form_data->total_wash; ?>">
                                <span class="error text-danger validation-message" data-field="total_wash"></span>
                            </div>   
                        </div>

                        <div class="col-lg-12">
                            <label class="form-control-label">Validity *</label>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Year</label>
                                <input type="text" name="year" class="form-control" placeholder="Year" value="<?php echo $validity['year']; ?>">
                                <span class="error text-danger validation-message" data-field="year"></span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Month</label>
                                <input type="text" name="month" class="form-control" placeholder="Month" value="<?php echo $validity['month']; ?>">
                                <span class="error text-danger validation-message" data-field="month"></span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Day</label>
                                <input type="text" name="day" class="form-control" placeholder="Day" value="<?php echo $validity['day']; ?>">
                                <span class="error text-danger validation-message" data-field="day"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
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
                <a href="<?php echo base_url(ADMIN.'package'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>