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
                    <!-- <h6 class="heading-small text-muted mb-4">Company information</h6> -->
                    <!-- <div class="pl-lg-4"> -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="">
                                    <span class="error text-danger validation-message" data-field="name"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Amount *</label>
                                    <input type="text" name="amount" class="form-control" placeholder="Amount" value="">
                                    <span class="error text-danger validation-message" data-field="amount"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Duration * (In Minutes)</label>
                                    <input type="text" name="duration" class="form-control" placeholder="Duration" value="">
                                    <span class="error text-danger validation-message" data-field="duration"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                    <span class="error text-danger validation-message" data-field="description"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-10 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">Image</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <!-- <input type="hidden" name="profile_pic_old" id="profile_pic_old" value=""/> -->
                                                <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                        <img src="" id="" class="img-fluid"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Categories *</label>
                                    <select name="categories[]" id="categories" class="form-control select2" multiple>
                                        <!-- <option hidden="hidden" value="">--select--</option> -->
                                        <?php foreach($categories as $key=>$val){ ?>
                                            <option value="<?php echo $val->category_id; ?>"><?php echo $val->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error text-danger validation-message" data-field="categories[]"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Status *</label>
                                    <br/>
                                    <label class="custom-toggle">
                                        <input type="checkbox" name="status" checked>
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    <!-- </div> -->
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'package'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>