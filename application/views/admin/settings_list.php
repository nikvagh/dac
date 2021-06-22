
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>

                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="mb-2 nav-link <?php if($tab == "companyCoreSetting"){ echo 'active'; } ?>" id="v-pills-company_core_setting-tab" data-toggle="pill" href="#v-pills-company_core_setting" role="tab" aria-controls="v-pills-company_core_setting" aria-selected="true">Company Core Setting</a>
                                <a class="mb-2 nav-link <?php if($tab == "paymentSetting"){ echo 'active'; } ?>" id="v-pills-payment_setting-tab" data-toggle="pill" href="#v-pills-payment_setting" role="tab" aria-controls="v-pills-payment_setting" aria-selected="true">Payment Setting</a>
                                <a class="mb-2 nav-link <?php if($tab == "userVerificationSetting"){ echo 'active'; } ?>" id="v-pills-user_verification_setting-tab" data-toggle="pill" href="#v-pills-user_verification_setting" role="tab" aria-controls="v-pills-user_verification_setting" aria-selected="true">User Verification</a>
                                <a class="mb-2 nav-link <?php if($tab == "notificationSetting"){ echo 'active'; } ?>" id="v-pills-notification_setting-tab" data-toggle="pill" href="#v-pills-notification_setting" role="tab" aria-controls="v-pills-notification_setting" aria-selected="true">Notification Setting</a>
                                <a class="mb-2 nav-link <?php if($tab == "privacyPolicy"){ echo 'active'; } ?>" id="v-pills-privacy_policy-tab" data-toggle="pill" href="#v-pills-privacy_policy" role="tab" aria-controls="v-pills-privacy_policy" aria-selected="true">Privacy Policy</a>
                                <!-- <a class="mb-2 nav-link <?php if($tab == "companyCoreSetting"){ echo 'active'; } ?>" id="v-pills-admin_setting-tab" data-toggle="pill" href="#v-pills-admin_setting" role="tab" aria-controls="v-pills-admin_setting" aria-selected="true">Admin Setting</a> -->
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">

                                    <div class="tab-pane fade <?php if($tab == "companyCoreSetting"){ echo 'show active'; } ?>" id="v-pills-company_core_setting" role="tabpanel" aria-labelledby="v-pills-company_core_setting-tab">
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

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Company Email *</label>
                                                                <input type="text" name="company_email" class="form-control" placeholder="Company Email" value="<?php echo $this->system->company_email; ?>">
                                                                <span class="error text-danger validation-message" data-field="company_email"></span>
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

                                    <div class="tab-pane fade <?php if($tab == "paymentSetting"){ echo 'show active'; } ?>" id="v-pills-payment_setting" role="tabpanel" aria-labelledby="v-pills-payment_setting-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3>Payment Setting</h3>
                                                <form action="" id="form1_paymentSetting">
                                                    <div class="row">

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Service Paid Locally</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="service_paid_locally" <?php if($this->system->service_paid_locally == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Paypal</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="paypal" <?php if($this->system->paypal == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Stripe</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="stripe" <?php if($this->system->stripe == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Razorpay</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="razorpay" <?php if($this->system->razorpay == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Flutterwave</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="flutterwave" <?php if($this->system->flutterwave == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Paystack</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="paystack" <?php if($this->system->paystack == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Paypal Environment Sandbox</label>
                                                                <input type="text" name="paypal_environment_sandbox" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->paypal_environment_sandbox; ?>">
                                                                <span class="error text-danger validation-message" data-field="paypal_environment_sandbox"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Paypal Environment Production</label>
                                                                <input type="text" name="paypal_environment_production" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->paypal_environment_production; ?>">
                                                                <span class="error text-danger validation-message" data-field="paypal_environment_production"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Stripe Published Key</label>
                                                                <input type="text" name="stripe_published_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->stripe_published_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="stripe_published_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Stripe Secret Key</label>
                                                                <input type="text" name="stripe_secret_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->stripe_secret_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="stripe_secret_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Razorpay Key</label>
                                                                <input type="text" name="razorpay_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->razorpay_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="razorpay_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Flutterwave Public Key</label>
                                                                <input type="text" name="flutterwave_public_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->flutterwave_public_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="flutterwave_public_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Paystack Public key</label>
                                                                <input type="text" name="paystack_public_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->paystack_public_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="paystack_public_key"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('paymentSetting')">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade <?php if($tab == "userVerificationSetting"){ echo 'show active'; } ?>" id="v-pills-user_verification_setting" role="tabpanel" aria-labelledby="v-pills-user_verification_setting-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3>User Verification Setting</h3>
                                                <form action="" id="form1_userVerificationSetting">
                                                    <div class="row">

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">User Verification</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="user_verification" <?php if($this->system->user_verification == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">User Verify By SMS</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="user_verify_by_sms" <?php if($this->system->user_verify_by_sms == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">User Verify By Email</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="user_verify_by_email" <?php if($this->system->user_verify_by_email == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Twilio Account Id</label>
                                                                <input type="text" name="twilio_account_id" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->twilio_account_id; ?>">
                                                                <span class="error text-danger validation-message" data-field="twilio_account_id"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Twilio Auth Token</label>
                                                                <input type="text" name="twilio_auth_token" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->twilio_auth_token; ?>">
                                                                <span class="error text-danger validation-message" data-field="twilio_auth_token"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Twilio Phone Number</label>
                                                                <input type="text" name="twilio_phone_number" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->twilio_phone_number; ?>">
                                                                <span class="error text-danger validation-message" data-field="twilio_phone_number"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('userVerificationSetting')">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade <?php if($tab == "notificationSetting"){ echo 'show active'; } ?>" id="v-pills-notification_setting" role="tabpanel" aria-labelledby="v-pills-notification_setting-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3>Notification Setting</h3>
                                                <form action="" id="form1_notificationSetting">
                                                    <div class="row">

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Push Notification</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="push_notification" <?php if($this->system->push_notification == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Notification</label>
                                                                <br/>
                                                                <label class="custom-toggle">
                                                                    <input type="checkbox" name="mail_notification" <?php if($this->system->mail_notification == 'Yes'){ echo 'checked'; } ?>>
                                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Onesignal App Id</label>
                                                                <input type="text" name="onesignal_app_id" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->onesignal_app_id; ?>">
                                                                <span class="error text-danger validation-message" data-field="onesignal_app_id"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Onesignal Auth Key</label>
                                                                <input type="text" name="onesignal_auth_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->onesignal_auth_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="onesignal_auth_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Onesignal Rest Api Key</label>
                                                                <input type="text" name="onesignal_rest_api_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->onesignal_rest_api_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="onesignal_rest_api_key"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Project Number</label>
                                                                <input type="text" name="project_number" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->project_number; ?>">
                                                                <span class="error text-danger validation-message" data-field="project_number"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Host</label>
                                                                <input type="text" name="mail_host" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_host; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_host"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Port</label>
                                                                <input type="text" name="mail_port" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_port; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_port"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Username</label>
                                                                <input type="text" name="mail_username" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_username; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_username"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Password</label>
                                                                <input type="text" name="mail_password" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_password; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_password"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Encryption</label>
                                                                <input type="text" name="mail_encryption" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_encryption; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_encryption"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail From Address</label>
                                                                <input type="text" name="mail_from_address" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->mail_from_address; ?>">
                                                                <span class="error text-danger validation-message" data-field="mail_from_address"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Twilio</label>
                                                                <input type="text" name="onesignal_rest_api_key" class="form-control" placeholder="only admin can see" value="<?php echo $this->system->onesignal_rest_api_key; ?>">
                                                                <span class="error text-danger validation-message" data-field="onesignal_rest_api_key"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('notificationSetting')">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade <?php if($tab == "privacyPolicy"){ echo 'show active'; } ?>" id="v-pills-privacy_policy" role="tabpanel" aria-labelledby="v-pills-privacy_policy-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3>Privacy Policy</h3>
                                                <form action="" id="form1_privacyPolicy">
                                                    <div class="row">

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <!-- <label class="form-control-label">Privacy Policy </label> -->
                                                                <textarea name="privacy_policy" id="privacy_policy" class="form-control" placeholder="Privacy Policy Content" rows="10"><?php echo $this->system->privacy_policy; ?></textarea>
                                                                <span class="error text-danger validation-message" data-field="privacy_policy"></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('privacyPolicy')">Submit</button>
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
