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
                    <h6 class="heading-small text-muted mb-4">Company information</h6>
                    <div class="pl-lg-4">
                        <div class="row">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Company Name *</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="<?php echo $form_data->company_name; ?>">
                                    <span class="error text-danger validation-message" data-field="company_name"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $form_data->email; ?>">
                                    <span class="error text-danger validation-message" data-field="email"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone *</label>
                                    <input type="text" name="phone_day" class="form-control" placeholder="Phone" value="<?php echo $form_data->phone_day; ?>">
                                    <span class="error text-danger validation-message" data-field="phone_day"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-10 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">Logo</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <input type="hidden" name="image_old" id="image_old" value="<?php echo $form_data->profile; ?>"/>
                                                <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                        <img src="<?php echo base_url(SP_IMG.$form_data->profile); ?>" id="" class="img-fluid" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">EIN/SSN *</label>
                                    <input type="text" name="EIN" class="form-control" placeholder="EIN" value="<?php echo $form_data->EIN; ?>">
                                    <span class="error text-danger validation-message" data-field="EIN"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">W9</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <input type="hidden" name="W9_old" id="W9_old" value="<?php echo $form_data->W9; ?>"/>
                                                <input type="file" name="W9" class="form-control input-single" onchange="" accept=".png, .jpg, .jpeg, .svg, .pdf, .doc,.docx,application/msword"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center pre-img-box">
                                        <?php if($form_data->W9 != ""){ ?>
                                            <a href="<?php echo base_url(W9_PATH.$form_data->W9); ?>" target="_blank">Click To View Documents</a>
                                        <?php }else{ ?>
                                            Documents are not uploaded.    
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">COI</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <input type="hidden" name="COI_old" id="COI_old" value="<?php echo $form_data->COI; ?>"/>
                                                <input type="file" name="COI" class="form-control input-single" onchange="" accept=".png, .jpg, .jpeg, .svg, .pdf, .doc,.docx,application/msword"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center pre-img-box">
                                        <?php if($form_data->COI != ""){ ?>
                                            <a href="<?php echo base_url(COI_PATH.$form_data->COI); ?>" target="_blank">Click To View Documents</a>
                                        <?php }else{ ?>
                                            Documents are not uploaded.    
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Active *</label>
                                    <br/>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="status" checked>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- </div> -->
                    <input type="hidden" name="id" value="<?php echo $form_data->sp_id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'serviceProvider'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>