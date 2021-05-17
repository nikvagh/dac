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
                    <?php 
                        // echo "<pre>";
                        // print_r($this->member);
                    ?>
                    <table class="table align-items-center dataTable table-hover table-striped">
                        <tbody class="list">
                            <tr>
                                <td width="25%">User Name</td>
                                <td><?php echo $this->member->loginData->username; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $this->member->loginData->email; ?></td>
                            </tr>
                            <tr>
                                <td>Referral Code</td>
                                <td><?php echo $this->member->loginData->refer_code; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">First Name *</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $this->member->loginData->firstname; ?>">
                                <span class="error text-danger validation-message" data-field="firstname"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Last Name *</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo $this->member->loginData->lastname; ?>">
                                <span class="error text-danger validation-message" data-field="lastname"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Phone *</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $this->member->loginData->phone; ?>">
                                <span class="error text-danger validation-message" data-field="phone"></span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Password (New Password Only)</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" value="">
                                <span class="error text-danger validation-message" data-field="password"></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-10 file-box-wrapper">
                                    <div class="form-group">
                                        <label class="form-control-label">Profile</label>
                                        <label class="file-box">
                                            <span class="name-box">Drag or Select Files</span>
                                            <input type="hidden" name="image_old" id="image_old" value="<?php echo $this->member->loginData->profile; ?>"/>
                                            <input type="file" name="image" class="form-control input-single" onchange="preview(this);" accept=".png, .jpg, .jpeg, .svg"/>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-items-center pre-img-box">
                                    <img src="<?php echo base_url(CUSTOMER_IMG.$this->member->loginData->profile); ?>" id="" class="img-fluid" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Address *</label>
                                <textarea name="address" id="" cols="30" rows="3" class="form-control"><?php echo $this->member->loginData->address; ?></textarea>
                                <span class="error text-danger validation-message" data-field="address"></span>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $this->member->loginData->id; ?>">
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