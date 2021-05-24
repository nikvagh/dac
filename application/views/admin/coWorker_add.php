<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">New <?php echo $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <h6 class="heading-small text-muted mb-4">Company information</h6>

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Service Provider *</label>
                                    <select name="sp_id" id="sp_id" class="form-control select2">
                                        <option value="">--select--</option>
                                        <?php foreach($serviceProvider as $key=>$val){ ?>
                                            <option value="<?php echo $val->sp_id; ?>"><?php echo $val->company_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="sp_id"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="">
                                    <span class="error text-danger validation-message" data-field="name"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="">
                                    <span class="error text-danger validation-message" data-field="email"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone *</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="">
                                    <span class="error text-danger validation-message" data-field="phone"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Start Time *</label>
                                    <input type="text" name="start_time" id="start_time" class="form-control" placeholder="Start Time" value="" autocomplete="off">
                                    <span class="error text-danger validation-message" data-field="start_time"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">End Time *</label>
                                    <input type="text" name="end_time" id="end_time" class="form-control" placeholder="End Time" value="" autocomplete="off">
                                    <span class="error text-danger validation-message" data-field="end_time"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Password *</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="">
                                    <span class="error text-danger validation-message" data-field="password"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Experience</label>
                                    <input type="text" name="experience" id="experience" class="form-control" placeholder="Experience" value="">
                                    <span class="error text-danger validation-message" data-field="experience"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                    <span class="error text-danger validation-message" data-field="description"></span>
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
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'serviceProvider'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>