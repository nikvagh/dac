
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>

                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="mb-2 nav-link active" id="v-pills-company_core_setting-tab" data-toggle="pill" href="#v-pills-company_core_setting" role="tab" aria-controls="v-pills-company_core_setting" aria-selected="true">Company Core Setting</a>
                                <a class="mb-2 nav-link" id="v-pills-payment_setting-tab" data-toggle="pill" href="#v-pills-payment_setting" role="tab" aria-controls="v-pills-payment_setting" aria-selected="true">Payment Setting</a>
                                <a class="mb-2 nav-link" id="v-pills-user_verification-tab" data-toggle="pill" href="#v-pills-user_verification" role="tab" aria-controls="v-pills-user_verification" aria-selected="true">User Verification</a>
                                <a class="mb-2 nav-link" id="v-pills-notification_setting-tab" data-toggle="pill" href="#v-pills-notification_setting" role="tab" aria-controls="v-pills-notification_setting" aria-selected="true">Notification Setting</a>
                                <a class="mb-2 nav-link" id="v-pills-privacy_policy-tab" data-toggle="pill" href="#v-pills-privacy_policy" role="tab" aria-controls="v-pills-privacy_policy" aria-selected="true">Privacy Policy</a>
                                <a class="mb-2 nav-link" id="v-pills-admin_setting-tab" data-toggle="pill" href="#v-pills-admin_setting" role="tab" aria-controls="v-pills-admin_setting" aria-selected="true">Admin Setting</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="v-pills-company_core_setting" role="tabpanel" aria-labelledby="v-pills-company_core_setting-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3>Company Core Setting</h3>
                                                <form action="" id="form1_companyCoreSetting">
                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-10 file-box-wrapper">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Company Logo</label>
                                                                        <label class="file-box">
                                                                            <span class="name-box">Drag or Select Files</span>
                                                                            <input type="hidden" name="company_logo_old" id="company_logo_old" value="<?php echo $this->system->company_logo; ?>"/>
                                                                            <input type="file" name="company_logo" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                                                    <img src="<?php echo base_url(SYSTEM_IMG.$this->system->company_logo); ?>" id="" class="img-fluid" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                <div class="col-lg-10 file-box-wrapper">
                                                                    <div class="form-group">
                                                                        <label class="form-control-label">Company Favicon</label>
                                                                        <label class="file-box">
                                                                            <span class="name-box">Drag or Select Files</span>
                                                                            <input type="hidden" name="company_favicon_old" id="company_favicon_old" value="<?php echo $this->system->company_favicon; ?>"/>
                                                                            <input type="file" name="company_favicon" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                                                    <img src="<?php echo base_url(SYSTEM_IMG.$this->system->company_favicon); ?>" id="" class="img-fluid" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Currency *</label>
                                                                <select class="form-control select2" name="currency">
                                                                    <option value="">--select--</option>
                                                                    <?php foreach($currency_list as $key=>$val){ ?>
                                                                        <option value="<?php echo $val->id; ?>" <?php if($val->id == $this->system->currency){ echo "selected"; } ?>><?php echo $val->nicename.' '.$val->iso3.' ('.$val->currency.')'; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="error text-danger validation-message" data-field="currency"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Company Name *</label>
                                                                <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="<?php echo $this->system->company_name; ?>">
                                                                <span class="error text-danger validation-message" data-field="company_name"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Company Phone *</label>
                                                                <input type="text" name="company_phone1" class="form-control" placeholder="Company Name" value="<?php echo $this->system->company_phone1; ?>">
                                                                <span class="error text-danger validation-message" data-field="company_phone1"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Company Address *</label>
                                                                <textarea name="company_address" class="form-control" placeholder="Company Address" rows="10"><?php echo $this->system->company_address; ?></textarea>
                                                                <span class="error text-danger validation-message" data-field="company_address"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('companyCoreSetting')">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
