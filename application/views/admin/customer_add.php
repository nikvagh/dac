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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">First Name *</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="">
                                <span class="error text-danger validation-message" data-field="firstname"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Name *</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="">
                                <span class="error text-danger validation-message" data-field="lastname"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">User Name *</label>
                                <input type="text" name="username" class="form-control" placeholder="User Name" value="">
                                <span class="error text-danger validation-message" data-field="username"></span>
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

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Home Address </label>
                                <textarea name="address" class="form-control" placeholder="Home Address"></textarea>
                                <span class="error text-danger validation-message" data-field="address"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Profile Pic</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="image_old" id="image_old" value=""/>
                                            <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="" id="" class="img-fluid" />
                                </div>
                            </div>
                        </div>

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

                        <div class="col-lg-12">
                            <h6 class="heading-small text-muted mt-3 bg-gray text-white"> &nbsp;&nbsp; Address </h6>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Home Address *</label>
                                <textarea name="address" class="form-control" placeholder="Home Address"><?php if(isset($form_data->home_address->address)){ echo $form_data->home_address->address; } ?></textarea>
                                <span class="error text-danger validation-message" data-field="address"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Zip code *</label>
                                <input type="text" name="zipcode" class="form-control" placeholder="Zip code" value="<?php if(isset($form_data->home_address->zipcode)){ echo $form_data->home_address->zipcode; } ?>">
                                <span class="error text-danger validation-message" data-field="zipcode"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="text-right">
                                <button class="btn btn-sm btn-primary new_address_btn">Add New Addresses</button>
                            </div>
                            <br>

                            <div class="multiAddressBox">
                                <?php //foreach($form_data->addresses as $key=>$val){ ?>
                                    <!-- <div class="row address_row mb-2">
                                        <div class="col-md-2">
                                            <select name="address_type[]" class="form-control">
                                                <option value="work">work</option>
                                                <option value="gym">gym</option>
                                                <option value="school">school</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="address_address[]" class="form-control" placeholder="Address" value="">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="address_zipcode[]" class="form-control" placeholder="Zip Code" value="">
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger dlt_address_btn"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div> -->
                                <?php //} ?>
                            </div>
                        </div>
                        <br><br>

                        <div class="col-lg-12">
                            <h6 class="heading-small text-muted mt-3 bg-gray text-white"> &nbsp;&nbsp; Vehicle </h6>
                        </div>
                        <br>

                        <div class="col-lg-12">
                            <div class="text-right">
                                <button class="btn btn-sm btn-primary new_vehicle_btn">Add New Vehicle</button>
                            </div>
                            <br>
                            <div class="multiVehicleBox"></div>
                        </div>

                        <div class="col-lg-12">
                            <h6 class="heading-small text-muted mt-3 bg-gray text-white"> &nbsp;&nbsp; Cards </h6>

                            <div class="text-right">
                                <button class="btn btn-sm btn-primary new_card_btn">Add New Card</button>
                            </div>
                            <br>

                            <div class="multiCardBox"></div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'customer'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="create_data()">Submit</button>
            </div>
        </div>
    </div>
</div>