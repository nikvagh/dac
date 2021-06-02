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
                                <label class="form-control-label">Company Name *</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="<?php echo $this->sp->loginData->company_name; ?>">
                                <span class="error text-danger validation-message" data-field="company_name"></span>
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
                                <input type="text" name="phone_day" class="form-control" placeholder="Phone" value="<?php echo $this->sp->loginData->phone_day; ?>">
                                <span class="error text-danger validation-message" data-field="phone_day"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Email *</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $this->sp->loginData->email; ?>">
                                <span class="error text-danger validation-message" data-field="email"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Logo</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="image_old" id="image_old" value="<?php echo $this->sp->loginData->profile; ?>"/>
                                            <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(ADMIN_IMG.$this->sp->loginData->profile); ?>" id="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $this->sp->loginData->sp_id; ?>">
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">EIN/SSN *</label>
                                <input type="text" name="EIN" class="form-control" placeholder="EIN" value="<?php echo $this->sp->loginData->EIN; ?>">
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
                                            <input type="hidden" name="W9_old" id="W9_old" value="<?php echo $this->sp->loginData->W9; ?>"/>
                                            <input type="file" name="W9" class="form-control input-single" onchange="" accept=".png, .jpg, .jpeg, .svg, .pdf, .doc,.docx,application/msword"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center pre-img-box">
                                    <?php if($this->sp->loginData->W9 != ""){ ?>
                                        <a href="<?php echo base_url(W9_PATH.$this->sp->loginData->W9); ?>" target="_blank">Click To View Documents</a>
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
                                            <input type="hidden" name="COI_old" id="COI_old" value="<?php echo $this->sp->loginData->COI; ?>"/>
                                            <input type="file" name="COI" class="form-control input-single" onchange="" accept=".png, .jpg, .jpeg, .svg, .pdf, .doc,.docx,application/msword"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center pre-img-box">
                                    <?php if($this->sp->loginData->COI != ""){ ?>
                                        <a href="<?php echo base_url(COI_PATH.$this->sp->loginData->COI); ?>" target="_blank">Click To View Documents</a>
                                    <?php }else{ ?>
                                        Documents are not uploaded.    
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'dashboard'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>