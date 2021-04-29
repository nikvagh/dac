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
                    <!-- <div class="pl-lg-4"> -->

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Username *</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $form_data->username; ?>">
                                    <span class="error text-danger validation-message" data-field="username"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Password (New Password Only)</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="">
                                    <span class="error text-danger validation-message" data-field="password"></span>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone *</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $form_data->phone; ?>">
                                    <span class="error text-danger validation-message" data-field="phone"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $form_data->email; ?>">
                                    <span class="error text-danger validation-message" data-field="email"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-10 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">Profile</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <input type="hidden" name="image_old" id="image_old" value="<?php echo $form_data->profile; ?>"/>
                                                <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(ADMIN_IMG.$form_data->profile); ?>" id="" class="img-fluid" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Role *</label>
                                    <select class="form-control" name="role">
                                        <option value="">--select--</option>
                                        <?php foreach($roles as $key=>$val){ ?>
                                            <option value="<?php echo $val->id; ?>" <?php if($val->id == $form_data->admin_group_id){ echo "selected"; } ?>><?php echo $val->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="role"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Status *</label>
                                    <br/>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="status" <?php if($form_data->status == "Enable"){ echo "checked"; } ?>>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    <!-- </div> -->
                    <input type="hidden" name="id" value="<?php echo $form_data->admin_id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'adminUser'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>