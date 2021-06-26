<div class="row justify-content-md-center">
    <div class="col-xl-10 order-xl-1">
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
                                    <label class="form-control-label">First Name *</label>
                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $form_data->firstname; ?>">
                                    <span class="error text-danger validation-message" data-field="firstname"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Last Name *</label>
                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $form_data->lastname; ?>">
                                    <span class="error text-danger validation-message" data-field="lastname"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">User Name *</label>
                                    <input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $form_data->username; ?>">
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
                                    <label class="form-control-label">Email *</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $form_data->email; ?>">
                                    <span class="error text-danger validation-message" data-field="email"></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone *</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $form_data->phone; ?>">
                                    <span class="error text-danger validation-message" data-field="phone"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-10 file-box-wrapper">
                                        <div class="form-group">
                                            <label class="form-control-label">Profile Pic</label>
                                            <label class="file-box">
                                                <span class="name-box">Drag or Select Files</span>
                                                <input type="hidden" name="image_old" id="image_old" value="<?php echo $form_data->profile; ?>"/>
                                                <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                        <img src="<?php echo base_url(CUSTOMER_IMG.$form_data->profile); ?>" id="" class="img-fluid" />
                                    </div>
                                </div>
                            </div>

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

                            <?php 
                                // echo "<pre>";
                                // print_r($form_data);
                                // exit;
                            ?>
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
                                    <?php foreach($form_data->addresses as $key=>$val){ ?>
                                        <div class="row address_row mb-2">
                                            <div class="col-md-2">
                                                <select name="address_type[]" class="form-control">
                                                    <option value="work" <?php if($val->type == "word"){ echo "selected"; } ?>>work</option>
                                                    <option value="gym" <?php if($val->type == "gym"){ echo "selected"; } ?>>gym</option>
                                                    <option value="school" <?php if($val->type == "school"){ echo "selected"; } ?>>school</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="address_address[]" class="form-control" placeholder="Address" value="<?php echo $val->address; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="address_zipcode[]" class="form-control" placeholder="Zip Code" value="<?php echo $val->zipcode;?>">
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-danger dlt_address_btn"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <br><br>

                            <div class="col-lg-12">
                                <h6 class="heading-small text-muted mt-3 bg-gray text-white"> &nbsp;&nbsp; Vehicle </h6>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-right">
                                    <button class="btn btn-sm btn-primary new_vehicle_btn">Add New Vehicle</button>
                                </div>
                                <br>

                                <div class="multiVehicleBox">
                                    <?php foreach($form_data->vehicles as $key=>$val){ ?>
                                        <div class="row vehicle_row mb-2">
                                            <div class="col-md-4">
                                                <input type="text" name="vehicle_name[]" class="form-control" placeholder="Vehicle Name" value="<?php echo $val->name; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="vehicle_year[]" id="" class="form-control select2">
                                                    <?php foreach(get_last_30_yr() as $val1){ ?>
                                                        <option value="<?php echo $val1; ?>" <?php if($val1 == $val->year){ echo "selected"; } ?>><?php echo $val1; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-lg-10 file-box-wrapper">
                                                        <label class="file-box">
                                                            <span class="name-box">Drag or Select Files</span>
                                                            <input type="hidden" name="vehicle_image_old[]" id="image_old" value="<?php echo $val->image; ?>"/>
                                                            <input type="file" name="vehicle_image[]" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-2 d-flex1 align-items-center pre-img-box">
                                                        <?php if($val->image != ""){ ?>
                                                            <img src="<?php echo base_url(VEHICLE_IMG.$val->image); ?>" id="" class="img-fluid" />
                                                        <?php }else{ ?>
                                                            <img src="<?php echo $this->assets.'img/no_image.png'; ?>" id="" class="img-fluid" />
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <button class="btn btn-danger dlt_vehicle_btn"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <h6 class="heading-small text-muted mt-3 bg-gray text-white"> &nbsp;&nbsp; Cards </h6>

                                <div class="text-right">
                                    <button class="btn btn-sm btn-primary new_card_btn">Add New Card</button>
                                </div>
                                <br>

                                <div class="multiCardBox">

                                    <?php foreach($form_data->cards as $key=>$val){ ?>
                                        <div class="row card_row mb-2">
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="card_name[]" class="form-control" placeholder="Name" value="<?php echo $val->name; ?>">
                                            </div>

                                            <div class="col-lg-6 mb-2">
                                                <input type="text" name="card_number[]" class="form-control" placeholder="Number" value="<?php echo $val->number; ?>" onkeypress="return isNumber(event)">
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <select name="card_expiry_month[]" id="" class="form-control select2">
                                                    <option value=""> -- Expiry Month --</option>
                                                    <?php foreach(get_month() as $val1){ ?>
                                                        <option value="<?php echo $val1; ?>" <?php if($val1 == $val->expiry_month){ echo "selected"; } ?> ><?php echo $val1; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <select name="card_expiry_year[]" id="" class="form-control select2">
                                                    <option value=""> -- Expiry Year --</option>
                                                    <?php foreach(get_next_30_yr() as $val1){ ?>
                                                        <option value="<?php echo $val1; ?>" <?php if($val1 == $val->expiry_year){ echo "selected"; } ?>><?php echo $val1; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                                <input type="text" name="card_cvv[]" class="form-control" placeholder="CVV" value="<?php echo $val->cvv; ?>" onkeypress="return isNumber(event)">
                                                <span class="error text-danger validation-message" data-field="cvv"></span>
                                            </div>

                                            <div class="col-md-3 text-right">
                                                <button class="btn btn-danger dlt_card_btn"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            
                            <br><br>
                        </div>


                    <input type="hidden" name="id" value="<?php echo $form_data->id; ?>">
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url(ADMIN.'customer'); ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary btn-submit" onclick="edit_data()">Submit</button>
            </div>
        </div>
    </div>
</div>