
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>

                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <?php foreach($list as $key=>$val){ ?>
                                    <a class="mb-2 nav-link <?php if($val->heading_code == $tab){echo "active";} ?>" id="v-pills-<?php echo $val->heading_code; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $val->heading_code; ?>" role="tab" aria-controls="v-pills-<?php echo $val->heading_code; ?>" aria-selected="true"><?php echo $val->heading; ?></a>
                                <?php } ?>
                            </div>
                            <br>
                            <p><code><mark>{customer_name}</mark></code>: Name of customer</p>
                            <p><code><mark>{service_name}</mark></code>: Name of service</p>
                            <p><code><mark>{company_name}</mark></code>: Name of company</p>
                            <p><code><mark>{company_website}</mark></code>: Website of company</p>
                            <p><code><mark>{coupon}</mark></code>: Coupon Code</p>
                            <p><code><mark>{coupon_percentage}</mark></code>: Coupon Percentage</p>
                            <p><code><mark>{coupon_expiry}</mark></code>: Coupon Expiry</p>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                
                                <?php foreach($list as $key=>$val){ ?>
                                    <div class="tab-pane fade show <?php if($val->heading_code == $tab){echo "active";} ?>" id="v-pills-<?php echo $val->heading_code; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $val->heading_code; ?>-tab">
                                        <div class="card shadow">
                                            <div class="card-body">

                                                <h3><?php echo $val->heading; ?></h3>
                                                <form action="" id="form1_<?php echo $val->heading_code; ?>">
                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Title *</label>
                                                                <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $val->heading; ?>" readonly>
                                                                <span class="error text-danger validation-message" data-field="title"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Subject</label>
                                                                <input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo $val->subject; ?>">
                                                                <span class="error text-danger validation-message" data-field="subject"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Notification Content</label>
                                                                <textarea name="notification_content" class="form-control" placeholder="Notification Content" rows="10"><?php echo $val->notification_content; ?></textarea>
                                                                <span class="error text-danger validation-notification_content" data-field="notification_content"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Mail Content</label>
                                                                <textarea name="mail_content" id="mail_content_<?php echo $val->heading_code; ?>" class="form-control" placeholder="Mail Content"><?php echo $val->mail_content; ?></textarea>
                                                                <span class="error text-danger validation-mail_content" data-field="mail_content"></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <input type="hidden" name="heading_code" value="<?php echo $val->heading_code; ?>"/>
                                                </form>

                                                <div class="text-right">
                                                    <button class="btn btn-primary btn-submit" onclick="edit_data('<?php echo $val->heading_code; ?>')">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
